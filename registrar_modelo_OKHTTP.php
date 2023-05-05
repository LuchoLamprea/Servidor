<?php
	require_once("db.php");
	$consecutivo;
	

	$publicacion = $_POST['publicacion'];
	//$modelo_codificado= $_POST['modelo'];
	//$modelo_decodificado= base64_decode($modelo_codificado);


	//echo $publicacion.'\n';

	$query_previo= "SELECT * FROM modelos ORDER BY id DESC LIMIT 1";
	$result_previo= $mysql->query($query_previo);
	if($mysql->affected_rows >0){
	    $row = $result_previo->fetch_assoc();
	    $consecutivo= $row['id']+1;
	}
	else{
	    $consecutivo=1;
	}
	
	$rutaModelo= "modelos/modelo_$consecutivo.glb";
	$rutaCompleta= "https://udvivienda360.000webhostapp.com/$rutaModelo";
	
	$query = "INSERT INTO modelos (publicacion, modelo) VALUES ('$publicacion', '$rutaCompleta')";
	$result = $mysql->query($query);
	
	
	if ($result === TRUE) {
		//file_put_contents($rutaModelo, $modelo_decodificado);
		if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $rutaModelo)){
			echo "OK";
		}
	} else{
	   echo "Error";
	}

	$mysql->close();

?>