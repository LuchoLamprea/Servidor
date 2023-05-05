<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		require_once("db.php");

		$correo = $_POST['correo'];
		$contrasena = $_POST['contrasena'];
		
		$tok= strtok($correo, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$correo=$textoOriginal;
		
		$tok= strtok($contrasena, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$contrasena=$textoOriginal;
		

		$query = "UPDATE usuarios SET  contrasena = '$contrasena' WHERE correo = '$correo'";
		$result = $mysql->query($query);

		if($mysql->affected_rows >0){
			if($result === TRUE){
				echo "OK";
			}
			else{
				echo "error";
			}
		} else{
			echo "registro_no_encontrado";
		}

		$mysql->close();
		
	}