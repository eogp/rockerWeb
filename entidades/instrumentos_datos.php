<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Instrumentos_datos {

    private $id;
    public $anio;
    public $estado;
    private $pais_id;
    public $otro;

    public function __construct($id, $anio, $estado, $pais_id, $otro) {
        $this->id = $id;
        $this->anio = $anio;
        $this->estado = $estado;
        $this->pais_id = $pais_id;
        $this->otro = $otro;
    }

    public function getId() {
        return $this->id;
    }

    public function getAnio() {
        return $this->anio;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getPais_id() {
        return $this->pais_id;
    }

    public function getOtro() {
        return $this->otro;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setAnio($anio) {
        $this->anio = $anio;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setPais_id($pais_id) {
        $this->pais_id = $pais_id;
    }

    public function setOtro($otro) {
        $this->otro = $otro;
    }


}