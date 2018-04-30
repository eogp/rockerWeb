<?php
require_once 'entidades/instrumentos_marcas.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Instrumentos_marcasModel
 *
 * @author enriquegomezpena
 */
class Instrumentos_marcasModel {
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

            $stm = $this->pdo->prepare("SELECT * FROM instrumentos_marcas");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $instrumentos_marcas = new Instrumentos_marcas(
                        $r->id, 
                        $r->instrumentos_id, 
                        $r->marcas_id
                        );
                $result[] = $instrumentos_marcas;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function insertar(Instrumentos_marcas $data) {

        try {
            $sql = "INSERT INTO instrumentos_marcas (
                                    `instrumentos_id`,
                                    `marcas_id`
                                    ) 
                                VALUES (?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getInstrumentos_id(),
                                $data->getMarcas_id()
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function ListarInstrumentos_MarcasByInstrumentosID(Instrumentos $data){
        try 
        {
            $result = array();
            $stm = $this->pdo
                      ->prepare("SELECT * FROM instrumentos_marcas WHERE (instrumentos_id = ? )");
                      
            $stm->execute(array($data->getId()));
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r){
                
                $instrumentos_marcas = new Equipos_marcas(
                    $r->id, 
                    $r->instrumentos_id, 
                    $r->marcas_id
                        );

                $result[] = $instrumentos_marcas;
            }
            
            return $result;
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
    
}
