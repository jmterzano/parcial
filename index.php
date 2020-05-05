<?php
require_once './usuario.php';
require_once './materia.php';
require_once './profesor.php';
require_once './file.php';


$path= $_SERVER['PATH_INFO'] ?? "";
$metodo= $_SERVER['REQUEST_METHOD'] ?? "";


switch($path)
{
    case "/usuario":
        if($metodo=='POST'){
            
           $email =$_POST['email'] ?? "";
           $clave=$_POST['clave'] ?? "";
      

           if($clave!="" && $email!="")
            {
           
                $usuario= new Usuario($email,$clave);
                $rta=$usuario->save();
                if($rta!=0)
                {
                    echo "se guardo correctamente";
                }
                
            }
            else{
                echo "faltan datos";
            }
        }
        else{
            echo"Debe ingresar por POST";
        }

    break;

    case "/login":
        if($metodo=="POST")
        {
            $email=$_POST['email'] ?? "";
            $clave=$_POST['clave'] ?? "";
          
            if($email!="" && $clave!="")
            {
    
              if(Usuario :: validar($email,$clave))
              {
                echo " <br>Se encontro";
              }else{
                    echo "Nombre o Clave erroneos";
              }
    
            }else{
                echo "Faltan datos";
            }
    
    
        }else{
            echo"Debe usar metodo POST";
        }
    break;

    case"/materia":
        if($metodo=="POST")
        {
            $header = getallheaders();
            $mitoken=$header["token"] ?? " ";
            
            if(Token::decodeToken($mitoken))
            {
                $id=time();
                $nombre =$_POST['nombre'] ?? "";
                $cuatrimestre=$_POST['cuatrimestre'] ?? "";
                if($nombre!="" && $cuatrimestre!="")
                    {  
                        
                        $materia= new Materia($id,$nombre,$cuatrimestre);
                        $rta=$materia->savemateria();
        
                        if($rta != 0)
                        {
                            echo "se guardo la materia correctamente";
                        }
                    }
                  else
                    {
                        echo "faltan datos";
                    }
             
            }
        }else{
            echo"Debe usar metodo POST";
        }
    
    break;

    case"/profesor":
        if($metodo=="POST")
        {
            $header = getallheaders();
            $mitoken=$header["token"] ?? " ";
            
            if(Token::decodeToken($mitoken))
            {
                $nombre =$_POST['nombre'] ?? "";
             if(Profesor :: validarlegajo($legajo=$_POST['legajo']))
             {
                $legajo=$_POST['legajo'] ?? "";
             }else
             {
                 echo "legajo existente";
             }
                
                $imag=$_FILES['imagen']['tmp_name'] ?? "";
                if($imag!="")
                {
                    $imagen=File :: guardarfoto($_FILES['imagen']);
                }
                else
                {
                    echo "Debe ingresar una imagen";
                }
                if($nombre!="" && $legajo!="")
                    {  
                        
                        $profesor= new Profesor($nombre,$legajo,$imagen);
                        $rta=$profesor->saveprofesor();
        
                        if($rta != 0)
                        {
                            echo "se guardo el profesor";
                        }
                    }
                  else
                    {
                        echo "faltan datos";
                    }
             
            }
            else{
                echo "token erroneo";
            }
        }else{
            echo"Debe usar metodo POST";
        }
    
    break;

    case "/materia":
        if($metodo == "GET")
        {
            $header = getallheaders();
            $mitoken=$header["token"] ?? " ";
            if(Token::decodeToken($mitoken))
            {
              
                    $lista = Datos::leerJson("materias.json");
                    echo json_encode($lista);
                   
                
            }
        }else{
            echo "debe ingresar por metodo get";
        }


    break;

    case "/profesor":
        if($metodo == "GET")
        {
            $header = getallheaders();
            $mitoken=$header["token"] ?? " ";
            if(Token::decodeToken($mitoken))
            {
               
                {
                    $lista = Datos::leerJson("profesores.json");
                    echo json_encode($lista);
                   
                }
            }
        }else{
            echo "debe ingresar por metodo get";
        }

    break;

    
    












}

?>