<?php
class UsersController extends AppController
{
    const REGISTER_USER = 'register';
    const REGISTER_END_USER = 'register_end';
    const LOGIN_USER = 'login';
    const LOGIN_END_USER = 'login_end';

    public function login() 
    {   
        $user = new Users;
        $page = Param::get('page_next', self::LOGIN_USER);
        
        switch ($page){
            case self::LOGIN_USER:
                break;

            case self::LOGIN_END_USER:
                $user->username = trim(Param::get('username'));                
                $user->password = trim(Param::get('password'));
                try {
                    $user_account = $user->login($user);
                    session_start();
                    $_SESSION['username'] = $user_account->username;
                    $_SESSION['id'] = $user_account->id;

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
        $user = new Users;
        $page = Param::get('page_next', self::REGISTER_USER);

        switch ($page) {
            case self::REGISTER_USER:
                break;
                
            case self::REGISTER_END_USER:
                $user->username = trim(Param::get('username'));
                $user->firstname = trim(Param::get('firstname'));
                $user->lastname = trim(Param::get('lastname'));
                $user->email = trim(Param::get('email'));
                $user->password = trim(Param::get('password'));
                try {
                    $user->register($user);
                    session_start();
                    $_SESSION['username'] = $user->username;
                    $_SESSION['id'] = $user->id;
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
        session_start();
        session_unset($_SESSION);
        session_destroy();
        redirect('login');
        exit();
    }
        
}
