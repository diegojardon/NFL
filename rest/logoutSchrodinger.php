<?php
	/*
		Desarroll�: Diego Alberto Jard�n Ram�rez
		Fecha: 31 - Mayo - 2014
		Versi�n: 1.0
		Appsteroid -- Mundial
	
		Servicio de logout
				
	*/

	require("constantes.php");

	session_start();
	session_destroy();
	
	header('Location: ../web/view/login.html');
	
?>