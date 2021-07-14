<?php

    $titulo = $_POST["titulo"];
	$lanza = $_POST["lanza"];
	$tipo =  $_POST["tipo"];

	require_once $_SERVER["DOCUMENT_ROOT"] . "/db/db_config.php";
	
	$sql = "INSERT INTO videojuego VALUES (0,?,?,?)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("sss", $titulo, $lanza, $tipo);

		if($stmt->execute())
		{
			$id = $db_conn->insert_id;
			header("location: /registro/generojuego.php?id=$id"); //Siguiente registro
			exit;
		}
	}
	
	$stmt->close();

	$db_conn->close();
?>