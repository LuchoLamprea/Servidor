<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		require_once("db.php");
		
		$id = $_POST['id'];
		$oferta = $_POST['oferta'];
		$inmueble = $_POST['inmueble'];
		$precio = $_POST['precio'];
		$areaconst = $_POST['areaconst'];
		$habitaciones = $_POST['habitaciones'];
		$banos = $_POST['banos'];
		$garajes = $_POST['garajes'];
		$estrato = $_POST['estrato'];
		$antiguedad = $_POST['antiguedad'];
		$descripcion = $_POST['descripcion'];
		$direccion = $_POST['direccion'];
		$barrio = $_POST['barrio'];
		$localidad = $_POST['localidad'];
		
		$tok= strtok($id, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$id=$textoOriginal;
		
		$tok= strtok($oferta, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$oferta=$textoOriginal;
		
		$tok= strtok($inmueble, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$inmueble=$textoOriginal;
		
		$tok= strtok($precio, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$precio=$textoOriginal;
		
		$tok= strtok($areaconst, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$areaconst=$textoOriginal;
		
		$tok= strtok($habitaciones, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$habitaciones=$textoOriginal;
		
		$tok= strtok($banos, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$banos=$textoOriginal;
		
		$tok= strtok($garajes, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$garajes=$textoOriginal;
		
		$tok= strtok($estrato, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$estrato=$textoOriginal;
		
		$tok= strtok($antiguedad, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$antiguedad=$textoOriginal;
		
		$tok= strtok($descripcion, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$descripcion=$textoOriginal;
		
		$tok= strtok($direccion, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$direccion=$textoOriginal;
		
		$tok= strtok($barrio, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$barrio=$textoOriginal;
		
		$tok= strtok($localidad, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$localidad=$textoOriginal;
		
		$query = "UPDATE publicaciones SET oferta = '$oferta', inmueble = '$inmueble', precio = '$precio', areaconst = '$areaconst', habitaciones = '$habitaciones', banos = '$banos', garajes = '$garajes', estrato = '$estrato', antiguedad = '$antiguedad', descripcion = '$descripcion', direccion = '$direccion', barrio = '$barrio', localidad = '$localidad' WHERE id = '$id'";
		
		$result = $mysql->query($query);

		if ($result === TRUE) {
			echo "OK";
		} else{
		   echo "Error";
		}

		$mysql->close();
		
	}