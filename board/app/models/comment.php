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