<?php
	if($_SERVER['REQUEST_METHOD']=='GET'){
		require_once("db.php");

		$correo = $_GET['correo'];
		$contrasena = $_GET['contrasena'];
		
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
		

		$query = "SELECT * FROM usuarios WHERE correo = '$correo' AND contrasena='$contrasena'";
		$result = $mysql->query($query);

		if($mysql->affected_rows >0){
			if($result == TRUE){
				echo "registrada";
			}
			else{
				echo "error";
			}
		} else{
			echo "no_registrada";
		}

		$mysql->close();
		
	}