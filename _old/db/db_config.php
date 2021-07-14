<?php
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'proyecto');
	define('DB_PASSWORD', 'clave123');
	define('DB_NAME', 'proyectobd');

	$db_conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if($db_conn === false)
	{
		die("ERROR: Connection failed. " . $db_conn->connect_error);
	}

?>