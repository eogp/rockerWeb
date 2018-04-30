<?php
require_once 'entidades/tipoPub.php';
require_once 'conexionBD.php';


class TipoPubModel{
    
    private $pdo;
    public function __construct() {
        $this->conexion=new ConexionBD();
        $this->pdo= $this->conexion->getPdo();
    }
    
    public function listar(){
        
        try
        {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM tipoPub");
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $tipoPub=new TipoPub(
                        $r->id, 
                        $r->descripcion);
                $result[]=$tipoPub;
                        
            }

            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
        
    }
    
    public function ObtenerTipoPub($id){
        try 
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM tipoPub WHERE (id = ?)");
                      
            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            if(isset($r->id)){
                $tipoPub = new TipoPub(
                        $r->id, 
                        $r->descripcion);

                return $tipoPub;
            }
            
            return null;
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
    
    
    
}