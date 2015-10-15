<?php
function validate_between($check, $min, $max)
{
    $check = trim($check);
    $n = mb_strlen($check);
	return $min <= $n && $n <= $max;
}

function validate_name($name)
{
    return preg_match("/^[a-zA-Z]+(?:[\s][A-Za-z]+)*$/", $name); 
}

function validate_alphanumeric($check)
{
    return preg_match('/^[_a-zA-Z0-9]+$/', $check);
}

function validate_email($email)
{
    return preg_match('/^[a-zA-Z0-9._-]+@[a-z]+\.[a-z]{2,4}$/', $email);
}

function username_exists($username)
{
    return !Users::getUsername($username);
}

function email_exists($email)
{
    return !Users::getEmail($email);
}
 