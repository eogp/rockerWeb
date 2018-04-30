<?php

require_once 'entidades/direccion.php';
require_once 'conexionBD.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DireccionModel
 *
 * @author enriquegomezpena
 */
class DireccionModel {

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

            $stm = $this->pdo->prepare("SELECT * FROM direccion");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $direccion = new Direccion(
                        $r->id, 
                        $r->depto, 
                        $r->torre, 
                        $r->altura, 
                        $r->calle, 
                        $r->localidad, 
                        $r->ciudad, 
                        $r->partido, 
                        $r->cp, 
                        $r->pais, 
                        $r->provincia, 
                        $r->latitud, 
                        $r->longitud);
                $result[] = $direccion;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Direccion $data) {

        try {
            $sql = "INSERT INTO direccion (
                                    `depto`,
                                    `torre`,
                                    `altura`,
                                    `calle`,
                                    `localidad`,
                                    `ciudad`,
                                    `partido`,
                                    `cp`,
                                    `pais`,
                                    `provincia`,
                                    `latitud`,
                                    `longitud`
                                    ) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getDepto(),
                                $data->getTorre(),
                                $data->getAltura(),
                                $data->getCalle(),
                                $data->getLocalidad(),
                                $data->getCiudad(),
                                $data->getPartido(),
                                $data->getCp(),
                                $data->getPais(),
                                $data->getProvincia(),
                                $data->getLatitud(),
                                $data->getLongitud()
                            )
            );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerDireccionById($id) {
        try {
            $stm = $this->pdo
                    ->prepare("SELECT * FROM direccion WHERE (id=?)");

            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if (isset($r->id)) {
                $direccion = new Direccion(
                        $r->id, 
                        $r->depto, 
                        $r->torre, 
                        $r->altura, 
                        $r->calle, 
                        $r->localidad, 
                        $r->ciudad, 
                        $r->partido, 
                        $r->cp, 
                        $r->pais, 
                        $r->provincia, 
                        $r->latitud, 
                        $r->longitud);

                return $direccion;
            }

            return null;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function actualizarDireccion(Direccion $data) {

        try {
            $sql = "UPDATE direccion SET 
                        depto         = ?, 
                        torre         = ?,
                        calle         = ?, 
                        altura        = ?,
                        localidad     = ?,
                        ciudad        = ?, 
                        partido       = ?,
                        cp            = ?,
                        provincia     = ?,
                        pais          = ?,
                        latitud       = ?,
                        longitud      = ?
                    WHERE id = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getDepto(),
                                $data->getTorre(),
                                $data->getCalle(),
                                $data->getAltura(),
                                $data->getLocalidad(),
                                $data->getCiudad(),
                                $data->getPartido(),
                                $data->getCp(),
                                $data->getProvincia(),
                                $data->getPais(),
                                $data->getLatitud(),
                                $data->getLongitud(),
                                $data->getId()
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


}


