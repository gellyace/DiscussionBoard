<h2> <?php char_to_html($thread->title) ?> </h2>
<!-- Validation Errors Block-->
<?php if ($comment->hasError()): ?>
    <div class="alert alert-danger alert-block fade in alert-dismissable" style="width: 530px">
        <h4 class="alert-heading">Validation error!</h4>
            <?php if (!empty($comment->validation_errors['body']['length'])): ?>                
                <div><em>Comment</em> must be between 
                    <?php char_to_html($comment->validation['body']['length'][1]) ?>  and                    
                    <?php char_to_html($comment->validation['body']['length'][2]) ?> characters in length.
                </div>            
            <?php endif ?>
    </div> 
<?php endif ?>
<!-- Form Block -->
<form class="well" method="post" action="<?php char_to_html(url('comment/write')) ?>">
    <label>Comment</label>
        <textarea name="body" placeholder = "comment" value="<?php char_to_html(Param::get('body')) ?>"></textarea>
    <br />
    <input type="hidden" name="thread_id" value="<?php char_to_html($thread->id) ?>">
    <input type="hidden" name="page_next" value="write_end">
    <button type="submit" class="btn btn-primary">Submit</button>                  
</form> 
<br><br>
<a href="<?php char_to_html(url('comment/view', array('thread_id'=>$thread->id))) ?>"> 
    &larr; Back to thread
</a>