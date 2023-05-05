<?php
	if($_SERVER['REQUEST_METHOD']== 'GET'){
		$numero = $_GET['numero'];
		
		echo mb_chr(intval($numero));
	}