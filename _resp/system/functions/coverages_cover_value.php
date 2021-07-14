<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$cover_value = array();
	
	$sql = "SELECT coverage FROM coverages WHERE clients_id = {$clients_id} AND type_id = {$type_id}";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$cover_value[] = $result;
		endwhile;
	
?>