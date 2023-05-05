<?php
	if($_SERVER['REQUEST_METHOD']== 'POST'){
		require_once("db.php");
		$id = $_POST['id'];
		$query = "DELETE FROM usuarios WHERE id='$id'";
		$result = $mysql->query($query);

		if($mysql->affected_rows >0){
			if ($result ===  TRUE) {
				echo "el usuario fue eliminado exitosamente";
			}
		}
		else{
			echo "no se encontró el registro";
		}
		$mysql->close();
	}