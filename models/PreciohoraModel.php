<?php

require_once 'conexionBD.php';
require_once 'entidades/precioHora.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PreciohoraModel
 *
 * @author enriquegomezpena
 */
class PreciohoraModel {

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

            $stm = $this->pdo->prepare("SELECT * FROM preciohora");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $precioHora = new PrecioHora(
                        $r->id, $r->valor, $r->publicacion_id
                );
                $result[] = $precioHora;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(PrecioHora $data) {

        try {
            $sql = "INSERT INTO preciohora (
                                    `valor`,
                                    `publicacion_id`) 
                                VALUES (?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getValor(),
                                $data->getPublicacion_id()
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function obtenerPreciohoraByPubId($id){
        
        try
        {
            $stm = $this->pdo->prepare("SELECT * FROM preciohora WHERE (publicacion_id = ?)");
            $stm->execute(array($id));

            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id))
            {
                $precioHora = new PrecioHora(
                        $r->id, $r->valor, $r->publicacion_id
                );
                return $precioHora;
         
            }

            return null;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
    
    public function actualizar(PrecioHora $data){
         try 
        {
            $sql = "UPDATE preciohora SET 
                        `valor` = ?
                    WHERE publicacion_id = ?";

            $this->pdo->prepare($sql)
                 ->execute(
                array(
                    $data->getValor(), 
                    $data->getPublicacion_id()
                    )
                );
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

}
