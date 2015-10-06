<!DOCTYPE html>
<html>
<head> 
    <title>Login Page</title>
</head>
<body>
<!-- Validation Errors Block-->
<?php if(!$user->user_validated): ?>
<div class="row_alert">
    <div class="col-md-4 col-md-offset-8">
        <div class="alert alert-danger fade in alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Ooops!</strong> Invalid Username or Password.
        </div>
    </div>
</div>
<?php endif ?>
<!-- Form Block -->
<div class="row">
    <div class="col-md-3 col-md-offset-4">
        <div class="form-group">
            <fieldset>
            <legend class="form_legend">Welcome Guest</legend>
            <form class="span5 well" role="form" action="<?php char_to_html(url('')) ?>" method="post">
                <label class="form"><span class="glyphicon glyphicon-user"></span>  Username:</label>
                    <input type="text" class="input" name="username" placeholder="Enter username" value="<?php char_to_html(Param::get('username')) ?>" required>
                <hr>
                <label class="form"><span class="glyphicon glyphicon-lock"></span>  Password:</label>
                    <input type="password" name="password" placeholder="Enter password" value="<?php char_to_html(Param::get('password')) ?>" required>
                <hr>
                <div class="col-sm-offset-5">
                    <input type="hidden" name="page_next" value="login_end">
                    <button type="submit" class="btn">Login</button>
                </div>
                <br>
                <div class="col-sm-offset-1">
                    <label class="form_link">Don't have an account? <a class="form_link" href="<?php char_to_html(url('users/register')) ?>"> Register Here </a></label>
                </div>
            </form>
            </fieldset>
        </div>
    </div>
</div>
</body>
</html>
