<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";

	$obj;
	$jsnObj;
	$list_doc_templates = array();

	$agent_id = $_REQUEST["aid"];
	$vendors_id = $_REQUEST["vid"];

	$sql = "SELECT doc_link.id, doc_templates.id, doc_templates.desc, doc_templates.file, doc_templates.covers FROM doc_templates INNER JOIN doc_link ON doc_templates.id = doc_link.doc_templates_id WHERE doc_link.vendors_id = $vendors_id AND doc_link.agents_id = $agent_id AND doc_templates.status = 1";

	$query_result = $db_conn->query($sql);

	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$list_doc_templates[] = $result;
		endwhile;
	
	$query_result->free_result();
	mysqli_close($db_conn);
	
	$obj->templates = $list_doc_templates;
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>