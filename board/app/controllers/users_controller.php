<?php
class UsersController extends AppController
{
    public function index() //login ~ index.php
    {   

    	$user = new Users;
    	$page = Param::get('page_next', 'index');

    	switch ($page) {
    		case 'index':
    			break;

    		case 'index_end':
    			$user->username = Param::get('username');                
                $user->password=Param::get('password');
                try {
                    $user->index($user);
                } catch (ValidationException $e) {
                    $page='index';
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
