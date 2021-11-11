<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";

	$obj = new stdClass();

	$raw = file_get_contents('php://input');
    $data = json_decode($raw);

	$sql = "UPDATE users SET name = ?, email = ?, password = ?, status = ? WHERE id = ?";
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("sssii", $data->name, $data->mail, $data->pass, $data->level, $data->id);

		if($stmt->execute())
		{
			$obj->success = TRUE;
			$obj->msg = "Agent updated successfully";
		}else{
			$obj->success = FALSE;
			$obj->msg = "Agent update could not be processed";
		}
	}
	
	$stmt->close();
	mysqli_close($db_conn);
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>