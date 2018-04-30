<?php
require_once 'entidades/serviciosProf.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServiciosProfModel
 *
 * @author enriquegomezpena
 */
class ServiciosProfModel {
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

            $stm = $this->pdo->prepare("SELECT * FROM serviciosProf");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $serviciosProf = new ServiciosProf(
                        $r->id, $r->descripcion);
                $result[] = $serviciosProf;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(ServiciosProf $data) {
        try {
            $sql = "INSERT INTO serviciosProf (
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

   public function obtenerServicioProfBybId($id){
        
        try
        {
            $stm = $this->pdo->prepare("SELECT * FROM serviciosProf WHERE (id = ?)");
            $stm->execute(array($id));

            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id))
            {
                $serviciosProf = new ServiciosProf(
                        $r->id, 
                        $r->descripcion);
                return $serviciosProf;
         
            }

            return null;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
        
    }


}
