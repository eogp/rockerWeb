<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Instrumentos_datosModel {

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

            $stm = $this->pdo->prepare("SELECT * FROM instrumentos_datos");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $instrumentos_datos = new Instrumentos_datos(
                        $r->id, $r->anio, $r->estado, $r->pais_id, $r->otro
                );
                $result[] = $instrumentos_datos;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Instrumentos_datos $data) {

        try {
            $sql = "INSERT INTO instrumentos_datos (
                                    `anio`,
                                    `estado`,
                                    `pais_id`,
                                    `otro`
                                    ) 
                                VALUES (?,?,?,?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getAnio(),
                                $data->getEstado(),
                                $data->getPais_id(),
                                $data->getOtro()
                            )
            );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerInstrumentos_datosById($id) {

        try {


            $stm = $this->pdo->prepare("SELECT * FROM instrumentos_datos WHERE (id = ?)");
            $stm->execute(array($id));

            $r = $stm->fetch(PDO::FETCH_OBJ);
            if (isset($r->id)) {
                $instrumentos_datos = new Instrumentos_datos(
                        $r->id, $r->anio, $r->estado, $r->pais_id, $r->otro
                );
                return $instrumentos_datos;
            }

            return null;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function actualizar(Instrumentos_datos $data) {
        try {
            $sql = "UPDATE instrumentos_datos SET 
                        `anio` = ?,
                        `estado` = ?,
                        `pais_id` = ?,
                        `otro` = ?
                    WHERE id = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getAnio(),
                                $data->getEstado(),
                                $data->getPais_id(),
                                $data->getOtro(),
                                $data->getId()
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
