<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";

	$obj;
    $jsnObj;
	$companies = array();
	
	$sql = "SELECT * FROM companies";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$companies[] = $result;
		endwhile;

	$query_result->free_result();

	mysqli_close($db_conn);

	$obj->companies = $companies;
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>