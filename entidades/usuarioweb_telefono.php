<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuarioweb_telefono
 *
 * @author enriquegomezpena
 */
class Usuarioweb_telefono {
    private $id;
    private $usuarioweb_id;
    private $telefono_id;
    public function __construct($id, $usuarioweb_id, $telefono_id) {
        $this->id = $id;
        $this->usuarioweb_id = $usuarioweb_id;
        $this->telefono_id = $telefono_id;
    }
    public function getId() {
        return $this->id;
    }

    public function getUsuarioweb_id() {
        return $this->usuarioweb_id;
    }

    public function getTelefono_id() {
        return $this->telefono_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsuarioweb_id($usuarioweb_id) {
        $this->usuarioweb_id = $usuarioweb_id;
    }

    public function setTelefono_id($telefono_id) {
        $this->telefono_id = $telefono_id;
    }


}
