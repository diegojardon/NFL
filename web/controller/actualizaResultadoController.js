/*
	Desarroll�: Diego Alberto Jard�n Ram�rez
	Fecha: 31 - Mayo - 2014
	Versi�n: 1.0
	Appsteroid -- Mundial
	
	Controlador para actualizar los resultados
	
*/

function actualizaResultadoCtrl($scope, $http, $templateCache){

	//nombre del m�todo
	$scope.actualizaResultado = function(partido){
		//enviamos los par�metros por post al servicio REST
		$http.post("http://www.appsteroid.com/nfl/rest/altaResultado.php", 
		//$http.post("http://localhost:8018/mundial/rest/altaResultado.php", 
			{'idPartido': partido.idPartido, 'marcadorPartido': partido.marcadorPartido, 'resultadoPartido': partido.resultadoPartido})
			.success(function(data){
				if(data.response == 0){
					//Aqu� se puede colocar un loader y un timer que diga "Iniciando Sesi�n"
					alert("Actualizacion de resultado exitosa!");
				}else{
					alert("Actualizacion de resultado erronea!");
					//$scope.mensaje = "Error! Usuario y/o password incorrecto.";
				}
			})
			.error(function(data){
				//Enviar a HTML de error gen�rico
			});
		}
	}
}
