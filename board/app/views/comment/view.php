<?php
    session_start();
    $username = $_SESSION['username'];
?>

<h1> <?php eh($thread->title) ?> </h1>

<?php foreach($comments as $k=>$v): ?>
    <div class ="comment">
        <div class="meta">
            <?php eh($k + 1) ?>: <?php eh($v->username) ?> <?php eh($v->created) ?>            
        </div>
        <div><?php echo readable_text($v->body) ?></div>
    </div>
<?php endforeach ?>

<br><br>
<?php if($pagination->current > 1): ?>
    <a href='?page=<?php echo $pagination->prev ?>'>Previous</a>
<?php else: ?>
    Previous
<?php endif ?>

<?php for($i = 1; $i <= $pages; $i++): ?>
    <?php if($i == $page): ?>
        <?php echo $i ?>
    <?php else: ?>
        <a href='?page=<?php echo $i ?>'><?php echo $i ?></a>
    <?php endif; ?>
<?php endfor; ?>

<?php if(!$pagination->is_last_page): ?>
    <a href='?page=<?php echo $pagination->next ?>'>Next</a>
<?php else: ?>
    Next
<?php endif ?>

<br><br><br><hr> 
<form class="well" method="post" action="<?php eh(url('comment/write')) ?>">
    <label>Comment:</label>
        <textarea name="body" placeholder="comment" value="<?php eh(Param::get('body'))?>"></textarea>
    <br>
    <input type="hidden" name="thread_id" value="<?php eh($thread->id) ?>">
    <input type="hidden" name="page_next" value="write_end">
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<br><br>
<a href="<?php eh(url('thread/index', array('thread_id' => $thread->id))) ?>">
    &larr; Back to All threads
</a>