<!-- Validation Errors Block-->
<?php if ($user->hasError()): ?>
<div class="col-md-4 col-md-offset-6">
    <div class="alert alert-danger alert-block fade in alert-dismissable" style="width: 530px">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4 class="alert-heading">Validation error!</h4>
            <!-- Generate Error Message if username contains characters other than numbers and letters -->
            <?php if (!empty($user->validation_errors['username']['alphanumeric'])): ?>
                <div><em>Username</em> must only contain alphanumeric (a-z, A-Z, 0-9) characters.</div>
            <? endif ?>
            <!-- Generate Error Message if firstname or lastname contain characters other than letters and extra spaces -->
            <?php if (!empty($user->validation_errors['firstname']['name'])): ?>
                <div><em>Firstname</em> must only contain letters (a-z, A-Z).</div>
            <? endif ?>
            <?php if (!empty($user->validation_errors['lastname']['name'])): ?>
                <div><em>Lastname</em> must only contain letters (a-z, A-Z).</div>
            <? endif ?>
            <!-- Generate Error Message if email address does not follow the alphanumeric@word.word format -->
            <?php if (!empty($user->validation_errors['email']['format'])): ?>
                <div><em>Email Address</em> must follow the proper (alphanumeric@word.word) format.</div>
            <? endif ?>
            <!-- Generate Error Message if username or email already exists -->
            <?php if (!empty($user->validation_errors['username']['exists_username'])): ?>
                <div><em>Username</em> already exists.</div>
            <? endif ?>
            <?php if (!empty($user->validation_errors['email']['exists_email'])): ?>
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
</div>
<? endif ?> 

<!-- Form Block -->
<div class="row" id="login_screen">
    <div class="col-md-3 col-md-offset-4" id="login">
        <div class="form-group">
            <fieldset>
            <legend class="form_legend">Register</legend>
            <form class="well span4" id="well" role="form" name="login" action="<?php char_to_html(url('')) ?>" method="post">
                <label class="form" id="login_text"><span class="glyphicon glyphicon-user"></span>  First Name:</label><br>
                    <input type="text" class="form-control" name="firstname" placeholder="Enter firstname" value="<?php char_to_html(Param::get('firstname')) ?>" required>
                <hr>
                <label class="form" id="login_text"><span class="glyphicon glyphicon-user"></span>  Last Name:</label><br>
                    <input type="text" class="form-control" name="lastname" placeholder="Enter lastname" value="<?php char_to_html(Param::get('lastname')) ?>" required>
                <hr>
                <label class="form" id="login_text"><span class="glyphicon glyphicon-user"></span>  Username:</label><br>
                    <input type="text" class="form-control" name="username" placeholder="Enter username" value="<?php char_to_html(Param::get('username')) ?>" required>
                <hr>
                <label class="form" id="login_text"><span class="glyphicon glyphicon-envelope"></span>  Email Address:</label><br>
                    <input type="text" class="form-control" name="email" placeholder="Enter email" value="<?php char_to_html(Param::get('email')) ?>" required>
                <hr>
                <label class="form" id="login_text"><span class="glyphicon glyphicon-lock"></span>  Password:</label><br>
                    <input type="password" class="form-control" name="password" placeholder="Enter password" value="<?php char_to_html(Param::get('password')) ?>" required>
                <hr>
                <div class="col-sm-offset-4">
                    <input type="hidden" name="page_next" value="register_end">
                    <button type="submit" class="btn">Submit</button>
                </div>
                <br>
                <div class="col-sm-offset-2">
                    <label class="form_link">Back to <a class="form_link" href="<?php char_to_html(url('users/login')) ?>"> &larr; Login Page </a></label>
                </div>
            </form>
            </fieldset>
        </div>
    </div>
</div>
