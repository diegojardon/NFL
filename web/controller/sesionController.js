/*
	Desarrolló: Diego Alberto Jardón Ramírez
	Fecha: 31 - Mayo - 2014
	Versión: 1.0
	Appsteroid -- Mundial
	
	Controlador para mostrar la quiniela del usuario en su home y actualizarlas
	
*/

var app = angular.module("app", []);

app.controller("sesionController", function($scope, $http){

	var app = this;
	var suma = 0;
	$http.get("http://www.appsteroid.com/nfl/rest/validaSesion.php")
	.success(function(data){
		console.log(data);
		app.sesion = data.sesion;
		app.nombreUsuario = data.nombreUsuario;
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
