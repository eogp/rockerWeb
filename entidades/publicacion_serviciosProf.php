<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of publicacion_serviciosProf
 *
 * @author enriquegomezpena
 */
class Publicacion_serviciosProf {

    private $id;
    private $publicacion_id;
    private $serviciosProf_id;
    public $experiencia;

    public function __construct($id, $publicacion_id, $serviciosProf_id, $experiencia) {
        $this->id = $id;
        $this->publicacion_id = $publicacion_id;
        $this->serviciosProf_id = $serviciosProf_id;
        $this->experiencia = $experiencia;
    }

    public function getId() {
        return $this->id;
    }

    public function getPublicacion_id() {
        return $this->publicacion_id;
    }

    public function getServiciosProf_id() {
        return $this->serviciosProf_id;
    }

    public function getExperiencia() {
        return $this->experiencia;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setPublicacion_id($publicacion_id) {
        $this->publicacion_id = $publicacion_id;
    }

    public function setServiciosProf_id($serviciosProf_id) {
        $this->serviciosProf_id = $serviciosProf_id;
    }

    public function setExperiencia($experiencia) {
        $this->experiencia = $experiencia;
    }


    
}
