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
        
    public static function getAll($offset, $limit, $thread_id)
    {
        $comments = array();
        $db = DB::conn();
        $rows = $db->rows(
            sprintf("SELECT * FROM comment WHERE thread_id=? LIMIT %d, %d", $offset, $limit),
            array($thread_id)
        );
        
        foreach ($rows as $row) {
            $row['username'] = Users::getUsernameById($row['user_id']);
            $comments[] = new self($row);
        }
        return $comments;
    }
       
    public static function countAll($thread_id)
    {
        $db = DB::conn();
        return $db->value('SELECT COUNT(*) FROM comment WHERE thread_id = ?', array($thread_id));
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
            'body' => $this->body
        );

        $db->insert(self::COMMENT_TABLE, $params);
        $db->commit();
    }

}
