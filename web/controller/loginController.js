/*
	Desarroll�: Diego Alberto Jard�n Ram�rez
	Fecha: 31 - Mayo - 2014
	Versi�n: 1.0
	Appsteroid -- Mundial
	
	Controlador para el inicio de sesi�n
	
*/

function loginCtrl($scope, $http, $templateCache){
	//nombre del m�todo
	$scope.iniciaSesion = function(usuario){
		//enviamos los par�metros por post al servicio REST
		//alert("Usuario: "+usuario.nombre+" , Password: "+usuario.password);
		//Web Service Productivo
		$http.post("http://www.appsteroid.com/nfl/rest/login.php", {'usuarioUsuario': usuario.usuario, 'passwordUsuario': usuario.password})
		//$http.post("http://localhost:8018/mundial/rest/login.php", {'usuarioUsuario': usuario.usuario, 'passwordUsuario': usuario.password})
		.success(function(data){
			$scope.usuarioLogin = data;
			if(data.response == 0){
				//Aqu� se puede colocar un loader y un timer que diga "Iniciando Sesi�n"
				document.location.href = "../view/homeUsuario.html";
			}else{
				//alert("Valor: " + $scope.usuarioLogin.response);
				$scope.mensaje = "Error! Usuario y/o password incorrecto.";
			}
		})
		.error(function(data){
			//Enviar a HTML de error gen�rico
		});
	}
}
