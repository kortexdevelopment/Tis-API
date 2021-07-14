<?php
	if($_GET["client_id"] <= 0)
	{
		header("location:/system/functions/logout.php");
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$id = $_GET["id"];
	$client_id = $_GET["client_id"];
	
	$bsn_year = trim($_POST["bsn_year"]);
	$bsn_start = trim($_POST["bsn_start"]);
	$prior_carrier = trim($_POST["prior_carrier"]);
	$commodity_a = trim($_POST["commodity_a"]);
	$commodity_b = trim($_POST["commodity_b"]);
	$moving_violations = trim($_POST["moving_violations"]);
	$accidents = trim($_POST["accidents"]);
	$anual_miles = trim($_POST["anual_miles"]);
	
	$date_from = date("Y-m-d",  strtotime($_POST["date_from"]));
	$date_to = date("Y-m-d",  strtotime($_POST["date_to"]));
	
	$policy = trim($_POST["policy"]);
	$coverage_type = trim($_POST["coverage_type"]);
	$losses = trim($_POST["losses"]);
	$loss_amount = trim($_POST["loss_amount"]);
	$loss_driver = trim($_POST["loss_driver"]);
	$value_average_a = trim($_POST["value_average_a"]);
	$value_average_b = trim($_POST["value_average_b"]);
	$value_max_a = trim($_POST["value_max_a"]);
	$value_max_b = trim($_POST["value_max_b"]);
	
	$sql = "DELETE FROM client_extra_info WHERE id=?";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("i", $id);
		
		if($stmt->execute())
		{
			$sql = "INSERT INTO client_extra_info VALUES (0,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	
			if($stmt = $db_conn->prepare($sql))
			{
				$stmt->bind_param("isssssssssssssssssss", $client_id, $bsn_year, $bsn_start, $prior_carrier, $commodity_a, $commodity_b, $moving_violations, $accidents, $anual_miles,
														$date_from, $date_to, $policy, $coverage_type, $losses, $loss_amount, $loss_driver, $value_average_a, $value_average_b,
														$value_max_a, $value_max_b);
														
				if($stmt->execute())
				{
					header("location:/system/client_additional_info.php?client_id=$client_id");
					exit;
				}
				else
				{
					header("location:/system/client_additional_info.php?client_id=$client_id");
					exit;
				}
			}
		}
		else
		{
			header("location:/system/client_additional_info.php?client_id=$client_id");
			exit;
		}
	}
	
	$stmt->close();

	$db_conn->close();
?>