<?php
	if($_GET["client_id"] <= 0)
	{
		header("locations:/system/functions/logout.php");
		exit;
	}

	$client_id = $_GET["client_id"];
	
	exec("bash ~/bin/mk_doc.sh $client_id");
	
	header("location:/system/clients_docs.php");
?>