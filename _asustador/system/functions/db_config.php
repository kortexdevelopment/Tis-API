<?php
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'truckiv3');
	define('DB_PASSWORD', 'Pelambre@01');
	define('DB_NAME', 'truckiv3_plataform_database');

	$db_conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if($db_conn === false)
	{
		die("ERROR: Connection failed. " . $db_conn->connect_error);
	}

?>