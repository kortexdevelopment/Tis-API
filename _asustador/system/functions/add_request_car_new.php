<?php
    session_start();

	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
    $rid = $_REQUEST["rid"];
    $make = $_REQUEST["mk"];
    $year = $_REQUEST["yr"];
    $gvw = $_REQUEST["gvw"];
    $vin = $_REQUEST["vin"];
    $model = $_REQUEST["md"];
    $value = $_REQUEST["vl"];
    $ded = $_REQUEST["ded"];

    $result = FALSE;
    $id = 0;

	$sql = "INSERT INTO request_vehicles VALUES (0,?,0,?,?,?,?,?,?,?)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("isssssdd", $rid, $make, $year, $gvw, $model, $vin, $value, $ded);

        $result = $stmt->execute();
        
        if($result)
        {
            $id = $db_conn->insert_id;
        }
	}
    
    if($result)
    {
        //return data
    	$sql = "SELECT * FROM request_vehicles WHERE id = {$id}";

        $query_result = $db_conn->query($sql);
	
        $data = $query_result->fetch_array(MYSQLI_NUM);
    }

	$stmt->close();

    $db_conn->close();
    
?>

<?php if($result) {; ?>

    <tr id="nvr<?php echo $data[0]; ?>">
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
            <?php echo $data[6]; ?>
        </td>
        <td>
            <?php echo $data[7]; ?>
        </td>
        <td>
            <?php echo "$" . number_format($data[8]); ?>
        </td>
        <td>
            <?php echo "$" . number_format($data[9]); ?>
        </td>
        <td>
            <button class="w3-button w3-round-large w3-red" onclick="newVehicleRemove(<?php echo $data[0]; ?>)">REMOVE</button>
        </td>
    </tr>
<?php }; ?>