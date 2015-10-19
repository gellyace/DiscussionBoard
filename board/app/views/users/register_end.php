<h2>Register</h2>
<p class="alert alert-success">
	Registration successful. <br>
	You will be redirected to the Login Page in <span id="countdown">3</span> seconds.
</p>

<script type="text/javascript">
(function () {
    var timeLeft = 3,
        cinterval;

    var timeDec = function (){
        timeLeft--;
        document.getElementById('countdown').innerHTML = timeLeft;
        if(timeLeft === 0){
            clearInterval(cinterval);
            window.location.href = "<?php char_to_html(url('users/login')) ?>";
        }
    };
    cinterval = setInterval(timeDec, 1000);
})();
</script>
