<?php
interface DAO {
    /**
     * Récupère tous les éléments
     * @return array
     */
    public function getAll();
    
    /**
     * Récupère un élément par son identifiant
     * @param int $id
     * @return mixed
     */
    public function getById($id);
    
    /**
     * Ajoute un élément
     * @param mixed $item
     * @return bool
     */
    public function add($item);
    
    /**
     * Met à jour un élément
     * @param mixed $item
     * @return bool
     */
    public function update($item);
    
    /**
     * Supprime un élément
     * @param int $id
     * @return bool
     */
    public function delete($id);
}