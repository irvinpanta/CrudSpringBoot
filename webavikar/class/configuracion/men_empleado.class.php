<?php 

	require_once('class/mensaje.class.php');

	define('API_RUTA_EMPLEADO', '/api/empleado/');

	class MenEmpleado extends mensaje
	{
		
		function consultar($xFlag, $id = '') {

			$curl = curl_init();

			if ($xFlag == 1){
				$url = APP_URL_API . API_RUTA_EMPLEADO . "listar";
			}elseif ($xFlag == 2){
				$url = APP_URL_API. API_RUTA_EMPLEADO . "listar/{$id}";
			}

			curl_setopt_array($curl, [
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_CUSTOMREQUEST => "GET",
			]);
			
			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
				$this->setMsgErr("Error no se pudo establecer comunicacion #: " . $err);
				return "1";
			}else{
				return $response;	
			}

		}

		function mantenimientoData($xFlag, $xForm)
		{	

			$xId = "";
			$xNumeroDocumento = "";
			$xNombres = "";
			$xApellidos = "";
			$xDireccion = "";
			$xTelefono = "";
			$xActivo = 0;
			$xRol = 0;

			if ($xFlag == "1" || $xFlag == "2") {

				$xId = $xForm["id"];
				$xNumeroDocumento = $xForm["txt_dni"];
				$xNombres = $xForm["txt_nombres"];
				$xApellidos = $xForm["txt_apellidos"];
				$xDireccion = $xForm["txt_direccion"];
				$xTelefono = $xForm["txt_telefono"];
				$xRol = $xForm["lst_rol"];
				$xActivo = isset($xForm["chk_activo"]) ? 1 : 0;

			}elseif ($xFlag == "3"){
				$xId = $xForm;
			}

			if ($xFlag == "1"){
				$url = APP_URL_API . API_RUTA_EMPLEADO . "save";
				$metodo = "POST";
			}elseif ($xFlag == "2"){
				$url = APP_URL_API . API_RUTA_EMPLEADO . "update/{$xId}";
				$metodo = "PUT";
			}elseif ($xFlag == "3"){
				$url = APP_URL_API . API_RUTA_EMPLEADO . "delete/{$xId}";
				$metodo = "DELETE";
			}


			$curl = curl_init();

			curl_setopt_array($curl, [
			  CURLOPT_URL => $url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_CUSTOMREQUEST => $metodo,
			 CURLOPT_POSTFIELDS => "  {
			 	\n    \"numerodocumento\": \"{$xNumeroDocumento}\",
			 	\n    \"nombres\": \"{$xNombres}\",
			 	\n    \"apellidos\": \"{$xApellidos}\",
			 	\n    \"direccion\": \"{$xDireccion}\",
			 	\n    \"telefono\": \"{$xTelefono}\",
			 	\n    \"activo\": {$xActivo},
			 	\n    \"rol\": {
			 					\n      \"rol\": {$xRol}
			 					\n    }\n  }",
			  CURLOPT_HTTPHEADER => [
			    "Content-Type: application/json"
			  ],
			]);

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  	$this->setMsgErr("Error no se pudo establecer comunicacion #: " . $err);
				return "0";
			} else {
			  	return $response;
			}


		}
			
	}





 ?>
