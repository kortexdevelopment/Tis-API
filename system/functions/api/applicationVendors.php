<?php

	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";

	$obj;
	$jsnObj;
	$list_vendors = array();
	
	$agent_id = $_REQUEST["id"];

	$sql = "SELECT vendors.id, vendors.desc, vendors.img FROM vendors INNER JOIN doc_link ON vendors.id = doc_link.vendors_id WHERE doc_link.agents_id = $agent_id AND vendors.status = 1 GROUP BY vendors.id";

	$query_result = $db_conn->query($sql);

	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$list_vendors[] = $result;
		endwhile;
	
	$query_result->free_result();
	mysqli_close($db_conn);
	
	$obj->vendors = $list_vendors;
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>