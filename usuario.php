<?php
include_once './datos.php';
include_once './token.php';
class Usuario
{
    public $email;
    public $clave;
  
    
    public function __construct($email,$clave)
    {
        $this->email=$email;
        $this->clave=$clave;
        
    }

    public function save()
   {

    return Datos::guardar("users.json", $this);

   }

   public static function validar($email,$clave)
   {
     $lista= Datos::leerjson("users.json");

     foreach($lista as $value)
     {
         if($value->email==$email && $value->clave==$clave)
         {

             $token= new Token;
             
             echo json_encode($token->encodetoken($email,$clave));
             return true;
             break;
         }
             
     }
     return false;

   }

  




}
?>