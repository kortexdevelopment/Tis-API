<?php
	
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";
	
	$users_data = array();
	
	$cid = $_REQUEST["company_id"];
	$obj;
    $jsnObj;
	
	$sql = "SELECT * FROM users WHERE companies_id = {$cid}";
	
	$query_result = $db_conn->query($sql);

	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$users_data[] = $result;
		endwhile;
	
	$query_result->free_result();
	
	mysqli_close($db_conn);

	$obj->agents = $users_data;
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>