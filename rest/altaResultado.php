<?php

	/*
		Desarrolló: Diego Alberto Jardón Ramírez
		Fecha: 31 - Mayo - 2014
		Versión: 1.0
		Appsteroid -- Mundial
	
		Servicio que asigna marcador y resultado a un partido
	
	*/

	require("conexion.php");
	require("constantes.php");
	require("cors.php");
	
	
	$data = json_decode(file_get_contents("php://input"));
	$idPartido = mysql_real_escape_string($data->idPartido);
	$marcadorPartido = mysql_real_escape_string($data->marcadorPartido);
	$resultadoPartido = mysql_real_escape_string($data->resultadoPartido);
	
	/*$idPartido = 1;
	$marcadorPartido = "1-1";
	$resultadoPartido = 1;*/
	
	//Actualizamos el resultado del partido en la BD
	$query = "UPDATE partido SET marcadorPartido = '$marcadorPartido', resultadoPartido = '$resultadoPartido' WHERE idPartido = '$idPartido'";
	$result = mysql_query($query);
	if($result === TRUE){
		$resultado["response"] = Constantes::EXITO;
	}else{
		$resultado["response"] = Constantes::ERROR_INSERCION_RESULTADO_NO_VALIDO;
	}
	
	echo json_encode($resultado);		

?>