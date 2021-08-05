<?php 

	require_once('class/mensaje.class.php');
	define('API_RUTA_TIPOPRODUCTO', '/api/tipoproducto/');

	class MenTipoProducto extends mensaje
	{
		
		function consultar($xFlag, $id = '') {

			$curl = curl_init();

			if ($xFlag == 1){
				$url = APP_URL_API_PRO . API_RUTA_TIPOPRODUCTO . "listar";
			}elseif ($xFlag == 2){
				$url = APP_URL_API_PRO . API_RUTA_TIPOPRODUCTO . "listar/{$id}";
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
			$xActivo = 0;

			if ($xFlag == "1" || $xFlag == "2") {

				$xId = $xForm["id"];
				$xDescripcion = $xForm["txt_descripcion"];
				$xActivo = isset($xForm["chk_activo"]) ? 1 : 0;

			}elseif ($xFlag == "3"){
				$xId = $xForm;
			}

			if ($xFlag == "1"){
				$url = APP_URL_API_PRO . API_RUTA_TIPOPRODUCTO . "save";
				$metodo = "POST";
			}elseif ($xFlag == "2"){
				$url = APP_URL_API_PRO . API_RUTA_TIPOPRODUCTO . "update/{$xId}";
				$metodo = "PUT";
			}elseif ($xFlag == "3"){
				$url = APP_URL_API_PRO . API_RUTA_TIPOPRODUCTO . "delete/{$xId}";
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
