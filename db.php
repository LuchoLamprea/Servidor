<?php
	$mysql = new mysqli(
		"localhost",
		"id19456106_android",
		"3wZ*]JW{r]vddhez",
		"id19456106_vivienda360"
	);

	if($mysql->connect_error){
		die("Fallo en la conexion" . $mysql->connect_error);
	}