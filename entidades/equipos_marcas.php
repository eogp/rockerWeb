<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of equipos_marcas
 *
 * @author enriquegomezpena
 */
class Equipos_marcas {

    private $id;
    private $equipos_id;
    private $marcas_id;

    public function __construct($id, $equipos_id, $marcas_id) {
        $this->id = $id;
        $this->equipos_id = $equipos_id;
        $this->marcas_id = $marcas_id;
    }

    public function getId() {
        return $this->id;
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

    public function setEquipos_id($equipos_id) {
        $this->equipos_id = $equipos_id;
    }

    public function setMarcas_id($marcas_id) {
        $this->marcas_id = $marcas_id;
    }

}
