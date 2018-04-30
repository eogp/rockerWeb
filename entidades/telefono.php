<?php

/**
 * 
 */
class Telefono {

    private $id;
    public $numero;
    public $codarea;
    public $codpais;
    public $celular;


    public function __construct($id, $numero, $codarea, $codpais, $celular) {
        $this->id = $id;
        $this->numero = $numero;
        $this->codarea = $codarea;
        $this->codpais = $codpais;
        $this->celular = $celular;
    }

    public function getId() {
        return $this->id;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getCodarea() {
        return $this->codarea;
    }

    public function getCodpais() {
        return $this->codpais;
    }

    public function getCelular() {
        return $this->celular;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setCodarea($codarea) {
        $this->codarea = $codarea;
    }

    public function setCodpais($codpais) {
        $this->codpais = $codpais;
    }

    public function setCelular($celular) {
        $this->celular = $celular;
    }



    
}
