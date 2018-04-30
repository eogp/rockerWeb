<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of estilovida_pruductos
 *
 * @author enriquegomezpena
 */
class Estilovida_productos {

    private $id;
    private $estilovida_id;
    private $productos_id;

    public function __construct($id, $estilovida_id, $productos_id) {
        $this->id = $id;
        $this->estilovida_id = $estilovida_id;
        $this->productos_id = $productos_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getEstilovida_id() {
        return $this->estilovida_id;
    }

    public function getProductos_id() {
        return $this->productos_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setEstilovida_id($estilovida_id) {
        $this->estilovida_id = $estilovida_id;
    }

    public function setProductos_id($productos_id) {
        $this->productos_id = $productos_id;
    }

}
