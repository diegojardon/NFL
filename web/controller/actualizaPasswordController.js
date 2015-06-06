/*
	Desarroll�: Diego Alberto Jard�n Ram�rez
	Fecha: 31 - Mayo - 2014
	Versi�n: 1.0
	Appsteroid -- Mundial
	
	Controlador para el inicio de sesi�n
	
*/

function actualizaPasswordCtrl($scope, $http, $templateCache){

	/*var cadGET = location.search.substr(1,location.search.length); 
	var arrGET = cadGET.split("&"); 
	var vars = new Array(); 
	var variable = ""; 
	var valor = ""; 
	for(i=0;i<arrGET.length;i++){ 
		var aux = arrGET[i].split("="); 
		variable = aux[0]; 
		valor = aux[1]; 
		vars[variable] = valor; 
	} 

	$scope.idUsuario = vars['id'];*/
	
	/*$http.get("http://www.appsteroid.com/mundial/rest/obtieneDatosSesion.php")
	//$http.get("http://localhost:8018/mundial/rest/obtieneDatosSesion.php")
	.success(function(data){
		console.log(data);
		$scope.idUsuario = data.idUsuario;
	})
	.error(function(data){
		console.log(data);
	})*/
	
	//nombre del m�todo
	$scope.cambiaPassword = function(usuario){
		//enviamos los par�metros por post al servicio REST
		//alert("Usuario: "+usuario.nombre+" , Password: "+usuario.password);
		//Web Service Productivo
		//$http.post("http://www.appsteroid.com/mundial/rest/actualizaPassword.php", {'idUsuario': vars['id'], 'passwordUsuario': usuario.password})
		
		if(usuario.password != usuario.confirmacion){
			alert("Los password no coinciden");
		}else{
			$http.post("http://www.appsteroid.com/nfl/rest/actualizaPassword.php", {'passwordUsuario': usuario.password})
			//$http.post("http://localhost:8018/mundial/rest/actualizaPassword.php", {'passwordUsuario': usuario.password})
			.success(function(data){
				$scope.usuarioLogin = data;
				if(data.response == 0){
					//Aqu� se puede colocar un loader y un timer que diga "Iniciando Sesi�n"
					alert("Actualizacion de password exitosa!");
					document.location.href = "../view/homeUsuario.html";
				}else{
					alert("Actualizacion de password erronea!");
					//$scope.mensaje = "Error! Usuario y/o password incorrecto.";
				}
			})
			.error(function(data){
				//Enviar a HTML de error gen�rico
			});
		}
	}
}
