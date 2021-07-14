<?php
	
    $obj;
    $jsnObj;

    if ($_SERVER['REQUEST_METHOD'] != 'POST') 
	{
        $obj->error = "Invalid Process";
        $jsnObj = json_encode($obj);
        echo($jsnObj);
		exit;
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
    $raw = file_get_contents('php://input');
    $data = json_decode($raw);

	$cid = $data->cid;
	$name = $data->name;
	$street = $data->street;
	$city = $data->city;
	$state = $data->state;
	$zip = $data->zip;
	
	$final_loc = $street . "::" . $city . "::" . $state . "::" . $zip;
	
	$sql = "INSERT INTO client_clients VALUES (0,?,?,?)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("iss", $cid, $name, $final_loc);

		if($stmt->execute())
		{
			$lid = $db_conn->insert_id;
			$obj->lid = $lid;
            $jsnObj = json_encode($obj);
            echo($jsnObj);
		}
        else
        {
            $obj->error = "Error creating company";
            $jsnObj = json_encode($obj);
            echo($jsnObj);
        }
        exit;
	}
	
	$stmt->close();

	$db_conn->close();
?>