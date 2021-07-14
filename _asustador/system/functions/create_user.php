<?php
    session_start();

	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$dir = isset($_SESSION["console"]) ? "/system/management/agency_users.php" : "/system/agency_users.php";

	$cid = $_SESSION["company_id"];
	
    $name   = $_POST["name"];
    $mail   = $_POST["mail"];
    $pass   = $_POST["pass"];
    $level  = $_POST["level"];

	$sql = "INSERT INTO users VALUES (0,?,?,?,?,?)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("isssi", $cid, $name, $mail, $pass, $level);

		if($stmt->execute())
		{
			header("location:". $dir ."#list");
			exit;
        }
        else
        {
            header("location:". $dir ."?error=1");
			exit;
        }
	}
	
	$stmt->close();

	$db_conn->close();
?>