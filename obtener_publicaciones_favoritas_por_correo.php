<?php
	if($_SERVER['REQUEST_METHOD']== 'GET'){
		require_once("db.php");
		$correo = $_GET['correo'];
		$limit = $_GET['limit'];
		$filtro = $_GET['filtro'];

		$tok= strtok($correo, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$correo=$textoOriginal;

		$tok= strtok($filtro, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$filtro=$textoOriginal;

		$query3 = "SELECT favoritos FROM usuarios WHERE correo='$correo'";
		
		$result3 = $mysql->query($query3);
		$listado_ids;

		if ($mysql->affected_rows >0) {
			while ($fila = $result3->fetch_assoc()) {
				$listado_ids = $fila["favoritos"];
            }
		} else{
		   $listado_ids = "";
		}

		$tok= strtok($listado_ids, " ");
		$condicion_query="";
		$contador_ids=0;
		while($tok !== false){
			$contador_ids=$contador_ids+1;
			if($contador_ids==1){
				$condicion_query="fotos.publicacion=".$tok;
			}
			else{
				$condicion_query=$condicion_query." or fotos.publicacion=".$tok;
			}
			$tok = strtok(" ");
		}



		$query2 = "SELECT COUNT(*) FROM ( SELECT publicaciones.barrio, publicaciones.precio, publicaciones.areaconst, publicaciones.habitaciones, publicaciones.banos, fotos.foto, publicaciones.id, publicaciones.oferta, publicaciones.inmueble FROM publicaciones INNER JOIN fotos ON publicaciones.id = fotos.publicacion WHERE (".$condicion_query.") AND ".$filtro." GROUP BY fotos.publicacion ) AS paso";
		
		$result2 = $mysql->query($query2);
		$array2= [];

		if ($mysql->affected_rows >0) {
			while ($fila = $result2->fetch_assoc()) {
                $array2[]= array("barrio" => "final", "conteo" => $fila["COUNT(*)"]);
            }
		} else{
		   $array2[]= array("barrio" => "final", "conteo" => "0");
		}



		$query = "SELECT publicaciones.barrio, publicaciones.precio, publicaciones.areaconst, publicaciones.habitaciones, publicaciones.banos, fotos.foto, publicaciones.id, publicaciones.oferta, publicaciones.inmueble FROM publicaciones INNER JOIN fotos ON publicaciones.id = fotos.publicacion WHERE (".$condicion_query.") AND ".$filtro." GROUP BY fotos.publicacion LIMIT ".$limit.", 10";

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