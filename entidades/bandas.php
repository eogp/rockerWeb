<?php

/**
 * 
 */
class Bandas {

    private $id;
    public $descripcion;
    private $publicacion_showeventos_id;

    public function __construct($id, $descripcion, $publicacion_showeventos_id) {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->publicacion_showeventos_id = $publicacion_showeventos_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getPublicacion_showeventos_id() {
        return $this->publicacion_showeventos_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setPublicacion_showeventos_id($publicacion_showeventos_id) {
        $this->publicacion_showeventos_id = $publicacion_showeventos_id;
    }




}
