<?php
class Users extends AppModel
{
    const MIN_DETAILS_LENGTH = 1;   
    const MIN_PASSWORD_LENGTH = 6;
    const MIN_EMAIL_LENGTH = 11;
    const MAX_DETAILS_LENGTH = 30;
    
    const USERS_TABLE = 'user';

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
        $row = $db->row('SELECT password FROM user WHERE username = ?', array($username));
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

        $user_account = $db->row('SELECT id, username, password FROM user WHERE BINARY username = ?', array($username));
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
        $row = $db->row('SELECT * FROM user WHERE username = ?', array($username));

        return !$row ? false : new self($row);
    } 

    public static function getEmail($email)
    {
        $db = DB::conn();
        $row = $db->row('SELECT * FROM user WHERE email = ?', array($email));

        return !$row ? false : new self($row);
    }

    public static function getUsernameById($id)
    {
        $db = DB::conn();
        $row = $db->row('SELECT username FROM user WHERE id = ?', array($id));
        return $row['username'];
    }

    public static function getEmailById($id)
    {
        $db = DB::conn();
        $row = $db->row('SELECT email FROM user WHERE id = ?', array($id));
        return $row['email'];
    }

    public static function getIdByUsername($username)
    {
        $db = DB::conn();
        $row = $db->row('SELECT id FROM user WHERE username = ?', array($username));
        return $row['id'];
    }

    public static function viewProfile($user_id)
    {
        $users = array();
        $session_id = get_session_id();


        $db = DB::conn();
        $rows = $db->rows('SELECT * FROM user WHERE id = ?', array($user_id));

        foreach ($rows as $row) {
            $users[] = new self($row);
        }
        return $users; 
    }

    public static function viewThreads($user_id)
    {
        $user_threads = array();
        $session_id = get_session_id();

        $db = DB::conn();
        $rows = $db->rows('SELECT * FROM thread WHERE user_id = ?', array($user_id));

        foreach ($rows as $row) {
            $user_threads[] = new self($row);
        }
        return $user_threads; 
    }

    public static function getById($user_id)
    {
        $db = DB::conn();
        $row = $db->row('SELECT * FROM user WHERE id = ?', array($user_id));
        
        if(!$row){
            throw new RecordNotFoundException('No Record Found');
        }
        return new self($row);
    }

    public static function get($id)
    {
        $db = DB::conn();
        $row = $db->row('SELECT * FROM user WHERE id = ?', array($id));

        if(!$row){
            throw new RecordNotFoundException('No Record Found');
        }
        return new self($row);
    }

    public function edit()
    {
        $hashedPassword = self::getHashedPassword(get_session_username());

        $change_password = !empty($this->current_password) || !empty($this->new_password);
        
        if(empty($this->new_password)){
            if(self::verifyPassword($this->current_password, $this->password)){
                unset ($this->validation_errors['username']);
                unset ($this->validation_errors['password']);
                unset ($this->validation_errors['email']);               
            } else {
                echo "Password does not match";
                throw new ValidationException('Update not valid.');   
            }
        } else {
            if(self::verifyPassword($this->current_password, $this->password)){
                $this->password = self::generateHash($this->new_password);
                unset ($this->validation_errors['username']);
                unset ($this->validation_errors['email']);               
            } else {
                echo "Password does not match";
                throw new ValidationException('Update not valid.');   
            }
        }

        if($this->hasError()){
            throw new ValidationException();       
        }
     
        $id = get_session_id();
        $db = DB::conn();
        $db->begin();

        $params = array(
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'password' => $this->password,
        );
        $where_params = array('id' => $id);

        $db->update(self::USERS_TABLE, $params,$where_params);
        $db->commit();
    }

    public function deactivate()
    {
        if (!$this->validate()) {
            throw new ValidationException('Deactivate not valid');
        }

        $id = get_session_id();
        $db = DB::conn();
       
        $params = array(
            'status' => 'Inactive',
        );
        $where_params = array('id' => $id);

        $db->update(self::USERS_TABLE, $params,$where_params);
    }

    public static function reactivate()
    {
        $id = get_session_id();
        $db = DB::conn();
       
        $params = array(
            'status' => 'Active',
        );
        $where_params = array('id' => $id);

        $db->update(self::USERS_TABLE, $params,$where_params);
    }

    public static function checkStatus()
    {
        $db = DB::conn();
        $username = get_session_username();
        $user_status = $db->row('SELECT status FROM user WHERE username = ?', array($username));

        if ($user_status['status'] == 'Inactive'){
                self::reactivate();
        }
    }
}
