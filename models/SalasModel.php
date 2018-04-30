<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SalasModel
 *
 * @author enriquegomezpena
 */
class SalasModel {

    //put your code here
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

            $stm = $this->pdo->prepare("SELECT * FROM Salas");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $salas = new Salas(
                        $r->id, $r->cantidad, $r->publicacion_id);
                $result[] = $salas;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Salas $data) {

        try {
            $sql = "INSERT INTO Salas (
                                    `cantidad`,
                                    `publicacion_id`) 
                                VALUES (?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getCantidad(),
                                $data->getPublicacion_id()
                            )
            );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerSalasByPubId($id) {
        try {
            
            $stm = $this->pdo
                    ->prepare("SELECT * FROM Salas WHERE (publicacion_id=?)");
            $stm->execute(array($id));
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $salas = new Salas(
                        $r->id, $r->cantidad, $r->publicacion_id);
                return $salas;
            }

            return null;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function actualizar(Salas $data){
         try 
        {
            $sql = "UPDATE Salas SET 
                        `cantidad` = ?
                    WHERE publicacion_id = ?";

            $this->pdo->prepare($sql)
                 ->execute(
                array(
                    $data->getCantidad(), 
                    $data->getPublicacion_id()
                    )
                );
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

}
