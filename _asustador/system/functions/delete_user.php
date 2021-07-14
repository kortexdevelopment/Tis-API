<?php
	session_start();

	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$uid = $_GET["uid"];
	
	if(!isset($_SESSION["console"]))
	{
		if($_SESSION["user_id"] == $uid)
		{
			header("location:/system/agency_users.php?error=2");
			exit;
		}
	}

	$dir = isset($_SESSION["console"]) ? "/system/management/agency_users.php" : "/system/agency_users.php";

	$sql = "DELETE FROM users WHERE id = ?";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("i",$uid);

		if($stmt->execute())
		{
			header("location:". $dir ."#list");
			exit;
		}
	}
	
	$stmt->close();
	
	$db_conn->close();
?>