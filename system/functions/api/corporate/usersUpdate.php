<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";

	$obj = new stdClass();
	
	$raw = file_get_contents('php://input');
    $data = json_decode($raw);
	
	$sql = "UPDATE corp_users SET name = ?, email = ?, pass = ?, role = ? WHERE id = ?";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("ssssi", $data->name, $data->email, $data->pass, $data->role, $data->id);
		if($stmt->execute())
		{
			$obj->success = TRUE;
			$obj->msg = "User updated successfully";
		}else{
			$obj->success = FALSE;
			$obj->msg = "User update could not be processed";
		}
	}

	$stmt->close();
	mysqli_close($db_conn);
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>