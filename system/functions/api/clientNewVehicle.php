<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";

	$obj;
	$jsnObj;
	
	$raw = file_get_contents('php://input');
    $data = json_decode($raw);
	
	$client_id = $data->cid;
	
	$make = $data->make;
	$year = $data->year;
	$gvw = $data->gvw;
	$model = $data->model;
	$vin = $data->vin;
	
	$value1 = $data->value;
	$deductible1 = $data->deductible;
	$value2 = $data->value;
	$deductible2 = $data->deductible;
	$value3 = $data->value;
	$deductible3 = $data->deductible;
	$value4 = $data->value;
	$deductible4 = $data->deductible;
	
	//, tractor_v, tractor_d, non_v, non_d, inter_v, inter_d
	//,?,?,?,?,?,?

	$sql = "INSERT INTO vehicles (id, clients_id, make, year, gvw, vin, model, trailer_v, trailer_d, tractor_v, tractor_d, non_v, non_d, inter_v, inter_d) VALUES (0,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("isssssdddddddd", 
				$client_id, $make, $year, $gvw, $vin, $model, 
				$value1, $deductible1, $value2, $deductible2, $value3, $deductible3, $value4, $deductible4);

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