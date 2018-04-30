<?php

require_once 'entidades/perfil.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PerfilModel
 *
 * @author enriquegomezpena
 */
class PerfilModel {

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

            $stm = $this->pdo->prepare("SELECT * FROM perfil");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $perfil = new Perfil(
                        $r->id, $r->descripcion);
                $result[] = $perfil;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



}


