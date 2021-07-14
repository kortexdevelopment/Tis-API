<?php
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$sql = "SELECT * FROM request_coverage WHERE doc_request_id = $request_id";
	
	$query_result = $db_conn->query($sql);
	
	$request_coverages = $query_result->fetch_array(MYSQLI_NUM);
?>