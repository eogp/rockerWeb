<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of publicacion_servicios
 *
 * @author enriquegomezpena
 */
class Publicacion_servicios {

    private $id;
    private $publicacion_id;
    private $servicios_id;
    private $active;

    public function __construct($id, $publicacion_id, $servicios_id) {
        $this->id = $id;
        $this->publicacion_id = $publicacion_id;
        $this->servicios_id = $servicios_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getPublicacion_id() {
        return $this->publicacion_id;
    }

    public function getServicios_id() {
        return $this->servicios_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setPublicacion_id($publicacion_id) {
        $this->publicacion_id = $publicacion_id;
    }

    public function setServicios_id($servicios_id) {
        $this->servicios_id = $servicios_id;
    }
    
    public function getActive() {
        return $this->active;
    }

    public function setActive($active) {
        $this->active = $active;
    }



}
