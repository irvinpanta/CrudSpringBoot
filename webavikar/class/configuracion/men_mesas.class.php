<?php 

	require_once('class/mensaje.class.php');

	define('API_RUTA_MESAS', '/api/mesas/');

	class MenMesas extends mensaje
	{
		
		function consultar($xFlag, $id = '') {

			$curl = curl_init();

			if ($xFlag == 1){
				$url = APP_URL_API . API_RUTA_MESAS . "listar";
			}elseif ($xFlag == 2){
				$url = APP_URL_API. API_RUTA_MESAS . "listar/{$id}";
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
			$xDescripcion = "";
			$xCantidad = 0;
			$xMesaRapida = 0;
			$xActivo = 0;

			$xSalon = 0;

			if ($xFlag == "1" || $xFlag == "2") {

				$xId = $xForm["id"];
				$xDescripcion = $xForm["txt_descripcion"];
				$xCantidad = $xForm["txt_cantidad"];
				$xMesaRapida = isset($xForm["chk_mesarapida"]) ? 1: 0;
				$xSalon = $xForm["lst_salon"];
				$xActivo = isset($xForm["chk_activo"]) ? 1 : 0;

			}elseif ($xFlag == "3"){
				$xId = $xForm;
			}

			if ($xFlag == "1"){
				$url = APP_URL_API . API_RUTA_MESAS . "save";
				$metodo = "POST";
			}elseif ($xFlag == "2"){
				$url = APP_URL_API . API_RUTA_MESAS . "update/{$xId}";
				$metodo = "PUT";
			}elseif ($xFlag == "3"){
				$url = APP_URL_API . API_RUTA_MESAS . "delete/{$xId}";
				$metodo = "DELETE";
			}


			$curl = curl_init();

			curl_setopt_array($curl, [
			  CURLOPT_URL => $url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_CUSTOMREQUEST => $metodo,
			 CURLOPT_POSTFIELDS => "  {
			 	\n    \"descripcion\": \"{$xDescripcion}\",
			 	\n    \"cantidad\": {$xCantidad},
			 	\n    \"mesarapida\": {$xMesaRapida},
			 	\n    \"activo\": {$xActivo},
			 	\n    \"salon\": {
			 					\n      \"salon\": {$xSalon}
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
