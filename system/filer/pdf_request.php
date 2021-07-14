<?php
    require $_SERVER["DOCUMENT_ROOT"] . "/system/functions/fpdm/fpdm.php";
    require $_SERVER["DOCUMENT_ROOT"] . "/system/functions/fpdf_merge/fpdf_merge.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/applications/request_data.php";

    $client = array();
    $client["cName"] = $c_info[2] . " " . $c_info[3];

    $agency = array();
    $names = explode(":", $a_info[1]);
    $agency["agName"] = $names[count($names) - 1];
    $agency["agTel"] = explode(":", $a_info[3])[0]; //We split cuz the tel column holds the phonenumber and the email
    $agency["agFax"] = $a_info[4];
    $agency["agLic"] = $a_info[2];

    $headers = array();
    $headers["reqNum1"] = $rid;
    $headers["reqNum2"] = $rid;
    $headers["reqNum3"] = $rid;

    $nv = array();

    for($r = 0; $r < count($nv_data); $r++)
    {
        $nv["nvYr" . $r] = $nv_data[$r][4];
        $nv["nvMk" . $r] = $nv_data[$r][3];
        $nv["nvMd" . $r] = $nv_data[$r][6];
        $nv["nvVin" . $r]  = $nv_data[$r][7];
    }

    $dv = array();

    for($r = 0; $r < count($dv_data); $r++)
    {
        $dv["dvYr" . $r] = $dv_data[$r][4];
        $dv["dvMk" . $r] = $dv_data[$r][3];
        $dv["dvMd" . $r] = $dv_data[$r][6];
        $dv["dvVin" . $r]  = $dv_data[$r][7];
    }

    $nd = array();

    for($r = 0; $r < count($nd_data); $r++)
    {
        $nd["ndNam" . $r] = $nd_data[$r][3];
        $nd["ndDob" . $r] = date("m/d/Y", strtotime($nd_data[$r][6]));
        $nd["ndLic" . $r] = $nd_data[$r][4];
        $nd["ndSta" . $r] = $nd_data[$r][5];
        $nd["ndExp" . $r] = $nd_data[$r][8];
    }

    $dd = array();

    for($r = 0; $r < count($dd_data); $r++)
    {
        $dd["ddNam" . $r] = $dd_data[$r][3];
        $dd["ddDob" . $r] = date("m/d/Y", strtotime($dd_data[$r][6]));
        $dd["ddLic" . $r] = $dd_data[$r][4];
        $dd["ddSta" . $r] = $dd_data[$r][5];
    }

    $cvrs = array();

    for($r = 0; $r < count($cvrs_data); $r++)
    {
        $ctp = $cvrs_data[$r][2];

        $cvrs["cvr{$ctp}val"] = "$" . number_format($cvrs_data[$r][3]);
        $cvrs["cvr{$ctp}ded"] = "$" . number_format($cvrs_data[$r][4]);
    }

    $final = array();

    $final += $client;
    $final += $agency;
    $final += $headers;
    $final += $nv;
    $final += $dv;
    $final += $nd;
    $final += $dd;
    $final += $cvrs;

    $rqFile = $_SERVER["DOCUMENT_ROOT"] . "/system/templates/request.pdf";

    //PDF rendering
	$pdf = new FPDM($rqFile);
	$pdf->Load($final);
	$pdf->Merge();
	
	$pdf->Output("I","Request.pdf");

?>