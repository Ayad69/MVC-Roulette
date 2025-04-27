<?php
require_once('Joueur.php');
require_once('model/Database.php');
require_once('DAO.php');

class JoueurDAO implements DAO {
    private PDO $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
  
    public function getAll() {
        $joueurs = [];
        $stmt = $this->db->query('SELECT * FROM roulette_joueur ORDER BY argent DESC');
        
        while ($data = $stmt->fetch()) {
            $joueurs[] = new Joueur(
                $data['identifiant'], 
                $data['nom'], 
                $data['motdepasse'], 
                $data['argent']
            );
        }
        
        return $joueurs;
    }
    
 
    public function getById($id) {
        $stmt = $this->db->prepare('SELECT * FROM roulette_joueur WHERE identifiant = :id');
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();
        
        if ($data) {
            return new Joueur(
                $data['identifiant'], 
                $data['nom'], 
                $data['motdepasse'], 
                $data['argent']
            );
        }
        
        return null;
    }
    
   
    public function getByNom($nom) {
        $stmt = $this->db->prepare('SELECT * FROM roulette_joueur WHERE nom = :nom');
        $stmt->execute(['nom' => $nom]);
        $data = $stmt->fetch();
        
        if ($data) {
            return new Joueur(
                $data['identifiant'], 
                $data['nom'], 
                $data['motdepasse'], 
                $data['argent']
            );
        }
        
        return null;
    }
    
  
    public function add($joueur) {
        $stmt = $this->db->prepare(
            'INSERT INTO roulette_joueur (nom, motdepasse, argent) 
             VALUES (:nom, :motdepasse, :argent)'
        );
        
        return $stmt->execute([
            'nom' => $joueur->getNom(),
            'motdepasse' => $joueur->getMotdepasse(),
            'argent' => $joueur->getArgent()
        ]);
    }
    

    public function ajouteUtilisateur($nom, $motdepasse) {
        $stmt = $this->db->prepare(
            'INSERT INTO roulette_joueur (nom, motdepasse, argent) 
             VALUES (:nom, :motdepasse, 500)'
        );
        
        return $stmt->execute([
            'nom' => $nom,
            'motdepasse' => $motdepasse
        ]);
    }
    
  
    public function update($joueur) {
        $stmt = $this->db->prepare(
            'UPDATE roulette_joueur 
             SET nom = :nom, motdepasse = :motdepasse, argent = :argent 
             WHERE identifiant = :id'
        );
        
        return $stmt->execute([
            'id' => $joueur->getIdentification(),
            'nom' => $joueur->getNom(),
            'motdepasse' => $joueur->getMotdepasse(),
            'argent' => $joueur->getArgent()
        ]);
    }
    
  
    public function majArgent($id, $argent) {
        $stmt = $this->db->prepare(
            'UPDATE roulette_joueur 
             SET argent = :argent 
             WHERE identifiant = :id'
        );
        
        return $stmt->execute([
            'id' => $id,
            'argent' => $argent
        ]);
    }
    
   
    public function delete($id) {
        $stmt = $this->db->prepare('DELETE FROM roulette_joueur WHERE identifiant = :id');
        return $stmt->execute(['id' => $id]);
    }
    
    
    public function authentifier($nom, $motdepasse) {
        $stmt = $this->db->prepare(
            'SELECT * FROM roulette_joueur 
             WHERE nom = :nom AND motdepasse = :motdepasse'
        );
        
        $stmt->execute([
            'nom' => $nom,
            'motdepasse' => $motdepasse
        ]);
        
        $data = $stmt->fetch();
        
        if ($data) {
            return new Joueur(
                $data['identifiant'], 
                $data['nom'], 
                $data['motdepasse'], 
                $data['argent']
            );
        }
        
        return null;
    }
}