<?php

	$resultado[0] = "1";
	$resultado[0]["quinielas"][0] = "2";
	$resultado[0]["quinielas"][1] = "3";
	$resultado[1] = "2";
	$resultado[1]["quinielas"][0] = "1";
	
	echo json_encode($resultado);

?>