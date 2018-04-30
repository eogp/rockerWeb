<?php
require_once 'entidades/marcas.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MarcasModel
 *
 * @author enriquegomezpena
 */
class MarcasModel {
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

            $stm = $this->pdo->prepare("SELECT * FROM marcas");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $marcas = new Marcas(
                        $r->id, 
                        $r->descripcion
                        );
                $result[] = $marcas;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    
    public function insertar(Marcas $data) {

        try {
            $sql = "INSERT INTO marcas (
                                    `descripcion`
                                    ) 
                                VALUES (?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getDescripcion(),
                                $data->getEquiporef_id()
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function ObetenerMarcasByID($data){
        try 
        {
            
            $stm = $this->pdo
                      ->prepare("SELECT * FROM marcas WHERE (id = ? )");
                      
            $stm->execute(array($data));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id)){
                $marcas = new Marcas(
                    $r->id, 
                    $r->descripcion
                        );

                return  $marcas;
            }
            
            return null;
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
    
    public function obetenerIDByNombre($data){
        try 
        {
            //DEVUELVE EL PRIMERP
            $stm = $this->pdo
                      ->prepare("SELECT * FROM marcas WHERE (descripcion = ? )");
                      
            $stm->execute(array($data));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id)){


                return  $r->id;
            }
            
            return null;
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
    
}
