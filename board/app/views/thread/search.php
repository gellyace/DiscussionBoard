<!DOCTYPE html>
<html class="search">
<head>
    <title></title>
</head>
<body class="search">
<!-- Form Block -->
<h1> Search Page</h1>
<div class="col-sm-3">
<form role="form" name="search" action="<?php char_to_html(url('')) ?>" method="post">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search" name="keyword" required value="<?php char_to_html(Param::get('keyword')) ?>" onFocus="this.value=''"/>
    <div class="input-group-btn">
        <input type="hidden" name="page_next" value="search_end"/>
        <button type="submit" class="btn btn-primary">Submit</button> 
    </div>    
</form>
</div>

<br><br><br><br><hr>
<div class="text-center">
<a href="<?php char_to_html(url('thread/index')) ?>">
    &larr; Go to All Threads
</a>
</div>
</body>
</html>
