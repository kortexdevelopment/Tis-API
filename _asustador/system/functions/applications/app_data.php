<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	//////////////////////////////////////////////////////////////////////////
	// request data
	
	$sql = "SELECT * FROM doc_request WHERE id = {$request}";
	
	$query_result = $db_conn->query($sql);
	
	$info = $query_result->fetch_array(MYSQLI_NUM);
	
	$cid = $info[1];
	$dlk = $info[2];
	
	//////////////////////////////////////////////////////////////////////////
	// doc link info
	
	$sql = "SELECT * FROM doc_link WHERE id = {$dlk}";
	
	$query_result = $db_conn->query($sql);
	
	$link = $query_result->fetch_array(MYSQLI_NUM);
	
	$tmp = $link[3];
	
	//////////////////////////////////////////////////////////////////////////
	// template data
	
	$sql = "SELECT * FROM doc_templates WHERE id = {$tmp}";
	
	$query_result = $db_conn->query($sql);
	
	$template = $query_result->fetch_array(MYSQLI_NUM);
	
	//////////////////////////////////////////////////////////////////////////
	// client data
	
	$sql = "SELECT * FROM clients WHERE id = {$cid}";
	
	$query_result = $db_conn->query($sql);
	
	$c_info = $query_result->fetch_array(MYSQLI_NUM);
	
	//////////////////////////////////////////////////////////////////////////
	// client extra data
	
	$sql = "SELECT * FROM client_extra_info WHERE clients_id = {$cid}";
	
	$query_result = $db_conn->query($sql);
	
	$c_extra = $query_result->fetch_array(MYSQLI_NUM);
	
	//////////////////////////////////////////////////////////////////////////
	// client vehicles
	
	$vehicles = array();
	
	$sql = "Select vehicles.id, vehicles.clients_id, vehicles.make, vehicles.year, vehicles.gvw, vehicles.vin, vehicles.model, vehicles.tractor_v, vehicles.tractor_d from vehicles where model = 'Tractor' And clients_id = {$cid}
	Union
	Select vehicles.id, vehicles.clients_id, vehicles.make, vehicles.year, vehicles.gvw, vehicles.vin, vehicles.model, vehicles.trailer_v, vehicles.trailer_d from vehicles where model = 'Trailer' And clients_id = {$cid}
	Union
	Select vehicles.id, vehicles.clients_id, vehicles.make, vehicles.year, vehicles.gvw, vehicles.vin, vehicles.model, vehicles.non_v, vehicles.non_d from vehicles where model = 'Non Owned' And clients_id = {$cid}
	Union
	Select vehicles.id, vehicles.clients_id, vehicles.make, vehicles.year, vehicles.gvw, vehicles.vin, vehicles.model, vehicles.inter_v, vehicles.inter_d from vehicles where model = 'Interchange' And clients_id = {$cid}";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$vehicles[] = $result;
		endwhile;
	
	//////////////////////////////////////////////////////////////////////////
	// client drivers
	
	$drivers = array();
	
	$sql = "SELECT * FROM drivers WHERE clients_id = {$cid}";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$drivers[] = $result;
		endwhile;
	
	//////////////////////////////////////////////////////////////////////////
	// client coverages
	
	$sql = "SELECT * FROM client_covers WHERE clients_id = {$cid}";
	
	$query_result = $db_conn->query($sql);
	
	$c_covers = $query_result->fetch_array(MYSQLI_NUM);
	
	//////////////////////////////////////////////////////////////////////////
	// Agency data
	$sql = "SELECT * FROM companies WHERE id = {$c_info[1]}";
	
	$query_result = $db_conn->query($sql);
	
	$agency_info = $query_result->fetch_array(MYSQLI_NUM);

	//////////////////////////////////////////////////////////////////////////
	// Db Conection Closing
	$db_conn->close();
?>