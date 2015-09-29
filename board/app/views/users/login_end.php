<?php
    $username = $_SESSION['username'];
    $id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <h3>Welcome Back <?php echo $username ?> </h3>
    <a href="<?php char_to_html(url('thread/index')) ?>"> &larr; Thread Page </a>
</body>
</html>


