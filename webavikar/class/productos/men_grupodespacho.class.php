<?php 

	require_once('class/mensaje.class.php');

	define('API_RUTA_GRUPODESPACHO', '/api/areadespacho/');

	class MenGrupoDespacho extends mensaje
	{
		
		function consultar($xFlag, $id = '') {

			$curl = curl_init();

			if ($xFlag == 1){
				//$url = APP_URL_API_PRO . API_RUTA_GRUPODESPACHO . "listar";
			}elseif ($xFlag == 2){
				$url = APP_URL_API_PRO . API_RUTA_GRUPODESPACHO . "listar/query?area={$id}";
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

		function mantenimientoData($xFlag, $xIdProducto = '', $xIdArea = '', $xIdDespacho = '')
		{	

			if ($xFlag == "1"){
				
				$url = APP_URL_API_PRO . API_RUTA_GRUPODESPACHO . "save";
				$metodo = "POST";

			}elseif ($xFlag == "3"){
				
				$url = APP_URL_API_PRO . API_RUTA_GRUPODESPACHO . "delete/{$xIdDespacho}";
				$metodo = "DELETE";

			}


			$curl = curl_init();

			curl_setopt_array($curl, [
			  CURLOPT_URL => $url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_CUSTOMREQUEST => $metodo,
			  CURLOPT_POSTFIELDS => "{
			  	\n    \"producto\": {
			  		\n\t\t\t\t\"producto\": {$xIdProducto}
			  		\n\t\t},
			  		\n    \"area\": {
			  			\n\t\t\t\"area\": {$xIdArea}
			  			\n\t\t}\n  }",
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
