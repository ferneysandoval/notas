<?php
// conexiones persistentes, se deberá establecer PDO::ATTR_PERSISTENT (,array( PDO::ATTR_PERSISTENT => true)
 class Conexion{
	public static function conexionbd()
	{
		try{
            //$cnn= new PDO('mysql:host=localhost;dbname=gradernotasdb','root','');
			$cnn= new PDO('mysql:host=gradernotasdb.cmn2d1zxgm1q.us-east-1.rds.amazonaws.com;port=3306;dbname=graderNotasDB','admin','Sandoval2021');

		} catch(exception $e){
			die("Error en la conexion".$e->GetMessage());
			echo "Linea de error ".$e->getLine();
		}
		return $cnn;
	}
}
	Conexion::conexionbd();
?>
