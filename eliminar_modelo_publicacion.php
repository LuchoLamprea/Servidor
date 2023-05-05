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
		
		$query = "SELECT modelo FROM modelos WHERE publicacion='$publicacion'";
		$result = $mysql->query($query);

		$array =[];
		
		if($mysql->affected_rows >0){
		    while ($fila = $result->fetch_assoc()) {
                array_push($array, substr($fila["modelo"], 40));
            }
            foreach($array as $modelo){
                unlink($modelo);
            }
            
		}
		else{
			echo "no se encontró el registro";
		}

		$query2 = "DELETE FROM modelos WHERE publicacion='$publicacion'";
		
		$result2 = $mysql->query($query2);

		if ($result2 === TRUE) {
			echo "OK";
		} else{
		   echo "Error";
		}

		$mysql->close();
		
	}