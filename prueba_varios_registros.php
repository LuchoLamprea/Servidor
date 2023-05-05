<?php
	if($_SERVER['REQUEST_METHOD']== 'GET'){
		require_once("db.php");
		$contrasena = $_GET['contrasena'];
		$query = "SELECT * FROM usuarios WHERE contrasena='$contrasena'";
		$result = $mysql->query($query);
		$array =[];
		
		if($mysql->affected_rows >0){
		    while ($fila = $result->fetch_assoc()) {
                array_push($array, $fila);
            }
			echo json_encode($array);
		}
		else{
			echo "no se encontró el registro";
		}

		$result->close();
		$mysql->close();
	}