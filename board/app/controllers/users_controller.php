<?php
class UsersController extends AppController
{
    // Declare constants to avoid the use of "magic numbers"
    const REGISTER_USER = 'register';
    const REGISTER_END_USER = 'register_end';
    const LOGIN_USER = 'login';
    const LOGIN_END_USER = 'login_end';

    public function login() 
    {   
        $user = new Users();
        $page = Param::get('page_next', self::LOGIN_USER);
        
        switch ($page){
            case self::LOGIN_USER:
                break;

            case self::LOGIN_END_USER:
                $user->username = Param::get('username');                
                $user->password = Param::get('password');
                try {
                    $user_account = $user->login($user);
                    set_session_username($user_account->username);
                } catch (RecordNotFoundException $e){
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
        $user = new Users();
        $page = Param::get('page_next', self::REGISTER_USER);

        switch ($page) {
            case self::REGISTER_USER:
                break;
                
            case self::REGISTER_END_USER:
                $user->username = Param::get('username');
                $user->firstname = Param::get('firstname');
                $user->lastname = Param::get('lastname');
                $user->email = Param::get('email');
                $user->password = Param::get('password');
                try {
                    $user->register($user);
                    set_session_username($user->username);
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

    public function logout()
    {
        session_destroy();
        redirect('login');
        exit();
    }  
}
