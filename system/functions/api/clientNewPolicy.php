<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";

	$obj;
	$jsnObj;
	
	$raw = file_get_contents('php://input');
    $data = json_decode($raw);	
	
	$id = $data->cid;
	$name = $data->name;
	$number = $data->number;
	$naic = $data->naic;
	$start = $data->from;
	$end = $data->to;
	$covers = $data->covers;
	$strCovers = "";
	
	$sql = "INSERT INTO policies VALUES (0,?,?,?,?,?,?,1,?)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("issssss", $id, $name, $number, $start, $end, $covers, $naic);

		if($stmt->execute())
		{
			$obj->succes = TRUE;
		}
	}

	$stmt->close();
	mysqli_close($db_conn);
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>