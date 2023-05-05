<?php
	if($_SERVER['REQUEST_METHOD']== 'GET'){
		require_once("db.php");
		$id = $_GET['id'];

		$tok= strtok($id, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$id=$textoOriginal;

		$query = "SELECT foto FROM fotos WHERE publicacion = '$id'";
		$result = $mysql->query($query);


		$array =[];
		
		if($mysql->affected_rows >0){
		    while ($fila = $result->fetch_assoc()) {
                array_push($array, $fila);
            }
			echo json_encode($array);
		}
		else{
			echo "ERROR";
		}

		$result->close();
		$mysql->close();
	}