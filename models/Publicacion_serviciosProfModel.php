<?php
require_once 'entidades/publicacion_serviciosProf.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Publicacion_serviciosProfModel
 *
 * @author enriquegomezpena
 */
class Publicacion_serviciosProfModel {
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

            $stm = $this->pdo->prepare("SELECT * FROM publicacion_serviciosProf");
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $publicacion_serviciosProf=new Publicacion_serviciosProf(
                        $r->id, 
                        $r->publicacion_id, 
                        $r->serviciosProf_id,
                        $r->experiencia

                        );
                $result[]=$publicacion_serviciosProf;
         
            }

            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
        
    }
    
    public function insertar(Publicacion_serviciosProf $data) {
        try {
            $sql = "INSERT INTO publicacion_serviciosProf (
                                    `publicacion_id`,
                                    `serviciosProf_id`,
                                    `experiencia`
                                    ) 
                                VALUES (?, ?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getPublicacion_id(),
                                $data->getServiciosProf_id(),
                                $data->getExperiencia()
                            )
            );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function obtenerPublicacion_servProfByPubId($id){
        
        try
        {
            $stm = $this->pdo->prepare("SELECT * FROM publicacion_serviciosProf WHERE (publicacion_id = ?)");
            $stm->execute(array($id));

            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id))
            {
                $publicacion_serviciosProf=new Publicacion_serviciosProf(
                        $r->id, 
                        $r->publicacion_id, 
                        $r->serviciosProf_id,
                        $r->experiencia

                        );
                return $publicacion_serviciosProf;
         
            }

            return null;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
        
    }
    
     public function actualizar(Publicacion_serviciosProf $data){
         try 
        {
            $sql = "UPDATE publicacion_serviciosProf SET 
                        `serviciosProf_id` = ?,
                        `experiencia` = ?
                    WHERE publicacion_id = ?";

            $this->pdo->prepare($sql)
                 ->execute(
                array(
                    $data->getServiciosProf_id(), 
                    $data->getExperiencia(),
                    $data->getPublicacion_id()
                    )
                );
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
    
}
