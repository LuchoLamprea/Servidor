<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		require_once("db.php");
		
		$propietario = $_POST['propietario'];
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
		
		$tok= strtok($propietario, "-*-");
		$textoOriginal='';
	    while($tok !== false){
			$textoOriginal=$textoOriginal.mb_chr(intval($tok));
			$tok = strtok("-*-");
		}
		$propietario=$textoOriginal;
		
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
		
		$query = "INSERT INTO publicaciones (propietario, oferta, inmueble, precio, areaconst, habitaciones, banos, garajes, estrato, antiguedad, descripcion, direccion, barrio, localidad) VALUES ('$propietario', '$oferta', '$inmueble', '$precio', '$areaconst', '$habitaciones','$banos', '$garajes', '$estrato', '$antiguedad', '$descripcion', '$direccion', '$barrio', '$localidad')";
		$result = $mysql->query($query);
		

		if ($result === TRUE) {
			$query2 ="SELECT LAST_INSERT_ID() AS 'id' ";
			$result2 = $mysql->query($query2);
			$row = $result2->fetch_assoc();
			echo $row['id'];
		} else{
		   echo "Error";
		}

		$mysql->close();
		
	}