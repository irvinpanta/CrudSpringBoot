<?php 

	require_once('class/mensaje.class.php');
	define('API_RUTA_TIPOOPERA', '/api/tipooperacion/');

	class MenTipoO extends mensaje
	{
		
		function consultar($xFlag, $id = '') {

			$curl = curl_init();

			if ($xFlag == 1){
				$url = APP_URL_API . API_RUTA_TIPOOPERA . "listar";
			}elseif ($xFlag == 2){
				$url = APP_URL_API . API_RUTA_TIPOOPERA . "listar/{$id}";
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

			$xTipoO = "";
			$xDescripcion = "";
			$xActivo = 0;

			if ($xFlag == "1" || $xFlag == "2") {

				$xTipoO = $xForm["id"];
				$xDescripcion = $xForm["txt_descripcion"];
				$xActivo = isset($xForm["chk_activo"]) ? 1 : 0;

			}elseif ($xFlag == "3"){
				$xTipoO = $xForm;
			}

			if ($xFlag == "1"){
				$url = APP_URL_API . API_RUTA_TIPOOPERA . "save";
				$metodo = "POST";
			}elseif ($xFlag == "2"){
				$url = APP_URL_API . API_RUTA_TIPOOPERA . "update/{$xTipoO}";
				$metodo = "PUT";
			}elseif ($xFlag == "3"){
				$url = APP_URL_API . API_RUTA_TIPOOPERA . "delete/{$xTipoO}";
				$metodo = "DELETE";
			}


			$curl = curl_init();

			curl_setopt_array($curl, [
			  CURLOPT_URL => $url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_CUSTOMREQUEST => $metodo,
			  CURLOPT_POSTFIELDS => "{
			  	\n\t\"descripcion\": \"{$xDescripcion}\",
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
