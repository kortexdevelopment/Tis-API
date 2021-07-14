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
	
	$value = $data->value;
	$deductible = $data->deductible;
	
	$sql = "INSERT INTO vehicles (id, clients_id, make, year, gvw, vin, model, trailer_v, trailer_d) VALUES (0,?,?,?,?,?,?,?,?)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("isssssdd", 
				$client_id, $make, $year, $gvw, $vin, $model, 
				$value, $deductible);

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