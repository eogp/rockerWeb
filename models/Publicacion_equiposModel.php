<?php

require_once 'entidades/publicacion_equipos.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Publicacion_equiposModel
 *
 * @author enriquegomezpena
 */
class Publicacion_equiposModel {

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

            $stm = $this->pdo->prepare("SELECT * FROM publicacion_equipos");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $publicacion_equipos = new Publicacion_equipos(
                        $r->id, $r->publicacion_id, $r->equipos_id, $r->marcas_id
                );
                $result[] = $publicacion_equipos;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Publicacion_equipos $data) {
        try {
            $sql = "INSERT INTO publicacion_equipos (
                                    `equipos_id`,                                    
                                    `publicacion_id`,
                                    `marcas_id`
                                    ) 
                                VALUES ( ?, ?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getEquipos_id(),
                                $data->getPublicacion_id(),
                                $data->getMarcas_id()
                            )
            );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerPublicaciones_equiposByPubId($id) {
        try {
            $result = array();

            $stm = $this->pdo
                    ->prepare("SELECT * FROM publicacion_equipos WHERE (publicacion_id=? and active=1)");

            $stm->execute(array($id));
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $publicacion_equipos = new Publicacion_equipos(
                        $r->id, $r->publicacion_id, $r->equipos_id, $r->marcas_id
                );
                $result[] = $publicacion_equipos;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerPublicaciones_equiposByPubIdEquipos_idMarcas_Id($pubId, $equipos_id, $marcasId) {
        try {
            $result = array();

            $stm = $this->pdo
                    ->prepare("SELECT * FROM publicacion_equipos WHERE (publicacion_id=? and equipos_id=? and marcas_id=? and active=1)");

            $stm->execute(array($pubId, $equipos_id, $marcasId));
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $publicacion_equipos = new Publicacion_equipos(
                        $r->id, $r->publicacion_id, $r->equipos_id, $r->marcas_id
                );
                $result[] = $publicacion_equipos;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminarPublicacionEquipos(Publicacion_equipos $data) {
        try {
            $sql = "UPDATE publicacion_equipos SET 
                        active      = 0
                    WHERE publicacion_id = ? and equipos_id = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getPublicacion_id(),
                                $data->getEquipos_id(),
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
