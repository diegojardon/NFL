<?php

	/*
		Desarrolló: Diego Alberto Jardón Ramírez
		Fecha: 31 - Mayo - 2014
		Versión: 1.0
		Appsteroid -- Mundial
	
		Servicio que consulta las Semanas
				
	*/

	require("conexion.php");
	require("constantes.php");
	
	$hoy = date("Y-m-d H:i:s");
	//echo $hoy;
	
	$query = "SELECT idSemana FROM semana WHERE '".$hoy."' BETWEEN fechaInicioSemana AND fechaFinSemana";
		
	$result = mysql_query($query,$link);
	
	if($result === FALSE){
		$resultado["response"] = Constantes::ERROR_SELECCION_NO_VALIDA;
	}else{
		$totalFilas = mysql_num_rows($result);
		if($totalFilas == 1){
			$info = mysql_fetch_assoc($result);
			$resultado["idSemana"] = $info["idSemana"];
		}else{
			//No hay resultados, por default se manda la fecha 1.
			$resultado["idSemana"] = 1;
		}
	}
	
	//if($hoy - strtotime($info["fechaPartido"]) < -18000)
	
	echo json_encode($resultado);

?>