<?php

require_once 'conexionBD.php';
require_once 'entidades/usuarioWeb.php';

class UsuarioWebModel {

    private $conexion;
    private $pdo;

    public function __construct() {
        $this->conexion = new ConexionBD();
        $this->pdo = $this->conexion->getPdo();
    }

    public function listar() {
        try {
            $result = array();

            $select = $this->pdo->prepare("SELECT * FROM usuarioweb");
            $select->execute();

            foreach ($select->fetchAll(PDO::FETCH_OBJ) as $r) {
                $usuarioWeb = new UsuarioWeb(
                        $r->id, 
                        $r->email, 
                        $r->pass, 
                        $r->pnombre, 
                        $r->snombre, 
                        $r->papellido, 
                        $r->sapellido, 
                        $r->dni, 
                        $r->fnacimiento, 
                        $r->falta, 
                        $r->activo, 
                        $r->faceid,
                        $r->perfil_id
                        );
                $result[] = $usuarioWeb;
            }

            return $result;
        } catch (Exception $e) {

            die($e->getMessage());
        }
    }

    public function insertar(UsuarioWeb $data) {

        try {
            $sql = "INSERT INTO usuarioweb (
                                    `email`,
                                    `pass`,
                                    `pnombre`,
                                    `snombre`,
                                    `papellido`,
                                    `sapellido`,
                                    `dni`,
                                    `fnacimiento`,
                                    `falta`,
                                    `activo`,
                                    `faceid`,
                                    `perfil_id`) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->getEmail(),
                                $data->getPass(),
                                $data->getPnombre(),
                                $data->getSnombre(),
                                $data->getPapellido(),
                                $data->getSapellido(),
                                $data->getDni(),
                                $data->getFnacimineto(),
                                $data->getFalta(),
                                $data->getActivo(),                                
                                $data->getFaceid(),
                                $data->getPerfil_id()
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerUsuarioWeb($email, $pass){
        try 
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM usuarioweb WHERE (email = ? AND pass=?)");
                      
            $stm->execute(array($email,$pass));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id)){
                $usuarioWeb = new UsuarioWeb(
                    $r->id, 
                    $r->email, 
                    $r->pass, 
                    $r->pnombre, 
                    $r->snombre, 
                    $r->papellido, 
                    $r->sapellido, 
                    $r->dni, 
                    $r->fnacimiento, 
                    $r->falta, 
                    $r->activo, 
                    $r->faceid, 
                    $r->perfil_id);

                return $usuarioWeb;
            }
            
            return null;
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
    
    public function ObtenerUsuarioId(UsuarioWeb $data){
        try 
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM usuarioweb WHERE (id = ?)");
                      
            $stm->execute(array($data->getId()));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id)){
                $usuarioWeb = new UsuarioWeb(
                    $r->id, 
                    $r->email, 
                    $r->pass, 
                    $r->pnombre, 
                    $r->snombre, 
                    $r->papellido, 
                    $r->sapellido, 
                    $r->dni, 
                    $r->fnacimiento, 
                    $r->falta, 
                    $r->activo, 
                    $r->faceid, 
                    $r->perfil_id);

                return $usuarioWeb;
            }
            
            return null;
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }   
    
    public function ObtenerUsuarioWebByEmail($email){
        try 
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM usuarioweb WHERE (email = ?)");
                      
            $stm->execute(array($email));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id)){
                $usuarioWeb = new UsuarioWeb(
                    $r->id, 
                    $r->email, 
                    $r->pass, 
                    $r->pnombre, 
                    $r->snombre, 
                    $r->papellido, 
                    $r->sapellido, 
                    $r->dni, 
                    $r->fnacimiento, 
                    $r->falta, 
                    $r->activo, 
                    $r->faceid, 
                    $r->perfil_id);

                return $usuarioWeb;
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
                      ->prepare("SELECT * FROM usuarioweb WHERE (email = ?)");
                      

            $stm->execute(array($email));
            $r = $stm->fetchColumn();
            /*
            $usuarioWeb = new UsuarioWeb(
                    $r->id, 
                    $r->email, 
                    $r->pass, 
                    $r->pnombre, 
                    $r->snombre, 
                    $r->papellido, 
                    $r->sapellido, 
                    $r->dni, 
                    $r->fnacimiento, 
                    $r->falta, 
                    $r->activo, 
                    $r->perfil_id, 
                    $r->faceid);

            */

            return $r;
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
    
    public function actualizarUsuarioWeb(UsuarioWeb $data) {

        try 
        {
            $sql = "UPDATE usuarioweb SET 
                        email       = ?, 
                        pass        = ?,
                        pnombre     = ?, 
                        snombre     = ?,
                        papellido   = ?,
                        sapellido   = ?,
                        dni         = ?, 
                        fnacimiento = ?,
                        falta       = ?, 
                        activo      = ?,
                        faceid      = ?,
                        perfil_id   = ?
                    WHERE id = ?";

            $this->pdo->prepare($sql)
                 ->execute(
                array(
                    $data->getEmail(), 
                    $data->getPass(), 
                    $data->getPnombre(),
                    $data->getSnombre(),
                    $data->getPapellido(),
                    $data->getSapellido(),
                    $data->getDni(),
                    $data->getFnacimineto(),
                    $data->getFalta(),
                    $data->getActivo(),
                    $data->getFaceid(),
                    $data->getPerfil_id(),
                    $data->getId()
                    )
                );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }


}

//TEST--------------------------------
//$usuarioWebModel = new UsuarioWebModel();
//$usuarioWebModel->mostrar();

