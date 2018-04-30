<?php

require_once 'entidades/equipos_marcas.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Equipos_marcasModel
 *
 * @author enriquegomezpena
 */
class Equipos_marcasModel {

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

            $stm = $this->pdo->prepare("SELECT * FROM equipos_marcas");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $equipos_marcas = new Equipos_marcas(
                        $r->id, 
                        $r->equipos_id, 
                        $r->marcas_id);
                $result[] = $equipos_marcas;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Equipos_marcas $data) {

        try {
            $sql = "INSERT INTO equipos_marcas (
                                    `equipos_id`,
                                    `marcas_id`
                                    ) 
                                VALUES (?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getEquipos_id(),
                                $data->getMarcas_id()
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function ListarEquipos_MarcasByEquiposID(Equipos $data){
        try 
        {
            $result = array();
            $stm = $this->pdo
                      ->prepare("SELECT * FROM equipos_marcas WHERE (equipos_id = ? )");
                      
            $stm->execute(array($data->getId()));
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r){
                $equipos_marcas = new Equipos_marcas(
                    $r->id, 
                    $r->equipos_id, 
                    $r->marcas_id
                        );

                $result[] = $equipos_marcas;
            }
            
            return $result;
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

}
