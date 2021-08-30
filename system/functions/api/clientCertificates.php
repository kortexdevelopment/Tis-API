<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";

	$obj;
    $jsnObj;
	$client_logs = array();
	
	$id = $_REQUEST["cid"];

	$sql = "SELECT id, holder, date FROM cert_log WHERE clients_id = {$id} ORDER BY id DESC";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$client_logs[] = $result;
		endwhile;
		
	mysqli_close($db_conn);
	$obj->certificates = $client_logs;
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>