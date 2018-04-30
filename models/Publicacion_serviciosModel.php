<?php

require_once 'entidades/publicacion_servicios.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Publicacion_serviciosModel
 *
 * @author enriquegomezpena
 */
class Publicacion_serviciosModel {

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

            $stm = $this->pdo->prepare("SELECT * FROM publicacion_servicios");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $publicacion_servicios = new Publicacion_servicios(
                        $r->id, $r->publicacion_id, $r->servicios_id
                );
                $result[] = $publicacion_servicios;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Publicacion_servicios $data) {
        try {
            $sql = "INSERT INTO publicacion_servicios (
                                    `publicacion_id`,
                                    `servicios_id`
                                    ) 
                                VALUES (?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getPublicacion_id(),
                                $data->getServicios_id()
                            )
            );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerPublicaciones_serviciosByPubId($id) {
        try {
            $result = array();

            $stm = $this->pdo
                    ->prepare("SELECT * FROM publicacion_servicios WHERE (publicacion_id=? and active=1)");

            $stm->execute(array($id));
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $publicacion_servicios = new Publicacion_servicios(
                        $r->id, $r->publicacion_id, $r->servicios_id
                );
                $result[] = $publicacion_servicios;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminarPublicacionServicios(Publicacion_servicios $data) {
        try {
            $sql = "UPDATE publicacion_servicios SET 
                        active      = 0
                    WHERE publicacion_id = ? and servicios_id = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getPublicacion_id(),
                                $data->getServicios_id(),
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
