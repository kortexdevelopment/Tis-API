<?php
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$client_docs = array();
	
	$sql = "SELECT * FROM docs WHERE clients_id = $client_id" . (isset($_SESSION["client_app"]) ? " AND type = 1" : "");
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$client_docs[] = $result;
		endwhile;
?>