<?php
class Team {

	protected $teamName;

	function __construct($teamName) {
		$this->teamName = $teamName;
	}

	function getTeamName() {
		return $this->teamName;
	}
}
	

