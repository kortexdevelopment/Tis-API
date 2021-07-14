<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/db/db_config.php";
	
	$catalogo = array();
	
	$sql = "SELECT * FROM videojuego";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$catalogo[] = $result;
        endwhile;
    
    $db_conn->close();
?>