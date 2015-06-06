<?php

	/*
		Desarrolló: Diego Alberto Jardón Ramírez
		Fecha: 31 - Mayo - 2014
		Versión: 1.0
		Appsteroid -- Mundial
	
		Servicio que consulta los partidos
				
	*/

	/*session_start();
	if(isset($_SESSION['login'])){
		$idUsuario = $_SESSION['idUsuario'];
	}*/
	
	require("conexion.php");
	require("constantes.php");
	
	//$idUsuario = ($_GET["idUsuario"]);
	//$idUsuario = 2;	
	
		setlocale(LC_ALL,"es_ES");
	
	$query = "SELECT idPartido, localPartido, visitantePartido, resultadoPartido, fechaPartido FROM partido ORDER BY fechaPartido ASC";
	
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
				$resultado[$i]["localPartido"] = $info["localPartido"];
				$resultado[$i]["visitantePartido"] = $info["visitantePartido"];
				$resultado[$i]["resultadoPartido"] =  $info["resultadoPartido"];
				
				$tmpFecha = strftime ("%A %d de %B de %Y a las %H:%M",strtotime($info["fechaPartido"]));
				
				if (strpos($tmpFecha, 'lunes') !== false){
					$fechaFormato = str_replace("lunes","Lunes",$tmpFecha);
				}else{
					if (strpos($tmpFecha, 'martes') !== false){
						$fechaFormato = str_replace("martes","Martes",$tmpFecha);
					}else{
						if (strpos($tmpFecha, 'miércoles') !== false){
							$fechaFormato = str_replace("miércoles","Miercoles",$tmpFecha);
						}else{
							if (strpos($tmpFecha, 'jueves') !== false){
								$fechaFormato = str_replace("jueves","Jueves",$tmpFecha);
							}else{
								if (strpos($tmpFecha, 'viernes') !== false){
									$fechaFormato = str_replace("viernes","Viernes",$tmpFecha);
								}else{
									if (strpos($tmpFecha, 'sábado') !== false){
										$fechaFormato = str_replace("sábado","Sabado",$tmpFecha);
									}else{
										if (strpos($tmpFecha, 'domingo') !== false){
											$fechaFormato = str_replace("domingo","Domingo",$tmpFecha);
										}else{
												
										}
									}
								}
							}
						}
					}
				}
				
				$resultado[$i]["fechaPartido"] = $fechaFormato;
				
				$i++;
			}
		}else{
			$resultado["response"] = Constantes::ERROR_SIN_RESULTADOS_QUINIELA;
		}	
	}
	
	echo json_encode($resultado);

?>