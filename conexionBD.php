<?php

/**
 * 
 */
class ConexionBD {

    private $pdo;

    function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=rockerapp', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getPdo() {
        return $this->pdo;
    }

    public function getlastInsert(){
        return $this->pdo->lastInsertId();
    }
    
}
