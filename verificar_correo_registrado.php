<?php
	if($_SERVER['REQUEST_METHOD']== 'GET'){
		require_once("db.php");

		$correo = $_GET['correo'];
		
		$tok= strtok($correo, "-*-");
		$textoOriginal='';

	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		
		$correo=$textoOriginal;

		$query = "SELECT * FROM usuarios WHERE correo='$correo'";
		$result = $mysql->query($query);

		if($mysql->affected_rows >0){
			echo "registrado";
		}
		else{
			echo "no_registrado";
		}

		$result->close();
		$mysql->close();
	}