<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$vehicles_data = array();
	
	$client_id = isset($_GET["client_id"]) ? $_GET["client_id"] : $_GET["cid"];
	
	// $sql = "SELECT * FROM vehicles WHERE vehicles.clients_id = {$client_id}"; //Old verzion where was full listed
	
	$sql = "Select vehicles.id, vehicles.clients_id, vehicles.make, vehicles.year, vehicles.gvw, vehicles.vin, vehicles.model, vehicles.tractor_v, vehicles.tractor_d from vehicles where model = 'Tractor' And clients_id = {$client_id}
	Union
	Select vehicles.id, vehicles.clients_id, vehicles.make, vehicles.year, vehicles.gvw, vehicles.vin, vehicles.model, vehicles.trailer_v, vehicles.trailer_d from vehicles where model = 'Trailer' And clients_id = {$client_id}
	Union
	Select vehicles.id, vehicles.clients_id, vehicles.make, vehicles.year, vehicles.gvw, vehicles.vin, vehicles.model, vehicles.non_v, vehicles.non_d from vehicles where model = 'Non Owned' And clients_id = {$client_id}
	Union
	Select vehicles.id, vehicles.clients_id, vehicles.make, vehicles.year, vehicles.gvw, vehicles.vin, vehicles.model, vehicles.inter_v, vehicles.inter_d from vehicles where model = 'Interchange' And clients_id = {$client_id}";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$vehicles_data[] = $result;
		endwhile;
?>