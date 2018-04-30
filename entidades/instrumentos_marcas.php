<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of instrumentos_marcas
 *
 * @author enriquegomezpena
 */
class Instrumentos_marcas {

    private $id;
    private $instrumentos_id;
    private $marcas_id;

    public function __construct($id, $instrumentos_id, $marcas_id) {
        $this->id = $id;
        $this->instrumentos_id = $instrumentos_id;
        $this->marcas_id = $marcas_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getInstrumentos_id() {
        return $this->instrumentos_id;
    }

    public function getMarcas_id() {
        return $this->marcas_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setInstrumentos_id($instrumentos_id) {
        $this->instrumentos_id = $instrumentos_id;
    }

    public function setMarcas_id($marcas_id) {
        $this->marcas_id = $marcas_id;
    }

}
