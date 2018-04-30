<?php

require_once 'entidades/telefono.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TelefonoModel
 *
 * @author enriquegomezpena
 */
class TelefonoModel {

    //put your code here  private $conexion;
    private $pdo;

    public function __construct() {
        $this->conexion = new ConexionBD();
        $this->pdo = $this->conexion->getPdo();
    }

    public function listar() {

        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM telefono");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $telefono = new Telefono(
                        $r->id, $r->numero, $r->codarea, $r->codpais, $r->celular
                );
                $result[] = $telefono;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Telefono $data) {

        try {
            $sql = "INSERT INTO telefono (
                                    `numero`,
                                    `codarea`,
                                    `codpais`,
                                    `celular`) 
                                VALUES (?, ?, ?, ? )";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getNumero(),
                                $data->getCodarea(),
                                $data->getCodpais(),
                                $data->getCelular()
                            )
            );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerTelefonoById($id) {
        try {
            $stm = $this->pdo
                    ->prepare("SELECT * FROM telefono WHERE (id=?)");

            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if (isset($r->id)) {
                $telefono = new Telefono(
                        $r->id, $r->numero, $r->codarea, $r->codpais, $r->celular
                );

                return $telefono;
            }

            return null;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function actualizarTelefono(Telefono $data) {

        try {
            $sql = "UPDATE telefono SET 
                        numero      = ?, 
                        codarea     = ?,
                        codpais     = ?, 
                        celular     = ?
                    WHERE id = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getNumero(),
                                $data->getCodarea(),
                                $data->getCodpais(),
                                $data->getCelular(),
                                $data->getId()
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    


}
