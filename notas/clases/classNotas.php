<?php
include_once("../conexion.php");
class Nota{
    private $idNota;
    private $idCurso;
    private $idMateria;
    private $idProfesor;
    private $notaValor;
    private $notaPorcentaje;
    private $notaPeriodo;
    private $notaComentario;

    public function __construct($idNota,$idCurso,$idMateria,$idProfesor,$notaValor,$notaPorcentaje,$notaPeriodo,$notaComentario){
        $this->idNota = $idNota;
        $this->idCurso = $idCurso;
        $this->idMateria = $idMateria;
        $this->idProfesor = $idProfesor;
        $this->notaValor = $notaValor;
        $this->notaPorcentaje = $notaPorcentaje;
        $this->notaPeriodo = $notaPeriodo;
        $this->notaComentario= $notaComentario;
    }
    // setters  
    public function setidNota($idNota){
        $this->idNota = $idNota;
        return $this;
    }
    
    public function setidCurso($idCurso){
        $this->idCurso = $idCurso;
        return $this;
    }
    public function setidMateria($idMateria){
        $this->idMateria = $idMateria;
        return $this;
    }
    public function setidProfesor($idProfesor){
        $this->idProfesor = $idProfesor;
        return $this;
    }
    public function setNotaValor($notaValor){
        $this->notaValor = $notaValor;
        return $this;
    }
    public function setNotaPorcentaje($notaPorcentaje){
        $this->notaPorcentaje = $notaPorcentaje;
        return $this;
    }
    public function setNotaPeriodo($notaPeriodo){
        $this->notaPeriodo = $notaPeriodo;
        return $this;
    }
    public function setNotaComentario($notaComentario){
        $this->notaComentario = $notaComentario;
        return $this;
    }
    // getters
    public function getidNota(){
        return $this->idNota;
    }
    public function getidCurso(){
        return $this->idCurso;
    }
    public function getidMateria(){
        return $this->idMateria;
    }
    public function getidProfesor(){
        return $this->idProfesor;
    }
    public function getNotaValor(){
        return $this->notaValor;
    }
    public function getNotaPorcentaje(){
        return $this->notaPorcentaje;
    }
    public function getNotaPeriodo(){
        return $this->notaPeriodo;
    }
    public function getNotaComentario(){
        return $this->notaComentario;
    }

    public function __toString(){
       return $this->idNota." ".$this->idCurso." ".$this->idMateria." ".$this->idProfesor." ".$this->notaValor." ".$this->notaPorcentaje." ".$this->notaPeriodo." ".$this->notaComentario." "; 
    }
    //--------- CRUD  -----------------//
    //----------Create ----------------//
    public function guardarNota(){
        try{
            $ps=Conexion::conexionbd()->prepare("INSERT INTO tablaNotas (notasIdCursoEstudiante,notasIdMateria,notasIdProfesor,notasValor,notasPorcentaje,notasPeriodo,NotasComentarios) VALUES(?,?,?,?,?,?,?)");
            //$ps->bindParam(1,$this->idCurso);
            $ps->bindParam(1,$this->idCurso);
            $ps->bindParam(2,$this->idMateria);
            $ps->bindParam(3,$this->idProfesor);
            $ps->bindParam(4,$this->notaValor);
            $ps->bindParam(5,$this->notaPorcentaje);
            $ps->bindParam(6,$this->notaPeriodo);
            $ps->bindParam(7,$this->notaComentario);   
            $ps->execute();
            //Return last id
            $id=Conexion::conexionbd()->prepare("SELECT MAX(notasId) AS id FROM tablaNotas");
            $id->execute();
            $li=$id->fetch();
            $ps = null;
		} catch (Exception $e) {
        echo "Error al consultar".$e;
        }
        $this->idNota = $li['id'];
        $li = null;
        return $this->idNota;
    }
    //---------- Read all ----------------//
    public function obtenerNotas(){
        try{
            $ps=Conexion::conexionbd()->prepare('Select * from tablaNotas');
            $ps->execute();
           while ($fila = $ps->fetch(PDO::FETCH_ASSOC)) {
                $idNota = $fila['notasId'];
                $idCurso = $fila['notasIdCursoEstudiante'];
                $idMateria = $fila['notasIdMateria'];
                $idProfesor = $fila['notasIdProfesor'];
                $notaValor = $fila['notasValor'];
                $notaPorcentaje = $fila['notasPorcentaje'];
                $notaPeriodo = $fila['notasPeriodo'];
                $notaComentario = $fila['NotasComentarios']; 
                $datos[]=array('notasId'=>$idNota, 'notasIdCursoEstudiante'=>$idCurso, 'notasIdMateria'=>$idMateria, 'notasIdProfesor'=>$idProfesor, 'notasValor'=>$notaValor, 'notasPorcentaje'=>$notaPorcentaje,'notasPeriodo'=>$notaPeriodo);//,'notaComentario'=>$notaComentario);
            }
		} catch (Exception $e) {
        echo "Error al consultar".$e;
        }
        //obtener las notas y devolverlas
        echo json_encode($datos);
        
    }
    //---------- Read one ----------------//   
    public static function obtenerNotaId($idNota){
        try {
            $ps=Conexion::conexionbd()->prepare('Select * from tablaNotas where notasId=?');
            $ps->bindParam(1,$idNota);
            $ps->execute();
            $datos=$ps->fetch(PDO::FETCH_ASSOC);
            $ps = null;
        } catch (Exeption $e) {
            echo "Error al consultar".$e;
        }
        //$json_string = json_encode($datos);
        echo json_encode($datos);
     }
    //---------- update all ---------------//  
    public function actualizarNota($idNota){
        try{
            $ps=Conexion::conexionbd()->prepare("UPDATE tablaNotas SET notasValor=?, notasPorcentaje=?, notasPeriodo=?, NotasComentarios=? WHERE notasId=?");
            $ps->bindParam(1,$this->notaValor);
            $ps->bindParam(2,$this->notaPorcentaje);
            $ps->bindParam(3,$this->notaPeriodo);
            $ps->bindParam(4,$this->notaComentario);
            $ps->bindParam(5,$idNota);    
            if($ps->execute())
            {
                $ps=Conexion::conexionbd()->prepare('Select * from tablaNotas where notasId=?');
                $ps->bindParam(1, $idNota);
                $ps->execute();
                $datos=$ps->fetch(PDO::FETCH_ASSOC);
            }
            else
            {
                $datos= 0;
            }
            $ps = null;
        } catch (Exception $e) {
            echo "Error al insertar ".$e;
        }
        return $datos;
    }
    //---------- delete ----------------//
    public static function eliminarNota($idNota){
        try{
            $ps=Conexion::conexionbd()->prepare("DELETE FROM  tablaNotas  WHERE notasId=?");
            $ps->bindParam(1,$idNota);
            if($ps->execute()){
                $borrado["id"] = $idNota;
                $json_string = json_encode($borrado);
            }
            $ps = null;
        } catch (Exception $e){
            echo "Error al Eliminar ".$e;
        }
        echo $json_string;
    }
}
?>