<?php
	if($_SERVER['REQUEST_METHOD']=='GET'){
		require_once("db.php");

		$texto = $_GET['texto'];
		$tok= strtok($texto, "-*-");
		$textoOriginal='';

	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		echo $textoOriginal;

		$mysql->close();
		
	}