<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
	<h3>Welcome Back <?php echo (get_session_username()); ?></h3>
	<p class="alert alert-success">
		You will be redirected to the Home Page in <span id="countdown">3</span> seconds.
	</p>
</body>
</html>

<script type="text/javascript">
(function () {
    var timeLeft = 3,
        cinterval;

    var timeDec = function (){
        timeLeft--;
        document.getElementById('countdown').innerHTML = timeLeft;
        if(timeLeft === 0){
            clearInterval(cinterval);
            window.location.href = "<?php char_to_html(url('thread/index')) ?>";
        }
    };
    cinterval = setInterval(timeDec, 1000);
})();
</script>
