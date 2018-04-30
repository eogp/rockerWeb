<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of precioHora
 *
 * @author enriquegomezpena
 */
class PrecioHora {
    
    private $id;
    public $valor;
    private $publicacion_id;
    
    public function __construct($id, $valor, $publicacion_id) {
        $this->id = $id;
        $this->valor = $valor;
        $this->publicacion_id = $publicacion_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getPublicacion_id() {
        return $this->publicacion_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function setPublicacion_id($publicacion_id) {
        $this->publicacion_id = $publicacion_id;
    }


}
