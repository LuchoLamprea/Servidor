<?php
	if($_SERVER['REQUEST_METHOD']== 'GET'){
		require_once("db.php");
		$zona = $_GET['zona'];
		$oferta = $_GET['oferta'];
		$limit = $_GET['limit'];
		$filtro = $_GET['filtro'];

		$tok= strtok($zona, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$zona=$textoOriginal;

		$condicion_query="";
		if(strpos($zona, "- LOCALIDAD") !== false){
			$condicion_query= "publicaciones.localidad = '".$zona."'";
		}
		else{
			$condicion_query= "publicaciones.barrio = '".$zona."'";
		}

		$tok= strtok($filtro, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$filtro=$textoOriginal;

		$tok= strtok($oferta, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$oferta=$textoOriginal;

		$condicion_query2= "( publicaciones.oferta = '".$oferta."' )";
		

		$query2 = "SELECT COUNT(*) FROM ( SELECT publicaciones.barrio, publicaciones.precio, publicaciones.areaconst, publicaciones.habitaciones, publicaciones.banos, fotos.foto, publicaciones.id, publicaciones.oferta, publicaciones.inmueble FROM publicaciones INNER JOIN fotos ON publicaciones.id = fotos.publicacion WHERE (".$condicion_query.") AND ".$filtro." AND ".$condicion_query2." GROUP BY fotos.publicacion ) AS paso";
		
		$result2 = $mysql->query($query2);
		$array2= [];

		if ($mysql->affected_rows >0) {
			while ($fila = $result2->fetch_assoc()) {
                $array2[]= array("barrio" => "final", "conteo" => $fila["COUNT(*)"]);
            }
		} else{
		   $array2[]= array("barrio" => "final", "conteo" => "0");
		}

		$query = "SELECT publicaciones.barrio, publicaciones.precio, publicaciones.areaconst, publicaciones.habitaciones, publicaciones.banos, fotos.foto, publicaciones.id, publicaciones.oferta, publicaciones.inmueble FROM publicaciones INNER JOIN fotos ON publicaciones.id = fotos.publicacion WHERE (".$condicion_query.") AND ".$filtro." AND ".$condicion_query2." GROUP BY fotos.publicacion LIMIT ".$limit.", 10";

		$result = $mysql->query($query);


		$array =[];
		
		if($mysql->affected_rows >0){
		    while ($fila = $result->fetch_assoc()) {
                array_push($array, $fila);
            }
            array_push($array, $array2[0]);
			echo json_encode($array);
		}
		else{
		    array_push($array, $array2[0]);
			echo json_encode($array);
		}

		//$result->close();
		$mysql->close();
	}