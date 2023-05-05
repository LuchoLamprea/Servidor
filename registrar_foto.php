<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		require_once("db.php");
		
		$publicacion = $_POST['publicacion'];
		$foto_codificada= $_POST['foto'];
		$string_foto= base64_decode($foto_codificada);
		$consecutivo;
		
		$query_previo= "SELECT * FROM fotos ORDER BY id DESC LIMIT 1";
		$result_previo= $mysql->query($query_previo);
		if($mysql->affected_rows >0){
		    $row = $result_previo->fetch_assoc();
		    $consecutivo= $row['id']+1;
		}
		else{
		    $consecutivo=1;
		}
		
		$rutaImagen= "fotos/foto_$consecutivo.jpg";
		$rutaCompleta= "https://udvivienda360.000webhostapp.com/$rutaImagen";
		
		
		$query = "INSERT INTO fotos (publicacion, foto) VALUES ('$publicacion', '$rutaCompleta')";
		$result = $mysql->query($query);
		
		if ($result === TRUE) {
		    file_put_contents($rutaImagen, $string_foto);
			echo "OK";
		} else{
		   echo "Error";
		}

		$mysql->close();
		
	}