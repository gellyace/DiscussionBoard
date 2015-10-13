<!-- Validation Errors Block-->
<?php if ($user_edit->hasError()): ?>
<div class="col-md-4 col-md-offset-6">
    <div class="alert alert-danger alert-block fade in alert-dismissable" style="width: 530px">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4 class="alert-heading">Validation error!</h4>
            <!-- Generate Error Message if firstname or lastname contain characters other than letters and extra spaces -->
            <?php if (!empty($user_edit->validation_errors['firstname']['name'])): ?>
                <div><em>Firstname</em> must only contain letters (a-z, A-Z).</div>
            <? endif ?>
            <?php if (!empty($user_edit->validation_errors['lastname']['name'])): ?>
                <div><em>Lastname</em> must only contain letters (a-z, A-Z).</div>
            <? endif ?>
            <!-- Generate Error Message if Textbox fields are empty -->
            <?php if (!empty($user_edit->validation_errors['firstname']['length'])): ?>
                <div><em>Firstname</em> must be between
                    <?php char_to_html($user_edit->validation['firstname']['length'][1]) ?> and
                    <?php char_to_html($user_edit->validation['firstname']['length'][2]) ?> characters in length.
                </div>
            <? endif ?>
            <?php if (!empty($user_edit->validation_errors['lastname']['length'])): ?>
                <div><em>Lastname</em> must be between
                    <?php char_to_html($user_edit->validation['lastname']['length'][1]) ?> and
                    <?php char_to_html($user_edit->validation['lastname']['length'][2]) ?> characters in length.
                </div>
            <? endif ?>
            <!--
            <?php if (!empty($user_edit->validation_errors['passwordNew']['length'])): ?>
                <div><em>New Password</em> must be between
                    <?php char_to_html($user_edit->validation['passwordNew']['length'][1]) ?> and
                    <?php char_to_html($user_edit->validation['passwordNew']['length'][2]) ?> characters in length.
                </div>
            <? endif ?>
            -->
            <?php if (!empty($user_edit->validation_errors['password']['length'])): ?>
                <div><em>New Password</em> must be between
                    <?php char_to_html($user_edit->validation['password']['length'][1]) ?> and
                    <?php char_to_html($user_edit->validation['password']['length'][2]) ?> characters in length.
                </div>
            <? endif ?>
    </div>
</div>
<? endif ?> 

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script type="text/javascript">
        function enable_text(status)
        {
            status=!status; 
            document.login.passwordNew.disabled = status;
        }
    </script>
</head>
<body onload='enable_text(false);'>
<!-- Form Block -->
<div class="row">
    <div class="col-md-3 col-md-offset-4">
        <div class="form-group">
            <fieldset>
            <legend class="form_legend">Details</legend>
            <form class="well span4" role="form" name="login" action="<?php char_to_html(url('')) ?>" method="post">
                <label class="form"><span class="glyphicon glyphicon-user"></span>  First Name:</label><br>
                    <input type="text" name="firstname" placeholder="Enter firstname" value="<?php char_to_html($user_edit->firstname) ?>" required>
                <hr>
                <label class="form"><span class="glyphicon glyphicon-user"></span>  Last Name:</label><br>
                    <input type="text" name="lastname" placeholder="Enter lastname" value="<?php char_to_html($user_edit->lastname) ?>" required>
                <hr>

                <label class="form"><span class="glyphicon glyphicon-lock"></span>  Password:</label><br>
                    <input type="password" id="password" name="password" placeholder="Enter password" value="" required >
                <hr>
                <label class="form"><span class="glyphicon glyphicon-lock"></span>  New Password:</label><br>
                    <input type="password" id="passwordNew" name="passwordNew" placeholder="Enter password" value="" required>
                    <input type="checkbox" name="others" onclick="enable_text(this.checked)"><span class="glyphicon glyphicon-pencil"></span>
                <hr>

                <div class="col-sm-offset-4">
                    <input type="hidden" name="page_next" value="edit_end">
                    <button type="submit" class="btn btn-primary"> Submit </button>
                </div>
                <br>
                <div class="text-center">
                    <a class="btn btn-large btn-primary" href="<?php char_to_html(url('thread/index')) ?>"> Back to All Threads </a>
                </div>
            </form>
            </fieldset>
        </div>
    </div>
</div>
</body>
</html>
