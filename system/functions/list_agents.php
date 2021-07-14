<?php

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";

	$list_agents = array();

	$sql = "SELECT * FROM agents";

	$query_result = $db_conn->query($sql);

	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$list_agents[] = $result;
		endwhile;
?>