<?php 

	require_once('class/mensaje.class.php');

	class MenRol extends mensaje
	{
		
		function consultarRol($xFlag, $rol = '') {

			$curl = curl_init();

			if ($xFlag == 1){
				$url = "http://localhost:8080/api/roles/listar";
			}elseif ($xFlag == 2){
				$url = "http://localhost:8080/api/roles/listar/{$rol}";
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

			$xRol = "";
			$xDescripcion = "";
			$xActivo = 0;

			if ($xFlag == "1" || $xFlag == "2") {

				$xRol = $xForm["idRol"];
				$xDescripcion = $xForm["txt_descripcion_rol"];
				$xActivo = isset($xForm["chk_activo_rol"]) ? 1 : 0;

			}elseif ($xFlag == "3"){
				$xRol = $xForm;
			}

			if ($xFlag == "1"){
				$url = "http://localhost:8080/api/roles/save";
				$metodo = "POST";
			}elseif ($xFlag == "2"){
				$url = "http://localhost:8080/api/roles/update/{$xRol}";
				$metodo = "PUT";
			}elseif ($xFlag == "3"){
				$url = "http://localhost:8080/api/roles/delete/{$xRol}";
				$metodo = "DELETE";
			}


			$curl = curl_init();

			curl_setopt_array($curl, [
			  CURLOPT_URL => $url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_CUSTOMREQUEST => $metodo,
			  CURLOPT_POSTFIELDS => "{
			  	\n\t\"descripcion\": \"{$xDescripcion}\",
			  	\n\t\"orden\": 2,
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
