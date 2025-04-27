<?php
require_once('model/PartieDAO.php');
require_once('model/JoueurDAO.php');
require_once('model/AuthManager.php');

// Démarrer la session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$authManager = new AuthManager();
$joueurDAO = new JoueurDAO();
$partieDAO = new PartieDAO();

$module = "connexion";
$message_erreur = '';

// Vérifie que le bouton du formulaire a été cliqué
if(isset($_GET['inscription'])){
    $module = "inscription";
}

// Traitement du formulaire de connexion
if(isset($_POST['btnConnect'])) {
    // Vérifie que les champs existent et ne sont pas vides
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

// Traitement du formulaire d'inscription
if(isset($_POST['btnSignup'])) {
    // Vérifie que les champs existent et ne sont pas vides
    if(isset($_POST['nom']) && $_POST['nom'] != '' &&
       isset($_POST['motdepasse']) && $_POST['motdepasse'] != '') {
        
        // Vérifie si l'utilisateur existe déjà
        $joueur = $joueurDAO->getByNom($_POST['nom']);
        
        if ($joueur) {
            $message_erreur = 'Cet identifiant est déjà utilisé';
        } else {
            // Ajoute le nouvel utilisateur
            $joueurDAO->ajouteUtilisateur($_POST['nom'], $_POST['motdepasse']);
            
            // Connecte l'utilisateur
            $authManager->connecteUtilisateur($_POST['nom'], $_POST['motdepasse']);
            
            // Redirige vers le jeu
            header('Location: view/roulette.php');
            exit;
        }
    } else {
        $message_erreur = 'Il faut remplir les champs!';
    }
}

// Affichage des vues
if($module == "inscription") {
    include('view/inscription.php'); 
} elseif ($module == "connexion") {
    include('view/connexion.php'); 
}