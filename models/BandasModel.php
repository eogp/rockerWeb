<?php
require_once 'conexionBD.php';
require_once 'entidades/bandas.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BandaModel
 *
 * @author enriquegomezpena
 */
class BandasModel {
    //put your code here
    private $conexion;
    private $pdo;
    public function __construct() {
        $this->conexion=new ConexionBD();
        $this->pdo= $this->conexion->getPdo();
    }
    public function listar(){
        
        try
        {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM bandas");
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $bandas=new Bandas($r->id, $r->descripcion, $r->publicacion_showeventos_id);
                $result[]=$bandas;
                        
            }

            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
        
    }
    
    public function insertar(Bandas $data) {
        
        try {
            $sql = "INSERT INTO bandas (
                                    `descripcion`,
                                    `publicacion_showeventos_id`) 
                                VALUES (?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getDescripcion(),
                                $data->getPublicacion_showeventos_id()
                              
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function obtenerBandasByPub_ShowEventosId($id){
        try 
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM bandas WHERE (publicacion_showeventos_id = ?)");
                      
            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id)){
                $bandas=new Bandas($r->id, $r->descripcion, $r->publicacion_showeventos_id);

                return $bandas;
            }
            
            return null;
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
    
     public function actualizar(Bandas $data){
         try 
        {
            $sql = "UPDATE bandas SET 
                        `descripcion` = ?
                    WHERE publicacion_showeventos_id = ?";

            $this->pdo->prepare($sql)
                 ->execute(
                array(
                    $data->getDescripcion(), 
                    $data->getPublicacion_showeventos_id()
                    )
                );
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

}

