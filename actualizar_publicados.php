<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		require_once("db.php");

		$correo = $_POST['correo'];
		$publicados = $_POST['publicados'];
		
		$tok= strtok($correo, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$correo=$textoOriginal;
		
		$tok= strtok($publicados, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$publicados=$textoOriginal;
		
		$query = "UPDATE usuarios SET publicados = '$publicados' WHERE correo = '$correo'";
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