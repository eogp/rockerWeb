<?php

require_once 'entidades/usuarioweb_telefono.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuarioweb_telefonoModel
 *
 * @author enriquegomezpena
 */
class Usuarioweb_telefonoModel {

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

            $stm = $this->pdo->prepare("SELECT * FROM usuarioweb_telefono");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $usuarioweb_telefono = new Usuarioweb_telefono(
                        $r->id, $r->usuarioweb_id, $r->telefono_id
                );
                $result[] = $usuarioweb_telefono;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Usuarioweb_telefono $data) {
        try {
            $sql = "INSERT INTO usuarioweb_telefono (
                                    `usuarioweb_id`,
                                    `telefono_id`
                                    ) 
                                VALUES (?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getUsuarioweb_id(),
                                $data->getTelefono_id()
                            )
            );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerUsuarioweb_telefonoByUserID($usuarioweb_id) {
        try {
            $stm = $this->pdo
                    ->prepare("SELECT * FROM usuarioweb_telefono WHERE (usuarioweb_id = ?)");

            $stm->execute(array($usuarioweb_id));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if (isset($r->id)) {
                $usuarioweb_telefono = new Usuarioweb_telefono(
                        $r->id, $r->usuarioweb_id, $r->telefono_id);

                return $usuarioweb_telefono;
            }

            return null;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
