<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/certificates/client_data_crt.php";
	
	//General propurse data/////////////////////////////////
	$dta_general = array();
	$dta_general["note"] = $_GET["note"];	

	//Date value
	$dta_general["date"] = date(" m / d / Y");

	//Set up drivers
	$dvrs = "SCHEDULED DRIVERS: ";
	for($r = 0; $r < count($drivers_data); $r++)
	{
		$dvrs = $dvrs . $drivers_data[$r][2] . " DL#" .  $drivers_data[$r][3] . ($r < (count($drivers_data) - 1) ? ", " : " ");
	}
	
	//Set up vehicles
	$vhc = "SCHEDULED VEHICLES: ";
	for($r = 0; $r < count($vehicles_data); $r++)
	{
		$vhc = $vhc . $vehicles_data[$r][3] . " " . $vehicles_data[$r][2] . " VIN#" . $vehicles_data[$r][5];
		$vhc = $vhc . " W/$" . number_format($vehicles_data[$r][7]) . " PHYSICAL DAMAGE DED. $" . number_format($vehicles_data[$r][8]) . " ";
		$vhc = $vhc . ($r < (count($vehicles_data) - 1) ? ", " : " ");
	}
	
	//Schedule data
	$dta_general["desc"] = $dvrs . $vhc;
	
	//Holder data
	$hld_add = explode("::", $client_data_crt[3]);
	$fnl_add = "";
	
	for($r = 0; $r < count($hld_add);$r++)
	{
		$fnl_add = $fnl_add . $hld_add[$r] . ($r == 3 ? "" : ($r == 0 ? "\n" : ",") );
	}
	
	$dta_general["holder"] = $client_data_crt[2] . "\n" . $fnl_add;
	
	//Client gral info////////////////////////////////////
	$dta_client = array();
	$dta_client["cName"] = $client_data[2] . " " . $client_data[3];
	$dta_client["cBsn"] = "DBA: " . $client_data[4];
	$dta_client["cAdd"] = $client_data[11] . "\n" . $client_data[12] . "," . $client_data[13] . "," . $client_data[14];
	$dta_client["cFonA"] = $client_data[5];
	$dta_client["cFonB"] = $client_data[5];
	
	//Policies info black magic ////////////////////////////
	$ltrs = array("A","B","C","D","E","F");
	
	$dta_pl = array();       //Key value pair the letter with the insurance company
	$dta_insurers = array(); //This set the insurers company in the rows
	
	for($r = 0; $r < count($policies_comp) && $r < 6; $r++)
	{
		$dta_pl[$ltrs[$r]] = $policies_comp[$r][2];
		$dta_insurers["ins" . $ltrs[$r]] = $policies_comp[$r][2];
		$dta_insurers["naic" . $ltrs[$r]] = $policies_comp[$r][8];
	}
	
	$general = array();
	$general["plA"] = "";
	$general["efdA"] = "";
	$general["exdA"] = "";
	
	$general["plB"] = "";
	$general["efdB"] = "";
	$general["exdB"] = "";
	
	$general["plE"] = "";
	$general["efdE"] = "";
	$general["exdE"] = "";
	
	$general["plF"] = "";
	$general["efdF"] = "";
	$general["exdF"] = "";
	
	$letters = array();
	$letters["ltrA"] = "";
	$letters["ltrB"] = "";
	$letters["ltrE"] = "";
	$letters["ltrF"] = "";
	
	for($r = 0; $r < count($policies_data); $r++)
	{
		$cvrs = explode(",", $policies_data[$r][6]);
		
		foreach($cvrs as $cvr)
		{
			switch($cvr)
			{
				case "Gral. Liability":
					$letters["ltrA"] = $letters["ltrA"] . $policies_data[$r][2] . ",";
					$general["plA"]  = $general["plA"]  . $policies_data[$r][3] . "  \n";
					$general["efdA"] = $general["efdA"] . date("m/d/Y", strtotime($policies_data[$r][4])) . "\n";
					$general["exdA"] = $general["exdA"] . date("m/d/Y", strtotime($policies_data[$r][5])) . "\n";
					break;
				case "Liability":
					$letters["ltrB"] = $letters["ltrB"] . $policies_data[$r][2] . ",";
					$general["plB"]  = $general["plB"]  . $policies_data[$r][3] . "  \n";
					$general["efdB"] = $general["efdB"] . date("m/d/Y", strtotime($policies_data[$r][4])) . "\n";
					$general["exdB"] = $general["exdB"] . date("m/d/Y", strtotime($policies_data[$r][5])) . "\n";
				break;
				case "Cargo":
					$letters["ltrE"] = $letters["ltrE"] . $policies_data[$r][2] . ",";
					$general["plE"]  = $general["plE"]  . $policies_data[$r][3] . "  \n";
					$general["efdE"] = $general["efdE"] . date("m/d/Y", strtotime($policies_data[$r][4])) . "\n";
					$general["exdE"] = $general["exdE"] . date("m/d/Y", strtotime($policies_data[$r][5])) . "\n";
				break;
				case "Damage":
					$letters["ltrF"] = $letters["ltrF"] . $policies_data[$r][2] . ",";
					$general["plF"]  = $general["plF"]  . $policies_data[$r][3] . "  \n";
					$general["efdF"] = $general["efdF"] . date("m/d/Y", strtotime($policies_data[$r][4])) . "\n";
					$general["exdF"] = $general["exdF"] . date("m/d/Y", strtotime($policies_data[$r][5])) . "\n";
				break;
			}
		}
	}
	
	//Covers values and deducibles
	$cover_values = array();
	
	//Filtered if covers are aplied
	$cover_values["dtB"] = number_format($covers_data[2]); //Liability (value)
	$cover_values["dtE"] = "DED.$" . number_format($covers_data[5]) . "     $" . number_format($covers_data[4]); //Cargo (value + deducible)
	
	//Revome empty values 
	
	$ltr_cleaner = array("A","B","E","F");
	
	foreach($ltr_cleaner as $lc)
	{
		$ltrTemp = array();
		$comps = explode(",", $letters["ltr".$lc]);
		
		foreach($comps as $cmp)
		{
			if(!empty($cmp))
			{
				$ltrTemp[] = array_search($cmp, $dta_pl);
			}
		}
		
		$ltrTemp = array_unique($ltrTemp);
		$letters["ltr".$lc] = "";
		
		for($r = 0; $r < count($ltrTemp); $r++)
		{
			$letters["ltr".$lc] = $letters["ltr".$lc] . $ltrTemp[$r] . "\n";
		}
		
		if($letters["ltr" . $lc] == "")
		{
			unset($letters["ltr".$lc]);
			unset($general["pl" .$lc]);
			unset($general["efd".$lc]);
			unset($general["exd".$lc]);
			
			switch($lc)
			{
				case "B":
					unset($cover_values["dtB"]);
					break;
				case "E":
					unset($cover_values["dtE"]);
					break;
			}
		}
	}
	
	//PDF Creation//////////////////////////////////////////
	$main = array();
	
	$main += $dta_general;
	$main += $dta_client;
	$main += $dta_insurers;
	$main += $general;
	$main += $letters;
	$main += $cover_values;
	
	//Data saving
	$content = "";
	foreach($main as $k => $v)
	{
		$content = $content . "::" . $k . "=>" . $v;
	}
	
	$sql = "INSERT INTO cert_log VALUES (0,?,?,?,?)";
	$obj;
    $jsnObj;

	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("isss", $client_id, $main["holder"], $main["date"], $content);

		if($stmt->execute())
		{
			$lid = $db_conn->insert_id;
			$obj->lid = $lid;
		}
		else
		{
			$obj->error = "Error Creating Certificate Log";
		}
	}

	$stmt->close();
	mysqli_close($db_conn);
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>