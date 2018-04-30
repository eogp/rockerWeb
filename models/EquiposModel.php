<?php
require_once 'conexionBD.php';
require_once 'entidades/equipos.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EquiposModel
 *
 * @author enriquegomezpena
 */
class EquiposModel {

    private $conexion;
    private $pdo;

    public function __construct() {
        $this->conexion = new ConexionBD();
        $this->pdo = $this->conexion->getPdo();
    }
    
    public function listar() {
        try {
            $result = array();

            $select = $this->pdo->prepare("SELECT * FROM equipos");
            $select->execute();

            foreach ($select->fetchAll(PDO::FETCH_OBJ) as $r) {
                $usuarioWeb = new Equipos(
                        $r->id, 
                        $r->descripcion);
                $result[] = $usuarioWeb;
            }

            return $result;
        } catch (Exception $e) {

            die($e->getMessage());
        }
    }
    
    public function insertar(Equipos $data) {

        try {
            $sql = "INSERT INTO equipos (
                                    `descripcion`) 
                                VALUES (?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getDescripcion()
                                
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function obtenerEquiposBybId($id) {
        try {
            $stm = $this->pdo
                    ->prepare("SELECT * FROM equipos WHERE (id=? )");

            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id)){
                $equipo=new Equipos($r->id, $r->descripcion);
                
                return $equipo;
            }

            return null;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
   
    
}
