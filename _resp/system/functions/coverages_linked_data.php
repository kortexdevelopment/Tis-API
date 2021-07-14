<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$coverages_linked_data = array();
	
	$sql = "SELECT * FROM vehicles INNER JOIN covered_vehicles ON vehicles.id = covered_vehicles.vehicles_id WHERE covered_vehicles.coverages_id = {$actual_cover}";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$coverages_linked_data[] = $result;
		endwhile;
	
?>