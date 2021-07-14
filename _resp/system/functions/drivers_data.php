<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$drivers_data = array();
	
	$client_id = $_GET["client_id"];
	
	$sql = "SELECT * FROM drivers WHERE clients_id = {$client_id}";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$drivers_data[] = $result;
		endwhile;
?>