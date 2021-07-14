<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/db/db_config.php";
    
    $id = $_GET["id"];

    //Info juego

	$datos = array();
	
	$sql = "SELECT * FROM videojuego WHERE clave = $id";
	
	$query_result = $db_conn->query($sql);
	
	$datos = $query_result->fetch_array(MYSQLI_NUM);
    
    //Info Generos
    $generos = array();
	
	$sql = "SELECT * FROM generos WHERE clave IN (SELECT generos_clave FROM generojuego WHERE videojuego_clave = $id)";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$generos[] = $result;
        endwhile;
    
    //Info Productoras
    $productoras = array();
	
	$sql = "SELECT * FROM productoras WHERE clave IN (SELECT productoras_clave FROM productjuego WHERE videojuego_clave = $id)";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$productoras[] = $result;
        endwhile;

    //Info Musicos
    $musicos = array();
	
	$sql = "SELECT * FROM musicos WHERE clave IN (SELECT musicos_clave FROM musicojuego WHERE videojuego_clave = $id)";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$musicos[] = $result;
        endwhile;

    //Info Plataformas
    $plataformas = array();
	
	$sql = "SELECT plataformas.clave, plataformas.nombre, specs.max, specs.costo, specs.mods FROM specs INNER JOIN plataformas ON specs.plataformas_clave = plataformas.clave WHERE specs.videojuego_clave = $id";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$plataformas[] = $result;
        endwhile;
    
    $db_conn->close();
?>