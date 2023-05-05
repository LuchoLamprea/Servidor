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

		$query = "SELECT pregunta_1, pregunta_2 FROM usuarios WHERE correo='$correo'";
		$result = $mysql->query($query);

		if($mysql->affected_rows >0){
			while ($row = $result->fetch_assoc()) {
				$array=$row;
			}
			echo json_encode($array);
		}
		else{
			echo "error";
		}

		$result->close();
		$mysql->close();
	}