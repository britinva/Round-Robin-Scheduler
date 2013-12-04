<?php
class Season {

	private $seasonId;
	protected $tourneyName;
	protected $schedule;
	protected $teams;
	protected $currWeek;
	
	//private $dbConn;

	function __construct($tourneyName, $teams, $timesPlayed = 2, $doShuffle = false) {
		$this->tourneyName = $tourneyName;

		if (count($teams)%2 != 0){
			array_push($teams,"");
		}

		$this->teams = $teams;
		$this->schedule = $this->initSchedule($timesPlayed, $doShuffle);
		$this->currWeek = 0;
		//$this->dbConn = new PDO('mysql:host=localhost;dbname=scheduler', 'root', 'root');
		//$this->seasonId = $this->putData();
	}

	private function putData() {
		try {
			$dbConn = new PDO('mysql:host=localhost;dbname=scheduler', 'root', 'root');
			$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}
		$insertsql = "INSERT INTO seasons (teams, currWeek) VALUES (:teams, :currWeek)";
		$query = $dbConn->prepare($insertsql);
		$query->bindParam(":teams", serialize($this->teams));
		$query->bindParam(":currWeek", $this->currWeek);
		$query->execute();
		return $dbConn->lastInsertId();
	}

	private function initSchedule($timesPlayed, $doShuffle) {
		$copyTeams = $this->teams;

		if ($doShuffle) {
			shuffle($copyTeams);
		}
		
		//print_r($copyTeams);
		
		
		$away = array_splice($copyTeams,(count($copyTeams)/2));
		$home = $copyTeams;

		for ($i=0; $i < (count($home)+count($away)-1)*$timesPlayed; $i++) {
			if ($i % 2 == 0) {
				for ($j=0; $j<count($home); $j++) {
					$round[$i][$j] = new Fixture(array_search($home[$j], $this->teams), array_search($away[$j], $this->teams));
				}	
			} else {
				for ($j=0; $j<count($home); $j++) {
					$round[$i][$j] = new Fixture(array_search($away[$j], $this->teams), array_search($home[$j], $this->teams));				
				}
			}

			if(count($home)+count($away)-1 > 2){
				array_unshift($away,array_shift(array_splice($home,1,1)));
				array_push($home,array_pop($away));
			}
		}
		return $round;
	}


	function showRound($x) {
		//$this->playRound($x);
		echo "<h4>Round ".($x+1)."</h4>";
		echo "<table class=\"table table-striped date-schedule\">";
		echo "<tr><th>Home Team</th><th>Away Team</th></tr>";
		sort($this->schedule[$x]);
		foreach($this->schedule[$x] AS $match) {
			$fixture = $match->getFixture();
			if ($this->teams[$fixture[0]] && $this->teams[$fixture[1]]) {
				echo "<tr><td>".$this->teams[$fixture[0]]."</td>";
				echo "<td>".$this->teams[$fixture[1]]."</td></tr>";
				//echo $match->getScore();
			}
		}
		echo "</table>";
	}

	
	function showTeamFixtures($id) {
		// error handling
		echo "<h4>".$this->teams[$id]." Schedule</h4>";
		echo "<table class=\"table table-striped team-schedule\">";
		echo "<tr><th>Round</th><th>Opponent</th><th>Venue</th></tr>";
		for($i = 0; $i < $this->getNumberRounds(); $i++){
			foreach($this->schedule[$i] AS $match) {
				$thisFixture = $match->getFixture();
				if ($thisFixture[0] == $id) {
					if ($this->teams[$thisFixture[1]]) {
						echo "<tr><td>".($i+1)."</td><td>".$this->teams[$thisFixture[1]]."</td><td>Home</td>"; //show home fixture
					} else {
						echo "<tr><td>".($i+1)."</td><td><i>BYE</i></td><td></td>"; //show bye
					}
					break;					
				} elseif ($thisFixture[1] == $id) {
					if ($this->teams[$thisFixture[0]]) {
						echo "<tr><td>".($i+1)."</td><td>".$this->teams[$thisFixture[0]]."</td><td>Away</td>"; //show away fixture
					} else {
						echo "<tr><td>".($i+1)."</td><td><i>BYE</i></td><td></td>"; //show bye
					}
					break;
				}
			}
		}
		echo "</ul>";
	}


	function playRound($x) {
		foreach($this->schedule[$x] AS $match) {
			$match->playFixture();
		}
	}


	function getNumberRounds() {
		return count($this->schedule);
	}

	
	function getNumberTeams() {
		return count($this->teams);
	}

	
	function getTeamName($x) {
		return $this->teams[$x];
	}


	function getTourneyName() {
		return $this->tourneyName;
	}

	
	function getCurrWeek() {
		return $this->currWeek;
	}

	function getId() {
		return $this->seasonId;
	}

}
