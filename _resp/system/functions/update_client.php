<?php
	if($_GET["client_id"] <= 0)
	{
		header("locations:/system/functions/logout.php");
		exit;
	}

	session_start();

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";

	$errorType = 0;

	$client_id = $_GET["client_id"];

	$name_f = trim($_POST["name_first"]);
	$name_s = trim($_POST["name_second"]);
	$name_b = trim($_POST["name_bsn"]);
	$phone = trim($_POST["phone"]);
	$email = trim($_POST["email"]);

	$g_adds = trim($_POST["garage_address"]);
	$g_city = trim($_POST["garage_city"]);
	$g_state = trim($_POST["garage_state"]);
	$g_zip = trim($_POST["garage_zip"]);

	$m_adds = trim($_POST["mail_address"]);
	$m_city = trim($_POST["mail_city"]);
	$m_state = trim($_POST["mail_state"]);
	$m_zip = trim($_POST["mail_zip"]);

	$g_radius = trim($_POST["radius"]);

	$finance_a = trim($_POST["finance_a"]);
	$finance_a_account = trim($_POST["finance_a_account"]);
	$finance_b = trim($_POST["finance_b"]);
	$finance_b_account = trim($_POST["finance_b_account"]);

	$filing_ca = trim($_POST["filing_ca"]);
	$filing_mc = trim($_POST["filing_mc"]);
	$filing_usdot = trim($_POST["filing_usdot"]);

	$sql = "UPDATE clients SET name_first = ?, name_second = ?, name_bsn = ?, phone = ?, email = ?, garage_address = ?, garage_city = ?, garage_state = ?, garage_zip = ?, mail_address = ?, mail_city = ?, mail_state = ?, mail_zip = ?, radius = ?,
									finance_a = ?, finance_a_account = ?, finance_b = ?, finance_b_account = ?, filing_ca = ?, filing_mc = ?, filing_usdot = ?
									WHERE id = ?";

	if($stmt = $db_conn->prepare($sql))
	{
	$stmt->bind_param("sssssssssssssssssssssi", $name_f, $name_s, $name_b, $phone, $email, $g_adds, $g_city, $g_state, $g_zip, $m_adds, $m_city, $m_state, $m_zip, $g_radius,
										$finance_a, $finance_a_account, $finance_b, $finance_b_account, $filing_ca, $filing_mc, $filing_usdot,
										$client_id);

		if($stmt->execute())
		{
			header("location:/system/client_profile.php?client_id=$client_id");
			exit;
		}
		else
		{
			$errorType = 2;
		}
	}
	else
	{
		$errorType = 2;
	}

	$stmt->close();

	$db_conn->close();
?>