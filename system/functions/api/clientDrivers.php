<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";

	$obj;
    $jsnObj;
	
	$drivers_data = array();
	
	$client_id = $_REQUEST['cid'];
	
	$sql = "SELECT * FROM drivers WHERE clients_id = {$client_id}";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$drivers_data[] = $result;
		endwhile;
	
	$query_result->free_result();

	mysqli_close($db_conn);

	$obj->drivers = $drivers_data;
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>