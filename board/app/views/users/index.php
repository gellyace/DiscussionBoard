<!DOCTYPE html>
<html>
<head> 
	<title>Login Page</title>
</head>
<body>

<!-- Wrong credentials of user-->
<?php if (!$user->user_validated): ?>
	<div class="alert alert-error">
		<em><h4 class="alert-heading">Wait!</h4></em>
		<em>Invalid Username or Password</em>
	</div>
<?php endif ?>


<div id="header"> <h2>Welcome Guest</h2> </div>

    <form id="body" method="post" action="<?php eh(url('')) ?>">
		<div id="rcorners2">
			<label>Username</label>
			<input type="text" class="span2" name="username" placeholder="username" value="<?php eh(Param::get('username')) ?>" />
			
			<label>Password</label>
			<input type="password" class="span2" name="password" placeholder="password" value="<?php eh(Param::get('password')) ?>" />

			<br/>
			<!-- Redirection to home, if logging in is succesful-->		
			<input type="hidden" name="page_next" value="index_end">	
			<button type="submit" class="btn btn-primary"> Login </button>
			<br/><br/> 
			<!-- Once hyperlink is clicked, will be redirected to Register Page-->
			Don't have an account? <a href="<?php eh(url('users/register')) ?>"> Register here </a>
		</div>
	</form>


</body>
</html>
