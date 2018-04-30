<?php

require_once 'entidades/imagen.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImagenModel
 *
 * @author enriquegomezpena
 */
class ImagenModel {

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

            $stm = $this->pdo->prepare("SELECT * FROM imagen");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $imagen = new Imagen($r->id, $r->uri, $r->thumbnail, $r->publicacion_id);
                $result[] = $imagen;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Imagen $data) {

        try {
            $sql = "INSERT INTO imagen (
                                    `uri`,
                                    `thumbnail`, 
                                    `publicacion_id`) 
                                VALUES (?, ?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getUri(),
                                $data->getThumbnail(),
                                $data->getPublicacion_id()
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerImagenesByPubId($id) {
        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM imagen WHERE (publicacion_id=? and active=1)");
            $stm->execute(array($id));

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $imagen = new Imagen($r->id, $r->uri, $r->thumbnail, $r->publicacion_id);
                $result[] = $imagen;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function obtenerImagenByIdAndPubId($id, $pubId) {
        try {
 
            $stm = $this->pdo->prepare("SELECT * FROM imagen WHERE (id=? and publicacion_id=? and active=1)");
            $stm->execute(array($id, $pubId));
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $imagen = new Imagen($r->id, $r->uri, $r->thumbnail, $r->publicacion_id);
                return $imagen;
            }

            return null;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function actualizar(Imagen $data) {
        try {
            $sql = "UPDATE imagen SET 
                        `uri` = ?
                    WHERE id = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getUri(),
                                $data->getId()
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminar(Imagen $data) {
        try {
            $sql = "UPDATE imagen SET 
                        `active` = ?
                    WHERE id = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                0,
                                $data->getId()
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
