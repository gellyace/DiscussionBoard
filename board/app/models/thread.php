<?php
class Thread extends AppModel
{
    const MIN_LENGTH = 1;
    const MAX_LENGTH = 30;

    public $validation = array(
        'title'=> array(
            'length' => array('validate_between', self::MIN_LENGTH, self::MAX_LENGTH),
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
        return (int) $db->value('SELECT COUNT(*) FROM thread');
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
            throw new ValidationException('invalid thread or comment');
        }
                    
        $db = DB::conn();
        $db->begin();
           
        $db->query('INSERT INTO thread SET title = ?, created = NOW()', array($this->title));

        $this->id = $db->lastInsertId();
                    
        // write first comment at the same time
        $comment->write($this->id);
                    
        $db->commit();
    }        
}
