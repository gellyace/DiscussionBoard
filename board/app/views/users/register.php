<h1>Register</h1>

<?php if ($thread->hasError() || $comment->hasError()): ?>
	<div class="alert alert-block">
		<h4 class="alert-heading">Validation error!</h4>
		    <?php if (!empty($thread->validation_errors['title']['length'])): ?>
		    	<div><em>Title</em> must be between
		    	    <?php eh($thread->validation['title']['length'][1]) ?> and
		    	    <?php eh($thread->validation['title']['length'][2]) ?> characters in length.
		    	</div>
		    <? endif ?>

			<?php if (!empty($comment->validation_errors['username']['length'])): ?>
		    	<div><em>Your name</em> must be between
		    	    <?php eh($comment->validation['username']['length'][1]) ?> and
		    	    <?php eh($comment->validation['username']['length'][2]) ?> characters in length.
		    	</div>
		    <? endif ?>

		    <?php if (!empty($comment->validation_errors['body']['length'])): ?>
		    	<div><em>Comment</em> must be between
		    	    <?php eh($comment->validation['body']['length'][1]) ?> and
		    	    <?php eh($comment->validation['body']['length'][2]) ?> characters in length.
		    	</div>
		    <? endif ?>    
	</div>
<? endif ?> 


<form name="login" method="post" action="<?php eh(url('')) ?>">
    <div>
	    <label>First Name</label>
	    <input type="text" class="span2" name="firstname" placeholder="Frist Name" value="<?php eh(Param::get('firstname')) ?>">
	    <label>Last Name</label> 
	    <input type="text" class="span2" name="lastname" placeholder="Last Name" value="<?php eh(Param::get('lastname')) ?>">
	    <label>Username</label> 
	    <input type="text" class="span2" name="username" placeholder="Username" value="<?php eh(Param::get('username')) ?>">
	    <label>Email Address</label> 
	    <input type="text" class="span3" name="emailaddress" placeholder="email@something.something" value="<?php eh(Param::get('emailaddress')) ?>">
	    <label>Password</label> 
	    <input type="password" class="span2" name="password" placeholder="Password" value="<?php eh(Param::get('password')) ?>">
	    <label>Re-type Password</label> 
	    <input type="password" class="span2" name="password" placeholder="Re-type Password" value="<?php eh(Param::get('password')) ?>">


	    <br/>
	    <button type="submit" class="btn btn-primary"> Submit </button>
	    

    </div>
</form>