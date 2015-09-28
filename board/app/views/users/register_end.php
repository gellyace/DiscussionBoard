<?php
    $username = $_SESSION['username'];
    $id = $_SESSION['id'];
?>
<h2>Register</h2>
<p class="alert alert-success">You have registered succesfully</p>
<a href="<?php eh(url('thread/index')) ?>">
    &larr; Home Page
</a>