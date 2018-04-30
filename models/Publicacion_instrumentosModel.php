<?php

require_once 'entidades/publicacion_instrumentos.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Publicacion_instrumentosModel
 *
 * @author enriquegomezpena
 */
class Publicacion_instrumentosModel {

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

            $stm = $this->pdo->prepare("SELECT * FROM publicacion_instrumentos");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $publicacion_instrumentos = new Publicacion_instrumentos(
                        $r->id, $r->publicacion_id, $r->instrumentos_id, $r->marcas_id, $r->instrumentos_datos_id
                );
                $result[] = $publicacion_instrumentos;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Publicacion_instrumentos $data) {
        try {
            $sql = "INSERT INTO publicacion_instrumentos (
                                    `publicacion_id`,
                                    `instrumentos_id`,
                                    `marcas_id`,
                                    `instrumentos_datos_id`
                                    ) 
                                VALUES (?, ?, ?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getPublicacion_id(),
                                $data->getInstrumentos_id(),
                                $data->getMarcas_id(),
                                $data->getInstrumentos_datos_id()
                            )
            );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerPublicacion_instrumentosByPubId($id) {

        try {


            $stm = $this->pdo->prepare("SELECT * FROM publicacion_instrumentos WHERE (publicacion_id = ?)");
            $stm->execute(array($id));

            $r = $stm->fetch(PDO::FETCH_OBJ);
            if (isset($r->id)) {
                $publicacion_instrumentos = new Publicacion_instrumentos(
                        $r->id, $r->publicacion_id, $r->instrumentos_id, $r->marcas_id, $r->instrumentos_datos_id
                );
                return $publicacion_instrumentos;
            }

            return null;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function actualizar(Publicacion_instrumentos $data) {
        try {
            $sql = "UPDATE publicacion_instrumentos SET 
                        `instrumentos_id` = ?,
                        `marcas_id` = ?,
                        `instrumentos_datos_id` = ?
                    WHERE id = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getInstrumentos_id(),
                                $data->getMarcas_id(),
                                $data->getInstrumentos_datos_id(),
                                $data->getId()
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
