<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";

	$obj;
	$jsnObj;
	
	$raw = file_get_contents('php://input');
    $data = json_decode($raw);

	$client_id = $data->cid;
	
	$name = $data->name;
	$licence = $data->licence;
	$state = $data->state;
	
	$dob = $data->dob;
	$doh = $data->doh;
	
	$driver_exp = $data->exp;
	
	$sql = "INSERT INTO drivers VALUES (0,?,?,?,?,?,?,?,0,1)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("issssss", $client_id, $name, $licence, $state, $dob, $doh, $driver_exp);

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