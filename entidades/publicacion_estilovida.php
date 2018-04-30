<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of publicacion_estilovida
 *
 * @author enriquegomezpena
 */
class Publicacion_estilovida {

    private $id;
    private $publicacion_id;
    private $estilovida_id;

    
    public function __construct($id, $publicacion_id, $estilovida_id) {
        $this->id = $id;
        $this->publicacion_id = $publicacion_id;
        $this->estilovida_id = $estilovida_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getPublicacion_id() {
        return $this->publicacion_id;
    }

    public function getEstilovida_id() {
        return $this->estilovida_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setPublicacion_id($publicacion_id) {
        $this->publicacion_id = $publicacion_id;
    }

    public function setEstilovida_id($estilovida_id) {
        $this->estilovida_id = $estilovida_id;
    }



}
