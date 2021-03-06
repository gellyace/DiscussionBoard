<?php
function char_to_html($string)
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

function wrong_password()
{
	echo "<p align='right'><font color='white' size='4pt'><u> Password does not match. </u></font></p> ";
}