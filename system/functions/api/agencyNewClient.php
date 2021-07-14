<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";
	
	$obj;
    $jsnObj;
	$createExtra = FALSE;

	$raw = file_get_contents('php://input');
    $data = json_decode($raw);

	$cid = $data->cid;
	$company_id = $data->cid;
	
	$name_f = $data->nameF;
	$name_s = $data->nameL;
	$name_b = $data->nameB;
	$phone = $data->phone;
	$email = $data->mail;
	
	$sql = "INSERT INTO clients (id, companies_id, name_first, name_second, name_bsn, phone, email) VALUES (0,?,?,?,?,?,?)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("isssss", $company_id, $name_f, $name_s, $name_b, $phone, $email);

		if($stmt->execute())
		{
			$obj->cid = $db_conn->insert_id;
			$createExtra = TRUE;
		}
		else
		{
			$obj->error = "Error creating client";
		}

		$stmt->close();
	}

	if($createExtra)
	{
		$sql = "INSERT INTO client_extra_info (id, clients_id) VALUES (0,?)";
	
		if($stmt = $db_conn->prepare($sql))
		{
			$stmt->bind_param("i", $obj->cid);
	
			if(!$stmt->execute())
			{
				$obj->error = "Error creating client extra info";
			}
	
			$stmt->close();
		}
	}

	$stmt->close();
	mysqli_close($db_conn);
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>