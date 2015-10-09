<!DOCTYPE html>
<html class="thread_index">
<head>
    <title></title>
</head>
<body class="thread_index">
<div class="container">
    <div class="row">
        <!-- list of all trending threads by comment count-->
        <div class="col-sm-3">
            <h5>Trending Threads:</h5>
            <ul>
                <?php foreach ($trending as $v): ?>
                <li>
                    <a href="<?php char_to_html(url('comment/view', array('thread_id' => $v->id))) ?>">
                    <?php char_to_html($v->title) ?></a>
                    <span class="label label-primary"><?php char_to_html($v->count)?></span>
                    <?php char_to_html($v->category)?>   
                </li>
                <?php endforeach ?>
            </ul>
        </div>
        <div class="col-sm-6">
            <h1>All threads</h1>
            <ul>
            <!-- list of all threads -->
                <?php foreach ($threads as $v): ?>
                <li>
                    <a href="<?php char_to_html(url('comment/view', array('thread_id' => $v->id))) ?>">
                    <?php char_to_html($v->title) ?> ----> Category: <?php char_to_html($v->category) ?></a>        
                </li>
                <?php endforeach ?>
            </ul>
            <!-- pagination -->
            <div class="text-center">
            <hr>
            <a class="btn btn-large btn-primary" href="<?php char_to_html(url('thread/create')) ?>"> Create </a>
            <a class="btn btn-large btn-primary" href="<?php char_to_html(url('users/logout')) ?>"> Logout </a>
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
        <a class="btn btn-large btn-primary" href="<?php char_to_html(url('thread/search')) ?>"> Go to Search Page </a> 
         <!--
        <form role="form" name="search" action="<?php char_to_html(url('')) ?>" method="post">
             <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" name="keyword" value="<?php char_to_html(Param::get('keyword')) ?>" onFocus="this.value=''"/>
            <div class="input-group-btn">
                <input type="hidden" name="page_next" value="search_end"/>
                <button type="submit" class="btn btn-primary">Submit</button>  
               <a class="btn btn-large btn-primary" href="<?php char_to_html(url('thread/search')) ?>"> Go </a> 
            
                <input type="hidden" name="page_next" value="search_end"/>
                <button type="submit" class="btn btn-primary">Submit</button>
                -->
            </div>
            </div>
        </form>
        
        </div>
    </div>
</div>
</body>
</html>
