<?php
require_once('objects/fixture.php');
require_once('objects/season.php');
require_once('objects/team.php');
session_start();
$league = $_SESSION["league"];
if (isset($_REQUEST["teamid"])) {
	$team = $_REQUEST["teamid"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Fixture Generator</title>
	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<link href="css/scheduler.css" rel="stylesheet">
	<script src="//code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="masthead">
			<ul class="nav nav-pills pull-right">
				<li><a href="index.php">Home</a></li>
				<li><a href="about.php">About</a></li>
				<li class="active"><a href="result.php">Schedule</a></li>
			</ul>
			<h3 class="muted">Round Robin</h3>
		</div>
	</div>

	<div class="main-heading">
		<div class="container">
			<h2><?=$league->getTourneyName()?></h2>
		</div>
	</div>

	<div class="container">
		<div class="row-fluid">
			<ul class="nav nav-tabs">
				<li 
					<?php if (!isset($team)): ?>class="active"<?php endif; ?>
				>
					<a href="result.php">by Round</a>
				</li>
				<li class="dropdown
					<?php if (isset($team)): ?>active<?php endif; ?>
				">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">by Team<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<?php for ($i = 0; $i < $league->getNumberTeams(); $i++):?>
							<li><a href="result.php?teamid=<?=$i?>"><?=$league->getTeamName($i)?></a></li>
						<?php endfor?>
					</ul>
				</li>
			</ul>
			
			<?php
			if (isset($team)) {
				$league->showTeamFixtures($team);
			} else {
				for($i = 0; $i < $league->getNumberRounds(); $i++){
					$league->showRound($i);
				}
			}
			?>
		</div>
	</div>
	<?php include_once("includes/analytics.php"); ?>
</body>
</html>
