<?php
	
	if(!isset($_POST["cid"]) || $_POST["cid"] <= 0 || $_SERVER['REQUEST_METHOD'] != 'POST')
	{
		header("location:/system/functions/logout.php");
		exit;
	}
		
	
	$id = $_POST["cid"];
	$name = $_POST["name"];
	$number = $_POST["number"];
	$naic = $_POST["naic"];
	$start = date("Y-m-d",  strtotime($_POST["start"]));
	$end = date("Y-m-d",  strtotime($_POST["end"]));
	$covers = $_POST["covers"];
	$strCovers = "";
	
	if(count($covers) <= 0)
	{
		header("location:/system/policies_menu.php?cid=$id&covers");
		exit;
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	for($c = 0; $c < count($covers); $c++)
	{
		$strCovers .= $covers[$c] . ( $c < (count($covers) - 1) ? "," : "");
	}
	
	$sql = "INSERT INTO policies VALUES (0,?,?,?,?,?,?,1,?)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("issssss", $id, $name, $number, $start, $end, $strCovers, $naic);

		if($stmt->execute())
		{
			$cid = $db_conn->insert_id;
			header("location:/system/policies_menu.php?cid=$id");
			exit;
		}
	}
	
	$stmt->close();

	$db_conn->close();
?>