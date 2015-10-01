<!DOCTYPE html>
<html class="comment_view">
<head>
    <title></title>
</head>
<body class="comment_view">

<h1> <?php char_to_html($thread->title) ?> </h1>

<?php foreach($comments as $k=>$v): ?>
    <div class ="comment">
        <div class="meta">
            <?php char_to_html($k + 1) ?>: <?php char_to_html($v->username) ?> <?php char_to_html($v->created) ?>            
        </div>
        <div><?php echo readable_text($v->body) ?></div>
    </div>
<?php endforeach ?>

<br><br>
<ul class="pagination">
    <ul class="pager">
    <?php if($pagination->current > 1): ?>
        <li class="previous"><a href='?thread_id=<?php echo $thread->id ?>&page=<?php echo $pagination->prev ?>'>Previous</a></li>
    <?php else: ?>
        <li class="previous disabled"><a href="#">Previous</a></li>
    <?php endif ?>

    <?php for($i = 1; $i <= $pages; $i++): ?>
        <?php if($i == $page): ?>
            <li class="active"><a href="#"><?php echo $i ?></a></li>
        <?php else: ?>
            <li><a href='?thread_id=<?php echo $thread->id ?>&page=<?php echo $i ?>'><?php echo $i ?></a></li>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if(!$pagination->is_last_page): ?>
        <li class="next"><a href='?thread_id=<?php echo $thread->id ?>&page=<?php echo $pagination->next ?>'>Next</a></li>
    <?php else: ?>
        <li class="next disabled"><a href="#">Next</a></li>
    <?php endif ?>
    </ul> <!-- end of pager -->
</ul> <!-- end of pagination -->

<br><br><br><hr> 
<form class="well" method="post" action="<?php char_to_html(url('comment/write')) ?>">
    <label class="form">Comment:</label>
        <textarea name="body" placeholder="comment" value="<?php char_to_html(Param::get('body'))?>"></textarea>
    <br>
    <input type="hidden" name="thread_id" value="<?php char_to_html($thread->id) ?>">
    <input type="hidden" name="page_next" value="write_end">
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<br><br>
<a href="<?php char_to_html(url('thread/index', array('thread_id' => $thread->id))) ?>">
    &larr; Back to All threads
</a>

</body>
</html>
