<?php

function eh($string)
{
    if (!isset($string)) return;
    echo htmlspecialchars($string, ENT_QUOTES);
}

function readable_text($s)
{
	$s = htmlspecialchars($s, ENT_QUOTES);
	$s = nl2br($s);
	return $s;
}


function redirect($url)
{        
    header('Location: '.$url);
    exit();
    	
}

function is_logged_in()
{
    if (!isset($_SESSION['id'])) {
        redirect('thread/index');
    } 
}