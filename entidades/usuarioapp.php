<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuarioapp
 *
 * @author enriquegomezpena
 */
class UsuarioApp {
    	public $id;
	public $email;
	private $pass;
	public $nombre;
	public $apellido;
	private $dni;
	public $fnacimineto;
	private $falta;
	private $activo;
	public $faceid;
        public $imageURI;

        public function __construct($id, $email, $pass, $nombre, $apellido, $dni, $fnacimineto, $falta, $activo, $faceid, $imageURI) {
            $this->id = $id;
            $this->email = $email;
            $this->pass = $pass;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->dni = $dni;
            $this->fnacimineto = $fnacimineto;
            $this->falta = $falta;
            $this->activo = $activo;
            $this->faceid = $faceid;
            $this->imageURI = $imageURI;
        }
        
        public function getId() {
            return $this->id;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getPass() {
            return $this->pass;
        }

        public function getNombre() {
            return $this->nombre;
        }

        public function getApellido() {
            return $this->apellido;
        }

        public function getDni() {
            return $this->dni;
        }

        public function getFnacimineto() {
            return $this->fnacimineto;
        }

        public function getFalta() {
            return $this->falta;
        }

        public function getActivo() {
            return $this->activo;
        }

        public function getFaceid() {
            return $this->faceid;
        }

        public function getImageURI() {
            return $this->imageURI;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function setPass($pass) {
            $this->pass = $pass;
        }

        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }

        public function setApellido($apellido) {
            $this->apellido = $apellido;
        }

        public function setDni($dni) {
            $this->dni = $dni;
        }

        public function setFnacimineto($fnacimineto) {
            $this->fnacimineto = $fnacimineto;
        }

        public function setFalta($falta) {
            $this->falta = $falta;
        }

        public function setActivo($activo) {
            $this->activo = $activo;
        }

        public function setFaceid($faceid) {
            $this->faceid = $faceid;
        }

        public function setImageURI($imageURI) {
            $this->imageURI = $imageURI;
        }



}
