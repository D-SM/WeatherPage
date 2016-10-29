<?php

/**
 * Description of DbConnector
 *
 * @author Scott
 */
class Cities extends AbstractModel {
    
    public function getCities($id) {
        $result = $this->conn->query('SELECT user_id, city_name '
                . 'FROM weather WHERE user_id = ' . $id);
        return $result->fetch_all();
    }
    
    public function deleteCity($id, $city) {
        $this->conn->query('DELETE FROM weather WHERE user_id = ' . $id . ' AND city_name = ' . $city);
    }
    
    public function addCity ($id, $city) {
        
        $result = $this->conn->query('SELECT count(*) as count FROM weather WHERE user_id = ' . $id
                                . ' AND city_name = ' . $city);
        $count = $result->fetch_assoc();
        
       
        if ($count['count'] !== 1) {
            $this->conn->query('INSERT INTO weather VALUE (' . $id . ',"' . $city .'")');
            return true;
        }  
        return false;     
    }
}   