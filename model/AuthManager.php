<?php
require_once('JoueurDAO.php');

class AuthManager {
    private JoueurDAO $joueurDAO;
    
    public function __construct() {
        $this->joueurDAO = new JoueurDAO();
    }
    
    /**
     * Connecte un utilisateur avec son nom et mot de passe
     * @param string $nom
     * @param string $motdepasse
     * @return string Message d'erreur ou chaîne vide si succès
     */
    public function connecteUtilisateur($nom, $motdepasse) {
        $joueur = $this->joueurDAO->authentifier($nom, $motdepasse);
        
        if ($joueur) {
            // Démarrer la session si elle n'est pas encore démarrée
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            // Créer les variables de session
            $_SESSION['joueur_id'] = $joueur->getIdentification();
            $_SESSION['joueur_nom'] = $joueur->getNom();
            $_SESSION['joueur_argent'] = $joueur->getArgent();
            
            return '';
        } else {
            return 'Identifiant ou mot de passe incorrect';
        }
    }
    
    /**
     * Vérifie si un utilisateur est connecté
     * @return bool
     */
    public function estConnecte() {
        // Démarrer la session si elle n'est pas encore démarrée
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        return isset($_SESSION['joueur_id']);
    }
    
    /**
     * Déconnecte l'utilisateur
     */
    public function deconnecte() {
        // Démarrer la session si elle n'est pas encore démarrée
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Détruire les variables de session
        $_SESSION = array();
        
        // Détruire la session
        session_destroy();
    }
    
    /**
     * Met à jour l'argent d'un utilisateur
     * @param int $id
     * @param int $argent
     * @return bool
     */
    public function majUtilisateur($id, $argent) {
        return $this->joueurDAO->majArgent($id, $argent);
    }
}