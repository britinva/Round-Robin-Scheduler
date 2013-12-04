<?php
require_once('objects/fixture.php');
require_once('objects/season.php');
require_once('objects/team.php');

session_start();

//$teams = array_filter($_POST['teams']);
$tourneyName = $_POST['tourneyName'];
$teams = explode("\n", trim($_POST['teams']));
$times = $_POST['multiples'];
if(isset($_POST['shuffle'])){
	$league = new Season($tourneyName, $teams, $times, true);
} else {
	$league = new Season($tourneyName, $teams, $times);
}
$_SESSION["league"] = $league;
//print_r($teams);
header("Location: result.php");
exit;
?>
