<?php

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";

	$templates_data = array();

	$sql = "SELECT * FROM company_templates";

	$query_result = $db_conn->query($sql);

	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$templates_data[] = $result;
		endwhile;
?>