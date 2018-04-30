<?php
require_once 'entidades/instrumentos.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InstrumentosModel
 *
 * @author enriquegomezpena
 */
class InstrumentosModel {
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

            $stm = $this->pdo->prepare("SELECT * FROM instrumentos");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $instrumentos = new Instrumentos(
                        $r->id, 
                        $r->descripcion
                        );
                $result[] = $instrumentos;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function insertar(Instrumentos $data) {

        try {
            $sql = "INSERT INTO instrumentos (
                                    `descripcion`
                                    ) 
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
    
    public function obetenerInstrumentosByID($id){
        try 
        {
            
            $stm = $this->pdo
                      ->prepare("SELECT * FROM instrumentos WHERE (id = ? )");
                      
            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id)){
                $instrumento=new Instrumentos($r->id, $r->descripcion);

                return  $instrumento;
            }
            
            return null;
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

 
}
