<?php
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$client_id = $_GET["client_id"];
	
	$sql = "SELECT * FROM client_extra_info WHERE clients_id = {$client_id}";
	
	$query_result = $db_conn->query($sql);
	
	$client_data_extra = $query_result->fetch_array(MYSQLI_NUM);
?>