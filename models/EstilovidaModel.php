<?php
require_once 'entidades/estilovida.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EstilovidaModel
 *
 * @author enriquegomezpena
 */
class EstilovidaModel {
    
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

            $stm = $this->pdo->prepare("SELECT * FROM estilovida");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $estilovida = new Estilovida(
                        $r->id, 
                        $r->descripcion
                        );
                $result[] = $estilovida;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Estilovida $data) {

        try {
            $sql = "INSERT INTO estilovida (
                                    `descripcion`
                                    ) 
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
    
    public function obetenerEstiloVidaByID($id){
        try 
        {
            
            $stm = $this->pdo
                      ->prepare("SELECT * FROM estilovida WHERE (id = ? )");
                      
            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id)){
                $estiloVida = new Estilovida(
                    $r->id, 
                    $r->descripcion
                        );

                return  $estiloVida;
            }
            
            return null;
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

}
