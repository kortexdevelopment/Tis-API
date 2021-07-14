<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/db/db_config.php";
	
	$id = $_GET["id"];

	$catalogo = array();
	
	$sql = "SELECT * FROM videojuego WHERE clave IN (SELECT videojuego_clave FROM specs WHERE plataformas_clave = $id)";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$catalogo[] = $result;
        endwhile;
    
    $db_conn->close();
?>