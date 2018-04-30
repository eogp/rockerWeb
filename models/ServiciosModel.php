<?php

require_once 'entidades/servicios.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServiciosModel
 *
 * @author enriquegomezpena
 */
class ServiciosModel {

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

            $stm = $this->pdo->prepare("SELECT * FROM servicios");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $servicios = new Servicios(
                        $r->id, $r->descripcion);
                $result[] = $servicios;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Servicios $data) {
        try {
            $sql = "INSERT INTO servicios (
                                    `descripcion`) 
                                VALUES (?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getDescripcion()
                                
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

   public function obtenerServicioBybId($id) {
        try {
            $stm = $this->pdo
                    ->prepare("SELECT * FROM servicios WHERE (id=? )");

            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id)){
                $servico=new Servicios($r->id, $r->descripcion);
                  
                return $servico;
            }

            return null;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



}

//TEST------------------------------
//$serviciosModel= new ServiciosModel();
//$serviciosModel->mostar();

