<?php

namespace User\Model;
abstract class AbstractModel {
    
    protected $conn;
    public function __construct() {
        $this->conn = new \mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB);
    }
}
