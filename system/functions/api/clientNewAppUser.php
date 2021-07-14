<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";

	$obj;
	$jsnObj;
	
	$raw = file_get_contents('php://input');
    $data = json_decode($raw);

	$client_id = $data->id;
	
	$name = $data->name;
	$pass = $data->pass;
	$domain = $data->domain;
	
	$name = $name . "@" . $domain;
	
	$sql = "INSERT INTO client_user VALUES (0,?,?,?,1)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("iss", $client_id, $name, $pass);

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