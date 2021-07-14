<?php
	if($_GET["client_id"] <= 0)
	{
		header("location:/system/functions/logout.php");
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$client_id = $_GET["client_id"];
	$type_id = $_GET["type_id"];
	
	$type = trim($_POST["cover_type"]);
	$company = trim($_POST["company"]);
	$cover = trim($_POST["coverage"]);
	$ded = trim($_POST["deductible"]);
	$eff_date = date("Y-m-d",strtotime($_POST["eff_date"]));
	$exp_date = date("Y-m-d",strtotime($_POST["exp_date"]));
	$p_number = trim($_POST["policy_number"]);
	
	$sql = "INSERT INTO coverages VALUES (0,?,?,?,?,?,?,?,?,?)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("isssssssi", $client_id, $type, $company, $cover, $ded, $eff_date, $exp_date, $p_number, $type_id);

		if($stmt->execute())
		{
			header("location:/system/client_profile.php?client_id=$client_id");
			exit;
		}
	}
	
	$stmt->close();

	$db_conn->close();
?>