<?php
require_once('model/PartieDAO.php');
require_once('model/JoueurDAO.php');
require_once('model/AuthManager.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$authManager = new AuthManager();
$joueurDAO = new JoueurDAO();
$partieDAO = new PartieDAO();

$module = "connexion";
$message_erreur = '';


if(isset($_GET['inscription'])){
    $module = "inscription";
}


if(isset($_POST['btnConnect'])) {

    if(isset($_POST['nom']) && $_POST['nom'] != '' &&
       isset($_POST['motdepasse']) && $_POST['motdepasse'] != '') {
        
        $message_erreur = $authManager->connecteUtilisateur($_POST['nom'], $_POST['motdepasse']);
        
        if($message_erreur == '') {
            header('Location: view/roulette.php');
            exit;
        }
    } else {
        $message_erreur = 'Veuillez remplir tous les champs';
    }
}


if(isset($_POST['btnSignup'])) {
  
    if(isset($_POST['nom']) && $_POST['nom'] != '' &&
       isset($_POST['motdepasse']) && $_POST['motdepasse'] != '') {
        

        $joueur = $joueurDAO->getByNom($_POST['nom']);
        
        if ($joueur) {
            $message_erreur = 'Cet identifiant est déjà utilisé';
        } else {
     
            $joueurDAO->ajouteUtilisateur($_POST['nom'], $_POST['motdepasse']);
            
     
            $authManager->connecteUtilisateur($_POST['nom'], $_POST['motdepasse']);
            
  
            header('Location: view/roulette.php');
            exit;
        }
    } else {
        $message_erreur = 'Il faut remplir les champs!';
    }
}


if($module == "inscription") {
    include('view/inscription.php'); 
} elseif ($module == "connexion") {
    include('view/connexion.php'); 
}