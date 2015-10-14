<?php
//Global functions used to set, get and check the session of a user
function set_session($username, $user_id)
{ 
    $_SESSION['username'] = $username;
    $_SESSION['id'] = $user_id;
}

function get_session_username()
{
    return $username = $_SESSION['username'];
}

function get_session_id()
{
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
