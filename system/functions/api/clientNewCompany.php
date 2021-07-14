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
	$location = $data->location;
	
	$sql = "INSERT INTO client_clients VALUES (0,?,?,?)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("iss", $id, $name, $location);

		if($stmt->execute())
		{
			$obj->id = $db_conn->insert_id;
		}
		else
		{
			$obj->error = TRUE;
		}
	}
	
	$stmt->close();
	mysqli_close($db_conn);
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>