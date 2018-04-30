<?php

/**
 * 
 */
class Pagos {

    private $id;
    private $fecha;
    private $importe;
    private $estado;
    private $activo;
    private $fecha_acreditacion;
    private $medio;
    private $publicacion_id;
    private $categoria;

    public function __construct($id, $fecha, $importe, $estado, $activo, $fecha_acreditacion, $medio, $publicacion_id, $categoria) {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->importe = $importe;
        $this->estado = $estado;
        $this->activo = $activo;
        $this->fecha_acreditacion = $fecha_acreditacion;
        $this->medio = $medio;
        $this->publicacion_id = $publicacion_id;
        $this->categoria = $categoria;
    }

    
    public function getId() {
        return $this->id;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getImporte() {
        return $this->importe;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getActivo() {
        return $this->activo;
    }

    public function getFecha_acreditacion() {
        return $this->fecha_acreditacion;
    }

    public function getMedio() {
        return $this->medio;
    }

    public function getPublicacion_id() {
        return $this->publicacion_id;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setImporte($importe) {
        $this->importe = $importe;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setActivo($activo) {
        $this->activo = $activo;
    }

    public function setFecha_acreditacion($fecha_acreditacion) {
        $this->fecha_acreditacion = $fecha_acreditacion;
    }

    public function setMedio($medio) {
        $this->medio = $medio;
    }

    public function setPublicacion_id($publicacion_id) {
        $this->publicacion_id = $publicacion_id;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }


    
}
