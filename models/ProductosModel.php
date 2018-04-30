<?php

require_once 'conexionBD.php';
require_once 'entidades/productos.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductosModel
 *
 * @author enriquegomezpena
 */
class ProductosModel {

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

            $stm = $this->pdo->prepare("SELECT * FROM productos");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $productos = new Productos(
                        $r->id, $r->descripcion
                );
                $result[] = $productos;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Productos $data) {

        try {
            $sql = "INSERT INTO productos (
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

    public function ObetenerProductosByID($data) {
        try {

            $stm = $this->pdo
                    ->prepare("SELECT * FROM productos WHERE (id = ? )");

            $stm->execute(array($data));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if (isset($r->id)) {
                $productos = new Productos(
                        $r->id, $r->descripcion
                );

                return $productos;
            }

            return null;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
