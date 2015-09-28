<?php
function validate_between($check, $min, $max) {
    $n = mb_strlen($check);
	return $min <= $n && $n <= $max;
}

function validate_name($check) {
    return preg_match('/^[a-zA-Z ]*$/', $check);
}

function validate_alphanumeric($check) {
    return preg_match('/^[_a-zA-Z0-9]+$/', $check);
}

function validate_email($check) {
    return preg_match('/^[a-zA-Z0-9._-]+@[a-z]+\.[a-z]{2,4}$/', $check);
}

function validate_username_exists($check) {
    return !Users::getUsername($check);
}

function validate_email_exists($check) {
    return !Users::getEmail($check);
}

    