<?php

require_once 'entidades/publicacion_telefono.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Publicacion_telefono
 *
 * @author enriquegomezpena
 */
class Publicacion_telefonoModel {

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

            $stm = $this->pdo->prepare("SELECT * FROM publicacion_telefono");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $publicacion_telefono = new Publicacion_telefono(
                        $r->id, $r->publicacion_id, $r->telefono_id
                );
                $result[] = $publicacion_telefono;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Publicacion_telefono $data) {
        try {
            $sql = "INSERT INTO publicacion_telefono (
                                    `publicacion_id`,
                                    `telefono_id`
                                    ) 
                                VALUES (?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getPublicacion_id(),
                                $data->getTelefono_id()
                            )
            );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obetnerPublicacionTelefonoByPubId($id) {
        try {
            $stm = $this->pdo
                    ->prepare("SELECT * FROM publicacion_telefono WHERE (publicacion_id = ? and active=1)");

            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if (isset($r->id)) {
                $publicacion_telefono = new Publicacion_telefono(
                        $r->id, $r->publicacion_id, $r->telefono_id
                );

                return $publicacion_telefono;
            }

            return null;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminarPublicacionTelefono(Publicacion_telefono $data) {
        try {
            $sql = "UPDATE publicacion_telefono SET 
                        active      = 0
                    WHERE publicacion_id = ? and telefono_id = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getPublicacion_id(),
                                $data->getTelefono_id(),
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
