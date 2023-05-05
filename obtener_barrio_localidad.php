<?php
	if($_SERVER['REQUEST_METHOD']== 'GET'){
		require_once("db.php");
		$ubicacion = $_GET['ubicacion'];
		
		
		$tok= strtok($ubicacion, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$ubicacion=$textoOriginal;
		
		$query = "SELECT nombre, localidad FROM zonas WHERE ST_Contains(geom, ST_GeomFromText('POINT($ubicacion)'))=1 and nombre!=localidad";
		$result = $mysql->query($query);

		if($mysql->affected_rows >0){
			while ($row = $result->fetch_assoc()) {
				$array=$row;
			}
			echo json_encode($array);
		}
		else{
			echo "no se encontró el registro";
		}
		$mysql->close();
	}