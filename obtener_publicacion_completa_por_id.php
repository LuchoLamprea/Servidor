<?php
	if($_SERVER['REQUEST_METHOD']== 'GET'){
		require_once("db.php");
		$id = $_GET['id'];
		$correo = $_GET['correo'];

		$tok= strtok($id, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$id=$textoOriginal;

		$tok= strtok($id, " ");
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

		$tok= strtok($correo, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$correo=$textoOriginal;

		if(strlen($correo)!=0){
			$query = "SELECT publicaciones.*, fotos.foto, modelos.modelo, if(LOCATE(publicaciones.id, usuarios.favoritos)>0, 'SI', 'NO') AS favorito FROM publicaciones INNER JOIN fotos ON publicaciones.id = fotos.publicacion LEFT JOIN modelos ON publicaciones.id = modelos.publicacion LEFT JOIN usuarios on LOCATE(publicaciones.id, usuarios.favoritos)>=0 OR LOCATE(publicaciones.id, usuarios.favoritos) IS NULL WHERE ".$condicion_query." AND usuarios.correo = '$correo' GROUP BY fotos.publicacion LIMIT 1";
		}
		else{
			$query = "SELECT publicaciones.*, fotos.foto, modelos.modelo, 'NO' AS favorito FROM publicaciones INNER JOIN fotos ON publicaciones.id = fotos.publicacion LEFT JOIN modelos ON publicaciones.id = modelos.publicacion WHERE ".$condicion_query." GROUP BY fotos.publicacion LIMIT 1";
		}

		$result = $mysql->query($query);
		$array =[];
		
		if($mysql->affected_rows >0){
		    while ($fila = $result->fetch_assoc()) {
                array_push($array, $fila);
            }
			echo json_encode($array);
		}
		else{
			echo "no se encontró el registro";
		}

		$result->close();
		$mysql->close();
	}