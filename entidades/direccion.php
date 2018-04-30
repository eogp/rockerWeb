<?php 

/**
* 
*/
class Direccion
{
	
	private $id;
	private $depto;
	private $torre;
	public $altura;
	public $calle;
	public $localidad;
        public $ciudad;
	public $partido;
        public $cp;
	public $pais;
	public $provincia;
        public $latitud;
        public $longitud;

        public function __construct($id, $depto, $torre, $altura, $calle, $localidad, $ciudad, $partido, $cp, $pais, $provincia, $latitud, $longitud) {
            $this->id = $id;
            $this->depto = $depto;
            $this->torre = $torre;
            $this->altura = $altura;
            $this->calle = $calle;
            $this->localidad = $localidad;
            $this->ciudad = $ciudad;
            $this->partido = $partido;
            $this->cp = $cp;
            $this->pais = $pais;
            $this->provincia = $provincia;
            $this->latitud = $latitud;
            $this->longitud = $longitud;
        }

        public function getId() {
            return $this->id;
        }

        public function getDepto() {
            return $this->depto;
        }

        public function getTorre() {
            return $this->torre;
        }

        public function getAltura() {
            return $this->altura;
        }

        public function getCalle() {
            return $this->calle;
        }

        public function getLocalidad() {
            return $this->localidad;
        }

        public function getCiudad() {
            return $this->ciudad;
        }

        public function getPartido() {
            return $this->partido;
        }

        public function getCp() {
            return $this->cp;
        }

        public function getPais() {
            return $this->pais;
        }

        public function getProvincia() {
            return $this->provincia;
        }

        public function getLatitud() {
            return $this->latitud;
        }

        public function getLongitud() {
            return $this->longitud;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setDepto($depto) {
            $this->depto = $depto;
        }

        public function setTorre($torre) {
            $this->torre = $torre;
        }

        public function setAltura($altura) {
            $this->altura = $altura;
        }

        public function setCalle($calle) {
            $this->calle = $calle;
        }

        public function setLocalidad($localidad) {
            $this->localidad = $localidad;
        }

        public function setCiudad($ciudad) {
            $this->ciudad = $ciudad;
        }

        public function setPartido($partido) {
            $this->partido = $partido;
        }

        public function setCp($cp) {
            $this->cp = $cp;
        }

        public function setPais($pais) {
            $this->pais = $pais;
        }

        public function setProvincia($provincia) {
            $this->provincia = $provincia;
        }

        public function setLatitud($latitud) {
            $this->latitud = $latitud;
        }

        public function setLongitud($longitud) {
            $this->longitud = $longitud;
        }


        
}


 