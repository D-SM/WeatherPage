<?php

/**
 * Description of DbConnector
 *
 * @author Scott
 */
namespace App\Model;
class Cities extends AbstractModel {
    
    public function getCities() {
        $result = $this->conn->query('SELECT user_id, city_name '
                . 'FROM cities WHERE user_id = 1');
        return $result->fetch_all();
    }
    
    public function deleteCity($id, $city) {
        $this->conn->query('DELETE FROM cities WHERE user_id = ' . $id . ' AND city_name = "'. $city .'"');
    }
    
    public function addCity ($id, $city) {
        
        $result = $this->conn->query('SELECT count(*) as count FROM cities WHERE user_id = ' . $id
                                . ' AND city_name = "'. $city .'"');
        $count = $result->fetch_assoc();
        
       
        if ($count['count'] !== 1) {
            $this->conn->query('INSERT INTO cities VALUE (' . $id . ',"' . $city .'")');
            return true;
        }  
        return false;     
    }
}   
