<?php

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";

	$pendings_data = array();

	$sql = "SELECT doc_request.id, company_templates.name, company_templates.logo FROM doc_request 
			INNER JOIN company_templates ON doc_request.company_templates_id = company_templates.id 
			WHERE doc_request.clients_id = $client_id AND doc_request.ready = $mode ORDER BY doc_request.created DESC";

	$query_result = $db_conn->query($sql);

	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$pendings_data[] = $result;
		endwhile;
?>