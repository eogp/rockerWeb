<?php
require_once 'entidades/publicacion.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PublicacionModel
 *
 * @author enriquegomezpena
 */
class PublicacionModel {
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

            $stm = $this->pdo->prepare("SELECT * FROM publicacion");
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $publicacion=new Publicacion(
                        $r->id, 
                        $r->nombre, 
                        $r->descripcion, 
                        $r->usuarioweb_id, 
                        $r->alta, 
                        $r->activa, 
                        $r->email,
                        $r->pagos_id, 
                        $r->tipoPub_id, 
                        $r->web);
                $result[]=$publicacion;
         
            }

            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
        
    }
    public function listarActivas(){
        
        try
        {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM publicacion WHERE activa=1");
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $publicacion=new Publicacion(
                        $r->id, 
                        $r->nombre, 
                        $r->descripcion, 
                        $r->usuarioweb_id, 
                        $r->alta, 
                        $r->activa, 
                        $r->email,
                        $r->pagos_id, 
                        $r->tipoPub_id, 
                        $r->web);
                $result[]=$publicacion;
         
            }

            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
        
    }
    
    public function insertar(Publicacion $data) {
        try {
            $sql = "INSERT INTO publicacion (
                                    `nombre`,
                                    `descripcion`,
                                    `usuarioweb_id`,
                                    `alta`,
                                    `activa`,
                                    `email`,
                                    `pagos_id`,
                                    `tipoPub_id`,
                                    `web`) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getNombre(),
                                $data->getDescripcion(),
                                $data->getUsuarioweb_id(),
                                $data->getAlta(),
                                $data->getActiva(),
                                $data->getEmail(),
                                $data->getPagos_id(),
                                $data->getTipoPub_id(),
                                $data->getWeb()
                            )
            );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function ObtenerPublicacion($id){
        try 
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM publicacion WHERE (id = ?)");
                      
            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id)){
                $publicacion = new Publicacion(
                        $r->id, 
                        $r->nombre, 
                        $r->descripcion, 
                        $r->usuarioweb_id, 
                        $r->alta, 
                        $r->activa, 
                        $r->email,
                        $r->pagos_id, 
                        $r->tipoPub_id, 
                        $r->web);

                return $publicacion;
            }
            
            return null;
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
    
    public function obetenerPublicacionesByUser($id){
        
        try
        {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM publicacion WHERE (usuarioweb_id = ?)");
            $stm->execute(array($id));

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $publicacion=new Publicacion(
                        $r->id, 
                        $r->nombre, 
                        $r->descripcion, 
                        $r->usuarioweb_id, 
                        $r->alta, 
                        $r->activa, 
                        $r->email,
                        $r->pagos_id, 
                        $r->tipoPub_id, 
                        $r->web);
                $result[]=$publicacion;
         
            }

            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
        
        
    }
   
    public function actualizar(Publicacion $data){
         try 
        {
            $sql = "UPDATE publicacion SET 
                        `nombre` =?,
                        `email` =?,
                        `web` =?
                    WHERE id = ?";

            $this->pdo->prepare($sql)
                 ->execute(
                array(
                    $data->getNombre(), 
                    $data->getEmail(),
                    $data->getWeb(),
                    $data->getId()
                    )
                );
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
    
    public function pausar($pubId){
         try 
        {
            $sql = "UPDATE publicacion SET 
                        `activa` = 0
                    WHERE id = ?";

            $this->pdo->prepare($sql)
                 ->execute(
                array(
                    $pubId
                    )
                );
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
    
    public function reanudar($pubId){
         try 
        {
            $sql = "UPDATE publicacion SET 
                        `activa` = 1
                    WHERE id = ?";

            $this->pdo->prepare($sql)
                 ->execute(
                array(
                    $pubId
                    )
                );
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

}
