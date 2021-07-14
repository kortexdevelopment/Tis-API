<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$users_data = array();
	
	$client_id = $_SESSION["client_id"];
	
	$sql = "SELECT * FROM client_user WHERE clients_id = {$client_id}";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$users_data[] = $result;
		endwhile;
?>