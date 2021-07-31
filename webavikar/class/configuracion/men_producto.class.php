<?php 

	require_once('class/mensaje.class.php');

	class MenProducto extends mensaje
	{
		
		function consultar($xFlag, $id = '') {

			$curl = curl_init();

			if ($xFlag == 1){
				$url = "http://localhost:8080/api/producto/listar";
			}elseif ($xFlag == 2){
				$url = "http://localhost:8080/api/producto/listar/{$id}";
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
			$xStock = 0;
			$xPrecio = 0;
			$xActivo = 0;

			$xTipoPro = 0;
			$xFamPro = 0;

			if ($xFlag == "1" || $xFlag == "2") {

				$xId = $xForm["id"];
				$xDescripcion = $xForm["txt_descripcion"];
				$xStock = $xForm["txt_stock"];
				$xPrecio = $xForm["txt_precio"];
				$xTipoPro = $xForm["lst_tipoproducto"];
				$xFamPro = $xForm["lst_famproducto"];
				$xActivo = isset($xForm["chk_activo"]) ? 1 : 0;

			}elseif ($xFlag == "3"){
				$xId = $xForm;
			}

			if ($xFlag == "1"){
				$url = "http://localhost:8080/api/producto/save";
				$metodo = "POST";
			}elseif ($xFlag == "2"){
				$url = "http://localhost:8080/api/producto/update/{$xId}";
				$metodo = "PUT";
			}elseif ($xFlag == "3"){
				$url = "http://localhost:8080/api/producto/delete/{$xId}";
				$metodo = "DELETE";
			}


			$curl = curl_init();

			curl_setopt_array($curl, [
			  CURLOPT_URL => $url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_CUSTOMREQUEST => $metodo,
			  CURLOPT_POSTFIELDS => "  {
			  	\n    \"descripcion\": \"{$xDescripcion}\",
			  	\n    \"stock\": {$xStock},
			  	\n    \"precio\": {$xPrecio},
			  	\n    \"activo\": {$xActivo},
			  	\n    \"famproducto\": {
			  						\n      \"id\": {$xFamPro}
			  						\n  },
			  	\n    \"tipoProducto\": {
			  						\n      \"tipoProducto\": {$xTipoPro}
			  						\n  }\n  }",
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
