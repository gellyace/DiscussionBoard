<h2><?php char_to_html($thread_edit->title) ?></h2>
<p class="alert alert-success">You successfully edited your comment</p>
<a href="<?php char_to_html(url('comment/view', array('thread_id' => $thread_edit->id))) ?>">
    &larr; Go to thread
</a>