<?php	

	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	$obj;
    $jsnObj;

    if ($_SERVER['REQUEST_METHOD'] != 'POST') 
	{
        $obj->error = "Invalid Process";
        $jsnObj = json_encode($obj);
        echo($jsnObj);
		exit;
	}

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";
	
	$raw = file_get_contents('php://input');
    $data = json_decode($raw);

	$cid = $data->cid;
	$name = $data->name;
	$mail = $data->mail;
	$pass = $data->pass;
	$level = $data->level;

	$sql = "INSERT INTO users VALUES (0,?,?,?,?,?)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("isssi", $cid, $name, $mail, $pass, $level);

		if($stmt->execute())
		{
			$obj->succes = "Agent create succesfully";
        }
        else
        {
			$obj->error = "Error creating agent";
        }
	}
	
	$stmt->close();
	mysqli_close($db_conn);
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>