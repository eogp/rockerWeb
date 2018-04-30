<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of publicacion_instrumentos
 *
 * @author enriquegomezpena
 */
class Publicacion_instrumentos {

    private $id;
    private $publicacion_id;
    private $instrumentos_id;
    private $marcas_id;
    private $instrumentos_datos_id;

    public function __construct($id, $publicacion_id, $instrumentos_id, $marcas_id, $instrumentos_datos_id) {
        $this->id = $id;
        $this->publicacion_id = $publicacion_id;
        $this->instrumentos_id = $instrumentos_id;
        $this->marcas_id = $marcas_id;
        $this->instrumentos_datos_id = $instrumentos_datos_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getPublicacion_id() {
        return $this->publicacion_id;
    }

    public function getInstrumentos_id() {
        return $this->instrumentos_id;
    }

    public function getMarcas_id() {
        return $this->marcas_id;
    }

    public function getInstrumentos_datos_id() {
        return $this->instrumentos_datos_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setPublicacion_id($publicacion_id) {
        $this->publicacion_id = $publicacion_id;
    }

    public function setInstrumentos_id($instrumentos_id) {
        $this->instrumentos_id = $instrumentos_id;
    }

    public function setMarcas_id($marcas_id) {
        $this->marcas_id = $marcas_id;
    }

    public function setInstrumentos_datos_id($instrumentos_datos_id) {
        $this->instrumentos_datos_id = $instrumentos_datos_id;
    }


    
}
