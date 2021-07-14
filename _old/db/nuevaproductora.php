<?php

    $valor = $_POST["productora"];
    
    $salida = "location:/registro/productora.php?registro=1";
    $salidaerror = "location:/registro/productora.php?error=1";

	$continuar = !empty($valor);
    
    if(!$continuar)
    {
        header($salidaerror);
        exit;
    }

	require_once $_SERVER["DOCUMENT_ROOT"] . "/db/db_config.php";
	
	$sql = "INSERT INTO productoras VALUES (0,?)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("s", $valor);

		if($stmt->execute())
		{
			header($salida);
			exit;
		}
	}
	
	$stmt->close();

	$db_conn->close();
?>