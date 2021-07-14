<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$plc_data = array();
	
	$id = $_GET["cid"];
	
	$sql = "SELECT * FROM policies WHERE clients_id = {$id} AND status = 1";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$plc_data[] = $result;
		endwhile;
?>