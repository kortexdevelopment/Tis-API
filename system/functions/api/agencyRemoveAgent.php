<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$obj;
    $jsnObj;

	$uid = $_REQUEST["uid"];

	$sql = "DELETE FROM users WHERE id = ?";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("i",$uid);

		if($stmt->execute())
		{
			$obj->error = "Error creating agent";
		}
		else
		{
			$obj->error = "Error creating agent";
		}
	}
	
	$stmt->close();
	mysqli_close($db_conn);
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>