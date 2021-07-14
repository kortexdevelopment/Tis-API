<?php

	require_once $_SERVER["DOCUMENT_ROOT"] . "/db/db_config.php";

	$id = $_POST["id"];
	$datos = $_POST["datos"];

	$sql = "INSERT INTO productjuego VALUES ";
	
	$valores = "";

	for($i = 0; $i < count($datos) - 1; $i++)
	{
		$d = $datos[$i];
		$valores = $valores . "($id,$d),";
	}

	$d = $datos[count($datos) - 1];
	$valores = $valores . "($id,$d)";

	$sql = $sql . $valores;

	if($stmt = $db_conn->prepare($sql))
	{
		if($stmt->execute())
		{
			header("location: /registro/musicojuego.php?id=$id"); //Paso 4 musicos
			exit;
		}
	}
	
	$stmt->close();

	$db_conn->close();
?>