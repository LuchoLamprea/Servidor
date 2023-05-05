<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		require_once("db.php");
		
		$publicacion = $_POST['publicacion'];
		
		$tok= strtok($publicacion, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$publicacion=$textoOriginal;
		
		$query = "SELECT foto FROM fotos WHERE publicacion='$publicacion'";
		$result = $mysql->query($query);

		$array =[];
		
		if($mysql->affected_rows >0){
		    while ($fila = $result->fetch_assoc()) {
                array_push($array, substr($fila["foto"], 40));
            }
            foreach($array as $foto){
                unlink($foto);
            }
		}
		else{
			echo "no se encontró el registro";
		}

		$query2 = "DELETE FROM publicaciones WHERE id='$publicacion'";
		
		$result2 = $mysql->query($query2);

		if ($result2 === TRUE) {
			echo "OK";
		} else{
		   echo "Error";
		}

		$mysql->close();
		
	}