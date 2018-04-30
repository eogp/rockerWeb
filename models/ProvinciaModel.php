<?php

require_once 'entidades/provincia.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProvinciaModel
 *
 * @author enriquegomezpena
 */
class ProvinciaModel {

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

            $stm = $this->pdo->prepare("SELECT * FROM provincia");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $provincia = new Provincia(
                        $r->id, $r->nombre);
                $result[] = $provincia;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerProvinciaById($id) {
        try {
            $stm = $this->pdo
                    ->prepare("SELECT * FROM provincia WHERE (id=?)");

            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if (isset($r->id)) {
                $provincia = new Provincia(
                        $r->id, $r->nombre);


                return $provincia;
            }

            return null;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
     public function ObtenerProvinciaByName($nombre) {
        try {
            $stm = $this->pdo
                    ->prepare("SELECT * FROM provincia WHERE (nombre=?)");
            $stm->execute(array($nombre));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if (isset($r->id)) {
                $provincia = new Provincia(
                        $r->id, 
                        $r->nombre);
                return $provincia;
            }
            return null;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //TEST--------------------------
    public function mostar() {

        foreach ($this->listar() as $item) {

            echo $item->getId();
            echo $item->getNombre();
        }
    }

}

//TEST------------------------------
//$ProvinciaModel= new ProvinciaModel();
//$ProvinciaModel->mostar();

