<?php
require_once 'entidades/estilovida_productos.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Estilovida_productosModel
 *
 * @author enriquegomezpena
 */
class Estilovida_productosModel {
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

            $stm = $this->pdo->prepare("SELECT * FROM estilovida_productos");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $estilovida_productos = new Estilovida_productos(
                        $r->id, 
                        $r->estilovida_id, 
                        $r->productos_id
                        );
                $result[] = $estilovida_productos;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Estilovida_productos $data) {

        try {
            $sql = "INSERT INTO estilovida_productos (
                                    `estilovida_id`,
                                    `productos_id`
                                    ) 
                                VALUES (?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getEstilovida_id(),
                                $data->getProductos_id()
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function ListarEstilovida_productosByEstilovidaID(Estilovida $data){
        try 
        {
            $result = array();
            $stm = $this->pdo
                      ->prepare("SELECT * FROM estilovida_productos WHERE (estilovida_id = ? )");
                      
            $stm->execute(array($data->getId()));
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r){
               
                $estilovida_productos = new Estilovida_productos(
                    $r->id, 
                    $r->estilovida_id,
                    $r->productos_id    
                    );

                $result[] = $estilovida_productos;
            }
            
            return $result;
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
    
}
