<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$cover_value = array();
	
	$sql = "SELECT covered_vehicles.cover_value From covered_vehicles Inner Join coverages on covered_vehicles.coverages_id = coverages.id Where coverages.clients_id = {$clients_id} And coverages.type_id = {$type_id} And covered_vehicles.vehicles_id = {$vehicle_id}";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$cover_value[] = $result;
		endwhile;
	
?>