<?php
require_once 'entidades/publicacion_estilovida.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Publicacion_estilovidaModel
 *
 * @author enriquegomezpena
 */
class Publicacion_estilovidaModel {
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

            $stm = $this->pdo->prepare("SELECT * FROM publicacion_estilovida");
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $publicacion_estilovida=new Publicacion_estilovida(
                        $r->id, 
                        $r->publicacion_id, 
                        $r->estilovida_id
                        );
                $result[]=$publicacion_estilovida;
         
            }

            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
        
    }
    
    public function insertar(Publicacion_estilovida $data) {
        try {
            $sql = "INSERT INTO publicacion_estilovida (
                                    `publicacion_id`,
                                    `estilovida_id`
                                    ) 
                                VALUES (?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getPublicacion_id(),
                                $data->getEstilovida_id()
                            )
            );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function obtenerPublicacion_estiloVidaByPubId($id){
        try 
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM publicacion_estilovida WHERE (publicacion_id = ?)");
                      
            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id)){
                $publicacion_estilovida=new Publicacion_estilovida(
                        $r->id, 
                        $r->publicacion_id, 
                        $r->estilovida_id
                        );

                return $publicacion_estilovida;
            }
            
            return null;
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
    
    
}
