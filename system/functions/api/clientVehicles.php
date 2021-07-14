<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";

	$obj;
    $jsnObj;
	
	$client_id = $_REQUEST['cid'];
	$vehicles_data = array();
	
// 	update vehicles set trailer_v = inter_v, trailer_d = inter_d where id > 0 and model = 'Interchange';
// update vehicles set trailer_v = non_v, trailer_d = non_d where id > 0 and model = 'Non Owned';
// update vehicles set trailer_v = tractor_v, trailer_d = tractor_d where id > 0 and model = 'Tractor';
// SELECT * FROM truckiv3_plataform_database.vehicles;
	$sql = "Select vehicles.id, vehicles.clients_id, vehicles.make, vehicles.year, vehicles.gvw, vehicles.vin, vehicles.model, vehicles.trailer_v, vehicles.trailer_d from vehicles where clients_id = {$client_id}";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$vehicles_data[] = $result;
		endwhile;
		
	$query_result->free_result();

	mysqli_close($db_conn);

	$obj->vehicles = $vehicles_data;
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>