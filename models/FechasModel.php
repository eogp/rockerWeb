<?php

require_once 'conexionBD.php';
require_once 'entidades/fechas.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FechasModel
 *
 * @author enriquegomezpena
 */
class FechasModel {

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

            $stm = $this->pdo->prepare("SELECT * FROM fechas");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $fechas = new Fechas(
                        $r->id, $r->diaHora, $r->publicacion_showeventos_id);
                $result[] = $fechas;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Fechas $data) {

        try {
            $sql = "INSERT INTO fechas (
                                    `diaHora`,
                                    `publicacion_showeventos_id`
                                    ) 
                                VALUES (?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getDiaHora(),
                                $data->getPublicacion_showeventos_id()
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerFechasByPub_ShowEventosId($id) {
        try {
            $result = array();
            $stm = $this->pdo
                    ->prepare("SELECT * FROM fechas WHERE (publicacion_showeventos_id = ? and active=1)");

            $stm->execute(array($id));

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $fechas = new Fechas(
                        $r->id, $r->diaHora, $r->publicacion_showeventos_id);
                $result[] = $fechas;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminar($pubShowEventoId) {
        try {
            $sql = "UPDATE fechas SET 
                        active = 0
                    WHERE publicacion_showeventos_id = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $pubShowEventoId
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
