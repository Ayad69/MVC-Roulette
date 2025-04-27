<?php
require_once('JoueurDAO.php');

class AuthManager {
    private JoueurDAO $joueurDAO;
    
    public function __construct() {
        $this->joueurDAO = new JoueurDAO();
    }
    
   
    public function connecteUtilisateur($nom, $motdepasse) {
        $joueur = $this->joueurDAO->authentifier($nom, $motdepasse);
        
        if ($joueur) {
         
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
        
            $_SESSION['joueur_id'] = $joueur->getIdentification();
            $_SESSION['joueur_nom'] = $joueur->getNom();
            $_SESSION['joueur_argent'] = $joueur->getArgent();
            
            return '';
        } else {
            return 'Identifiant ou mot de passe incorrect';
        }
    }
    
   
    public function estConnecte() {
    
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        return isset($_SESSION['joueur_id']);
    }
    
    
    public function deconnecte() {
     
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
       
        $_SESSION = array();
        
       
        session_destroy();
    }
    
  
    public function majUtilisateur($id, $argent) {
        return $this->joueurDAO->majArgent($id, $argent);
    }
}