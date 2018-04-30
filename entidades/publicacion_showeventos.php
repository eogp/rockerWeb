<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of publicacion_showeventos
 *
 * @author enriquegomezpena
 */
class Publicacion_showeventos {

    private $id;
    private $publicacion_id;
    private $showeventos_id;

    public function __construct($id, $publicacion_id, $showeventos_id) {
        $this->id = $id;
        $this->publicacion_id = $publicacion_id;
        $this->showeventos_id = $showeventos_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getPublicacion_id() {
        return $this->publicacion_id;
    }

    public function getShoweventos_id() {
        return $this->showeventos_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setPublicacion_id($publicacion_id) {
        $this->publicacion_id = $publicacion_id;
    }

    public function setShoweventos_id($showeventos_id) {
        $this->showeventos_id = $showeventos_id;
    }

}
