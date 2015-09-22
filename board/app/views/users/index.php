<!DOCTYPE html>
<html>
<head> 
	<title>Login Page</title>
	
</head>

<body>
<h2>Welcome Guest</h2>


    <form name="login" method="post" action="<?php eh(url('thread/index')) ?>">
		<fieldset>
		<legend>User Login</legend>
		<div>
			<label>Username</label>
			<input type="text" class="span2" name="username" placeholder="username" value="<?php eh(Param::get('username')) ?>" />
			
			<label>Password</label>
			<input type="password" class="span2" name="password" placeholder="password" value="<?php eh(Param::get('password')) ?>" />

			<br/>			
			<button type="submit" class="btn btn-primary"> Login </button>

			<br/><br/> Don't have an account? <a href="<?php eh(url('users/register')) ?>"> Register here </a>
		</div>
		</fieldset>
	</form>

</body>
</html>
