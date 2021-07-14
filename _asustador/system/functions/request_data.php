<?php
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$request_data = array();
	
	$sql = "SELECT doc_request.id, company_templates.logo, company_templates.name, doc_request.coverages FROM doc_request INNER JOIN company_templates ON doc_request.company_templates_id = company_templates.id WHERE doc_request.clients_id = $client_id";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$request_data[] = $result;
		endwhile;
?>