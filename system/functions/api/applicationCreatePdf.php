<?php
	$obj;
	$jsnObj;
	
	$raw = file_get_contents('php://input');
    $rdata = json_decode($raw);

	$fName = $rdata->file;
	$sName = $rdata->saved; //app_#numeroApp_#numeroDoc.pdf
	$data = $rdata->data;
	$fData = array();

	foreach($data as $dato)
	{
		$_ = explode('|', $dato);
		$fData[$_[0]] = $_[1];
	}

	require $_SERVER["DOCUMENT_ROOT"] . "/system/functions/fpdm/fpdm.php";
	$tmpCrt = $_SERVER["DOCUMENT_ROOT"] . "/system/templates/". $fName;
	$dest = $_SERVER["DOCUMENT_ROOT"] . '/system/ready_files/' . $sName;

	$pdf = new FPDM($tmpCrt);
	$pdf->Load($fData);
	$pdf->Merge();
	
	$pdf->Output('F', $dest);
	
	$obj->succes = true;
	$jsnObj = json_encode($obj);

?>