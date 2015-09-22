<?php
class Users extends AppModel
{
	
	public $validation = array(
		'username'=> array('length' => array('validate_between', 1,30),),
		'firstname'=> array('length' => array('validate_between', 1,30),),
		'lastname'=> array('length' => array('validate_between', 1,30),),
		'email'=> array('length' => array('validate_between', 1,30),),
		'password'=> array('length' => array('validate_between', 1,30),),
		);
    
	public function generateHash($password){
		if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
			$salt = '$2y$11$'.substr(md5(uniqid(rand(), true)), 0, 22);
			return crypt($password, $salt);
		}
	}

	public function verifyPassword(Users $user, $hashedPassword){
		//return crypt($user->password, $hashedpassword) == $hashedpassword;
		if(!password_verify($this->password, $hashedPassword)) {
			echo "Password not valid";
		}
	}

    public function register(Users $user){
    	
    	$hashedPassword = self::generateHash($this->password);

        $this->validate();
        
        if ($this->hasError()) {                    
            throw new ValidationException('Registration not valid');
        }

    	$db = DB::conn();
        $db->begin();

          
        $db->query('INSERT INTO users SET username = ?, firstname = ?, lastname = ?, email = ?, password = ?, created = NOW()', array($user->username, $user->firstname, $user->lastname, $user->email, $hashedPassword));

        $this->id = $db->lastInsertId();
                    
        
        $db->commit();
    }

    public function getAll(){
    	$users = array();

    	$db = DB::conn();

    	$rows = $db->rows('Select * FROM users');

    	foreach ($rows as $row) {
    		$users[] = new Users($row);
    	}
    	return $users;
    }
}
