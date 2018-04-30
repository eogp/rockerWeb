<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of publicacion_equipos
 *
 * @author enriquegomezpena
 */
class Publicacion_equipos {
    private $id;
    private $publicacion_id;
    private $equipos_id;
    private $marcas_id;
    private $active;
    
    public function __construct($id, $publicacion_id, $equipos_id, $marcas_id) {
        $this->id = $id;
        $this->publicacion_id = $publicacion_id;
        $this->equipos_id = $equipos_id;
        $this->marcas_id = $marcas_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getPublicacion_id() {
        return $this->publicacion_id;
    }

    public function getEquipos_id() {
        return $this->equipos_id;
    }

    public function getMarcas_id() {
        return $this->marcas_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setPublicacion_id($publicacion_id) {
        $this->publicacion_id = $publicacion_id;
    }

    public function setEquipos_id($equipos_id) {
        $this->equipos_id = $equipos_id;
    }

    public function setMarcas_id($marcas_id) {
        $this->marcas_id = $marcas_id;
    }

    public function getActive() {
        return $this->active;
    }

    public function setActive($active) {
        $this->active = $active;
    }





}
