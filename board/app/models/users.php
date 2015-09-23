<?php
class Users extends AppModel
{
	const MIN_LENGTH = 1;	
	const MIN_PASSWORD_LENGTH = 6;
	const MIN_EMAIL_LENGTH = 11;
	const MAX_LENGTH = 30;

	public $user_validated = true;

	public $validation = array(
		'username'=> array(
			'length' => array('validate_between',self::MIN_LENGTH,self::MAX_LENGTH),
			),
		
		'firstname'=> array(
			'length' => array('validate_between', self::MIN_LENGTH,self::MAX_LENGTH),
			),
		
		'lastname'=> array(
			'length' => array('validate_between', self::MIN_LENGTH,self::MAX_LENGTH),
			),
		
		'email'=> array(
			'length' => array('validate_between', self::MIN_EMAIL_LENGTH,self::MAX_LENGTH),
			),
		
		'password'=> array(
			'length' => array('validate_between', self::MIN_PASSWORD_LENGTH,self::MAX_LENGTH),
			)
		);
    
    // Encrypts the submitted password of the user using the Blowfish algorithm
	public function generateHash($password)
	{
		if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
			$salt = '$2y$11$'.substr(md5(uniqid(rand(), true)), 0, 22);
			return crypt($password, $salt);
		}
	}


	public function verifyPassword($userPassword, $hashedPassword)
	{		
		if(crypt($userPassword, $hashedPassword) == $hashedPassword) 
			return true;
	}

	public function getHashedPassword($username)
	{
		$db = DB::conn();

    	$row = $db->row('SELECT password FROM users WHERE username = ?', array($username));

    	return $row['password'];
	}

	public function getId($username)
	{
		$db = DB::conn();

    	$row = $db->row('SELECT id FROM users WHERE username = ?', array($username));

    	return $row['id'];
	}


	
    public function register(Users $user)
    {
        
        if (!$this->validate()) {                    
            throw new ValidationException('Registration not valid');
        }

        $hashedPassword = self::generateHash($this->password); //encrypts password before storing it

    	$db = DB::conn();
        $db->begin();

        $db->query('INSERT INTO users SET username = ?, firstname = ?, lastname = ?, email = ?, password = ?, created = NOW()', array($user->username, $user->firstname, $user->lastname, $user->email, $hashedPassword));
        $this->id = $db->lastInsertId();
                   
        
        $db->commit();
    }

    public function index(Users $user) // aunthentication of users ~ login page
    {
    	$username = stripslashes($this->username);
    	$password = stripslashes($this->password);

    	$username = mysql_real_escape_string($username);
    	$password = mysql_real_escape_string($password);
    	
    	$hashedPassword = self::getHashedPassword($username);
    	$id = self::getId($username);

    		
    		if (self::verifyPassword($password, $hashedPassword)) {    

    			session_start();
    			$_SESSION['sid'] = session_id();
    			redirect(url('users/index_end'));
    		}
    		else{    
    			var_dump($password);
    			var_dump($hashedPassword);			
    			$this->user_validated = false;
    			throw new RecordNotFoundException("No Record Found");
    		}
    }

    public function logout()
    {
    	
    }

    
public function redirect($url)
    {        
    	header('Location: '.$url);
    	exit();
    	
    }
}
