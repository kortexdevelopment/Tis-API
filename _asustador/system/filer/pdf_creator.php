<?php
	session_start();
	
	$fName = $_GET["file"];
	$data = $_SESSION["appData"];
	
	require $_SERVER["DOCUMENT_ROOT"] . "/system/functions/fpdm/fpdm.php";
	$tmpCrt = $_SERVER["DOCUMENT_ROOT"] . "/system/templates/$fName";
	
	$pdf = new FPDM($tmpCrt);
	$pdf->Load($data, false);
	$pdf->Merge();
	$pdf->Output('I',$fName);
?>