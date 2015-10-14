<!DOCTYPE html>
<html class="comment_view">
<head>
    <title></title>
    
</head>
<body class="comment_view">

<h1> <?php char_to_html($thread->title) ?> </h1>
<!-- Edit and Delete Thread -->
<?php if(($thread->user_id) == get_session_id()): ?>
    <a href="<?php char_to_html(url('thread/edit', array('thread_id' => $thread->id))) ?>">Edit</a>
    <a href="javascript:deleteThread(<?php echo ($thread->id); ?>)">Delete</a>
<?php endif ?>
<!-- Display All Comments inside this thread -->
<?php foreach($comments as $k=>$v): ?>
    <div class ="comment">
    <?php if (!in_array(($v->user_id),Thread::getAllInactiveUser())) : ?> <!-- added-->
        <div class="meta" id="comment_info">
            <!-- Dsiplay Date Created and Modified -->
            <?php if((($v->date_created) == ($v->date_modified)) || (($v->date_modified) == null) || (($v->date_modified) == (0)) ): ?>
                <?php char_to_html($k + 1) ?>: 
                <a href="<?php char_to_html(url('users/view_end', array('user_id' => $v->user_id))) ?>"><?php echo $v->username ?></a> --------   
                Date Created: <?php char_to_html($v->date_created) ?>
            <?php else: ?>
                <?php char_to_html($k + 1) ?>: 
                <a href="<?php char_to_html(url('users/view_end', array('user_id' => $v->user_id))) ?>"><?php echo $v->username ?></a> --------   
                Date Modified: <?php char_to_html($v->date_modified) ?>
            <?php endif ?>
            <!-- Edit and Delete Comment -->
            <?php if(($v->user_id) == get_session_id()): ?>
                <a href="<?php char_to_html(url('comment/edit', array('id' => $v->id, 'thread_id' => $thread->id))) ?>">Edit</a>
                <a href="javascript:deleteComment(<?php echo ($v->id)?>)">Delete</a>
            <?php endif ?>
        </div>
        <div><?php echo readable_text($v->body) ?></div>
        <!-- Like and Unlike Comment -->
        <span class="label label-primary"><?php echo "Total Likes: ".(Comment::countAllLikes($v->id))?></span><br>
        <?php if($v->is_like): ?>
            <a href="<?php char_to_html(url('likes/unlike', array('thread_id' => $thread->id, 'comment_id' => $v->id))) ?>">Unlike</a>
        <?php else: ?>
            <a href="<?php char_to_html(url('likes/like', array('thread_id' => $thread->id, 'comment_id' => $v->id))) ?>">Like</a>
        <?php endif ?>
    <?php endif ?>
    </div>
<?php endforeach ?>

<br><br>
<!-- pagination -->
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
<script type="text/javascript">
    function deleteThread(id)
    {
        if(confirm('Are you sure to DELETE this thread?')) {
            window.location.href="<?php char_to_html(url('thread/delete', array('thread_id' => $thread->id))) ?>";
        }
    }
    function deleteComment(id)
    {
        if(confirm('Are you sure to DELETE this comment?')) {
            window.location.href="<?php char_to_html(url('comment/delete', array('id' => $v->id))) ?>";
        }
    }
    </script>
</html>
