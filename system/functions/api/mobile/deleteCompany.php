<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$id = $_GET["cid"];
	$obj;
    $jsnObj;

	$sql = "DELETE FROM client_clients WHERE id = ?";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("i",$id);

		if($stmt->execute())
		{
			$obj->success = true;
			$jsnObj = json_encode($obj);
		}
		else
		{
			$obj->success = false;
			$jsnObj = json_encode($obj);
		}
		echo($jsnObj);
		exit;
	}
	
	$stmt->close();
	
	$db_conn->close();
?>