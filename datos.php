<?php
class Datos
{

    public static function guardar($archivo,$datos)
    {
      $file=fopen($archivo,'r');
      $string=fread($file,filesize($archivo));
      $json=json_decode($string);
      fclose($file);
  
      array_push($json,$datos);
  
      $file=fopen($archivo,'w');
      $rta=fwrite($file,json_encode($json));
      fclose($file);
  
      return $rta;
  
     }

     public static function leerJson($archivo)
     {
       $file=fopen($archivo,'r');
       $string=fread($file,filesize($archivo));
       $json=json_decode($string);
       fclose($file);
   
       return $json;
   
     }
  







}
?>