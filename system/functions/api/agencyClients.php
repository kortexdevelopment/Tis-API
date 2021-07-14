<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";
	
	$clients_data = array();
	
	$company_id = $_REQUEST["company_id"];
	$obj;
    $jsnObj;

	$sql = "SELECT * FROM clients WHERE companies_id = {$company_id} AND status = 1";
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$clients_data[] = $result;
		endwhile;
	
	$query_result->free_result();

	mysqli_close($db_conn);

	$obj->clients = $clients_data;
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>