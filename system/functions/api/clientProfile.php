<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";

	$obj;
	$jsnObj;
	
	$cid = $_REQUEST["cid"];
	
	$sql = "SELECT * FROM clients WHERE id = {$cid}";
	
	$query_result = $db_conn->query($sql);
	
	$client_data = $query_result->fetch_array(MYSQLI_NUM);

	$query_result->free();

	$sql = "SELECT * FROM client_extra_info WHERE clients_id = {$cid}";
	
	$query_result = $db_conn->query($sql);
	
	$client_data_extra = $query_result->fetch_array(MYSQLI_NUM);

	$query_result->free();
	$db_conn->close();

	$obj->main = $client_data;
	$obj->extra = $client_data_extra;
    $jsnObj = json_encode($obj);
    echo($jsnObj);
	exit;
?>