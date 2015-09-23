<?php
	session_start();
	if($_SESSION['sid']==session_id())
	{
		echo "Welcome to you<br>";
?>
		<a href="<?php eh(url('thread/index')) ?>"> &larr; Thread Page </a>

<?php }
	else
	{
		redirect(url('users/index'));
	}
?>





