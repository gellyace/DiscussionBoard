<?php
class Comment extends AppModel
{
    const MIN_COMMENT_LENGTH = 1;
    const MAX_COMMENT_LENGTH = 300;
    
    const COMMENT_TABLE = 'comment';

    public $validation = array(
        'body' => array(
            'length' => array('validate_between', self::MIN_COMMENT_LENGTH , self::MAX_COMMENT_LENGTH),
        ), 
    );
        
    public static function getAll($offset, $limit, $thread_id, $user_id)
    {
        $comments = array();
        $db = DB::conn();
        $user = implode(',',array_values(Thread::getAllInactiveUser())); 
        $rows = $db->rows(
            sprintf("SELECT * FROM comment WHERE thread_id=? and user_id not in (?) LIMIT %d, %d", $offset, $limit),
            array($thread_id, $user));
        
        foreach ($rows as $row) {
            $row['username'] = Users::getUsernameById($row['user_id']);
            $row['is_like'] = Likes::isLiked($user_id, $row['id']);
            $comments[] = new self($row);
        }
        return $comments;
    }
       
    public static function countAll($thread_id)
    {
        $db = DB::conn();
        $user = implode(',',array_values(Thread::getAllInactiveUser())); 
        return $db->value('SELECT COUNT(*) FROM comment WHERE thread_id = ? AND user_id not in (?)', array($thread_id, $user));
    }

    public static function sortComments()
    {
        $db = DB::conn();
        $user = implode(',',array_values(Thread::getAllInactiveUser())); 
        return $db->rows('SELECT COUNT(*) as comment_count, thread_id, user_id FROM comment WHERE user_id not in (?)
                            GROUP BY thread_id ORDER BY comment_count DESC, date_created DESC', array($user)); 
    }

    public static function countAllLikes($comment_id)
    {
        $db = DB::conn();
        $user = implode(',',array_values(Thread::getAllInactiveUser())); 
        return $db->value('SELECT COUNT(*) FROM liked WHERE comment_id = ? and user_id not in (?)', array($comment_id,$user));
    }
     
    public function write($thread_id)
    {
        if(!$this->validate()){
            throw new ValidationException("Invalid Comment");
        }

        $db = DB::conn();
            
        $params = array(
            'thread_id' => $thread_id,
            'user_id' => get_session_id(),
            'body' => $this->body,
        );

        $db->insert(self::COMMENT_TABLE, $params);
    }

    public static function getById($comment_id)
    { 
        $db = DB::conn();
        $row = $db->row('SELECT * FROM comment WHERE id = ?', array($comment_id));
        
        if(!$row){
            throw new RecordNotFoundException('No Record Found');
        }
        return new self($row);
    }

    public function edit()
    {
        $this->validate();
        if($this->hasError()){
            throw new ValidationException("Invalid Comment");
        }
                    
        $db = DB::conn();

        $db->query("UPDATE comment SET body = ?, date_modified = NOW() WHERE id = ?", array($this->body, $this->id));
    }

    public function delete($id)
    {    
        try {                
            $db = DB::conn();
            $db->begin();
            Likes::deleteByCommentId($id);
            $db->query("DELETE FROM comment WHERE id = ?", array($id));
            $db->commit();

        } catch (Exception $e) {
            $db->rollback();
        }
    }

    public static function deleteByThreadId($comment_id)
    {
        $db = DB::conn();
        $db->query('DELETE FROM comment WHERE thread_id = ?', array($comment_id));
    }

    public static function searchComment($keyword)
    {
        $comments = array();
        $db = DB::conn();
        
        $rows = $db->rows("SELECT * FROM comment WHERE body LIKE ? AND user_id not in (?)", array("%{$keyword}%", Thread::getAllInactiveUser()));
        
        foreach ($rows as $row) {
            $comments[] = new self($row);
        }

        return $comments;  
    }
}
