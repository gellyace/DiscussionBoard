<?php
class UsersController extends AppController
{

	const REGISTER_USER = 'register';
	const REGISTER_END_USER = 'register_end';
	const LOGIN_USER = 'index';
	const LOGIN_END_USER = 'index_end';

    public function index() //login ~ index.php
    {   
    	$user = new Users;
    	$page = Param::get('page_next', self::LOGIN_USER);
    	
    	switch ($page) {
    		case self::LOGIN_USER:
    			break;

    		case self::LOGIN_END_USER:
    			$user->username = Param::get('username');                
                $user->password=Param::get('password');
                
                try {
                	$user_account = $user->index($user);
                    session_start();
                    $_SESSION['username'] = $user_account->username;
                    $_SESSION['id'] = $user_account->id;

                } catch (RecordNotFoundException $e) {
                    $page=self::LOGIN_USER;
                }
    			break;

    		default:
    			throw new RecordNotFoundException("{$page} is not found");
    			break;
    	}
    		$this->set(get_defined_vars());
            $this->render($page);
    }

    public function register() 
    {
    	$user = new Users;
        $page = Param::get('page_next', self::REGISTER_USER);

        switch ($page) {
            case self::REGISTER_USER:
                break;
                
            case self::REGISTER_END_USER:
                $user->username = Param::get('username');
                $user->firstname=Param::get('firstname');
                $user->lastname=Param::get('lastname');
                $user->email=Param::get('email');
                $user->password=Param::get('password');
                try {
                    $user->register($user);
                } catch (ValidationException $e) {
                    $page=self::REGISTER_USER;
                }
                    break;

            default:
                throw new RecordNotFoundException("{$page} is not found");                    
                break;
        }
            $this->set(get_defined_vars());
            $this->render($page);
    }

    
    public function logout(){
    	$this->redirect($this->Auth->logout());
    }
}
