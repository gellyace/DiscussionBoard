<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>DietCake</title>
        
    <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="/custom/custom.css" rel="stylesheet">
    
    <script type="text/javascript" src="https://code.jquery.com/jquery.min.js"></script>
    <script type="/bootstrap/js/bootstrap.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="/custom/script.js"></script>

    <style>
      body {
        padding-top: 60px;
      }
    </style>
  </head>

  <body>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="#" id="header_name">Discussion Board</a>
        </div>
      </div>
    </div>

    <div class="container">

      <?php echo $_content_ ?>

    </div>

    <script>
    console.log(<?php char_to_html(round(microtime(true) - TIME_START, 3)) ?> + 'sec');
    </script>

  </body>
</html>
