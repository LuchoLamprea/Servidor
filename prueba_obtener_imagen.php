<?php
	if($_SERVER['REQUEST_METHOD']== 'GET'){
		require_once("db.php");

		$id = $_GET['id'];
		
		/*
		$tok= strtok($correo, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$correo=$textoOriginal;
		*/

		$query = "SELECT * FROM fotos WHERE id='$id'";
		$result = $mysql->query($query);

		//var_dump($result);
		
		if($mysql->affected_rows >0){
			while ($row = $result->fetch_assoc()) {
				$array=$row['foto'];
			}
			echo $array;
			$foto= imagecreatefromgd($array);
			$string_codificado=base64_encode($foto);
			echo $string_codificado;
		}
		else{
			echo "error";
		}
		

		$result->close();
		$mysql->close();
	}