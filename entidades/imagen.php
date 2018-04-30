<?php 
/**
* 
*/
class Imagen
{
	
	private $id;
	public $uri;
	private $thumbnail;
	private $publicacion_id;
        private $active;

	public function __construct($id, $uri, $thumbnail, $publicacion_id) {
            $this->id = $id;
            $this->uri = $uri;
            $this->thumbnail = $thumbnail;
            $this->publicacion_id = $publicacion_id;
        }

        public function getId() {
            return $this->id;
        }

        public function getUri() {
            return $this->uri;
        }

        public function getThumbnail() {
            return $this->thumbnail;
        }

        public function getPublicacion_id() {
            return $this->publicacion_id;
        }

        public function getActive() {
            return $this->active;
        }

                
        public function setId($id) {
            $this->id = $id;
        }

        public function setUri($uri) {
            $this->uri = $uri;
        }

        public function setThumbnail($thumbnail) {
            $this->thumbnail = $thumbnail;
        }

        public function setPublicacion_id($publicacion_id) {
            $this->publicacion_id = $publicacion_id;
        }

        public function setActive($active) {
            $this->active = $active;
        }

    
}
