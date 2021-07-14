<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$cid = $_REQUEST["company_id"];

	$obj;
    $jsnObj;
	
	$sql = "SELECT * FROM companies WHERE id = {$cid}";
	
	$query_result = $db_conn->query($sql);
	
	$agency_data = $query_result->fetch_array(MYSQLI_NUM);
	
	$query_result->free();
	$db_conn->close();

	$obj->data = $agency_data;
    $jsnObj = json_encode($obj);
    echo($jsnObj);
	exit;
?>