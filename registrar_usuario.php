<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		require_once("db.php");

		$correo = $_POST['correo'];
		$contrasena = $_POST['contrasena'];
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
		
		$tok= strtok($contrasena, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$contrasena=$textoOriginal;
		
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
		

		$query = "INSERT INTO usuarios (correo, contrasena, nombre, whatsapp, numero_contacto, pregunta_1, respuesta_1, pregunta_2, respuesta_2) VALUES ('$correo', '$contrasena', '$nombre', '$whatsapp', '$numero_contacto', '$pregunta_1','$respuesta_1', '$pregunta_2', '$respuesta_2')";
		$result = $mysql->query($query);

		if ($result === TRUE) {
			echo "OK";
		} else{
		   echo "Error";
		}

		$mysql->close();
		
	}