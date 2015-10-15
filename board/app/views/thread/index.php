<!DOCTYPE html>
<html class="thread_index">
<head>
    <title></title>
    <script type="text/javascript" language="javascript">
    $(document).ready(function() {
        //$('li.trending').slice(0,10).show();
        $('ul li.trending').hide().filter(':lt(10)').show();
    });
    </script>
</head>
<body class="thread_index" >
<div class="container">
    <div class="row">
        <!-- list of all trending threads by comment count-->
        <div class="col-sm-3" id="trending_info">
            <h5>Trending Threads:</h5>
            <ul>
            <?php foreach ($trending as $v): ?>
                <?php if (!in_array(($v->user_id),Thread::getAllInactiveUser())) : ?> <!-- added-->
                    <li class="trending">
                        <a href="<?php char_to_html(url('comment/view', array('thread_id' => $v->id))) ?>">
                        <?php char_to_html($v->title) ?></a>
                        <span class="label label-primary"><?php char_to_html($v->count)?></span>
                        <?php char_to_html($v->category)?>   
                    </li>
                <?php endif ?><!-- added-->
            <?php endforeach ?>
            </ul>
        </div>
        <div class="col-sm-6" id="thread_info">
            <h1>All threads</h1>
            <ul>
            <!-- list of all threads -->
                <?php foreach ($threads as $v): ?>
                <?php if (!in_array(($v->user_id),Thread::getAllInactiveUser())) : ?> <!-- added-->
                <li>
                    <a href="<?php char_to_html(url('comment/view', array('thread_id' => $v->id))) ?>">
                    <?php char_to_html($v->title) ?> ----> Category: <?php char_to_html($v->category) ?></a>  
                <?php endif ?><!-- added-->
                <?php endforeach ?>
            </ul>
            <!-- pagination -->
            <div class="text-center">
            <hr>
            <a class="btn btn-large btn-primary" href="<?php char_to_html(url('thread/create')) ?>"> Create </a>
            <br>
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
            </div>
        </div>
        <!-- search area-->
        <div class="col-sm-3">
            <a class="btn btn-large btn-primary" href="<?php char_to_html(url('users/view_end', array('user_id' => get_session_id()))) ?>"> Go to Your Profile </a> 
            <br><br>
            <a class="btn btn-large btn-primary" href="<?php char_to_html(url('thread/search')) ?>"> Go to Search Page </a> 
            <br><br>
            <a class="btn btn-large btn-primary" href="<?php char_to_html(url('users/logout')) ?>"> Logout </a>
        </div>
    </div>
</div>
</body>
</html>
