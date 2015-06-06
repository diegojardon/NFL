/*
	Desarrolló: Diego Alberto Jardón Ramírez
	Fecha: 31 - Mayo - 2014
	Versión: 1.0
	Appsteroid -- Mundial
	
	Controlador para mostrar la quiniela del usuario en su home y actualizarlas
	
*/

var app = angular.module("app", []);

app.controller("homeUsuarioController", function($scope, $http){

	var app = this;
	var suma = 0;
	$http.get("http://www.appsteroid.com/nfl/rest/consultaQuiniela.php")
	.success(function(data){
		console.log(data);
		app.partidos = data;
		//$scope.nombre = data[0].nombreUsuario;
		//Corregir el 10 por el total de juegos
		//console.log(data[0].nombreUsuario);
		for(i=0;i<data.length;i++){
			suma += data[i].puntosQuiniela; 
		}
		console.log(suma);
		$scope.total = suma;
	})
	.error(function(data){
		console.log(data);
	})
	
	$scope.actualizaQuiniela = function(id, resultado){
		//console.log(id +","+resultado);
		$http.post("http://www.appsteroid.com/nfl/rest/actualizaQuiniela.php", {'idQuiniela': id,'resultadoQuiniela':resultado})
		.success(function(data){
			$scope.usuarioLogin = data;
			console.log(data);
			if(data.response != 0){
				alert("Error al actualizar quiniela!");
			}
		})
		.error(function(data){
			//Enviar a HTML de error genérico
		});
	}
	
	$scope.consultaSemana = function(semana){
		suma = 0;
		$http.post("http://www.appsteroid.com/nfl/rest/consultaQuiniela.php", {'semana':semana})
		.success(function(data){
			console.log(data);
			app.partidos = data;
			$scope.nombre = data[0].nombreUsuario;
			//Corregir el 10 por el total de juegos
			console.log(data[0].nombreUsuario);
			for(i=0;i<data.length;i++){
				suma += data[i].puntosQuiniela; 
			}
			console.log(suma);
			$scope.total = suma;
			})
		.error(function(data){
			//Enviar a HTML de error genérico
		});
	}	
	
	$http.get("http://www.appsteroid.com/nfl/rest/validaSesion.php")
	.success(function(data){
		console.log(data);
		app.sesion = data.sesion;
		app.nombreUsuario = data.nombreUsuario;
		if(app.sesion == 0){
			alert("Para ver tu quiniela necesitas iniciar sesion");
			document.location.href = "login.html";
		}
	})
	.error(function(data){
		console.log(data);
	})
	
	$scope.cierraSesion = function(){
		$http.post("http://www.appsteroid.com/nfl/rest/logoutSchrodinger.php")
		.success(function(data){
			$scope.usuarioLogin = data;
			console.log(data);
			if(data.response != 0){
				alert("Error al actualizar quiniela!");
			}
		})
		.error(function(data){
			//Enviar a HTML de error genérico
		});
	}
	
	$scope.iniciaSesion = function(usuario){
		//enviamos los parámetros por post al servicio REST
		//alert("Usuario: "+usuario.nombre+" , Password: "+usuario.password);
		//Web Service Productivo
		$http.post("http://www.appsteroid.com/nfl/rest/login.php", {'usuarioUsuario': usuario.usuario, 'passwordUsuario': usuario.password})
		//$http.post("http://localhost:8018/mundial/rest/login.php", {'usuarioUsuario': usuario.usuario, 'passwordUsuario': usuario.password})
		.success(function(data){
			$scope.usuarioLogin = data;
			if(data.response == 0){
				//Aquí se puede colocar un loader y un timer que diga "Iniciando Sesión"
				document.location.href = "../view/homeUsuario.html";
			}else{
				//alert("Valor: " + $scope.usuarioLogin.response);
				$scope.mensaje = "Error! Usuario y/o password incorrecto.";
			}
		})
		.error(function(data){
			//Enviar a HTML de error genérico
		});
	}
	
});
