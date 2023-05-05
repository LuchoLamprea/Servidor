<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		require_once("db.php");

		$correo = $_POST['correo'];
		$favorito = $_POST['favorito'];
		
		$tok= strtok($correo, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$correo=$textoOriginal;
		
		$tok= strtok($favorito, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$favorito=$textoOriginal;

		$query2 = "SELECT favoritos FROM usuarios WHERE correo = '$correo'";
		$result2 = $mysql->query($query2);
		$favorito_nuevo="";

		if($mysql->affected_rows >0){
		    while ($fila = $result2->fetch_assoc()) {
		    	if($fila["favoritos"]=="NULL"){
		    		$favorito_nuevo=$favorito;
		    	}
		    	else{
		    		$favorito_nuevo=$fila["favoritos"]." ".$favorito;
		    	}
                
            }
		}
		else{
			echo "no se encontró el registro";
		}

		
		$query = "UPDATE usuarios SET favoritos = '$favorito_nuevo' WHERE correo = '$correo'";
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