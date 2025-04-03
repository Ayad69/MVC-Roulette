<?php

class Partie {

	private int $identifiant;
	private int $joueur;	
	private string $date;	
	private int $mise;
    private int $gain;


	public function __construct(int $id, string $jo, string $da, string $mi, int $ga)
	{
		$this->identifiant = $id;
		$this->joueur = $jo;
		$this->date = $da;
		$this->mise = $mi;
        $this->gain = $ga;   
	}

	public function getIdentifiant() {
		return $this->identifiant;
	}

	public function getJoueur() {
		return $this->joueur;
	}

	public function getDate() {
		return $this->date;
	}

	public function getMise() {
		return $this->mise;
	}

    public function getGain() {
		return $this->gain;
	}
		
	public function __set($attr, $value) {
		switch($attr) {
			case 'identifiant':
				$this->identifiant = $value;
				break;
			case 'joueur':
				$this->joueur = $value;
				break;
			case 'date':
				$this->date = $value;
				break;
			case 'mise':
				$this->mise = $value;
				break;
            case 'gain':
                $this->gain = $value;
                break;
			default:
				echo 'ERROR';
				break;
		}
	}

}