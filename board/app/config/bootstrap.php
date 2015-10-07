<?php
// application
require_once APP_DIR.'app_controller.php';
require_once APP_DIR.'app_model.php';
require_once APP_DIR.'app_layout_view.php';
require_once APP_DIR.'app_exception.php';

// helpers
require_once HELPERS_DIR.'html_helper.php';
require_once HELPERS_DIR.'validation_helper.php';

//vendor
require_once VENDOR_DIR.'SimpleDBI/SimpleDBI.php';

//library
require_once LIB_DIR.'SimplePagination/SimplePagination.php';

// config
require_once CONFIG_DIR.'log.php';
require_once CONFIG_DIR.'router.php';
require_once CONFIG_DIR.'database.php';

spl_autoload_register(function($name) {
    $filename = Inflector::underscore($name) . '.php';
    if (strpos($name, 'Controller') !== false) {
        require CONTROLLERS_DIR . $filename;
    } else {
        if (file_exists(MODELS_DIR . $filename)) {
            require MODELS_DIR . $filename;
        }
    }
});

function set_session($username, $user_id)
{
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    $_SESSION['username'] = $username;
    $_SESSION['id'] = $user_id;
}

function get_session_username()
{
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    return $username = $_SESSION['username'];
}

function get_session_id()
{
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    return $user_id = $_SESSION['id'];
}

function check_user_session($username)
{
    if((isset($_SESSION['username']) == $username) && ($username!=null)) {   
    }
    if(!isset($_SESSION['username'])) {
        session_start();
        session_destroy();
        redirect('/users/login');
        exit();
    }
}

