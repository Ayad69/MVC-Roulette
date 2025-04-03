<?php
require_once('model\PartieDAO.php');
require_once('model\JoueurDAO.php');



$message_erreur = '';

// Vérifie que le bouton du formulaire a été cliqué
if(isset($_POST['btnConnect'])) {
	// Vérifie que les champs existent et ne sont pas vides
	if(isset($_POST['nom']) && $_POST['nom'] != '' &&
		isset($_POST['motdepasse']) && $_POST['motdepasse'] != '') {
		$message_erreur = connecteUtilisateur($_POST['nom'], $_POST['motdepasse']);
		if($message_erreur == '') {
			// Si pas d'erreur, renvoie l'utilisateur vers le jeu de la roulette
			header('Location: roulette.php');
		}
	}
}
	
?>

<?php


$message_erreur = '';

// Vérifie que le bouton du formulaire a été cliqué
if(isset($_POST['btnSignup'])) {

	// Vérifie que les champs existent et ne sont pas vides
	if(isset($_POST['nom']) && $_POST['nom'] != '' &&
		isset($_POST['motdepasse']) && $_POST['motdepasse'] != '') {

		// Appelle des fonctions de BDD_Manager.php pour ajouter l'utilisateur en BDD puis le connecter
		ajouteUtilisateur($_POST['nom'], $_POST['motdepasse']);
		connecteUtilisateur($_POST['nom'], $_POST['motdepasse']);
		
		// Renvoie l'utilisateur vers le jeu de la roulette
		header('Location: roulette.php');
	} else {
		$message_erreur = 'Il faut remplir les champs!';
	}
}

?>

<?php


$message_erreur = '';
$message_info = '';
$message_erreur = '';
$gagne = false;

if(isset($_POST['btnJouer'])) {
	if($_POST['mise'] < 0) {
		$message_erreur = 'La mise doit être positive';
	} else if($_POST['mise'] == 0) {
		$message_erreur = 'Il faut miser de l\'argent ...';
	} else if($_POST['mise'] > $_SESSION['joueur_argent']) {
		$message_erreur = 'On ne mise pas plus que ce qu\'on a ...';
	} else if($_POST['numero'] == 0 && !isset($_POST['parite'])) {
		$message_erreur = 'Il faut miser sur quelquechose!';
	} else {
		$_SESSION['joueur_argent'] -= $_POST['mise'];
		$gain = 0;
		$numero = rand(1, 36);

		$miseJoueur = intval($_POST['mise']);
		$numeroJoueur = intval($_POST['numero']);
		$message_info = "La bille s'est arrêtée sur le $numero! ";
		if($_POST['numero']!= "") {
			$message_info .= "Vous avez misé sur le ".$numeroJoueur."!";
			if($numeroJoueur == $numero) {
				$message_resultat = "Jackpot! Vous gagnez ". $miseJoueur*35 ."€ !";
				$gagne = true;
				$gain = $miseJoueur*35;
				$_SESSION['joueur_argent'] += $gain;
			} else {
				$message_resultat = "Raté!";
			}
		} else {
			$message_info .= "Vous avez misé sur le fait que le résultat soit ".$_POST['parite'];
			$parite = $numero%2 == 0 ? 'pair' : 'impair';
			if($parite == $_POST['parite']) {
				$message_resultat = "Bien joué! Vous gagnez ". $miseJoueur*2 ."€ !";
				$gagne = true;
				$gain = $miseJoueur*2;
				$_SESSION['joueur_argent'] += $gain;
			} else {
				$message_resultat = "C'est perdu, dommage!";
			}
		}
		majUtilisateur($_SESSION['joueur_id'], $_SESSION['joueur_argent']);
		ajoutePartie($_SESSION['joueur_id'], date('Y-m-d h:i:s'), $_POST['mise'], $gain);
	}
}
?>

<?php include('connexion.php'); ?>
<?php include('roulette.php'); ?>
<?php include('inscription.php'); ?>
