<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";
	
	$obj;
	$jsnObj;

	$name = $_POST["name"];
	$lic_number = $_POST["lic_number"];
	$phone = $_POST["phone"];
	$phone_fax = $_POST["phone_fax"];
	$address = $_POST["address"];
	$city = $_POST["city"];
	$state = $_POST["state"];
	$zip = $_POST["zip"];
	$acces_finish = $_POST["acces_finish"];
	$status = $_POST["status"];
	$master_pass = $_POST["master_pass"];
	
	$sql = "INSERT INTO companies VALUES (0,?,?,?,?,?,?,?,?,?,?,?)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("sssssssssis",
						$name,
						$lic_number,
						$phone,
						$phone_fax,
						$address,
						$city,
						$state,
						$zip,
						$acces_finish,
						$status,
						$master_pass
					);

		if($stmt->execute())
		{
			$obj->success = TRUE;
		}
		else{
			$obj->success = FALSE;
		}
	}
	
	$stmt->close();
	mysqli_close($db_conn);

	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>