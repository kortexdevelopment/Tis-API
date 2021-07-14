<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";

	$obj;
	$jsnObj;
	
	$raw = file_get_contents('php://input');
    $data = json_decode($raw);
	
	$id = $data->id;
		
	$sql = "DELETE FROM client_clients WHERE id = ?";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("i",$id);

		if($stmt->execute())
		{
			$obj->succes = TRUE;
		}
		else
		{
			$obj->succes = FALSE;
		}
	}
	
	$stmt->close();
	mysqli_close($db_conn);
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>