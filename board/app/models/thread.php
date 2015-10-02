<?php
class Thread extends AppModel
{
    const MIN_TITLE_LENGTH = 1;
    const MAX_TITLE_LENGTH = 30;
    
    const THREAD_TABLE = 'thread';

    public $validation = array(
        'title'=> array(
            'length' => array('validate_between', self::MIN_TITLE_LENGTH, self::MAX_TITLE_LENGTH),
        ),
    );

    public static function getAll($offset, $limit)
    {
        $threads = array();
        $db = DB::conn();
        $rows = $db->rows( sprintf("SELECT * FROM thread ORDER BY id LIMIT %d, %d", $offset, $limit));

        foreach ($rows as $row) {
            $threads[] = new self($row);
        }
        return $threads;
    }

    public static function countAll()
    {
        $db = DB::conn();
        return $db->value('SELECT COUNT(*) FROM thread');
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
        $db->begin();
        
        $params = array(
            'title' => $this->title
        );

        $db->insert(self::THREAD_TABLE, $params);
        $this->id = $db->lastInsertId(); 

        // write first comment at the same time
        $comment->write($this->id);
        $db->commit();
    }        
}
