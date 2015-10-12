<h1>Search Result</h1> 
<h3>for <?php echo $keyword ?></h3>
<hr>
<!-- list of all search results -->
<h4>Users</h4>
    <?php foreach (Thread::searchProfile($keyword) as $v): ?>
        <ul>
        <li> <!-- user profile matches -->   
            Username: <?php char_to_html($v->username) ?>                        
        </li>
            <ul>
                <li>Firstname: <?php char_to_html($v->firstname) ?> </li>
                <li>Lastname: <?php char_to_html($v->lastname) ?> </li>
                <li>Email: <?php char_to_html($v->email) ?>      </li>
            </ul>
        </ul>
    <?php endforeach ?>
    <hr>
<h4>Threads</h4>
    <?php foreach (Thread::searchThread($keyword) as $v): ?>
        <ul>
        <li> <!-- thread matches -->
            Title: <?php char_to_html($v->title) ?>                        
        </li>
            <ul>
                <li>Category: <?php char_to_html($v->category) ?> </li>
                <li>Date Created: <?php char_to_html($v->date_created) ?> </li>
                <li>Date Modified: <?php char_to_html($v->date_modified) ?> </li>
            </ul>
        </ul>
        
    <?php endforeach ?>
    <hr>
 <h4>Comments</h4>
    <?php foreach (Thread::searchComment($keyword) as $v): ?>
        <ul>
        <li> <!-- comment matches -->
            Body:  <?php char_to_html($v->body) ?>                     
        </li>
            <ul>
                <li>Date Created: <?php char_to_html($v->date_created) ?> </li>
                <li>Date Modified: <?php char_to_html($v->date_modified) ?> </li>  
            </ul>
        </ul>
    <?php endforeach ?>    

            
<div class="text-center">
<hr>
    <a class="btn btn-large btn-primary" href="<?php char_to_html(url('thread/search')) ?>"> Back to Search Page </a>
</div>
