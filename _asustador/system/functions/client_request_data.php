<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$data = array();
	
    $cid = $_REQUEST["cid"];
    $status = 0;
	
	$sql = "SELECT * FROM client_request WHERE clients_id = {$cid} ORDER BY id DESC";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$data[] = $result;
        endwhile;
        
?>

<?php for($r = 0; $r < count($data); $r++) {; ?>

    <?php $status = $data[$r][3]; ?>

    <tr>
        <td>
            <?php echo $data[$r][0];?>
        </td>
        <td>
            <?php echo date("m/d/Y", strtotime($data[$r][2]));?>
        </td>
        <td>
            <?php echo $status == 0 ? "CANCELED" : ($status == 1 ? "PENDING" : "AUTHORIZED"); ?>
        </td>
        <td class="w3-center">
            <?php if($status == 2) {; ?>
                <a href="/system/requests/rq<?php echo $data[$r][0];?>.pdf" class="w3-button w3-round w3-blue-gray" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
            <?php } else {; ?>
                <a href="/system/filer/pdf_request.php?rid=<?php echo $data[$r][0];?>&cid=<?php echo $data[$r][1];?>" class="w3-button w3-round w3-blue-gray" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
            <?php }; ?>
            <?php if($status == 1) {; ?>
                <a href="/system/client_request_authorize.php?rid=<?php echo $data[$r][0];?>&cid=<?php echo $data[$r][1];?>" class="w3-button w3-round w3-green" ><i class="fa fa-check" aria-hidden="true"></i></a>
                <button class="w3-button w3-round w3-red" onclick="CancelRequest(<?php echo $data[$r][0];?>, <?php echo $data[$r][1];?>)"><i class="fa fa-times" aria-hidden="true"></i></button>
            <?php }; ?>
        </td>
    </tr>

<?php }; ?>