<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";

	$obj;
	$jsnObj;

	$raw = file_get_contents('php://input');
    $data = json_decode($raw);
	
	$cover_id = $data->id;
	
	$liab_v = $data->vLiability;
	$liab_d = $data->dLiability;
	
	$cargo_v = $data->vCargo;
	$cargo_d = $data->dCargo;
	
	$gral_v = $data->vGeneral;
	$gral_d = $data->dGeneral;

	$sql = "UPDATE client_covers SET liab_v = ?, liab_d = ?, cargo_v = ?, cargo_d = ?, gral_v = ?, gral_d = ? WHERE id = ?";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("ddddddi", $liab_v, $liab_d, $cargo_v, $cargo_d, $gral_v, $gral_d, $cover_id);

		if($stmt->execute())
		{
			$obj->succes = TRUE;
		}
	}
	
	$stmt->close();
	mysqli_close($db_conn);
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>