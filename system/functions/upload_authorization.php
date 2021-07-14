<?php
	
    $rid = $_REQUEST["rid"];
    $cid = $_REQUEST["cid"];

	$target_dir = $_SERVER["DOCUMENT_ROOT"] . "/system/requests/";
	$FileType = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
	$file_dir = "rq" . $rid . "." . $FileType;
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
		
		$sql = "CALL autoRequest(?,?)";
		
		if($stmt = $db_conn->prepare($sql))
		{
			$stmt->bind_param("ii", $rid, $cid);

			if($stmt->execute())
			{
				header("location:/system/client_request_history.php");
				exit;
			}
			else
			{
				$stmt->close();
			}
		}
			
		$db_conn->close();
	}
	
	header("location:/system/client_request.php");
	exit;
?>