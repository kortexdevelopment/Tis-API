<?php
	if($_GET["client_id"] <= 0)
	{
		header("locations:/system/functions/logout.php");
		exit;
	}

	$client_id = $_GET["client_id"];
	$request_id = $_GET["request_id"];
	
	exec("bash ~/bin/mk_doc.sh $request_id");
	
	header("location:/system/document_lobby.php?client_id=$client_id&request_id=$request_id");
?>