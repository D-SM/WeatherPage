<?php

/**
 * Description of DbConnector
 *
 * @author Scott
 */
namespace App\Model;
class Cities extends AbstractModel {
    private $id;
    
    public function __construct($id){ 
        parent::__construct();
        $this->id = $id;
    }
  
    public function getCities() {
       
        $result = $this->conn->query('SELECT user_id, city_name '
                . 'FROM cities WHERE user_id = ' . $this->id );
        
        return $result ? $result->fetch_all() : null;
    }
    
    public function deleteCity($city) {
        $city = strtolower($city);
        $this->conn->query('DELETE FROM cities WHERE user_id = '. $this->id .' AND city_name = "'. $city .'"');
    }
    
    public function addCity ($city) {
        
        $result = $this->conn->query('SELECT count(*) as count FROM cities WHERE user_id = ' . $this->id
                                . ' AND city_name = "'. $city .'"');

        $count = $result->fetch_assoc();       
       
        if ((int) $count['count'] === 0) {
            $this->conn->query('INSERT INTO cities VALUE (' . $this->id . ',"' . $city .'")');
            return true;
        }  
        return false;     
    }
}   
