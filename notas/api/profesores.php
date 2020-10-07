<?php
//Recibir peticiones del usuario
//echo 'Informacion: ' . file_get_contents('php://input');

header("Content-Type: application/json");
switch($_SERVER['REQUEST_METHOD']){
    case 'POST':
        //echo "Guardar";
        $_POST = json_decode(file_get_contents('php://input'),true);
        $resultado["mensaje"] =  "guardar id profesor ". json_encode($_POST); 
        echo json_encode($resultado);
    break;
    case 'GET':
        //echo "obtener nota/s";
        if(isset($_GET['id'])){
            $resultado["mensaje"] = "retornar el id del profesor: " .$_GET['id'];
            echo json_encode($resultado);
        }else{
            $resultado["mensaje"] = "retornar todos los profesor";
            echo json_encode($resultado);
        }
    break;
    case 'PUT':
        //echo "Actualizar nota";
        $_PUT = json_decode(file_get_contents('php://input'),true);
        $resultado["mensaje"] = "actualizar el id de un profesor: " .$_GET['id'].
                    ",información a actualizar: ".json_encode($_PUT);
        echo json_encode($resultado);
    break;
    case 'DELETE':
       // echo"Eliminar un nota";
       $resultado["mensaje"] = "Eliminar el id de un profesor: " .$_GET['id'];
       echo json_encode($resultado);
    break;
}
?>
