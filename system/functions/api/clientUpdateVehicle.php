<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";

	$obj = new stdClass();

	$raw = file_get_contents('php://input');
    $data = json_decode($raw);

	$sql = "UPDATE vehicles SET make = ?, year = ?, gvw = ?, vin = ?, model = ?, trailer_v = ?, trailer_d = ?, tractor_v = ?, tractor_d = ?, non_v = ?, non_d = ?, inter_v = ?, inter_d = ? WHERE id = ?";

	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("sssssddddddddi", $data->make, $data->year, $data->gvw, $data->vin, $data->model, $data->value, $data->deductible, $data->value, $data->deductible, $data->value, $data->deductible, $data->value, $data->deductible, $data->id);

		if($stmt->execute())
		{
			$obj->success = TRUE;
			$obj->msg = "Vehicle updated successfully";
		}else{
			$obj->success = FALSE;
			$obj->msg = "Vehicle updated could not be processed";
		}
	}
	
	$stmt->close();
	mysqli_close($db_conn);
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>