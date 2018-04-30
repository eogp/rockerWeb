<?php

require_once 'conexionBD.php';
require_once 'entidades/pais.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PaisModel
 *
 * @author enriquegomezpena
 */
class PaisModel {

    //put your code here

    private $conexion;
    private $pdo;

    public function __construct() {
        $this->conexion = new ConexionBD();
        $this->pdo = $this->conexion->getPdo();
    }

    public function listar() {

        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM pais");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $pais = new Pais(
                        $r->id, $r->nombre);
                $result[] = $pais;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerPaisById($id) {
        try {
            $stm = $this->pdo
                    ->prepare("SELECT * FROM pais WHERE (id=?)");

            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if (isset($r->id)) {
                $pais=new Pais($r->id, 
                        $r->nombre);

                return $pais;
            }

            return null;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
       public function ObtenerPaisByName($nombre) {
        try {
            $stm = $this->pdo
                    ->prepare("SELECT * FROM pais WHERE (nombre=?)");

            $stm->execute(array($nombre));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if (isset($r->id)) {
                        $pais=new Pais($r->id, 
                        $r->nombre);

                return $pais;
            }

            return null;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
