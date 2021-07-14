<?php
	
	$client_id = $_GET["client_id"];
	$doc_name = $_POST["desc"];
	$doc_client = $_POST["type"];
	
	$doc_type = 0;
	
	if($doc_client)
	{
		$doc_type = 1;
	}
	
	$target_dir = $_SERVER["DOCUMENT_ROOT"] . "/system/ready_files/";
	$FileType = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
	$file_dir = base64_encode($doc_name) . "." . $FileType;
	$target_file = $target_dir . $file_dir;
	$uploadOk = 1;
	
	if ($uploadOk != 0) 
	{
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))
		{
			$uploadOk = 2;
		}
	}
	
	if($uploadOk == 2)
	{
		require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
		
		$sql = "INSERT INTO docs VALUES (0,?,?,?,?)";
		
		if($stmt = $db_conn->prepare($sql))
		{
			$stmt->bind_param("issi", $client_id, $file_dir, $doc_name, $doc_type);

			if($stmt->execute())
			{
				header("location:/system/client_docs_stored.php?client_id=$client_id");
				exit;
			}
			else
			{
				$stmt->close();
			}
		}
			
		$db_conn->close();
	}
	
	header("location:/system/client_docs_stored.php?client_id=$client_id&stats=$uploadOk");
	exit;
?>