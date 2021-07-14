<?php

	$id = $_POST["id"];
	$max = $_POST["max"];
	$costo = $_POST["costo"];
	$mods = $_POST["mods"];
	$datos = $_POST["datos"];
	$agregar = $_POST["agregar"];

	$sql = "INSERT INTO specs VALUES ";
	
	$valores = "";

	for($i = 0; $i < count($agregar) - 1; $i++)
	{
		$j = $agregar[$i];

		$d = $datos[$j];
		$mx = $max[$j];
		$cs = $costo[$j];
		$md = $mods[$j];

		$valores = $valores . "(0,$id,$d,$mx,$cs,$md),";
	}

	$i = count($agregar) - 1; 
	$i = $agregar[$i];

	$d = $datos[$i];
	$mx = $max[$i];
	$cs = $costo[$i];
	$md = $mods[$i];

	$valores = $valores . "(0,$id,$d,$mx,$cs,$md)";

	$sql = $sql . $valores;

	require_once $_SERVER["DOCUMENT_ROOT"] . "/db/db_config.php";

	if($stmt = $db_conn->prepare($sql))
	{
		if($stmt->execute())
		{
			header("location: /registro/juego.php?registro=1"); //Cerramos y volvemos al main
			exit;
		}
	}
	
	$stmt->close();

	$db_conn->close();
	
?>