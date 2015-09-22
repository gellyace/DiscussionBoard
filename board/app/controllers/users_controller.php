<?php
class UsersController extends AppController
{
    public function index() // login home page
    {
        
    }

    public function register() // register page
    {
    	$user = new Users;
        $page = Param::get('page_next', 'register');

        switch ($page) {
            case 'register':
                break;
                
            case 'register_end':
                $user->username = Param::get('username');
                $user->firstname=Param::get('firstname');
                $user->lastname=Param::get('lastname');
                $user->email=Param::get('email');
                $user->password=Param::get('password');
                try {
                    $user->register($user);
                } catch (ValidationException $e) {
                    $page='register';
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
