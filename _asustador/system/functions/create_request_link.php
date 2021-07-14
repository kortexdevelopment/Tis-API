<?php
	ob_start();
	
	if(!isset($_POST["client"]))
	{
		header("location:/system/functions/logout.php");
	}

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";

	$client = $_POST["client"];
	$agent = $_POST["agent"];
	$vendor = $_POST["vendor"];
	$link = $_POST["link"];
	
	if(!isset($_POST["covers"]) || empty($_POST["covers"]))
	{
		$db_conn->close();
		header("location:/system/document_creator.php?client_id=$client&agent=$agent&vendor=$vendor&error=1");
		exit;
	}
	
	$covers = $_POST["covers"];
	
	$cFinal = "";
	
	for($c = 0; $c < count($covers) - 1; $c++)
	{
		$cFinal = $cFinal . $covers[$c] . ",";
	}
	
	$cFinal = $cFinal . $covers[count($covers) - 1];
	
	$sql = "INSERT INTO doc_request VALUES (0,?,?,?)";

	$id = 0;
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("iis", $client, $link, $cFinal);

		if($stmt->execute())
		{
			$id = $db_conn->insert_id;
		}
	}

	$stmt->close();
	$db_conn->close();
	
	if($id > 0)
	{
		echo "Data procesed succesfully!";
		header("Location:/system/document_creator.php?client_id=$client&agent=$agent&vendor=$vendor&doc=$id");
		exit;
	}
?>