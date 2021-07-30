<?php 

	require_once('class/mensaje.class.php');

	class MenTipoP extends mensaje
	{
		
		function consultar($xFlag, $id = '') {

			$curl = curl_init();

			if ($xFlag == 1){
				$url = "http://localhost:8080/api/tipopago/listar";
			}elseif ($xFlag == 2){
				$url = "http://localhost:8080/api/tipopago/listar/{$id}";
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

			$xTipoP = "";
			$xDescripcion = "";
			$xActivo = 0;
			$xRequiereEfec = 0;
			$xRequiereNumOpera = 0;

			if ($xFlag == "1" || $xFlag == "2") {

				$xTipoP = $xForm["id"];
				$xDescripcion = $xForm["txt_descripcion"];
				$xActivo = isset($xForm["chk_activo"]) ? 1 : 0;
				$xRequiereEfec = $xForm["valEfectivo"];
				$xRequiereNumOpera = $xForm["valNumOpera"];

			}elseif ($xFlag == "3"){
				$xTipoP = $xForm;
			}

			if ($xFlag == "1"){
				$url = "http://localhost:8080/api/tipopago/save";
				$metodo = "POST";
			}elseif ($xFlag == "2"){
				$url = "http://localhost:8080/api/tipopago/update/{$xTipoP}";
				$metodo = "PUT";
			}elseif ($xFlag == "3"){
				$url = "http://localhost:8080/api/tipopago/delete/{$xTipoP}";
				$metodo = "DELETE";
			}


			$curl = curl_init();

			curl_setopt_array($curl, [
			  CURLOPT_URL => $url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_CUSTOMREQUEST => $metodo,
			  CURLOPT_POSTFIELDS => "{
			  	\n\t\"descripcion\": \"{$xDescripcion}\",
			  	\n\t\"activo\": {$xActivo},
			  	\n\t\"requiereEfectivo\": {$xRequiereEfec},
			  	\n\t\"requiereNumOperacion\": {$xRequiereNumOpera}
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
