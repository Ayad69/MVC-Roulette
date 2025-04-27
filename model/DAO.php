<?php
interface DAO {
    /**
     * 
     * @return array
     */
    public function getAll();
    
    /**
     *
     * @param int $id
     * @return mixed
     */
    public function getById($id);
    
    /**
     * 
     * @param mixed $item
     * @return bool
     */
    public function add($item);
    
    /**
     * 
     * @param mixed $item
     * @return bool
     */
    public function update($item);
    
    /**
     * 
     * @param int $id
     * @return bool
     */
    public function delete($id);
}