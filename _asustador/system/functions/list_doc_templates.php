<?php

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";

	$list_doc_templates = array();

	$agent_id = $_GET["agent"];
	$vendors_id = $_GET["vendor"];

	$sql = "SELECT doc_link.id, doc_templates.id, doc_templates.desc, doc_templates.file, doc_templates.covers FROM doc_templates INNER JOIN doc_link ON doc_templates.id = doc_link.doc_templates_id WHERE doc_link.vendors_id = $vendors_id AND doc_link.agents_id = $agent_id AND doc_templates.status = 1";

	$query_result = $db_conn->query($sql);

	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$list_doc_templates[] = $result;
		endwhile;
?>