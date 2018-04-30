<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of horarios
 *
 * @author enriquegomezpena
 */
class Horarios {
    private $id;
    public $desdeHora;
    public $hastaHora;
    public $desdeDia;
    public $hastaDia;
    private $publicacion_id;
    private $active;
    
    public function __construct($id, $desdeHora, $hastaHora, $desdeDia, $hastaDia, $publicacion_id) {
        $this->id = $id;
        $this->desdeHora = $desdeHora;
        $this->hastaHora = $hastaHora;
        $this->desdeDia = $desdeDia;
        $this->hastaDia = $hastaDia;
        $this->publicacion_id = $publicacion_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getDesdeHora() {
        return $this->desdeHora;
    }

    public function getHastaHora() {
        return $this->hastaHora;
    }

    public function getDesdeDia() {
        return $this->desdeDia;
    }

    public function getHastaDia() {
        return $this->hastaDia;
    }

    public function getPublicacion_id() {
        return $this->publicacion_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDesdeHora($desdeHora) {
        $this->desdeHora = $desdeHora;
    }

    public function setHastaHora($hastaHora) {
        $this->hastaHora = $hastaHora;
    }

    public function setDesdeDia($desdeDia) {
        $this->desdeDia = $desdeDia;
    }

    public function setHastaDia($hastaDia) {
        $this->hastaDia = $hastaDia;
    }

    public function setPublicacion_id($publicacion_id) {
        $this->publicacion_id = $publicacion_id;
    }

    public function getActive() {
        return $this->active;
    }

    public function setActive($active) {
        $this->active = $active;
    }


    

}
