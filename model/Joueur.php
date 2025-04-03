<?php

class Joueur {

	private int $identification;
	private string $nom;	
	private string $motdepasse;	
	private int $argent;

	public function __construct(int $i, string $na, string $mdp, string $ar)
	{
		$this->identification = $i;
		$this->nom = $na;
		$this->motdepasse = $mdp;
		$this->argent = $ar;
	}

	public function getIdentification() {
		return $this->identification;
	}

	public function getNom() {
		return $this->nom;
	}

	public function getMotdepasse() {
		return $this->motdepasse;
	}

	public function getArgent() {
		return $this->argent;
	}
		
	public function __set($attr, $value) {
		switch($attr) {
			case 'identification':
				$this->identification = $value;
				break;
			case 'nom':
				$this->nom = $value;
				break;
			case 'motdepasse':
				$this->motdepasse = $value;
				break;
			case 'argent':
				$this->argent = $value;
				break;
			default:
				echo 'ERROR';
				break;
		}
	}

}