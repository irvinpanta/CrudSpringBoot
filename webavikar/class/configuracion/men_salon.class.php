<?php 

	require_once('class/mensaje.class.php');
	define('API_RUTA_SALON', '/api/salones/');

	class MenSalon extends mensaje
	{
		
		function consultarSalon($xFlag, $rol = '') {

			$curl = curl_init();

			if ($xFlag == 1){
				$url = APP_URL_API . API_RUTA_SALON . "listar";
			}elseif ($xFlag == 2){
				$url = APP_URL_API . API_RUTA_SALON . "listar/{$rol}";
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

			$xSalon = "";
			$xDescripcion = "";
			$xCapacidad = 0;
			$xActivo = 0;

			if ($xFlag == "1" || $xFlag == "2") {

				$xSalon = $xForm["idSalon"];
				$xDescripcion = $xForm["txt_descripcion_salon"];
				$xCapacidad = $xForm["txt_capacidad_salon"];
				$xActivo = isset($xForm["chk_activo_salon"]) ? 1 : 0;

			}elseif ($xFlag == "3"){
				$xSalon = $xForm;
			}

			if ($xFlag == "1"){
				$url = APP_URL_API . API_RUTA_SALON . "save";
				$metodo = "POST";
			}elseif ($xFlag == "2"){
				$url = APP_URL_API . API_RUTA_SALON . "update/{$xSalon}";
				$metodo = "PUT";
			}elseif ($xFlag == "3"){
				$url = APP_URL_API . API_RUTA_SALON . "delete/{$xSalon}";
				$metodo = "DELETE";
			}


			$curl = curl_init();

			curl_setopt_array($curl, [
			  CURLOPT_URL => $url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_CUSTOMREQUEST => $metodo,
			  CURLOPT_POSTFIELDS => "{
			  	\n\t\"descripcion\": \"{$xDescripcion}\",
			  	\n\t\"capacidad\": {$xCapacidad},
			  	\n\t\"activo\": {$xActivo}
			  	\n\t\n}\n",
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
