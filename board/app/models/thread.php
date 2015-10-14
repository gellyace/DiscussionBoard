<?php
class Thread extends AppModel
{
    const MIN_TITLE_LENGTH = 1;
    const MAX_TITLE_LENGTH = 30;
    
    const THREAD_TABLE = 'thread';
    const INACTIVE = 'Inactive';

    public $validation = array(
        'title'=> array(
            'length' => array('validate_between', self::MIN_TITLE_LENGTH, self::MAX_TITLE_LENGTH),
        ),
    );

    public static function getAll($offset, $limit)
    {
        $threads = array();
        $db = DB::conn();
        $user = implode(',',array_values(self::getAllInactiveUser())); // added

        $rows = $db->rows( sprintf("SELECT * FROM thread WHERE user_id not in (?) LIMIT %d, %d", 
            $offset, $limit), array($user));

        foreach ($rows as $row) {
            $threads[] = new self($row);
        }
        return $threads;
    }

    public static function countAll()
    {
        $db = DB::conn();
        $user = implode(',',array_values(self::getAllInactiveUser())); // added
        return $db->value('SELECT COUNT(*) FROM thread WHERE user_id not in (?)', array($user));
    }

    public static function get($id)
    {
        $db = DB::conn();
        $row = $db->row('SELECT * FROM thread WHERE id = ?', array($id));

        if(!$row){
            throw new RecordNotFoundException('No Record Found');
        }
        return new self($row);
    }

                
    public function create(Comment $comment)
    {
        $this->validate();
        $comment->validate();
        
        if ($this->hasError() || $comment->hasError()) {                    
            throw new ValidationException('Ivalid thread or comment');
        }
                    
        $db = DB::conn();
        
        $params = array(
            'title' => $this->title,
            'category' => $this->category,
            'user_id' => $this->user_id,
        );
        
        $db->insert(self::THREAD_TABLE, $params);

        $this->id = $db->lastInsertId(); 

        $comment->write($this->id);
    }

    public function edit()
    {
        $this->validate();
        
        if ($this->hasError()) {                    
            throw new ValidationException('Ivalid thread');
        }
                    
        $db = DB::conn();
        
        $db->query("UPDATE thread SET title = ?, category = ?, date_modified = NOW() WHERE id = ?", array($this->title, $this->category, $this->id));
    }

    public static function getById($thread_id)
    {
        $db = DB::conn();
        $row = $db->row('SELECT * FROM thread WHERE id = ?', array($thread_id));
        
        if(!$row){
            throw new RecordNotFoundException('No Record Found');
        }
        return new self($row);
    }

    public function delete($id)
    {                    
        $db = DB::conn();
        $db->begin();
        $rows = $db->rows('SELECT id FROM comment WHERE thread_id = ?', array($id));

        foreach ($rows as $row) {
            Likes::deleteByCommentId($row['id']);
        }
        
        $db->query("DELETE FROM comment WHERE thread_id = ?", array($id));        
        $db->query("DELETE FROM thread WHERE id = ?", array($id));
        $db->commit();
    }

    public static function trending()
    {
        $threads = array();
        $db = DB::conn();
        $mostComments = Comment::sortComments();
        $user = implode(',',array_values(self::getAllInactiveUser())); // added
        
        foreach ($mostComments as $row) {
            $rows = $db->row("SELECT * FROM thread WHERE id=?", array($row['thread_id']));
            $rows['count'] = $row['comment_count'];
            $rows['date_created'] = $rows['date_created'];
            $rows['category'] = $rows['category'];
            $threads[] = new self($rows);
        }
        return $threads;
    }
    
    public static function searchProfile($keyword)
    {
        $users = array();
        $db = DB::conn();
       
        $rows = $db->rows("SELECT * FROM user WHERE username LIKE ? AND id not in (?)", array("%{$keyword}%", self::getAllInactiveUser()));
        
        foreach ($rows as $row) {
            $users[] = new self($row);
        }
        return $users;  
    }

    public static function searchThread($keyword)
    {
        $threads = array();
        $db = DB::conn();
        
        $rows = $db->rows("SELECT * FROM thread WHERE (title LIKE ? AND user_id not in (?) )OR (category LIKE ? AND user_id not in (?))", array("%{$keyword}%", self::getAllInactiveUser(), "%{$keyword}%", self::getAllInactiveUser()));
        
        foreach ($rows as $row) {
            $threads[] = new self($row);
        }
        return $threads;  
    }

    public static function searchComment($keyword)
    {
        $comments = array();
        $db = DB::conn();
        
        $rows = $db->rows("SELECT * FROM comment WHERE body LIKE ? AND user_id not in (?)", array("%{$keyword}%", self::getAllInactiveUser()));
        
        foreach ($rows as $row) {
            $comments[] = new self($row);
        }
        return $comments;  
    }

    public static function getAllInactiveUser()
    {
        $users = array();
        $db = DB::conn();
        
        $rows = $db->rows("SELECT id FROM user WHERE status = ?", array(self::INACTIVE));
       
        foreach ($rows as $row) {
            $users[] = $row['id'];
        }

        return $users;
        

        //return $db->columns("SELECT id FROM user WHERE status = ?", array(self::INACTIVE));
    }
}
