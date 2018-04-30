<?php

/**
 * 
 */
class Publicacion {

    public $id;
    public $nombre;
    public $descripcion;
    private $usuarioweb_id;
    private $alta;
    private $activa;
    public $email;
    private $pagos_id;
    public $tipoPub_id;
    public $web;

    public function __construct($id, $nombre, $descripcion, $usuarioweb_id, $alta, $activa, $email, $pagos_id, $tipoPub_id, $web) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->usuarioweb_id = $usuarioweb_id;
        $this->alta = $alta;
        $this->activa = $activa;
        $this->email = $email;
        $this->pagos_id = $pagos_id;
        $this->tipoPub_id = $tipoPub_id;
        $this->web = $web;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getUsuarioweb_id() {
        return $this->usuarioweb_id;
    }

    public function getAlta() {
        return $this->alta;
    }

    public function getActiva() {
        return $this->activa;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPagos_id() {
        return $this->pagos_id;
    }

    public function getTipoPub_id() {
        return $this->tipoPub_id;
    }

    public function getWeb() {
        return $this->web;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setUsuarioweb_id($usuarioweb_id) {
        $this->usuarioweb_id = $usuarioweb_id;
    }

    public function setAlta($alta) {
        $this->alta = $alta;
    }

    public function setActiva($activa) {
        $this->activa = $activa;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPagos_id($pagos_id) {
        $this->pagos_id = $pagos_id;
    }

    public function setTipoPub_id($tipoPub_id) {
        $this->tipoPub_id = $tipoPub_id;
    }

    public function setWeb($web) {
        $this->web = $web;
    }


    
}
