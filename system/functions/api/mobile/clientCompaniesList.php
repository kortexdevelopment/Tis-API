<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$clients_record = array();
	$obj;
    $jsnObj;

	$client_id = $_GET["cid"];
	
	$sql = "SELECT * FROM client_clients WHERE clients_id = {$client_id}";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$clients_record[] = $result;
		endwhile;
	
	$obj->companies = $clients_record;
	$jsnObj = json_encode($obj);
	echo($jsnObj);

	$db_conn->close();

?>	