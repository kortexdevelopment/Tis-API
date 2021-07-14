<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";

	$obj;
	$jsnObj;
	
	$raw = file_get_contents('php://input');
    $data = json_decode($raw);

	$client = $data->cid;
	$agent = $data->aid;
	$vendor = $data->vid;
	$link = $data->lid;
	$covers = $data->covers;
	
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
			$obj->id = $db_conn->insert_id;
		}
	}

	$stmt->close();
	mysqli_close($db_conn);
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>