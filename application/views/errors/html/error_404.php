<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>404 Page Not Found</title>
<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

body {
	background-color: #fff;
	margin: 0px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin: 0px;
	background: #ffffff;
	border: 1px solid #D0D0D0;
	box-shadow: 0 0 8px #000000;
	
	position: absolute;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 30%;
    top: 50%;
    text-align: center;
}
.inquery{
    position: absolute;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 30%;
    top: 50%;
    /*margin-left: -25%;
    bottom: 10px !important;
    */
}
.inquery img{
    max-width: 100%;
}
p {
	margin: 12px 15px 12px 15px;
}
body, html, .container-fluid { /// take all available height
	background-position: 50%;
	background-repeat: no-repeat;
	background-size: cover;
	height: 100%;
}

</style>
</head>
<body style="background-image: url(<?php echo home_url().'/asset/'.idwebsite('header'); ?>);">
	<div id="container">

		<?php

		$link = (isset($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
		//echo str_replace('administrator/','',$link);
		//echo base_url();
		//echo containsWord('administrator/', $link);
		if (strpos(base_url(), "administrator/") !== false){
		// car found
			echo str_replace('administrator/','',base_url());
			header("Location: ".home_url(), true, 301);
			exit();
		}
		//echo home_url('contoh');
		//echo basename($_SERVER['SCRIPT_NAME']);
		//echo $link;//$_SERVER['HTTP_HOST']; //current_url().; 

		?>
		<a href="<?php echo home_url();?>"><img src="<?php echo home_url().'asset/'.idwebsite('logo'); ?>"></a>
		<!--<progress value="0" max="10" id="progressBar"></progress>-->
		<div class="row begin-countdown">
		  <div class="col-md-12 text-center">
		    <progress value="5" max="5" id="pageBeginCountdown"></progress>
		    <p> Begining in <span id="pageBeginCountdownText">5 </span> seconds</p>
		  </div>
		</div>
		<h1><?php echo $heading; ?> | Apa yg anda cari ?</h1>
		<?php echo $message; ?>
	</div>
	<script type="text/javascript">
		/*
		var timeleft = 10;
		var downloadTimer = setInterval(function(){
		  document.getElementById("progressBar").value = 10 - --timeleft;
		  if(timeleft <= 0)
		    clearInterval(downloadTimer);
		},1000);
		*/
		var url= "<?php echo home_url(); ?>";
		//var pindah = window.location = url;

		//ProgressCountdown(4, 'pageBeginCountdown', 'pageBeginCountdownText').then(value => alert(`Page has started: ${value}.`));
		ProgressCountdown(4, 'pageBeginCountdown', 'pageBeginCountdownText').then(value => '');

		function ProgressCountdown(timeleft, bar, text) {
		  return new Promise((resolve, reject) => {
		    var countdownTimer = setInterval(() => {
		      timeleft--;

		      document.getElementById(bar).value = timeleft;
		      document.getElementById(text).textContent = timeleft;

		      if (timeleft <= 0) {
		      	
		        clearInterval(countdownTimer);
		        resolve(true);
		        window.location = url;
		      }
		    }, 1000);
		  });
		}
	</script>
</body>
</html>