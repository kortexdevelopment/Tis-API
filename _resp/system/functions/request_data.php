<?php
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$sql = "SELECT * FROM doc_request INNER JOIN company_templates ON doc_request.company_templates_id = company_templates.id WHERE doc_request.id = $request_id";
	
	$query_result = $db_conn->query($sql);
	
	$request_data = $query_result->fetch_array(MYSQLI_NUM);
?>