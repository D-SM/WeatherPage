<?php

/**
 * Description of DbConnector
 *
 * @author Scott
 */
namespace App\Model;
class Cities extends AbstractModel {
    private $id;
    
    public function __construct(){
        $this->id = filter_var(session::getId(), FILTER_SANITIZE_NUMBER_INT);
    }
    public function getCities() {
        $result = $this->conn->query('SELECT user_id, city_name '
                . 'FROM cities WHERE user_id = ' . $this->id );
        
        return $result->fetch_all();
    }
    
    public function deleteCity($city) {
        $this->conn->query('DELETE FROM cities WHERE user_id = '. $this->id .' AND city_name = "'. $city .'"');
    }
    
    public function addCity ($city) {
        
        $result = $this->conn->query('SELECT count(*) as count FROM cities WHERE user_id = ' . $this->id
                                . ' AND city_name = "'. $city .'"');

        $count = $result->fetch_assoc();       
       
        if ($count['count'] !== 1) {
            $this->conn->query('INSERT INTO cities VALUE (' . $this->id . ',"' . $city .'")');
            return true;
        }  
        return false;     
    }
}   
