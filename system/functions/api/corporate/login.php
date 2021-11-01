<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";

	$obj;
    $jsnObj;
	$userData = array();
	
	$user = $_REQUEST["user"];
	$pass = $_REQUEST["pass"];
	
	$sql = "SELECT * FROM corp_users WHERE email = '{$user}' AND pass = '{$pass}'";
	
	$query_result = $db_conn->query($sql);
	
	$userData = $query_result->fetch_array(MYSQLI_NUM);
	
	$query_result->free();
	$db_conn->close();

	$obj->user = $userData;
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>