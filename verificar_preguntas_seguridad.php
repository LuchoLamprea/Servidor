<?php
	if($_SERVER['REQUEST_METHOD']== 'GET'){
		require_once("db.php");

		$correo = $_GET['correo'];
		$respuesta_1 = $_GET['respuesta_1'];
		$respuesta_2 = $_GET['respuesta_2'];
		
		$tok= strtok($correo, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$correo=$textoOriginal;
		
		$tok= strtok($respuesta_1, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$respuesta_1=$textoOriginal;
		
		$tok= strtok($respuesta_2, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$respuesta_2=$textoOriginal;

		$query = "SELECT * FROM usuarios WHERE correo='$correo' AND respuesta_1='$respuesta_1' AND respuesta_2='$respuesta_2'";
		$result = $mysql->query($query);

		if($mysql->affected_rows >0){
			echo "aprobado";
		}
		else{
			echo "no_aprobado";
		}

		$result->close();
		$mysql->close();
	}