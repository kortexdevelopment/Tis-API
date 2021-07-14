<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$cid = $_GET["cid"];
	
	///Holder Data
	
	$sql = "SELECT * FROM client_clients WHERE id = {$cid}";
	
	$query_result = $db_conn->query($sql);
	
	$client_data_crt = $query_result->fetch_array(MYSQLI_NUM);
	
	$client_id = $client_data_crt[1];
	
	//Client Data
	$sql = "SELECT * FROM clients WHERE id = {$client_id}";
	
	$query_result = $db_conn->query($sql);
	
	$client_data = $query_result->fetch_array(MYSQLI_NUM);
	
	//Vehicles Data
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
		
		
	//Drivers Data
	$sql = "SELECT * FROM drivers WHERE clients_id = {$client_id}";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$drivers_data[] = $result;
		endwhile;
	
	//Policies Data - List
	$sql = "SELECT * FROM policies WHERE clients_id = {$client_id} AND status = 1";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$policies_data[] = $result;
		endwhile;
		
	//Policies Data - Companies
	$sql = "SELECT * FROM policies WHERE clients_id = {$client_id} AND status = 1 Group By policies.name";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$policies_comp[] = $result;
		endwhile;
	
	//Covers Data
	$sql = "SELECT * FROM client_covers WHERE clients_id = {$client_id}";
	
	$query_result = $db_conn->query($sql);
	
	$covers_data = $query_result->fetch_array(MYSQLI_NUM);
?>