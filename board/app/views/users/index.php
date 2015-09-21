<h1>Welcome Guest!</h1> <br/>

<form name="login" method="post">
    <div>
	    <label>Username</label>
	    <input type="text" class="span2" name="username" placeholder="username" value="<?php eh(Param::get('username')) ?>">
	    <label>Password</label> 
	    <input type="password" class="span2" name="password" placeholder="password" value="<?php eh(Param::get('password')) ?>">
	    
	    <br/>
	    <button type="submit" class="btn btn-primary"> Login </button>
	    
	    <br/><br/> Don't have an account? 
	    <a href="<?php eh(url('users/register')) ?>"> Register here </a>

    </div>
</form>