<?php
include_once './datos.php';
class Materia
{

    public $nombre;
    public $cuatrimestre;
    public $id;
  
    
    public function __construct($id,$nombre,$cuatrimestre)
    {
        $this->id=$id;
        $this->nombre=$nombre;
        $this->cuatrimestre=$cuatrimestre;
        
    }

    public function savemateria()
    {
 
     return Datos::guardar("materias.json", $this);
 
    }
 
 





}
?>