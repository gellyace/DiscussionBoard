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
<?php if($pagination->current > 1): ?>
    <a href='?thread_id=<?php echo $thread->id ?>&page=<?php echo $pagination->prev ?>'>Previous</a>
<?php else: ?>
    Previous
<?php endif ?>

<?php for($i = 1; $i <= $pages; $i++): ?>
    <?php if($i == $page): ?>
        <?php echo $i ?>
    <?php else: ?>
        <a href='?thread_id=<?php echo $thread->id ?>&page=<?php echo $i ?>'><?php echo $i ?></a>
    <?php endif; ?>
<?php endfor; ?>

<?php if(!$pagination->is_last_page): ?>
    <a href='?thread_id=<?php echo $thread->id ?>&page=<?php echo $pagination->next ?>'>Next</a>
<?php else: ?>
    Next
<?php endif ?>

<br><br><br><hr> 
<form class="well" method="post" action="<?php char_to_html(url('comment/write')) ?>">
    <label>Comment:</label>
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