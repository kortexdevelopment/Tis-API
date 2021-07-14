<?php
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$client_docs = array();
	$client_id = $_GET["cid"];

	$obj;
    $jsnObj;
	
	$sql = "SELECT * FROM docs WHERE clients_id = $client_id AND type = 1";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$client_docs[] = $result;
		endwhile;

	$obj->library = $client_docs;
	$jsnObj = json_encode($obj);
	echo($jsnObj);

	$db_conn->close();
?>