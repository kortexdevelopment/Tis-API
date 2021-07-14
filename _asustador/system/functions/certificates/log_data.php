<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$lid = $_GET["lid"];
	
	$sql = "SELECT * FROM cert_log WHERE id = {$lid}";
	
	$query_result = $db_conn->query($sql);
	
	$log = $query_result->fetch_array(MYSQLI_NUM);
	
?>