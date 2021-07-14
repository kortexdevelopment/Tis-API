<?php
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$vehicle_id = $_GET["vehicle_id"];
	
	$sql = "SELECT * FROM vehicles WHERE id = {$vehicle_id}";
	
	$query_result = $db_conn->query($sql);
	
	$vehicle_data = $query_result->fetch_array(MYSQLI_NUM);
?>