<?php
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$driver_id = $_GET["driver_id"];
	
	$sql = "SELECT * FROM drivers WHERE id = {$driver_id}";
	
	$query_result = $db_conn->query($sql);
	
	$driver_data = $query_result->fetch_array(MYSQLI_NUM);
?>