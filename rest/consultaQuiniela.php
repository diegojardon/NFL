<?php

	/*
		Desarrolló: Diego Alberto Jardón Ramírez
		Fecha: 31 - Mayo - 2014
		Versión: 1.0
		Appsteroid -- Mundial
	
		Servicio que consulta la quiniela ingresada por el usuario
				
	*/

	session_start();
	if(isset($_SESSION['login'])){
		$idUsuario = $_SESSION['idUsuario'];
		$nombreUsuario = $_SESSION['nombreUsuario'];
	}
	
	require("conexion.php");
	require("constantes.php");
	require("cors.php");
	
	$data = json_decode(file_get_contents("php://input"));
	$semana = mysql_real_escape_string($data->semana);
	
	//$idUsuario = ($_GET["idUsuario"]);
	//$idUsuario = 2;	
	
	if(!isset($semana) or empty($semana)){
		$hoy = date("Y-m-d H:i:s");
			
		$query = "SELECT idSemana FROM semana WHERE '".$hoy."' BETWEEN fechaInicioSemana AND fechaFinSemana";
			
		$result = mysql_query($query,$link);
		
		if($result === FALSE){
			$resultado["response"] = Constantes::ERROR_SELECCION_NO_VALIDA;
		}else{
			$totalFilas = mysql_num_rows($result);
			if($totalFilas == 1){
				$info = mysql_fetch_assoc($result);
				$semana = $info["idSemana"];
			}else{
				//No hay resultados, por default se manda la fecha 1.
				$semana = 1;
			}
		}
	}	
	
	setlocale(LC_ALL,"es_ES");
	
	$query = "SELECT partido.idPartido, idQuiniela, localPartido, visitantePartido, fechaPartido, marcadorPartido, fasePartido, resultadoPartido, resultadoQuiniela FROM partido,quiniela WHERE idUsuario = '".$idUsuario."' AND partido.idPartido = quiniela.idPartido AND semanaPartido = '".$semana."'ORDER BY fechaPartido ASC";
	
	$result = mysql_query($query,$link);
	
	if($result === FALSE){
		$resultado["response"] = Constantes::ERROR_SELECCION_NO_VALIDA;
	}else{
		$totalFilas = mysql_num_rows($result);
		if($totalFilas > 0){
			$i = 0;
			while ($info = mysql_fetch_assoc($result)) {
			
				$resultado[$i]["response"] = Constantes::EXITO;
				$resultado[$i]["idPartido"] = $info["idPartido"];
				$resultado[$i]["idQuiniela"] = $info["idQuiniela"];
				$resultado[$i]["localPartido"] = $info["localPartido"];
				$resultado[$i]["visitantePartido"] = $info["visitantePartido"];
				$resultado[$i]["fasePartido"] = $info["fasePartido"];
				$resultado[$i]["fechaPartido"] = strftime ("%a %d de %b a las %H:%M",strtotime($info["fechaPartido"]));
				$resultado[$i]["marcadorPartido"] = $info["marcadorPartido"];
				$resultado[$i]["resultadoPartido"] =  $info["resultadoPartido"];
				$resultado[$i]["resultadoQuiniela"] =  $info["resultadoQuiniela"];
				$resultado[$i]["nombreUsuario"] = $nombreUsuario;
				$resultado[$i]["idSemana"] = $semana;
				$hoy = time();
				//-18000 por el desfase de 5 horas en el server
				if($hoy - strtotime($info["fechaPartido"]) < -18000)
					$resultado[$i]["mostrar"] =  false;
				else
					$resultado[$i]["mostrar"] =  true;
				if($info["resultadoPartido"] == $info["resultadoQuiniela"] && $info["resultadoPartido"] != 0){
						$resultado[$i]["puntosQuiniela"] = 1;
				}else{
					$resultado[$i]["puntosQuiniela"] = 0;
				}
				$i++;
			}
		}else{
			$resultado["response"] = Constantes::ERROR_SIN_RESULTADOS_QUINIELA;
		}	
	}
	
	echo json_encode($resultado);

?>