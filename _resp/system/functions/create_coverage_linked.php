<?php
	if($_GET["client_id"] <= 0)
	{
		header("location:/system/functions/logout.php");
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$client_id = $_GET["client_id"];
	$type_id = $_GET["type_id"];
	$cover = 0;
	$txtCover = "hola";
	
	$type = trim($_POST["cover_type"]);
	$company = trim($_POST["company"]);
	$ded = trim($_POST["deductible"]);
	$eff_date = date("Y-m-d", strtotime($_POST["eff_date"]));
	$exp_date = date("Y-m-d", strtotime($_POST["exp_date"]));
	$p_number = trim($_POST["policy_number"]);
	$vehicles = $_POST["vehicles"];
	$cover_values = $_POST["cover_values"];
	
	for($cv = 0; $cv < count($cover_values); $cv++)
	{
		$cover += floatval(str_replace(",","",$cover_values[$cv]));
	}
	
	$sql = "INSERT INTO coverages VALUES (0,?,?,?,?,?,?,?,?,?)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("isssssssi", $client_id, $type, $company, $cover, $ded, $eff_date, $exp_date, $p_number, $type_id);

		if($stmt->execute())
		{
			$id = $db_conn->insert_id;
			
			for($v = 0; $v < count($vehicles); $v++)
			{
				$sql = "INSERT INTO covered_vehicles VALUES (0,?,?,?)";
				
				if($stmtB = $db_conn->prepare($sql))
				{
					$stmtB->bind_param("iis", $id, $vehicles[$v], strval($cover_values[$v]));
					$stmtB->execute();
					$stmtB->close();
				}
			}
			
			header("location:/system/client_profile.php?client_id=$client_id");
			exit;
		}
	}
	
	$stmt->close();
	
	$db_conn->close();
?>