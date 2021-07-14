<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";

	$client_id = $_REQUEST['cid'];
	
	$client_docs = array();
	
	$sql = "SELECT * FROM docs WHERE clients_id = $client_id";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$client_docs[] = $result;
		endwhile;

	$query_result->free_result();
	mysqli_close($db_conn);

	$obj->files = $client_docs;
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>