<?php
require_once 'entidades/publicacion_showeventos.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Publicacion_showeventosModel
 *
 * @author enriquegomezpena
 */
class Publicacion_showeventosModel {
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

            $stm = $this->pdo->prepare("SELECT * FROM publicacion_showeventos");
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $publicacion_showeventos=new Publicacion_showeventos(
                        $r->id, 
                        $r->publicacion_id, 
                        $r->showeventos_id
                        );
                $result[]=$publicacion_showeventos;
         
            }

            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
        
    }
    
    public function insertar(Publicacion_showeventos $data) {
        try {
            $sql = "INSERT INTO publicacion_showeventos (
                                    `publicacion_id`,
                                    `showeventos_id`
                                    ) 
                                VALUES (?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getPublicacion_id(),
                                $data->getShoweventos_id()

                            )
            );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function obtenerPublicacion_showeventosByPubId($id){
        try 
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM publicacion_showeventos WHERE (publicacion_id = ?)");
                      
            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id)){
                $publicacion_showeventos=new Publicacion_showeventos(
                        $r->id, 
                        $r->publicacion_id, 
                        $r->showeventos_id
                        );

                return $publicacion_showeventos;
            }
            
            return null;
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
    
    
}
