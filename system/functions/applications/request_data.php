<?php
	
	session_start();

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
    
    $rid = $_REQUEST["rid"];
	$cid = $_REQUEST["cid"];
	$aid = $_SESSION["company_id"];
	
	//////////////////////////////////////////////////////////////////////////
	// client data
	
	$sql = "SELECT * FROM clients WHERE id = {$cid}";
	
	$query_result = $db_conn->query($sql);
	
	$c_info = $query_result->fetch_array(MYSQLI_NUM);
	
	//////////////////////////////////////////////////////////////////////////
	// agency data
	
	$sql = "SELECT * FROM companies WHERE id = {$aid}";
	
	$query_result = $db_conn->query($sql);
	
	$a_info = $query_result->fetch_array(MYSQLI_NUM);

	//////////////////////////////////////////////////////////////////////////
    // nv data
    
    $nv_data = array();
	
    $sql = "SELECT * FROM request_vehicles WHERE v_id = 0 AND client_request_id = {$rid}";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$nv_data[] = $result;
		endwhile;

    //////////////////////////////////////////////////////////////////////////
    // dv data
    
    $dv_data = array();
	
    $sql = "SELECT * FROM request_vehicles WHERE v_id > 0 AND client_request_id = {$rid}";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$dv_data[] = $result;
        endwhile;
        
    //////////////////////////////////////////////////////////////////////////
    // nd data
    
    $nd_data = array();
	
    $sql = "SELECT * FROM request_drivers WHERE d_id <= 0 AND client_request_id = {$rid}";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$nd_data[] = $result;
        endwhile;
    
    //////////////////////////////////////////////////////////////////////////
    // dd data
    
    $dd_data = array();
	
    $sql = "SELECT * FROM request_drivers WHERE d_id > 0 AND client_request_id = {$rid}";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$dd_data[] = $result;
        endwhile;

	//////////////////////////////////////////////////////////////////////////
	// covers data
	
	$cvrs_data = array();

    $sql = "SELECT * FROM request_covers WHERE client_request_id = {$rid}";

	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$cvrs_data[] = $result;
		endwhile;
		
	//////////////////////////////////////////////////////////////////////////
	// Db Conection Closing
	$db_conn->close();
?>