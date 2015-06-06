<?php

	/*
		Desarrolló: Diego Alberto Jardón Ramírez
		Fecha: 31 - Mayo - 2014
		Versión: 1.0
		Appsteroid -- Mundial
	
		Configuración de la conexión a Base de Datos
	
	*/
	
	//http://www.appsteroid.com:2082/
	//Usuario: appstero
	//Password: 4ppst3r01d

	//conexion a Base de Datos productiva
	$link = mysql_connect("localhost","appstero_nfl","3n33f33l3") or die('No se pudo conectar a la BD');
	mysql_select_db("appstero_nfl",$link);
	
	//conexion a Base de Datos pruebas
	/*$link = mysql_connect("localhost","root","") or die('No se pudo conectar a la BD');
	mysql_select_db("mundial",$link);*/
	
?>