<?php
require_once('Partie.php');
require_once('Database.php');
require_once('DAO.php');

class PartieDAO implements DAO {
    private PDO $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    /**
     * 
     * @return array
     */
    public function getAll() {
        $parties = [];
        $stmt = $this->db->query('SELECT * FROM roulette_partie ORDER BY date DESC');
        
        while ($data = $stmt->fetch()) {
            $parties[] = new Partie(
                $data['identifiant'], 
                $data['joueur'], 
                $data['date'], 
                $data['mise'], 
                $data['gain']
            );
        }
        
        return $parties;
    }
    
    /**
     * 
     * @param int $id
     * @return Partie|null
     */
    public function getById($id) {
        $stmt = $this->db->prepare('SELECT * FROM roulette_partie WHERE identifiant = :id');
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();
        
        if ($data) {
            return new Partie(
                $data['identifiant'], 
                $data['joueur'], 
                $data['date'], 
                $data['mise'], 
                $data['gain']
            );
        }
        
        return null;
    }
    
    /**
     * 
     * @param int $joueurId
     * @return array
     */
    public function getByJoueur($joueurId) {
        $parties = [];
        $stmt = $this->db->prepare(
            'SELECT * FROM roulette_partie 
             WHERE joueur = :joueur_id 
             ORDER BY date DESC'
        );
        
        $stmt->execute(['joueur_id' => $joueurId]);
        
        while ($data = $stmt->fetch()) {
            $parties[] = new Partie(
                $data['identifiant'], 
                $data['joueur'], 
                $data['date'], 
                $data['mise'], 
                $data['gain']
            );
        }
        
        return $parties;
    }
    
    /**
     * 
     * @param Partie $partie
     * @return bool
     */
    public function add($partie) {
        $stmt = $this->db->prepare(
            'INSERT INTO roulette_partie (joueur, date, mise, gain) 
             VALUES (:joueur, :date, :mise, :gain)'
        );
        
        return $stmt->execute([
            'joueur' => $partie->getJoueur(),
            'date' => $partie->getDate(),
            'mise' => $partie->getMise(),
            'gain' => $partie->getGain()
        ]);
    }
    
    /**
     * 
     * @param int $joueur
     * @param string $date
     * @param int $mise
     * @param int $gain
     * @return bool
     */
    public function ajoutePartie($joueur, $date, $mise, $gain) {
        $stmt = $this->db->prepare(
            'INSERT INTO roulette_partie (joueur, date, mise, gain) 
             VALUES (:joueur, :date, :mise, :gain)'
        );
        
        return $stmt->execute([
            'joueur' => $joueur,
            'date' => $date,
            'mise' => $mise,
            'gain' => $gain
        ]);
    }
    
    /**
     *
     * @param Partie $partie
     * @return bool
     */
    public function update($partie) {
        $stmt = $this->db->prepare(
            'UPDATE roulette_partie 
             SET joueur = :joueur, date = :date, mise = :mise, gain = :gain 
             WHERE identifiant = :id'
        );
        
        return $stmt->execute([
            'id' => $partie->getIdentifiant(),
            'joueur' => $partie->getJoueur(),
            'date' => $partie->getDate(),
            'mise' => $partie->getMise(),
            'gain' => $partie->getGain()
        ]);
    }
    
    /**
     * 
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        $stmt = $this->db->prepare('DELETE FROM roulette_partie WHERE identifiant = :id');
        return $stmt->execute(['id' => $id]);
    }
    
    /**
     * 
     * @return int
     */
    public function getCount() {
        $stmt = $this->db->query('SELECT COUNT(*) as total FROM roulette_partie');
        $result = $stmt->fetch();
        return $result['total'];
    }
    
    /**
     * 
     * @return int
     */
    public function getTotalGain() {
        $stmt = $this->db->query('SELECT SUM(gain) as total FROM roulette_partie');
        $result = $stmt->fetch();
        return $result['total'] ?: 0;
    }
}