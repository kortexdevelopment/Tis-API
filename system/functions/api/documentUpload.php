<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
	
	$obj;
	$jsnObj;

	$client_id = $_POST["cid"];
	$doc_name = $_POST["name"];
	$doc_client = $_POST["type"];
	
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
	
	$obj->succes = FALSE;

	if($uploadOk == 2)
	{
		require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";
		
		$sql = "INSERT INTO docs VALUES (0,?,?,?,?)";
		
		if($stmt = $db_conn->prepare($sql))
		{
			$stmt->bind_param("issi", $client_id, $file_dir, $doc_name, $doc_client);

			if($stmt->execute())
			{
				$obj->succes = TRUE;
			}
			$stmt->close();
		}
			
		$db_conn->close();
	}
	
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit;
?>