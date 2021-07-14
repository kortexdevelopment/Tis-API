<?php

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	require $_SERVER["DOCUMENT_ROOT"] . "/system/functions/fpdm/fpdm.php";
	require $_SERVER["DOCUMENT_ROOT"] . "/system/functions/fpdf_merge/fpdf_merge.php";
	

    $logs = "SELECT * FROM cert_log where id < 73";
	
	$logs_result = $db_conn->query($logs);
	
    while($result = $logs_result->fetch_array(MYSQLI_NUM)):
		$logs_data[] = $result;
		endwhile;

    foreach($logs_data as $datas)
    {
        $ligid = $datas[0];
        $tmpCrt = $_SERVER["DOCUMENT_ROOT"] . "/system/templates/acord_cert.pdf";
        $dest = $_SERVER["DOCUMENT_ROOT"] . '/system/ready_files/certs/cert' . $ligid . '.pdf';

        $sql = "SELECT * FROM cert_log WHERE id = {$ligid}";
	
        $query_result = $db_conn->query($sql);
        
        $log = $query_result->fetch_array(MYSQLI_NUM);

        $main = array();
	
        $fLayer = explode("::", $log[4]);

        foreach($fLayer as $fl)
        {
            if(!empty($fl))
            {
                $sLayer = explode("=>", $fl);
                
                $main[$sLayer[0]] = $sLayer[1];
            }
        }

        //PDF rendering
        $pdf = new FPDM($tmpCrt);
        $pdf->Load($main);
        $pdf->Merge();

        $pdf->Output('F', $dest);

        echo($ligid);
        echo("<br>");
        sleep(1);
    }

	$db_conn->close();

    echo(Finished);
?>