<?php
class Search extends AppModel
{
	public function searchProfile($keyword)
	{
		$users = array();
		$db = DB::conn();
		$db->begin();
		$rows = $db->rows('SELECT username,firstname,lastname,email FROM user WHERE username LIKE %:username% OR firstname LIKE %:firstname% OR lastname LIKE %:lastname% OR email LIKE %:email% ', array($keyword));
		
		foreach ($rows as $row) {
            $users[] = new self($row);
        }
        return $users;	
	}

	
}
