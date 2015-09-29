<?php
    session_start();
?>

<h2>Register</h2>

<?php if ($user->hasError()): ?>
    <div class="alert alert-block">
        <h4 class="alert-heading">Validation error!</h4>
            <!-- Generate Error Message if username contains characters other than numbers and letters -->
            <?php if (!empty($user->validation_errors['username']['alphanumeric'])): ?>
                <div><em>Username</em> must only contain alphanumeric (a-z, A-z, 0-9) characters.</div>
            <? endif ?>
            <!-- Generate Error Message if firstname or lastname contain characters other than letters and extra spaces -->
            <?php if (!empty($user->validation_errors['firstname']['name'])): ?>
                <div><em>Firstname</em> must only contain letters (a-z, A-z).</div>
            <? endif ?>
            <?php if (!empty($user->validation_errors['lastname']['name'])): ?>
                <div><em>Lastname</em> must only contain letters (a-z, A-z).</div>
            <? endif ?>
            <!-- Generate Error Message if email address does not follow the alphanumeric@word.word format -->
            <?php if (!empty($user->validation_errors['email']['format'])): ?>
                <div><em>Email Address</em> must follow the proper (alphanumeric@word.word) format.</div>
            <? endif ?>
            <!-- Generate Error Message if username or email already exists -->
            <?php if (!empty($user->validation_errors['username']['exists'])): ?>
                <div><em>Username</em> already exists.</div>
            <? endif ?>
            <?php if (!empty($user->validation_errors['email']['exists'])): ?>
                <div><em>Email</em> already exists.</div>
            <? endif ?>
            <!-- Generate Error Message if Textbox fields are empty -->
            <?php if (!empty($user->validation_errors['username']['length'])): ?>
                <div><em>Username</em> must be between
                    <?php char_to_html($user->validation['username']['length'][1]) ?> and
                    <?php char_to_html($user->validation['username']['length'][2]) ?> characters in length.
                </div>
            <? endif ?>
            <?php if (!empty($user->validation_errors['firstname']['length'])): ?>
                <div><em>Firstname</em> must be between
                    <?php char_to_html($user->validation['firstname']['length'][1]) ?> and
                    <?php char_to_html($user->validation['firstname']['length'][2]) ?> characters in length.
                </div>
            <? endif ?>
            <?php if (!empty($user->validation_errors['lastname']['length'])): ?>
                <div><em>Lastname</em> must be between
                    <?php char_to_html($user->validation['lastname']['length'][1]) ?> and
                    <?php char_to_html($user->validation['lastname']['length'][2]) ?> characters in length.
                </div>
            <? endif ?>
            <?php if (!empty($user->validation_errors['email']['length'])): ?>
                <div><em>Email Address</em> must be between
                    <?php char_to_html($user->validation['email']['length'][1]) ?> and
                    <?php char_to_html($user->validation['email']['length'][2]) ?> characters in length.
                </div>
            <? endif ?>
            <?php if (!empty($user->validation_errors['password']['length'])): ?>
                <div><em>Password</em> must be between
                    <?php char_to_html($user->validation['password']['length'][1]) ?> and
                    <?php char_to_html($user->validation['password']['length'][2]) ?> characters in length.
                </div>
            <? endif ?>
    </div>
<? endif ?> 

<form name="login" method="post" action="<?php char_to_html(url('')) ?>">
    <div>
        <label>First Name</label>
            <input type="text" class="span2" name="firstname" placeholder="Frist Name" value="<?php char_to_html(Param::get('firstname')) ?>">
        <label>Last Name</label> 
            <input type="text" class="span2" name="lastname" placeholder="Last Name" value="<?php char_to_html(Param::get('lastname')) ?>">
        <label>Username</label> 
            <input type="text" class="span2" name="username" placeholder="Username" value="<?php char_to_html(Param::get('username')) ?>">
        <label>Email Address</label> 
            <input type="text" class="span3" name="email" placeholder="email@something.something" value="<?php char_to_html(Param::get('emailaddress')) ?>">
        <label>Password</label> 
            <input type="password" class="span2" name="password" placeholder="Password" value="<?php char_to_html(Param::get('password')) ?>">
        <br/>
        <input type="hidden" name="page_next" value="register_end">
        <button type="submit" class="btn btn-primary"> Submit </button> 
    </div>
</form>
<a href="<?php char_to_html(url('users/login')) ?>">
    &larr; Login Page
</a>