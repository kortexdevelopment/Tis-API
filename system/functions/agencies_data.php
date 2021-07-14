<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$agencies_data = array();
	
	$sql = "SELECT * FROM companies";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$agencies_data [] = $result;
		endwhile;
?>