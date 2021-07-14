<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$out_drivers = array();
	$in_drivers = array();
	
	$client_id = $_GET["client_id"];
	$request_id = $_GET["request_id"];
	
	$sql = "SELECT * FROM drivers WHERE clients_id = {$client_id} AND NOT id IN (SELECT drivers_id FROM request_drivers WHERE doc_request_id = {$request_id})";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$out_drivers[] = $result;
		endwhile;
		
	$sql = "SELECT * FROM drivers WHERE clients_id = {$client_id} AND id IN (SELECT drivers_id FROM request_drivers WHERE doc_request_id = {$request_id})";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$in_drivers[] = $result;
		endwhile;
?>