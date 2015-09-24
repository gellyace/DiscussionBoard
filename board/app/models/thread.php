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

        public static function getAll()
        {
            $threads = array();

            $db = DB::conn();

            $rows = $db->rows('Select * FROM thread');

            foreach ($rows as $row) {
                $threads[] = new Thread($row);
            }
            return $threads;
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

        public function getComments()
        {
            $comments = array();

            $db = DB::conn();

            $rows = $db->rows('SELECT * FROM comment WHERE thread_id = ? ORDER BY created ASC', 
                                array($this->id));

            foreach ($rows as $row) {
                $comments[] = new Comment($row);
            }
            return $comments;
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
?>