<?php
require_once('Joueur.php');

class JoueurDAO {

	private ?PDO $bdd;

	public function __construct() {
		$this->bdd = null;
		try {
			$this->bdd = new PDO('mysql:host=localhost;dbname=roulette_cybersecu;charset=utf8', 
				'root', 
				''
			);	
		} catch(Exception $e) {
			die('Erreur connexion BDD : '.$e->getMessage());
		}
	}

	public function getAll() {
		$tab = [];
		$sql = 'SELECT * FROM roulette_joueur ORDER BY argent DESC';
		$req = $this->bdd->query($sql);
	
		while($data = $req->fetch()) {
			$joueur = new Joueur($data['identifiant'], $data['nom'], $data['motdepasse'], $data['argent']);
			$tab[] = $joueur;
	
		}
		return $tab;
	}

	function ajouteUtilisateur($nom, $motdepasse) {
		$bdd = initialiseConnexionBDD();
		if($bdd) {
			$query = $bdd->prepare('INSERT INTO roulette_joueur (nom, motdepasse, argent) VALUES (:t_nom, :t_mdp, 500);');
			$query->execute(array('t_nom' => $nom, 't_mdp' => $motdepasse));
		}
	}

}

