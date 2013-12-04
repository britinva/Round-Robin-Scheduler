<?php

class fixture {
	private $homeTeam;
	private $awayTeam;
	private $homeScore;
	private $awayScore;
	
	function __construct($homeTeam, $awayTeam) {
		$this->homeTeam = $homeTeam;
		$this->awayTeam = $awayTeam;
		//print $homeTeam;
	}
	
	function getFixture() {
		return array ($this->homeTeam, $this->awayTeam);
	}
	
	function playFixture() {
		$this->homeScore = rand(0, 4);
		$this->awayScore = rand(0, 4);
	}
	
	function getScore() {
		return $this->homeScore."-".$this->awayScore;
	}
}


class season {
	private $schedule;
	private $teams;
	private $currWeek;

	function __construct($teams) {
		sort($teams);  // Careful, this might bite you in the butt later
		$this->teams = $teams;
		$this->schedule = $this->initSchedule();
		$this->currWeek = 0;
	}

	private function initSchedule() {

		$copyTeams = $this->teams;
		shuffle($copyTeams);

		if (count($copyTeams)%2 != 0){
			array_push($copyTeams,"bye");
		}

		$away = array_splice($copyTeams,(count($copyTeams)/2));
		$home = $copyTeams;

		for ($i=0; $i < (count($home)+count($away)-1)*2; $i++) {
			if ($i % 2 == 0) {
				for ($j=0; $j<count($home); $j++) {
					$round[$i][$j] = new fixture(array_search($home[$j], $this->teams), array_search($away[$j], $this->teams));
				}	
			} else {
				for ($j=0; $j<count($home); $j++) {
					$round[$i][$j] = new fixture(array_search($away[$j], $this->teams), array_search($home[$j], $this->teams));				
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
		$this->playRound($x);
		echo "<h2>Round ".($x+1)."</h2>";
		echo "<ul>";
		sort($this->schedule[$x]);
		foreach($this->schedule[$x] AS $match) {
			$fixture = $match->getFixture();
			echo "<li>".$this->teams[$fixture[0]]." vs ".$this->teams[$fixture[1]]." ";
			echo $match->getScore();
			echo "</li>";
		}
		echo "</ul>";
	}

	
	function showTeamFixtures($id) {
		// error handling
		echo "<h2>".$this->teams[$id]." Fixtures</h2>";		
		echo "<ul>";
		for($i = 0; $i < $this->getNumberRounds(); $i++){
			foreach($this->schedule[$i] AS $match) {
				$thisFixture = $match->getFixture();
				if ($thisFixture[0] == $id) {
					echo "<li>Round ".($i+1).": ".$this->teams[$thisFixture[1]]." (H)</li>"; //show home fixture
					break;
				} elseif ($thisFixture[1] == $id) {
					echo "<li>Round ".($i+1).": ".$this->teams[$thisFixture[0]]." (A)</li>"; //show away fixture
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

	
	function getNumberRounds(){
		return count($this->schedule);
	}

}

$prem = new season(
	array("Arsenal",
	"Aston Villa",
	"Cardiff City",
	"Chelsea",
	"Crystal Palace",
	"Everton",
	"Fulham",
	"Hull City",
	"Liverpool",
	"Manchester City",
	"Manchester Utd",
	"Newcastle",
	"Norwich",
	"Southampton",
	"Stoke",
	"Sunderland",
	"Swansea",
	"Tottenham",
	"West Brom",
	"West Ham")
);

for ($i = 0; $i < 20; $i++) {
	$prem->showTeamFixtures($i);
}

for($i = 0; $i < $prem->getNumberRounds(); $i++){
	$prem->showRound($i);
}

?>