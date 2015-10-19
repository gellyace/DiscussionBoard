<!DOCTYPE html>
<html class="thread_edit">
<head>
    <title></title>
</head>
<body class="thread_edit">

<?php if ($thread_edit->hasError()): ?>
    <div class="alert alert-block">
        <h4 class="alert-warning">Validation error!</h4>
            <?php if (!empty($thread_edit->validation_errors['title']['length'])): ?>
                <div><em>Title</em> must be between
                    <?php char_to_html($thread_edit->validation['title']['length'][1]) ?> and
                    <?php char_to_html($thread_edit->validation['title']['length'][2]) ?> characters in length.
                </div>
            <? endif ?> 
<? endif ?> 
<!-- Form Block -->
<h1> Edit your thread</h1>
<form class="well" method="post" action="<?php char_to_html(url('')) ?>">

    <label class="form">Title</label>
        <input type="text" name="title" placeholder="title" value="<?php char_to_html($thread_edit->title) ?>">

    <div class="btn-group">
        <label>Categories:</label>
        <select name="category">
            <option value="Movies" <?php echo (($thread_edit->category) == 'Movies')? 'selected="selected"' : '' ; ?> >Movies</option>
            <option value="TV Series" <?php echo (($thread_edit->category) == 'TV Series')? 'selected="selected"' : '' ; ?> >TV Series</option>
            <option value="Anime/Manga" <?php echo (($thread_edit->category) == 'Anime/Manga')? 'selected="selected"' : '' ; ?> >Anime/Manga</option>
            <option value="Music" <?php echo (($thread_edit->category) == 'Music')? 'selected="selected"' : '' ; ?> >Music</option>
            <option value="Random Stuff" <?php echo (($thread_edit->category) == 'Random Stuff')? 'selected="selected"' : '' ; ?> >Random Stuff</option>
        </select>
    </div>

    <br/><br/><br/><br/>
    <input type="hidden" name="page_next" value="edit_end">
    <button type="submit" class="btn btn-primary"> Submit </button>
</form>

<br><br>
<a href="<?php char_to_html(url('comment/view', array('thread_id' => $thread_edit->id))) ?>">
    &larr; Back to your thread </a>

</body>
</html>
