<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuario_direccion
 *
 * @author enriquegomezpena
 */
class Usuarioweb_direccion {
    private $id;
    private $usuarioweb_id;
    private $direccion_id;
    public function __construct($id, $usuarioweb_id, $direccion_id) {
        $this->id = $id;
        $this->usuarioweb_id = $usuarioweb_id;
        $this->direccion_id = $direccion_id;
    }
    public function getId() {
        return $this->id;
    }

    public function getUsuarioweb_id() {
        return $this->usuarioweb_id;
    }

    public function getDireccion_id() {
        return $this->direccion_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsuarioweb_id($usuarioweb_id) {
        $this->usuarioweb_id = $usuarioweb_id;
    }

    public function setDireccion_id($direccion_id) {
        $this->direccion_id = $direccion_id;
    }


}
