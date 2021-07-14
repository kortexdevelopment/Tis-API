<?php
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
    $producer = trim($_POST["prod"]);
    $agency = trim($_POST["agen"]);
    $licence = trim($_POST["lic"]);
    $phone = trim($_POST["fon"]);
    $fax = trim($_POST["fax"]);
    $addres = trim($_POST["add"]);
    $city = trim($_POST["cty"]);
    $state = trim($_POST["sta"]);
    $zip = trim($_POST["zip"]);
    $duration = $_POST["dur"];
    $master = trim($_POST["pas"]);
    $email = trim($_POST["email"]);
    //Name join
    $name = $producer . ":" . $agency;

    $fullPhone = $phone . ":" . $email;

    //Expiration date today+years
    $exp = date("Y-m-d", mktime(0, 0, 0, date("m"),   date("d"),   date("Y")+$duration));

	$sql = "INSERT INTO companies VALUES (0,?,?,?,?,?,?,?,?,?,1,?)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("ssssssssss",$name, $licence,$fullPhone, $fax, $addres, $city, $state, $zip, $exp, $master);

		if($stmt->execute())
		{
            $id = $db_conn->insert_id;
			header("location:/system/management/agency_users.php?aid=".$id);
			exit;
		}
	}
	
	$stmt->close();

	$db_conn->close();
?>