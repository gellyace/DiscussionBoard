<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>DietCake</title>
    
    <script type="/bootstrap/js/bootstrap.js"></script>
    <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
      
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!--
    <link href="/custom/css/login_register.css" rel="stylesheet">
    -->
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
          <a class="brand" href="#">DietCake Board Exercises</a>
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
