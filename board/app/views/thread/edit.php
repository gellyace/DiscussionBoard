<!DOCTYPE html>
<html class="thread_edit">
<head>
    <title></title>
</head>
<body class="thread_edit">

<?php if ($thread->hasError()): ?>
    <div class="alert alert-block">
        <h4 class="alert-warning">Validation error!</h4>
            <?php if (!empty($thread->validation_errors['title']['length'])): ?>
                <div><em>Title</em> must be between
                    <?php char_to_html($thread->validation['title']['length'][1]) ?> and
                    <?php char_to_html($thread->validation['title']['length'][2]) ?> characters in length.
                </div>
            <? endif ?> 
<? endif ?> 
<!-- Form Block -->
<h1> Edit your thread</h1>
<form class="well" method="post" action="<?php char_to_html(url('')) ?>">

    <label class="form">Title</label>
        <input type="text" name="title" placeholder="title" value="<?php char_to_html($thread->title) ?>">

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

    <br/><br/><br/><br/>
    <input type="hidden" name="page_next" value="edit_end">
    <button type="submit" class="btn btn-primary"> Submit </button>
</form>


</body>
</html>
