<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";

	$obj;
    $jsnObj;

	$raw = file_get_contents('php://input');
    $data = json_decode($raw);

	$cid = $data->id;
	
	$name_f = $data->nameF;
	$name_s = $data->nameL;
	$name_b = $data->nameB;
	$phone = $data->phone;
	$email = $data->mail;

	$g_adds = $data->gAddress;
	$g_city = $data->gCity;
	$g_state = $data->gState;
	$g_zip = $data->gZip;
	$m_adds = $data->mAddress;
	$m_city = $data->mCity;
	$m_state = $data->mState;
	$m_zip = $data->mZip;
	$g_radius = $data->radius;

	$finance_a = $data->aFinance;
	$finance_a_account = $data->aAccount;
	$finance_b = $data->bFinance;
	$finance_b_account = $data->bAccount;
	$filing_ca = $data->numCa;
	$filing_mc = $data->numMc;
	$filing_usdot = $data->numUsDot;

	$sql = "UPDATE clients SET clients.name_first = ?, clients.name_second = ?, clients.name_bsn = ?, clients.phone = ?, clients.email = ?, 
								clients.garage_address = ?, clients.garage_city = ?, clients.garage_state = ?, clients.garage_zip = ?, 
								clients.mail_address = ?, clients.mail_city = ?, clients.mail_state = ?, clients.mail_zip = ?, 
								clients.radius = ?, 
								clients.finance_a = ?, clients.finance_a_account = ?, clients.finance_b = ?, clients.finance_b_account = ?, 
								clients.filing_ca = ?, clients.filing_mc = ?, clients.filing_usdot = ? 
								WHERE clients.id = ?";

	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("sssssssssssssssssssssi", 
						$name_f, $name_s, $name_b, $phone, $email,
						$g_adds, $g_city, $g_state, $g_zip, 
						$m_adds, $m_city, $m_state, $m_zip, 
						$g_radius,
						$finance_a, $finance_a_account, $finance_b, $finance_b_account, 
						$filing_ca, $filing_mc, $filing_usdot,
						$cid);

		if($stmt->execute())
		{
			$obj->main = TRUE;
		}

		$stmt->close();
	}

	$bsn_year = $data->yrsBussines;
	$bsn_start = $data->yrsStarted;
	
	$prior_carrier = $data->prior;

	$commodity_a = $data->caDesc;
	$commodity_b = $data->cbDesc;
	$value_average_a = $data->caAverage;
	$value_average_b = $data->cbAverage;
	$value_max_a = $data->caMax;
	$value_max_b = $data->cbMax;

	$date_from = $data->dateFrom;
	$date_to = $data->dateTo;
	$policy = $data->numPolicy;
	$coverage_type = $data->typePolicy;

	$losses = $data->losNum;
	$loss_amount = $data->losMoney;
	$loss_driver = $data->losDriver;
	
	$moving_violations = $data->numViolations;
	$accidents = $data->numAccidents;
	$anual_miles = $data->numMiles;
	
	$sql = "UPDATE client_extra_info SET client_extra_info.bsn_year = ?, client_extra_info.bsn_start = ?, 
									client_extra_info.prior_carrier = ?, 
									client_extra_info.commodity_a = ?, client_extra_info.value_average_a = ?, client_extra_info.value_max_a = ?, 
									client_extra_info.commodity_b = ?, client_extra_info.value_average_b = ?, client_extra_info.value_max_b = ?, 
									client_extra_info.date_from = ?, client_extra_info.date_to = ?, client_extra_info.policy = ?, client_extra_info.coverage_type = ?, 
									client_extra_info.losses = ?, client_extra_info.loss_amount = ?, client_extra_info.loss_driver = ?, 
									client_extra_info.moving_violations = ?, client_extra_info.accidents = ?, client_extra_info.anual_miles = ? 
									WHERE client_extra_info.clients_id = ?";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("sssssssssssssssssssi",
						$bsn_year, $bsn_start,
						$prior_carrier,
						$commodity_a, $value_average_a, $value_max_a, 
						$commodity_b, $value_average_b, $value_max_b,
						$date_from, $date_to, $policy, $coverage_type,
						$losses, $loss_amount, $loss_driver,
						$moving_violations, $accidents, $anual_miles,
						$cid);

		if($stmt->execute())
		{
			$obj->extra = TRUE;
		}

		$stmt->close();
	}
	
	mysqli_close($db_conn);
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>