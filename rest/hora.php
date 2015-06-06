<?php

	/*
		Desarrolló: Diego Alberto Jardón Ramírez
		Fecha: 31 - Mayo - 2014
		Versión: 1.0
		Appsteroid -- Mundial
	
		Servicio que consulta la quiniela ingresada por el usuario
				
	*/

	require("conexion.php");
	require("constantes.php");
	
	//$idUsuario = ($_GET["idUsuario"]);
	//$idUsuario = 2;	
	
	$query = "SELECT partido.idPartido, idQuiniela, localPartido, visitantePartido, fechaPartido, marcadorPartido, resultadoPartido, resultadoQuiniela FROM partido,quiniela WHERE idUsuario = 1 AND partido.idPartido = quiniela.idPartido ORDER BY fechaPartido ASC";
	
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
				$resultado[$i]["marcadorPartido"] = $info["marcadorPartido"];
				$resultado[$i]["resultadoPartido"] =  $info["resultadoPartido"];
				$resultado[$i]["resultadoQuiniela"] =  $info["resultadoQuiniela"];
				$resultado[$i]["nombreUsuario"] = $nombreUsuario;
				$hoy = time();
				
				echo "Hoy: ".$hoy."<br>";

				$horatmp = $hoy - strtotime($info["fechaPartido"]) + 18000;
				
				echo "Restan: ".$horatmp."<br>";
				
				if($hoy - strtotime($info["fechaPartido"]) < 0)
					$resultado[$i]["mostrar"] =  false;
				else
					$resultado[$i]["mostrar"] =  true;
				if($info["resultadoPartido"] == $info["resultadoQuiniela"] && $info["resultadoPartido"] != 0){
					if($info["resultadoPartido"] == 3){
						$resultado[$i]["puntosQuiniela"] = 1;
					}else{
						$resultado[$i]["puntosQuiniela"] = 3;
					}
				}else{
					$resultado[$i]["puntosQuiniela"] = 0;
				}
				$i++;
			}
		}else{
			$resultado["response"] = Constantes::ERROR_SIN_RESULTADOS_QUINIELA;
		}	
	}
	
	//echo json_encode($resultado);

?>