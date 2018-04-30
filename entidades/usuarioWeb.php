<?php

/**
* 
*/
class UsuarioWeb 
{
	private $id;
	private $email;
	private $pass;
	private $pnombre;
	private $snombre;
	private $papellido;
	private $sapellido;
	private $dni;
	private $fnacimineto;
	private $falta;
	private $activo;
	private $faceid;
	private $perfil_id;

        public function __construct($id, $email, $pass, $pnombre, $snombre, $papellido, $sapellido, $dni, $fnacimineto, $falta, $activo, $faceid, $perfil_id) {
            $this->id = $id;
            $this->email = $email;
            $this->pass = $pass;
            $this->pnombre = $pnombre;
            $this->snombre = $snombre;
            $this->papellido = $papellido;
            $this->sapellido = $sapellido;
            $this->dni = $dni;
            $this->fnacimineto = $fnacimineto;
            $this->falta = $falta;
            $this->activo = $activo;
            $this->faceid = $faceid;
            $this->perfil_id = $perfil_id;
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

        public function getPnombre() {
            return $this->pnombre;
        }

        public function getSnombre() {
            return $this->snombre;
        }

        public function getPapellido() {
            return $this->papellido;
        }

        public function getSapellido() {
            return $this->sapellido;
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

        public function getPerfil_id() {
            return $this->perfil_id;
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

        public function setPnombre($pnombre) {
            $this->pnombre = $pnombre;
        }

        public function setSnombre($snombre) {
            $this->snombre = $snombre;
        }

        public function setPapellido($papellido) {
            $this->papellido = $papellido;
        }

        public function setSapellido($sapellido) {
            $this->sapellido = $sapellido;
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

        public function setPerfil_id($perfil_id) {
            $this->perfil_id = $perfil_id;
        }


        
}





