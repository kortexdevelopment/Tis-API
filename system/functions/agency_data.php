<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$cid = $_SESSION["company_id"];
	
	$sql = "SELECT * FROM companies WHERE id = {$cid}";
	
	$query_result = $db_conn->query($sql);
	
	$agency_data = $query_result->fetch_array(MYSQLI_NUM);
?>