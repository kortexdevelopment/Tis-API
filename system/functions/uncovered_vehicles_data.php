<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$vehicles_data = array();
	
	$client_id = $_GET["client_id"];
	
	$sql = "SELECT * FROM vehicles LEFT JOIN covered_vehicles ON vehicles.id = covered_vehicles.vehicles_id LEFT JOIN coverages ON covered_vehicles.coverages_id = coverages.id WHERE vehicles.clients_id = {$clientProfile}";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$vehicles_data[] = $result;
		endwhile;
?>