<!DOCTYPE html>
<html class="thread_index">
<head>
    <title></title>
</head>
<body class="thread_index">
   
<h1>All threads</h1>
    <ul>
        <?php foreach ($threads as $v): ?>
        <li>
            <a href="<?php char_to_html(url('comment/view', array('thread_id' => $v->id))) ?>">
            <?php char_to_html($v->title) ?> ----> Category: <?php char_to_html($v->category) ?></a>        
        </li>
        <?php endforeach ?>
    </ul>

<br><br>
<!-- pagination -->
<ul class="pagination">
    <ul class="pager">
    <?php if($pagination->current > 1): ?>
        <li class="previous"><a href='?page=<?php echo $pagination->prev ?>'>Previous</a></li>
    <?php else: ?>
        <li class="previous disabled"><a href="#">Previous</a><li>
    <?php endif ?>

    <?php for($i = 1; $i <= $pages; $i++): ?>
        <?php if($i == $page): ?>
            <li class="active"><a href="#"><?php echo $i ?></a></li>
        <?php else: ?>
            <li><a href='?page=<?php echo $i ?>'><?php echo $i ?></a></li>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if(!$pagination->is_last_page): ?>
        <li class="next"><a href='?page=<?php echo $pagination->next ?>'>Next</a></li>
    <?php else: ?>
        <li class="next disabled"><a href="#">Next</a></li>
    <?php endif ?>
    </ul> <!-- end of pager -->
</ul> <!-- end of pagination -->

<br><br><br><br>
<a class="btn btn-large btn-primary" href="<?php char_to_html(url('thread/create')) ?>"> Create </a>
<a class="btn btn-large btn-primary" href="<?php char_to_html(url('users/logout')) ?>"> Logout </a>


</body>
</html>
