<?php

require_once 'entidades/video.php';
require_once 'conexionBD.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VideoModel
 *
 * @author enriquegomezpena
 */
class VideoModel {

    //put your code here
    private $conexion;
    private $pdo;

    public function __construct() {
        $this->conexion = new ConexionBD();
        $this->pdo = $this->conexion->getPdo();
    }

    public function listar() {

        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM video");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $video = new Video(
                        $r->id, $r->uri, $r->thumbnail, $r->publicacion_id);
                $result[] = $video;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Video $data) {

        try {
            $sql = "INSERT INTO video (
                                    `uri`,
                                    `thumbnail`,
                                    `publicacion_id`) 
                                VALUES (?, ?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getUri(),
                                $data->getThumbnail(),
                                $data->getPublicacion_id()
                            )
            );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
     public function obtenerVideoByPubId($id) {
        try {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM video WHERE (publicacion_id = ?)");
                      
            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id)){
                $video = new Video(
                        $r->id, $r->uri, $r->thumbnail, $r->publicacion_id);

                return $video;
            }
            
            return null;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function actualizar(Video $data){
         try 
        {
            $sql = "UPDATE video SET 
                        `uri` = ?
                    WHERE publicacion_id = ?";

            $this->pdo->prepare($sql)
                 ->execute(
                array(
                    $data->getUri(), 
                    $data->getPublicacion_id()
                    )
                );
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

}
