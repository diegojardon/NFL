<?php

	/*
		Desarroll�: Diego Alberto Jard�n Ram�rez
		Fecha: 31 - Mayo - 2014
		Versi�n: 1.0
		Appsteroid -- Mundial
	
		Servicio que obtiene datos de la sesi�n
				
	*/

	require("constantes.php");
	
	session_start();
	if(isset($_SESSION['login'])){
		$resultado["idUsuario"] = $_SESSION['idUsuario'];
		$resultado["nombreUsuario"] = $_SESSION['nombreUsuario'];
		$resultado["response"] = Constantes::EXITO;
	}else{
		$resultado["response"] = Constantes::ERROR_SESION_NO_VALIDA;
	}
	
	echo json_encode($resultado);

?>