<?php
header("Content-Type: application/json");
include_once("../clases/classNotas.php");
switch($_SERVER['REQUEST_METHOD']){
    case 'POST':  //Guardar una nota
        $_POST = json_decode(file_get_contents('php://input'),true);
        $nota = new Nota(NULL,$_POST["idCursoEstudiante"],$_POST["idMateria"],$_POST["idProfesor"],$_POST["notaValor"],$_POST["notaPorcentaje"],$_POST["notaPeriodo"],$_POST["notaComentario"]);
        $resultado["id"] = $nota->guardarNota();
        echo json_encode($resultado);
    break; 
    case 'GET':  //Obtener nota/s 
        if(isset($_GET['idNota'])){  //Notas por Id
            Nota::obtenerNotaId($_GET['idNota']);
        }else{                      //Todas las notas
            Nota::obtenerNotas();
        }
    break;
    case 'PUT':  //Actualizar nota
        $_PUT = json_decode(file_get_contents('php://input'),true);
        $nota = new Nota(NULL,NULL,NULL,NULL,$_PUT["notaValor"],$_PUT["notaPorcentaje"],$_PUT["notaPeriodo"],$_PUT["notaComentario"]);
        $resultado = $nota->actualizarNota($_GET['idNota']);
        echo json_encode($resultado);
    break;
    case 'DELETE': //Eliminar una nota
       if(isset($_GET['idNota'])){
        Nota::eliminarNota($_GET['idNota']);
       }else{
        echo "0";
       }   
    break;
}
?>
