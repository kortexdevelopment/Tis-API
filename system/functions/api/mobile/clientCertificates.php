<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";

	$id = $_GET['cid'];
	$obj;
    $jsnObj;

	$sql = "SELECT * FROM cert_log WHERE clients_id = {$id} ORDER BY id DESC";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$client_logs[] = $result;
		endwhile;
		
	$obj->certificates = $client_logs;
	$jsnObj = json_encode($obj);
	echo($jsnObj);

	$db_conn->close();
?>