<?php
//Recibir peticiones del usuario.
//echo 'Informacion: ' . file_get_contents('php://input');
header("Content-Type: application/json");
header("Content-Length: 2147483647");
include_once("../clases/classNotas.php");
switch($_SERVER['REQUEST_METHOD']){
    case 'POST':
        //echo "Guardar";
        $_POST = json_decode(file_get_contents('php://input'),true);
        $nota = new Nota(NULL,$_POST["idCursoEstudiante"],$_POST["idMateria"],$_POST["idProfesor"],$_POST["notaValor"],$_POST["notaPorcentaje"],$_POST["notaPeriodo"],$_POST["notaComentario"]);
        $resultado["id"] = $nota->guardarNota();
        echo json_encode($resultado);
    break; 
    case 'GET':
        //echo "obtener nota/s";
        if(isset($_GET['idNota'])){
            //$resultado["mensaje"] = "retornar la nota con el id: " .$_GET['id'];
            //echo json_encode($resultado);
            Nota::obtenerNotaId($_GET['idNota']);
        }else{
            //$resultado= $nota->obtenerNotas();
            //echo json_encode($resultado);
            Nota::obtenerNotas();

        }
    break;
    case 'PUT':  //Actualizar nota
        $_PUT = json_decode(file_get_contents('php://input'),true);
        $nota = new Nota(NULL,NULL,NULL,NULL,$_PUT["notaValor"],$_PUT["notaPorcentaje"],$_PUT["notaPeriodo"],$_PUT["notaComentario"]);
        $resultado = $nota->actualizarNota($_GET['idNota']);
        echo json_encode($resultado);
    break;
    case 'DELETE':
       // echo"Eliminar un nota";
       //$resultado["mensaje"] = "Eliminar un nota con el id: " .$_GET['id'];
       //echo json_encode($resultado);
       if(isset($_GET['idNota'])){
        Nota::eliminarNota($_GET['idNota']);
       }else{
        echo "0";
       }
       
    break;
}
?>
