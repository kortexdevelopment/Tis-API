<?php
    session_start();

	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
    $rid = $_REQUEST["rid"];
    $typ = $_REQUEST["typ"];
    $val = $_REQUEST["val"];
    $ded = $_REQUEST["ded"];

    $result = FALSE;
    $id = 0;

	$sql = "INSERT INTO request_covers VALUES (0,?,?,?,?)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("iidd", $rid, $typ, $val, $ded);

        $result = $stmt->execute();
        
        if($result)
        {
            $id = $db_conn->insert_id;
        }
	}
    
    if($result)
    {
        //return data
    	$sql = "SELECT * FROM request_covers WHERE id = {$id}";

        $query_result = $db_conn->query($sql);
	
        $data = $query_result->fetch_array(MYSQLI_NUM);
    }

	$stmt->close();

    $db_conn->close();
    
?>

<?php if($result) {; ?>

    <tr id="cvr<?php echo $data[0]; ?>">
        <td>
            <?php echo $data[2] == "1" ? "LIABILITY" : ($data[2] == "2" ? "CARGO" : "GRAL. LIABILITY"); ?>
        </td>
        <td>
            <?php echo "$" . number_format($data[3]); ?>
        </td>
        <td>
            <?php echo "$" . number_format($data[4]); ?>
        </td>
        <td>
            <button class="w3-button w3-round-large w3-red" onclick="cvrUpdateRemove(<?php echo $data[0]; ?>, <?php echo $data[2]; ?> )">REMOVE</button>
        </td>
    </tr>

<?php }; ?>