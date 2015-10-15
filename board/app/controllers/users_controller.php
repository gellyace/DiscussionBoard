<?php
class UsersController extends AppController
{
    // Declare constants to avoid the use of "magic numbers"
    const REGISTER_USER = 'register';
    const REGISTER_END_USER = 'register_end';
    const LOGIN_USER = 'login';
    const LOGIN_END_USER = 'login_end';
    const VIEW_OWN = 'view_end';
    const EDIT = 'edit';
    const EDIT_END = 'edit_end';
    const DEACTIVATE_USER = "deactivate_end";

    public function login() 
    {   
        $user = new Users();
        $page = Param::get('page_next', self::LOGIN_USER);

        if(isset($_SESSION['username'])){
            redirect(url('thread/index'));
        }      

        switch ($page){
            case self::LOGIN_USER:
                break;

            case self::LOGIN_END_USER:
                $user->username = Param::get('username');                
                $user->password = Param::get('password');
                try {
                    $user_account = $user->login($user);
                    set_session($user_account->username, $user_account->id);
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
        
        if(isset($_SESSION['username'])){
            redirect(url('thread/index'));
        }
        
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
                    $user_account = $user->register($user);
                    set_session($user_account->username, $user_account->id);
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
        session_destroy();
        redirect('login');
        exit();
    }

    public function view_end()
    {
        check_user_session(get_session_username());
        $user = new Users();
        $user_id = Param::get('user_id');
        $page = Param::get('page_next', self::VIEW_OWN);
        $users = Users::viewProfile($user_id);
        $usersThread = Users::viewThreads($user_id);

        switch ($page) {
            case self::VIEW_OWN:
                $user->id = Param::get('user_id');
                try {
                    $users = Users::viewProfile($user_id);
                    $usersThread = Users::viewThreads($user_id);
                } catch (ValidationException $e) {
                    $page = self::VIEW_OWN;
                }
                break;

            default:
                throw new NotFoundException("{$page} is not found");                    
                break;
        }

        $this->set(get_defined_vars());
        $this->render($page);
    }

    public function edit() 
    {
        check_user_session(get_session_username());
        $user_id = get_session_id();
        $page = Param::get('page_next', self::EDIT);
        
        $user_edit = Users::getById($user_id);
        
        switch ($page) {
            case self::EDIT:
                break;
                
            case self::EDIT_END:
                $user_edit->id = get_session_id();
                $user_edit->firstname = Param::get('firstname');
                $user_edit->lastname = Param::get('lastname');
                $user_edit->current_password = Param::get('password');
                $user_edit->new_password = Param::get('passwordNew');
                try {
                    $user_edit->edit();
                } catch (ValidationException $e) {
                    $page=self::EDIT;
                    break;
                } 
                break;

            default:
                throw new RecordNotFoundException("{$page} is not found");                    
                break;
        }

        $this->set(get_defined_vars());
        $this->render($page);
    }

    public function deactivate()
    {
        check_user_session(get_session_username());
        $user = new Users();
        $user_id = Param::get('id');
        $page = Param::get('page_next', self::DEACTIVATE_USER);

        switch ($page) {
            case self::DEACTIVATE_USER:
                $user->id = $user_id;
                try {
                    $user->deactivate();
                } catch (ValidationException $e) {
                    $page = self::DEACTIVATE_USER;
                }
                break;

            default:
                throw new NotFoundException("{$page} is not found");                    
                break;
        }

        $this->set(get_defined_vars());
        $this->render($page);
    }  
}
