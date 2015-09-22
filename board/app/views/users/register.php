<h1>Register</h1>


<form name="login" method="post" action="<?php eh(url('')) ?>">
    <div>
	    <label>First Name</label>
	    <input type="text" class="span2" name="firstname" placeholder="Frist Name" value="<?php eh(Param::get('firstname')) ?>">
	    <label>Last Name</label> 
	    <input type="text" class="span2" name="lastname" placeholder="Last Name" value="<?php eh(Param::get('lastname')) ?>">
	    <label>Username</label> 
	    <input type="text" class="span2" name="username" placeholder="Username" value="<?php eh(Param::get('username')) ?>">
	    <label>Email Address</label> 
	    <input type="text" class="span3" name="email" placeholder="email@something.something" value="<?php eh(Param::get('emailaddress')) ?>">
	    <label>Password</label> 
	    <input type="password" class="span2" name="password" placeholder="Password" value="<?php eh(Param::get('password')) ?>">
	    
	    <!--<label>Re-type Password</label> 
	    <input type="password" class="span2" name="password" placeholder="Re-type Password" value="<?php eh(Param::get('password')) ?>">
		-->	

	    <br/>
	    <input type="hidden" name="page_next" value="register_end">
	    <button type="submit" class="btn btn-primary"> Submit </button>
	    

    </div>
</form>