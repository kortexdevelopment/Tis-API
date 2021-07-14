<?php
    session_start();

	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
    $rid  = $_REQUEST["rid"];
    $did  = $_REQUEST["did"];
	
	$sql = "CALL addRqtDvr(?,?)";
    
    $result = FALSE;

	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("ii", $rid, $did);

        $result = $stmt->execute();
	}
	
	$stmt->close();

    $db_conn->close();
    
    if($result)
    {
        //Some type of response
    }
?>