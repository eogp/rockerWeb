<?php

require_once 'conexionBD.php';
require_once 'entidades/usuarioapp.php';

class UsuarioAppModel {
    private $conexion;
    private $pdo;

    public function __construct() {
        $this->conexion = new ConexionBD();
        $this->pdo = $this->conexion->getPdo();
    }
    
    public function insertar(UsuarioApp $data) {

        try {
            $sql = "INSERT INTO usuarioapp (
                                    `email`,
                                    `pass`,
                                    `nombre`,
                                    `apellido`,
                                    `dni`,
                                    `fnacimiento`,
                                    `falta`,
                                    `activo`,
                                    `faceid`,
                                    `imageURI`
                                    ) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getEmail(),
                                $data->getPass(),
                                $data->getNombre(),
                                $data->getApellido(),
                                $data->getDni(),
                                $data->getFnacimineto(),
                                $data->getFalta(),
                                $data->getActivo(),                                
                                $data->getFaceid(),
                                $data->getImageURI()

                            )
            );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function ObtenerUsuarioApp($email, $pass){
        try 
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM usuarioapp WHERE (email = ? AND pass=?)");
                      
            $stm->execute(array($email,$pass));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id)){
                $usuarioApp = new UsuarioApp(
                    $r->id, 
                    $r->email, 
                    $r->pass, 
                    $r->nombre, 
                    $r->apellido,  
                    $r->dni, 
                    $r->fnacimiento, 
                    $r->falta, 
                    $r->activo, 
                    $r->faceid,
                    $r->imageURI   
                    );

                return $usuarioApp;
            }
            
            return null;
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
    
    public function existeEmail($email){
        try 
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM usuarioapp WHERE (email = ? AND faceid IS NULL)");
                      
            $stm->execute(array($email));
            $r = $stm->fetchColumn();
          
            return $r;
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
    
  
    
    public function actualizarUsuario(UsuarioApp $data) {
        try 
        {
            $sql = "UPDATE usuarioapp SET 
                        email       = ?, 
                        pass        = ?,
                        nombre      = ?, 
                        apellido    = ?,
                        dni         = ?, 
                        fnacimiento = ?,
                        falta       = ?, 
                        activo      = ?,
                        imageURI    = ?
                    WHERE id = ?";

            $this->pdo->prepare($sql)
                 ->execute(
                array(
                    $data->getEmail(), 
                    $data->getPass(), 
                    $data->getNombre(),
                    $data->getApellido(),
                    $data->getDni(),
                    $data->getFnacimineto(),
                    $data->getFalta(),
                    $data->getActivo(),
                    $data->getImageURI(),
                    $data->getId()
                    )
                );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
    
    public function ObtenerUsuarioByEmail($email){
        try 
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM usuarioapp WHERE (email = ? AND faceid IS NULL)");
                      
            $stm->execute(array($email));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id)){
                $usuarioApp = new UsuarioApp(
                    $r->id, 
                    $r->email, 
                    $r->pass, 
                    $r->nombre, 
                    $r->apellido,  
                    $r->dni, 
                    $r->fnacimiento, 
                    $r->falta, 
                    $r->activo, 
                    $r->faceid,
                    $r->imageURI
                        
                    );

                return $usuarioApp;
            }
            
            return null;
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
    
    public function ObtenerUsuarioByFaceId($faceId){
        try 
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM usuarioapp WHERE (faceid = ?)");
                      
            $stm->execute(array($faceId));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id)){
                $usuarioApp = new UsuarioApp(
                    $r->id, 
                    $r->email, 
                    $r->pass, 
                    $r->nombre, 
                    $r->apellido,  
                    $r->dni, 
                    $r->fnacimiento, 
                    $r->falta, 
                    $r->activo, 
                    $r->faceid,
                    $r->imageURI
                        
                    );

                return $usuarioApp;
            }
            
            return null;
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
}
