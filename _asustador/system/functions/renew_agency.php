<?php
	if($_POST["aid"] <= 0)
	{
		header("locations:/system/management/agencies.php");
		exit;
	}

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
    $agency = $_POST["aid"];
    $year = $_POST["dur"];
    $date = date("Y-m-d", strtotime($_POST["date"]));
    $status = $_POST["status"];

    $ext = "";

    if($status == 1)
    {
        $ext = date("Y-m-d", mktime(0, 0, 0, date("m",strtotime($date)),   date("d",strtotime($date)),   date("Y",strtotime($date))+$year));
    }
    else
    {
        $ext = date("Y-m-d", mktime(0, 0, 0, date("m"),   date("d"),   date("Y")+$year));
    }
    
	$sql = "UPDATE companies SET companies.status = 1, acces_finish = ? WHERE id = ?";

	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("si", $ext, $agency);

		if($stmt->execute())
		{
			header("location:/system/management/agencies.php");
			exit;
		}
	}

	$stmt->close();

	$db_conn->close();
?>