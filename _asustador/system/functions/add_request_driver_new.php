<?php
    session_start();

	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
    
    $rid = $_REQUEST["rid"];
    
    $name = trim($_REQUEST["nam"]);
	$licence = trim($_REQUEST["lic"]);
	$state = trim($_REQUEST["sta"]);
	
	$dob = date("Y-m-d",  strtotime($_REQUEST["dob"]));
	$doh = date("Y-m-d",  strtotime($_REQUEST["doh"]));
	
	$driver_exp = trim($_REQUEST["exp"]);

    $result = FALSE;
    $id = 0;

	$sql = "INSERT INTO request_drivers VALUES (0,?,0,?,?,?,?,?,?,0)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("issssss", $rid, $name, $licence, $state, $dob, $doh, $driver_exp);

        $result = $stmt->execute();
        
        if($result)
        {
            $id = $db_conn->insert_id;
        }
	}
    
    if($result)
    {
    	$sql = "SELECT * FROM request_drivers WHERE id = {$id}";

        $query_result = $db_conn->query($sql);
	
        $data = $query_result->fetch_array(MYSQLI_NUM);
    }

	$stmt->close();

    $db_conn->close();
    
?>

<?php if($result) {; ?>

    <tr id="ndv<?php echo $data[0]; ?>">
        <td>
            <?php echo $data[3]; ?>
        </td>
        <td>
            <?php echo $data[4]; ?>
        </td>
        <td>
            <?php echo $data[5]; ?>
        </td>
        <td>
            <?php echo  date("m/d/Y",  strtotime($data[6])); ?>
        </td>
        <td>
            <?php echo  date("m/d/Y",  strtotime($data[7])); ?>
        </td>
        <td>
            <?php echo $data[8]; ?>
        </td>
        <td>
            <button class="w3-button w3-round-large w3-red" onclick="newDriverRemove(<?php echo $data[0]; ?>)">REMOVE</button>
        </td>
    </tr>

<?php }; ?>