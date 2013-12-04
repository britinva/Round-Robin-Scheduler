<?php
require_once('objects/fixture.php');
require_once('objects/season.php');
require_once('objects/team.php');

session_start();
$league = $_SESSION["league"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Fixture Generator</title>
	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<link href="css/scheduler.css" rel="stylesheet">
	<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
	
    <style type="text/css">
	</style>
</head>
<body>
<h2>League <?=$league->getId()?>
<h3>View By Team</h3>
<ul>
<?php for ($i = 0; $i < $league->getNumberTeams(); $i++):?>
	<li><a href="result.php?teamid=<?=$i?>"><?=$league->getTeamName($i)?></a></li>
<?php endfor?>
</ul>

<h3><a href="result.php">View Full Schedule</a></h3>
</body>
</html>