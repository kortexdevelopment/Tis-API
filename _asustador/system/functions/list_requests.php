<?php
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$request_data = array();
	
	$sql = "SELECT doc_request.id, doc_request.coverages, agents.desc, agents.img, vendors.desc, vendors.img, doc_templates.desc 
			FROM doc_request INNER JOIN doc_link ON doc_request.doc_link_id = doc_link.id 
			INNER JOIN agents On doc_link.agents_id = agents.id
			INNER JOIN vendors on doc_link.vendors_id = vendors.id 
			INNER JOIN doc_templates on doc_link.doc_templates_id = doc_templates.id 
			WHERE doc_request.clients_id = $client_id;";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$request_data[] = $result;
		endwhile;
?>