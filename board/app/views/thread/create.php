<!DOCTYPE html>
<html class="thread_create">
<head>
    <title></title>
</head>
<body class="thread_create">
<!-- Validation Errors Block-->
<?php if ($thread->hasError() || $comment->hasError()): ?>
    <div class="alert alert-danger alert-block fade in alert-dismissable" style="width: 530px">
        <h4 class="alert-warning">Validation error!</h4>
            <?php if (!empty($thread->validation_errors['title']['length'])): ?>
                <div><em>Title</em> must be between
                    <?php char_to_html($thread->validation['title']['length'][1]) ?> and
                    <?php char_to_html($thread->validation['title']['length'][2]) ?> characters in length.
                </div>
            <? endif ?> 
            <?php if (!empty($comment->validation_errors['body']['length'])): ?>
                <div><em>Comment</em> must be between
                    <?php char_to_html($comment->validation['body']['length'][1]) ?> and
                    <?php char_to_html($comment->validation['body']['length'][2]) ?> characters in length.
                </div>
            <? endif ?> 
    </div>
<? endif ?> 
<!-- Form Block -->
<h1> Create a thread</h1>
<form class="well" method="post" action="<?php char_to_html(url('')) ?>">
    <label class="form">Title</label>
        <input type="text" name="title" placeholder="title" value="<?php char_to_html(Param::get('title')) ?>">

    <div class="btn-group">
        <label>Categories:</label>
        <select name="category">
            <option value="Movies">Movies</option>
            <option value="TV Series">TV Series</option>
            <option value="Anime/Manga">Anime/Manga</option>
            <option value="Music">Music</option>
            <option value="Random Stuff">Random Stuff</option>
        </select>
    </div>

    <br><br><br><br>
    <label class="form-group">Comment</label>
        <textarea name="body" placeholder="comment" value="<?php char_to_html(Param::get('body')) ?>"></textarea>

    <br/><br/><br/><br/>
    <input type="hidden" name="page_next" value="create_end">
    <button type="submit" class="btn btn-primary"> Submit </button>
</form>

<a href="<?php char_to_html(url('thread/index', array('thread_id' => $thread->id))) ?>">
    &larr; Go to thread
</a>
</body>
</html>
