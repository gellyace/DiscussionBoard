<?php
class Comment extends AppModel
{
    const MIN_LENGTH = 1;
    const MAX_LENGTH = 300;

    public $validation = array(
        'body' => array(
            'length' => array('validate_between', self::MIN_LENGTH , self::MAX_LENGTH),
        ), 
    );
        
    public static function getAll($offset, $limit, $thread_id)
    {
        $comments = array();
        $db = DB::conn();
        $rows = $db->rows( sprintf("SELECT * FROM comment  WHERE thread_id = ? ORDER BY created LIMIT %d, %d", $offset, $limit), array($thread_id));

        foreach ($rows as $row) {
            $comments[] = new self($row);
        }
        return $comments;
    }
       
    public static function countAll($thread_id)
    {
        $db = DB::conn();
        return (int) $db->value('SELECT COUNT(*) FROM comment WHERE thread_id = ?', array($thread_id));
    }
     
    public function write($thread_id)
    {
        if(!$this->validate()){
            throw new ValidationException("Invalid Comment");
        }

        $db = DB::conn();
        $db->query('INSERT INTO comment SET thread_id = ?, username = ?, body = ?, created = NOW()', 
                    array($thread_id, $this->username, $this->body));
    }
}