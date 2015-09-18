<?php
    /**
    * 
    */
    class Thread extends AppModel
    {
    	
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
    }
?>