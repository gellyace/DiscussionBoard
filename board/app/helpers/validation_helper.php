<?php
    function validate_between($check, $min, $max)
    {
    	$n = mb_strlen($check);

    	return $min <= $n && $n <= $max;
    }

    function validate_name($check, $name){

    }

    function validate_username_password($name){
    	if(ctype_alnum($name))
    	    return $name;
    }

    function validate_email()
    {
    	
    }