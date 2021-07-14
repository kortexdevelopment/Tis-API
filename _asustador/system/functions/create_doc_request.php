<?php
	if($_GET["client_id"] <= 0)
	{
		header("location:/system/functions/logout.php");
	}

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";

	$client_id = $_GET["client_id"];
	$company_id = $_GET["company_id"];
	
	if(!isset($_POST["covers"]) || empty($_POST["covers"]))
	{
		$db_conn->close();
		header("location:/system/document_lobby.php?client_id=$client_id&error=1");
		exit;
	}
	
	$covers = $_POST["covers"];
	
	$cFinal = "";
	
	for($c = 0; $c < count($covers) - 1; $c++)
	{
		$cFinal = $cFinal . $covers[$c] . ",";
	}
	
	$cFinal = $cFinal . $covers[count($covers) - 1];
	
	$sql = "INSERT INTO doc_request VALUES (0,?,?,?,0)";

	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("iis", $client_id, $company_id, $cFinal);

		if($stmt->execute())
		{
			$id = $db_conn->insert_id;
			// header("location:/system/document_lobby.php?client_id=$client_id&request_id=$id");
			// Black Magic start here
			//header("location:/system/functions/client_docs_generate.php?client_id=$client_id&request_id=$id");
			header("location:http://documentor.truckinsurancesolutions.org:5000?client_id=$client_id&request_id=$id");
			exit;
		}
	}

	$stmt->close();
	$db_conn->close();
?>