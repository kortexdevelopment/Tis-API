<?php

	require $_SERVER["DOCUMENT_ROOT"] . "/system/functions/fpdm/fpdm.php";
	require $_SERVER["DOCUMENT_ROOT"] . "/system/functions/fpdf_merge/fpdf_merge.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/certificates/log_data.php";
	
	$tmpCrt = "";
	
	if(isset($_GET["panel"]))
	{
		$tmpCrt = $_SERVER["DOCUMENT_ROOT"] . "/system/templates/acord_cert_agency.pdf";
	}
	else
	{
		$tmpCrt = $_SERVER["DOCUMENT_ROOT"] . "/system/templates/acord_cert.pdf";
	}
	
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
	
	$pdf->Output("I","Certificate.pdf");
	
?>