<?php

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
    $obj;
    $jsnObj;

	$client_id = $_REQUEST["client_id"];
	
	$sql = "SELECT * FROM clients WHERE id = {$client_id}";
	
	$query_result = $db_conn->query($sql);
	
	$client_data = $query_result->fetch_array(MYSQLI_NUM);
	
    $obj->data = $client_data;
    $jsnObj = json_encode($obj);
    echo($jsnObj);

	$db_conn->close();
?>