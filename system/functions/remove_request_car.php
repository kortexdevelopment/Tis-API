<?php
    session_start();

	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$did = isset($_REQUEST["did"]) ? $_REQUEST["did"] : 0;

    $rid = $did ==  0 ? $_REQUEST["rid"] : 0;
    $vid = $did == 0 ? $_REQUEST["vid"] : 0;

	$sql = $did == 0 ? "DELETE FROM request_vehicles WHERE client_request_id = ? AND v_id = ?" : "DELETE FROM request_vehicles WHERE id = ?";
    
    $result = FALSE;

	if($stmt = $db_conn->prepare($sql))
	{
		if($did == 0)
		{
			$stmt->bind_param("ii", $rid, $vid);
		}
		else
		{
			$stmt->bind_param("i", $did);
		}

        $result = $stmt->execute();
	}
	
	$stmt->close();

    $db_conn->close();
    
    if($result)
    {
        //Some type of response
    }
?>