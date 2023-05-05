<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		require_once("db.php");

		$correo = $_POST['correo'];
		$nombre = $_POST['nombre'];
		$whatsapp = $_POST['whatsapp'];
		$numero_contacto = $_POST['numero_contacto'];
		$pregunta_1 = $_POST['pregunta_1'];
		$respuesta_1 = $_POST['respuesta_1'];
		$pregunta_2 = $_POST['pregunta_2'];
		$respuesta_2 = $_POST['respuesta_2'];
		
		$tok= strtok($correo, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$correo=$textoOriginal;
		
		$tok= strtok($nombre, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$nombre=$textoOriginal;
		
		$tok= strtok($whatsapp, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$whatsapp=$textoOriginal;
		
		$tok= strtok($numero_contacto, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$numero_contacto=$textoOriginal;
		
		$tok= strtok($pregunta_1, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$pregunta_1=$textoOriginal;
		
		$tok= strtok($respuesta_1, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$respuesta_1=$textoOriginal;
		
		$tok= strtok($pregunta_2, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$pregunta_2=$textoOriginal;
		
		$tok= strtok($respuesta_2, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$respuesta_2=$textoOriginal;

		$query = "UPDATE usuarios SET nombre = '$nombre', whatsapp = '$whatsapp', numero_contacto = '$numero_contacto', pregunta_1 = '$pregunta_1', respuesta_1 = '$respuesta_1', pregunta_2 = '$pregunta_2', respuesta_2 = '$respuesta_2' WHERE correo = '$correo'";
		
		$result = $mysql->query($query);

		if($mysql->affected_rows >0){
			if($result == TRUE){
				echo "OK";
			}
			else{
				echo "error";
			}
		} else{
			echo "registro_no_encontrado".$nombre;
		}

		$mysql->close();
		
	}