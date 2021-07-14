<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$users_data = array();
	
	$cid = $_SESSION["company_id"];
	
	$sql = "SELECT * FROM users WHERE companies_id = {$cid}";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$users_data[] = $result;
		endwhile;
?>