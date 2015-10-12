<h1>Profile</h1>
<!-- Edit and Deactivate Profile -->
<?php if($user_id == get_session_id()): ?>
    <a href="<?php char_to_html(url('users/edit', array('id' => $user_id))) ?>">Edit</a>
    <a href="javascript:deactivateUser(<?php echo $user_id; ?>)">Deactivate</a>
<?php endif ?>
<hr>
<!-- user details -->
<?php foreach ($users as $v): ?>
    <ul>
    	<li> Username: <?php char_to_html($v->username) ?> </li>
            <ul>
                <li>Firstname: <?php char_to_html($v->firstname) ?> </li>
                <li>Lastname: <?php char_to_html($v->lastname) ?> </li>
                <li>Email: <?php char_to_html($v->email) ?>      </li>
            </ul>
    </ul>
<?php endforeach ?>
<hr>
<!-- user threads -->
<h4>Threads</h4>
<?php foreach ($usersThread as $v): ?>
    <ul>
     	<li> Title: <?php char_to_html($v->title) ?> </li>
            <ul>
                <li>Category: <?php char_to_html($v->category) ?> </li>
                <li>Date Created: <?php char_to_html($v->date_created) ?> </li>
                <li>Date Modified: <?php char_to_html($v->date_modified) ?> </li>
            </ul>
    </ul> 
<?php endforeach ?>
<hr>

<div class="text-center">
	<a class="btn btn-large btn-primary" href="<?php char_to_html(url('thread/index')) ?>"> Back to All Threads </a>
</div>

<script type="text/javascript">
    function deactivateUser(id)
    {
        if(confirm('Are you sure you want to DEACTIVATE your account?')) {
            window.location.href="<?php char_to_html(url('users/deactivate', array('id' => $user_id))) ?>";
        }
    }
</script>