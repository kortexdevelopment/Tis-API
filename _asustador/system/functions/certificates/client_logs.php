<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$sql = "SELECT * FROM cert_log WHERE clients_id = {$id} ORDER BY id DESC";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$client_logs[] = $result;
		endwhile;
		
	$db_conn->close();
?>