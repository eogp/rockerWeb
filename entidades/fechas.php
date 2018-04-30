<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Fechas {

    private $id;
    public $diaHora;
    private $publicacion_showeventos_id;
    private $active;

    public function __construct($id, $diaHora, $publicacion_showeventos_id) {
        $this->id = $id;
        $this->diaHora = $diaHora;
        $this->publicacion_showeventos_id = $publicacion_showeventos_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getDiaHora() {
        return $this->diaHora;
    }

    public function getPublicacion_showeventos_id() {
        return $this->publicacion_showeventos_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDiaHora($diaHora) {
        $this->diaHora = $diaHora;
    }

    public function setPublicacion_showeventos_id($publicacion_showeventos_id) {
        $this->publicacion_showeventos_id = $publicacion_showeventos_id;
    }

    public function getActive() {
        return $this->active;
    }

    public function setActive($active) {
        $this->active = $active;
    }



}
