<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Round Robin Schedule Generator</title>
	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<link href="css/scheduler.css" rel="stylesheet">
	<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
</head>
<body>
	
	<div class="container">
		<div class="masthead">
			<ul class="nav nav-pills pull-right">
				<li><a href="index.php">Home</a></li>
				<li class="active"><a href="about.php">About</a></li>
				<li
					<?php if (!isset($_SESSION["league"])): ?>
					class="disabled"
					<?php endif; ?>
				><a href="result.php">Schedule</a></li>
	
			</ul>
			<h3 class="muted">Round Robin</h3>
		</div>
	</div>

	<div class="main-heading">
		<div class="container">
			<h2>About</h2>
		</div>
	</div>
	
	<div class="container">
		<div class="row-fluid">
			<div class="span12">
				
				<div class="question">
					<h3>What is it?</h3>
					<p>Round Robin a quick project that I created to schedule a round-robin tournament for any number of teams. Sports scheduling has always interested me and I wanted to see how quickly I put an app together. This is the result.</p>
				</div>
				<div class="question">				
					<h3>How does it work?</h3>
					<p>Just enter all the teams you want to schedule, decide how often you want each team to play each other (once, twice or four times) and generate your schedule. There's a randomize option in case you want to see a different schedule each time. You can see you tournament schedule round by round or by each team. </p>
				</div>
				<div class="question">				
					<h3>Can I save my schedule?</h3>
					<p>Not yet, but this is one of the first things I want to add. Right now there's no database connected to the app so no permanent storage. That means if you don't save or print off your schedule you will have to regenerate it later.</p>
				</div>
				<div class="question">				
					<h3>Will you keep developing this?</h3>
					<p>Probably, I certainly don't have a shortage of any ideas. In fact one of the reasons I put this out now is that I'm trying to be better at "shipping" my projects instead of keeping them in a permanent state of development. I'm hoping that by having something live I will be motivated to continue development.</p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>