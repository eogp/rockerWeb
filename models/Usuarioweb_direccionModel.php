<?php
require_once 'entidades/usuarioweb_direccion.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuarioweb_direccionModel
 *
 * @author enriquegomezpena
 */
class Usuarioweb_direccionModel {
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

            $stm = $this->pdo->prepare("SELECT * FROM usuarioweb_direccion");
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $usuarioweb_direccion=new Usuarioweb_direccion(
                        $r->id, 
                        $r->usuarioweb_id, 
                        $r->direccion_id
                        );
                $result[]=$usuarioweb_direccion;
         
            }

            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
        
    }
    
    public function insertar(Usuarioweb_direccion $data) {
        try {
            $sql = "INSERT INTO usuarioweb_direccion (
                                    `usuarioweb_id`,
                                    `direccion_id`
                                    ) 
                                VALUES (?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getUsuarioweb_id(),
                                $data->getDireccion_id()

                            )
            );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function ObtenerUsuarioweb_direccionByUserID($usuarioweb_id){
        try 
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM usuarioweb_direccion WHERE (usuarioweb_id = ?)");
                      
            $stm->execute(array($usuarioweb_id));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id)){
                $usuarioweb_direccion = new Usuarioweb_direccion(
                    $r->id, 
                    $r->usuarioweb_id, 
                    $r->direccion_id);

                return $usuarioweb_direccion;
            }
            
            return null;
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
}
