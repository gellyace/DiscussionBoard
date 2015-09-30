<!DOCTYPE html>
<html>
<head> 
    <title>Login Page</title>
    <link href="/custom/css/login_register.css" rel="stylesheet">
    <script type="/custom/js/index.js"></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
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



        
<h2 class="header login">Welcome Guest</h2>
<form class="form-horizontal" role="form" action="<?php char_to_html(url('')) ?>" method="post">
    <div class="well span6">   
    <div class="control-group">
        <label class="control-label col-sm-2" for="name"><span class="glyphicon glyphicon-user"></span> Username:</label>
        <div class="control">
            <input type="text" name="username" placeholder="Enter username" value="<?php char_to_html(Param::get('username')) ?>" required>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label col-sm-2"> <span class="glyphicon glyphicon-lock"></span> Password:</label>
        <div class="control">
            <input type="password" name="password" placeholder="Enter password" value="<?php char_to_html(Param::get('password')) ?>" required>
        </div>
    </div>
  
    <div class="control-group">
        <div class="col-sm-offset-5">
            <input type="hidden" name="page_next" value="login_end">
            <button type="submit" class="btn btn-info">Login</button>
        </div>
    </div>
    <hr> 
    Don't have an account? <a href="<?php char_to_html(url('users/register')) ?>"> Register Here </a>
   </div>
</form>


</body>
</html>
