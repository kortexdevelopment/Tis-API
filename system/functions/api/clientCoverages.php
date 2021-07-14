<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";

	$obj;
	$jsnObj;

	$client_coverages_data = array();
	
	$client_id = $_REQUEST["cid"];
	
	$sql = "SELECT * FROM client_covers WHERE clients_id = {$client_id}";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$client_coverages_data[] = $result;
		endwhile;

	$query_result->free();
	$db_conn->close();

	$obj->coverages = $client_coverages_data;
    $jsnObj = json_encode($obj);
    echo($jsnObj);
	exit;
?>