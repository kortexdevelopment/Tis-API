<?php
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$client_id = $_GET["client_id"];
	
	$sql = "SELECT * FROM clients WHERE id = {$client_id}";
	
	$query_result = $db_conn->query($sql);
	
	$client_data = $query_result->fetch_array(MYSQLI_NUM);
?>