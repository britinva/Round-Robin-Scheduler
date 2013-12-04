<?php
class Fixture {

	protected $homeTeam;
	protected $awayTeam;
	protected $homeScore;
	protected $awayScore;
	
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
	
	function fetchFixture() {
		
	}
}

