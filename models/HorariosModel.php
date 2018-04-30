<?php
require_once 'entidades/horarios.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HorariosModel
 *
 * @author enriquegomezpena
 */
class HorariosModel {
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

            $stm = $this->pdo->prepare("SELECT * FROM horarios");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $horarios = new Horarios(
                        $r->id, 
                        $r->desdeHora, 
                        $r->hastaHora, 
                        $r->desdeDia,
                        $r->hastaDia,
                        $r->publicacion_id);
                $result[] = $horarios;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Horarios $data) {

        try {
            $sql = "INSERT INTO horarios (
                                    `desdeHora`,
                                    `hastaHora`,
                                    `desdeDia`,
                                    `hastaDia`,
                                    `publicacion_id`
                                    ) 
                                VALUES (?, ?, ?, ?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getDesdeHora(),
                                $data->getHastaHora(),
                                $data->getDesdeDia(),
                                $data->getHastaDia(),
                                $data->getPublicacion_id()
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function obtenerHorariosByPubId($id) {

        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM horarios WHERE(publicacion_id = ? and active=1)");
            $stm->execute(Array($id));

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $horarios = new Horarios(
                        $r->id, 
                        $r->desdeHora, 
                        $r->hastaHora, 
                        $r->desdeDia,
                        $r->hastaDia,
                        $r->publicacion_id);
                $result[] = $horarios;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function eliminar($pubId) {
        try {
            $sql = "UPDATE horarios SET 
                        active      = 0
                    WHERE publicacion_id = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $pubId
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
