<?php

	/*
		Desarrolló: Diego Alberto Jardón Ramírez
		Fecha: 31 - Mayo - 2014
		Versión: 1.0
		Appsteroid -- Mundial
	
		Servicio que consulta el ranking de usuarios
				
	*/

	require("conexion.php");
	require("constantes.php");
	
	$query = "SELECT partido.idPartido, idQuiniela, usuario.idUsuario, marcadorPartido, resultadoPartido, resultadoQuiniela, nombreUsuario FROM partido,quiniela,usuario WHERE partido.idPartido = quiniela.idPartido 
			  AND usuario.idUsuario = quiniela.idUsuario";
	
	$result = mysql_query($query,$link);
	
	if($result === FALSE){
		$resultado["response"] = Constantes::ERROR_SELECCION_NO_VALIDA;
	}else{
		$totalFilas = mysql_num_rows($result);
		if($totalFilas > 0){
			$i = 0;
			while ($info = mysql_fetch_assoc($result)) {
				if($info["resultadoPartido"] == $info["resultadoQuiniela"] && $info["resultadoPartido"] != 0){
					$ranking[$info["idUsuario"]-1]["puntosQuiniela"] += 1;
					$ranking[$info["idUsuario"]-1]["nombreUsuario"] = $info["nombreUsuario"];
				}else{
					$ranking[$info["idUsuario"]-1]["puntosQuiniela"] += 0;
					$ranking[$info["idUsuario"]-1]["nombreUsuario"] = $info["nombreUsuario"];
				}
				$i++;
			}
		}else{
			$ranking["response"] = Constantes::ERROR_SIN_RESULTADOS_QUINIELA;
		}	
		
	//krsort($ranking);
		
	$size = count($ranking);
		for ($i=0; $i<$size; $i++) {
			for ($j=1; $j<$size-$i; $j++) {
				if ($ranking[$j-1]["puntosQuiniela"] < $ranking[$j]["puntosQuiniela"]) {
					$tmp = $ranking[$j-1]["puntosQuiniela"];
					$tmp2 = $ranking[$j-1]["nombreUsuario"];
					$ranking[$j-1]["puntosQuiniela"] = $ranking[$j]["puntosQuiniela"];
					$ranking[$j-1]["nombreUsuario"] = $ranking[$j]["nombreUsuario"];
					$ranking[$j]["puntosQuiniela"] = $tmp;
					$ranking[$j]["nombreUsuario"] = $tmp2;
				}
			}
		}
	
	//Si hay mas de un participante en un lugar, se pone la posicion por bloques
	
	$j=2;
	for($i=0;$i<$size;$i++){
		if($i>0){
			if($ranking[$i]["puntosQuiniela"] == $ranking[$i-1]["puntosQuiniela"]){
				$ranking[$i]["posicion"] = $ranking[$i-1]["posicion"];
			}else{
				$ranking[$i]["posicion"] = $j;
				$j++;
			}
		}else{
			$ranking[$i]["posicion"] = 1;
		}
	}
		
	/*$size = count($ranking);
		for ($i=0; $i<$size; $i++) {
			echo "Valor: ".$ranking[$i]["puntosQuiniela"];
		}*/
	}
	
	echo json_encode($ranking);

?>