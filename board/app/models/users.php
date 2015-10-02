<?php
class Users extends AppModel
{
    const MIN_DETAILS_LENGTH = 1;   
    const MIN_PASSWORD_LENGTH = 6;
    const MIN_EMAIL_LENGTH = 11;
    const MAX_DETAILS_LENGTH = 30;
    
    const USERS_TABLE = 'users';

    public $user_validated = true;
    public $validation = array(
        'username'=> array(
            'length' => array('validate_between',self::MIN_DETAILS_LENGTH, self::MAX_DETAILS_LENGTH),
            'alphanumeric' => array('validate_alphanumeric'),
            'exists_username' => array('username_exists'),
        ),
        'firstname'=> array(
            'length' => array('validate_between', self::MIN_DETAILS_LENGTH, self::MAX_DETAILS_LENGTH),
            'name' => array('validate_name'),
        ),
        'lastname'=> array(
            'length' => array('validate_between', self::MIN_DETAILS_LENGTH, self::MAX_DETAILS_LENGTH),
            'name' => array('validate_name'),
        ),
        'email'=> array(
            'length' => array('validate_between', self::MIN_EMAIL_LENGTH, self::MAX_DETAILS_LENGTH),
            'format' =>array('validate_email'),
            'exists_email' => array('email_exists'),
        ),
        'password'=> array(
            'length' => array('validate_between', self::MIN_PASSWORD_LENGTH, self::MAX_DETAILS_LENGTH),
        )
    );
    
    // Encrypts the submitted password of the user using the Blowfish Algorithm
    public function generateHash($password)
    {
        if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
            $salt = '$2y$11$'.substr(md5(uniqid(rand(), true)), 0, 22);
            return crypt($password, $salt);
        }
    }

    public function verifyPassword($userPassword, $hashedPassword)
    {       
        if(crypt($userPassword, $hashedPassword) == $hashedPassword) {
            return true;
        }
    }

    public function getHashedPassword($username)
    {
        $db = DB::conn();
        $row = $db->row('SELECT password FROM users WHERE username = ?', array($username));
        return $row['password'];
    }
    
    public function register(Users $user)
    {
        if (!$this->validate()) {
            throw new ValidationException('Registration not valid');
        }

        $hashedPassword = self::generateHash($this->password); //encrypts password before storing it

        $db = DB::conn();
        $db->begin();

        $params = array(
            'username' => $this->username,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'password' => $hashedPassword
        );

        $db->insert(self::USERS_TABLE, $params);
        $db->commit();
    }

    public function login(Users $user) 
    {
        $username = stripslashes($this->username);
        $password = stripslashes($this->password);

        $username = mysql_real_escape_string($username);
        $password = mysql_real_escape_string($password);
        
        $db = DB::conn();

        $user_account = $db->row('SELECT id, username, password FROM users WHERE username = ?', array($username));
        $hashedPassword = self::getHashedPassword($username);

        if (!$user_account OR !self::verifyPassword($password, $hashedPassword)) {
            $this->user_validated = false;
            throw new RecordNotFoundException("Invalid Information");
        }
        return new self($user_account);
    }

    public static function getUsername($username)
    {
        $db = DB::conn();
        $row = $db->row('SELECT * FROM users WHERE username = ?', array($username));

        return !$row ? false : new self($row);
    } 

    public static function getEmail($email)
    {
        $db = DB::conn();
        $row = $db->row('SELECT * FROM users WHERE email = ?', array($email));

        return !$row ? false : new self($row);
    }  
}
