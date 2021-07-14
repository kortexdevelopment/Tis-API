<?php

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";

	$list_vendors = array();
	
	$agent_id = $_GET["agent"];

	$sql = "SELECT vendors.id, vendors.desc, vendors.img FROM vendors INNER JOIN doc_link ON vendors.id = doc_link.vendors_id WHERE doc_link.agents_id = $agent_id AND vendors.status = 1 GROUP BY vendors.id";

	$query_result = $db_conn->query($sql);

	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$list_vendors[] = $result;
		endwhile;
?>