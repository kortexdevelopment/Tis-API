<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$out_vehicles = array();
	$in_vehicles = array();
	
	$client_id = $_GET["client_id"];
	$request_id = $_GET["request_id"];
	
	$sql = "SELECT * FROM vehicles WHERE vehicles.clients_id = {$client_id} AND NOT id IN (SELECT vehicles_id FROM request_vehicles WHERE doc_request_id = {$request_id})";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$out_vehicles[] = $result;
		endwhile;
		
	$sql = "SELECT * FROM vehicles WHERE vehicles.clients_id = {$client_id} AND id IN (SELECT vehicles_id FROM request_vehicles WHERE doc_request_id = {$request_id})";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$in_vehicles[] = $result;
		endwhile;
?>