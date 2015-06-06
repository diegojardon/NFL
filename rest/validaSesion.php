<?php

	//http://stackoverflow.com/questions/520237/how-do-i-expire-a-php-session-after-30-minutes

	session_start();

	if(!isset($_SESSION['login'])){
		$resultado["sesion"] = 0;
		//header('Location: ../web/view/login.html');
	}else{
		$ahora = time();
		if ($ahora > $_SESSION['expire']) {
            session_destroy();
			$resultado["sesion"] = 0;
			//header('Location: ../web/view/login.html');
        }else{
			$resultado["sesion"] = 1;
			$resultado["nombreUsuario"] = $_SESSION['nombreUsuario'];
		}
	}
	
	echo json_encode($resultado);
?>