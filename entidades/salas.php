<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of salas
 *
 * @author enriquegomezpena
 */
class Salas {
    //put your code here
    private $id;
    public $cantidad;
    private $publicacion_id;
    
    public function __construct($id, $cantidad, $publicacion_id) {
        $this->id = $id;
        $this->cantidad = $cantidad;
        $this->publicacion_id = $publicacion_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function getPublicacion_id() {
        return $this->publicacion_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function setPublicacion_id($publicacion_id) {
        $this->publicacion_id = $publicacion_id;
    }


    
}
