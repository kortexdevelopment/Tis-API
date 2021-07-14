<?php
	define('wHome', dirname(dirname(__FILE__)));
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$errorType = 1; //Means that the array is empty
	$clients_data = array();
	
	$company_id = $_SESSION["company_id"];
	$filter = $_GET["filter"];

	$sql = "SELECT * FROM clients WHERE companies_id = {$company_id} AND (name_first LIKE '%$filter%' OR name_second LIKE '%$filter%' OR name_bsn LIKE '%$filter%')";
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$errorType = 0;
		$clients_data[] = $result;
		endwhile;
	
	$db_conn->close();
?>