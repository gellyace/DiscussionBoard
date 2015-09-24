<?php
    $username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h3>Welcome Back <?php echo $username ?> </h3>
	<a href="<?php eh(url('thread/index')) ?>"> &larr; Thread Page </a>
</body>
</html>


