<?php

require_once 'entidades/pagos.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PagosModel
 *
 * @author enriquegomezpena
 */
class PagosModel {

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

            $stm = $this->pdo->prepare("SELECT * FROM pagos");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $pagos = new Pagos($r->id, $r->fecha, $r->importe, $r->estado, $r->activo, $r->fecha_acredit, $r->medio, $r->publicacion_id, $r->categoria);

                $result[] = $pagos;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Pagos $data) {

        try {
            $sql = "INSERT INTO pagos (
                                    `fecha`,
                                    `importe`,
                                    `estado`,
                                    `activo`,
                                    `fecha_acredit`,
                                    `medio`,
                                    `publicacion_id`,
                                    `categoria`) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getFecha(),
                                $data->getImporte(),
                                $data->getEstado(),
                                $data->getActivo(),
                                $data->getFecha_acreditacion(),
                                $data->getMedio(),
                                $data->getPublicacion_id(),
                                $data->getCategoria()
                            )
            );

            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obetenerPagosByPubId($pubId) {

        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM pagos WHERE (publicacion_id = ?)");
            $stm->execute(array($pubId));

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $pagos = new Pagos(
                        $r->id,
                        $r->fecha,
                        $r->importe,
                        $r->estado,
                        $r->activo,
                        $r->fecha_acredit,
                        $r->medio,
                        $r->publicacion_id,
                        $r->categoria
                        );

                $result[] = $pagos;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function actualizaPagos(Pagos $data) {

        try {
            $sql = "UPDATE pagos SET 
                        importe         = ?,
                        estado          = ?,
                        activo          = ?, 
                        fecha_acredit   = ?,
                        medio           = ?,
                        categoria       = ?
                    WHERE id = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getImporte(),
                                $data->getEstado(),
                                $data->getActivo(),
                                $data->getFecha_acreditacion(),
                                $data->getMedio(),
                                $data->getCategoria(),
                                $data->getId()
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
