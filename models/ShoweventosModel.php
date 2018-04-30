<?php
require_once 'entidades/showeventos.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ShowseventosModel
 *
 * @author enriquegomezpena
 */
class ShoweventosModel {
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

            $stm = $this->pdo->prepare("SELECT * FROM showeventos");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $showeventos = new Showeventos(
                        $r->id, 
                        $r->descripcion);
                $result[] = $showeventos;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Showeventos $data) {
        try {
            $sql = "INSERT INTO showeventos (
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
    
    public function obetenerShowEventosByID($id){
        try 
        {
            
            $stm = $this->pdo
                      ->prepare("SELECT * FROM showeventos WHERE (id = ? )");
                      
            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id)){
                $showEventos = new Showeventos(
                    $r->id, 
                    $r->descripcion
                        );

                return  $showEventos;
            }
            
            return null;
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
}
