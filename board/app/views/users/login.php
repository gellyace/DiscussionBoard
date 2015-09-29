<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head> 
    <title>Login Page</title>
</head>
<body>

<?php if(!$user->user_validated): ?>
<div class="row">
    <div class="col-md-3 col-md-offset-4">
        <div class="alert alert-danger" role="alert" width="40%">
            <h4>Invalid username or password!</h4>
        </div>
    </div>
</div>
<?php endif ?>

<div id="header"> <h2>Welcome Guest</h2> </div>
    <form id="body" method="post" action="<?php char_to_html(url('')) ?>">
        <div id="rcorners2">
            <label>Username</label>
            <input type="text" class="span2" name="username" placeholder="username" value="<?php char_to_html(Param::get('username')) ?>" />
            <label>Password</label>
            <input type="password" class="span2" name="password" placeholder="password" value="<?php char_to_html(Param::get('password')) ?>" />
            <br/>
            <!-- Redirection to Welcome Page, if logging in is succesful-->     
            <input type="hidden" name="page_next" value="login_end">    
            <button type="submit" class="btn btn-primary"> Login </button>
            <br/><br/> 
            <!-- Once hyperlink is clicked, will be redirected to Register Page-->
            Don't have an account? <a href="<?php char_to_html(url('users/register')) ?>"> Register here </a>
        </div>
    </form>
</body>
</html>
