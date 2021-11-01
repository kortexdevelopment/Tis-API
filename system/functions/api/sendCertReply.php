<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
    
	$sql = "Select companies.phone from cert_log Inner Join clients on cert_log.clients_id = clients.id 
			Inner join companies On clients.companies_id = companies.id
			Where cert_log.id = {$pid}";
	
	$query_result = $db_conn->query($sql);
	
	$_data = $query_result->fetch_array(MYSQLI_NUM);

    $query_result->free();
	$db_conn->close();
?>