<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Publicacion_productosModel
 *
 * @author enriquegomezpena
 */
class Publicacion_productosModel {
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

            $stm = $this->pdo->prepare("SELECT * FROM publicacion_productos");
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $publicacion_productos=new Publicacion_productos(
                        $r->id,
                        $r->publicacion_id, 
                        $r->productos_id
                        );
                $result[]=$publicacion_productos;
         
            }

            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
        
    }
    
    public function insertar(Publicacion_productos $data) {
        try {
            $sql = "INSERT INTO publicacion_productos (
                                    `publicacion_id`,
                                    `productos_id`
                                    ) 
                                VALUES (?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getPublicacion_id(),
                                $data->getProductos_id()
                            )
            );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function obtenerPublicacion_productosByPubId($id){
        
        try
        {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM publicacion_productos WHERE (publicacion_id = ? and active=1)");
            $stm->execute(array($id));

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $publicacion_productos=new Publicacion_productos(
                        $r->id,
                        $r->publicacion_id, 
                        $r->productos_id
                        );
                $result[]=$publicacion_productos;
         
            }

            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
        
    }
    
    public function eliminarPublicacionProductos($pubId) {
        try {
            $sql = "UPDATE publicacion_productos SET 
                        active = 0
                    WHERE publicacion_id = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $pubId
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
}
