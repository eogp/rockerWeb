<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of estilovida
 *
 * @author enriquegomezpena
 */
class Estilovida {
    public $id;
    public $descripcion;

    public function __construct($id, $descripcion) {
        $this->id = $id;
        $this->descripcion = $descripcion;
    }

    public function getId() {
        return $this->id;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }


    
}
