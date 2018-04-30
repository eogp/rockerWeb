<?php
require_once 'entidades/publicacion_direccion.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Publicaion_direccionModel
 *
 * @author enriquegomezpena
 */
class Publicacion_direccionModel {
    //put your code here
     private $conexion;
    private $pdo;
    public function __construct() {
        $this->conexion=new ConexionBD();
        $this->pdo= $this->conexion->getPdo();
    }
    
    public function listar(){
        
        try
        {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM publicacion_direccion");
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $publicacion_direccion=new Publicacion_direccion(
                        $r->id, 
                        $r->publicacion_id, 
                        $r->direccion_id
                        );
                $result[]=$publicacion_direccion;
         
            }

            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
        
    }
    
    public function insertar(Publicacion_direccion $data) {
        try {
            $sql = "INSERT INTO publicacion_direccion (
                                    `publicacion_id`,
                                    `direccion_id`
                                    ) 
                                VALUES (?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getPublicacion_id(),
                                $data->getDireccion_id()

                            )
            );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function obetnerPublicacionDireccionByPubId($id){
        try 
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM publicacion_direccion WHERE (publicacion_id = ? and active=1)");
                      
            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id)){
                $publicacion_direccion=new Publicacion_direccion(
                        $r->id, 
                        $r->publicacion_id, 
                        $r->direccion_id
                        );

                return $publicacion_direccion;
            }
            
            return null;
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
    
    public function eliminarPublicacionDireccion(Publicacion_direccion $data){
        try 
        {
            $sql = "UPDATE publicacion_direccion SET 
                        active      = 0
                    WHERE publicacion_id = ? and direccion_id = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getPublicacion_id(),
                                $data->getDireccion_id(),

                            )
            );
            
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
    
    
}
