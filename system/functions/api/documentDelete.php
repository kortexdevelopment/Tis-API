<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";
	
	$obj;
	$jsnObj;

	$file_id = $_POST["id"];
	$file_name = $_POST["name"];
	
	$sql = "DELETE FROM docs WHERE id = ?";
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("i",$file_id);

		if($stmt->execute())
		{
			unlink($_SERVER["DOCUMENT_ROOT"] . "/system/ready_files/" . $file_name); //File Delete
			$obj->success = TRUE;
		}
	}
	
	$stmt->close();
	mysqli_close($db_conn);

	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>