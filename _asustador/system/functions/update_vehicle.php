<?php
	if($_GET["client_id"] <= 0)
	{
		header("location:/system/functions/logout.php");
	}
	
	session_start();
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$client_id = $_GET["client_id"];
	$vehicle_id = $_GET["vehicle_id"];
	
	$make = trim($_POST["make"]);
	$year = trim($_POST["year"]);
	$gvw = trim($_POST["gvw"]);
	$model = trim($_POST["model"]);
	$vin = trim($_POST["vin"]);
	
	$tractor_v = $_POST["tractor_v"];
	$tractor_d = $_POST["tractor_d"];
	
	$trailer_v = $_POST["trailer_v"];
	$trailer_d = $_POST["trailer_d"];
	
	$non_v = $_POST["non_v"];
	$non_d= $_POST["non_d"];
	
	$inter_v = $_POST["inter_v"];
	$inter_d = $_POST["inter_d"];
	
	$sql = "UPDATE vehicles SET make = ?, year = ?, gvw = ?, model = ?, vin = ?, tractor_v = ?, tractor_d = ?, trailer_v = ?, trailer_d = ?, non_v = ?, non_d = ?, inter_v = ?, inter_d = ? WHERE id = ?";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("sssssddddddddi", $make, $year, $gvw, $model, $vin, $tractor_v, $tractor_d, $trailer_v, $trailer_d,  $non_v, $non_d, $inter_v, $inter_d, $vehicle_id);

		if($stmt->execute())
		{
			header("location:/system/client_vehicles.php?client_id=$client_id#list");
			exit;
		}
	}
	
	$stmt->close();

	$db_conn->close();
?>