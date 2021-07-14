<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";

	$obj;
    $jsnObj;
	
	$clients_data = array();
	
	$company_id = $_REQUEST["cid"];
	
	$sql = "SELECT * FROM client_clients WHERE clients_id = {$company_id}";
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$errorType = 0;
		$clients_data[] = $result;
		endwhile;
	
	$obj->companies = $clients_data;
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>