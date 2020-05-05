<?php 
require_once './datos.php';
class Profesor
{

    public $nombre;
    public $legajo;
    public $img;
  
    
    public function __construct($nombre,$legajo,$img)
    {
        $this->nombre=$nombre;
        $this->legajo=$legajo;
        $this->img=$img;
        
    }

    public function saveprofesor()
    {
 
     return Datos::guardar("profesores.json", $this);
 
    }

    public static function validarlegajo($legajo)
    {

        $lista= Datos::leerjson("profesores.json");

        foreach($lista as $value)
        {
            if($value->legajo==$legajo )
            {
   
               return false;
           
               break;
            }
                
        }

        return true;


    }
 



}
?>