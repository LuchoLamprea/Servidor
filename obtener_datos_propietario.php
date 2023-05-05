<?php
	if($_SERVER['REQUEST_METHOD']== 'GET'){
		require_once("db.php");
		$id = $_GET['id'];
		
		$tok= strtok($id, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$id=$textoOriginal;
		
		
		$query = "SELECT usuarios.correo, usuarios.whatsapp, usuarios.numero_contacto FROM publicaciones INNER JOIN usuarios ON usuarios.correo = publicaciones.propietario WHERE publicaciones.id='$id'";
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

		$result->close();
		$mysql->close();
	}