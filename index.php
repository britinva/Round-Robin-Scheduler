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
				<li class="active"><a href="index.php">Home</a></li>
				<li><a href="about.php">About</a></li>
				<li
					<?php if (!isset($_SESSION["league"])): ?>
					class="disabled"
					<?php endif; ?>
				><a href="result.php">Schedule</a></li>
			</ul>
			<h3 class="muted">Round Robin</h3>
		</div>
	</div>
	
	<div class="hero-unit">
		<div class="container">
			<h1>Create your schedule quickly and&nbsp;easily</h1>
		</div>
	</div>
	
	<div class="container">
		<form id="scheduler" action="generate.php" method="post" onsubmit="return validate()">
	
			<div class="row-fluid marketing">
				<div class="form-col span8 offset2 teams">
					<h3>The grand prize</h3>
					<p class="text-center"><input type="text" name="tourneyName" id="tourneyName" placeholder="Tournament Name" class="span8" /></p>
					<h3>Who’s competing?</h3>
					<p>
						<textarea name="teams" id="teams" placeholder="Teams (one per line)" class="expanding"></textarea>
					</p>
					<h3>How often?</h3>
					<p class="offset4 span4">
						<label class="radio" for="x1"><input type="radio" id="x1" name="multiples" value="1" /> 1x</label>
						<label class="radio" for="x2"><input type="radio" id="x2" name="multiples" value="2" checked="checked" /> 2x (Home & Away)</label>
						<label class="radio" for="x4"><input type="radio" id="x4" name="multiples" value="4" /> 4x (2x Home &amp; Away)</label>
					</p>
				</div>				
				<input type="checkbox" name="shuffle" id="shuffle" class="hidden" checked />
			</div>
			<div class="row-fluid">
				<div class="offset3 span6">		
					<input type="submit" class="btn btn-large btn-primary btn-block" style="" value="Create Schedule" />
				</div>
			</div>
		</form>
		
	</div>	

	<script>
		function validate() {
	        var tournamentName = document.getElementById("tourneyName").value;
	        var teams = document.getElementById("teams").value;
	        var numberOfTeams = (teams.match(/\n/g)||[]).length;

			if (tournamentName == "") {
				alert("Please enter a tournament name");
				return false;
			}
			if (numberOfTeams < 2) {
				alert("Please enter three or more teams");
				return false;
			}

		}
	</script>
	<?php include_once("includes/analytics.php"); ?>
</body>
</html>