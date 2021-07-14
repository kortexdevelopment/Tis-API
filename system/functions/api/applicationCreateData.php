<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";

	$obj;
	$jsnObj;

	$request = $_REQUEST['id'];

	$sql = "SELECT * FROM doc_request WHERE id = {$request}";
	
	$query_result = $db_conn->query($sql);
	$info = $query_result->fetch_array(MYSQLI_NUM);
	
	$cid = $info[1];
	$dlk = $info[2];
	
	//////////////////////////////////////////////////////////////////////////
	// doc link info
	
	$sql = "SELECT * FROM doc_link WHERE id = {$dlk}";
	
	$query_result = $db_conn->query($sql);
	
	$link = $query_result->fetch_array(MYSQLI_NUM);
	
	$tmp = $link[3];
	
	//////////////////////////////////////////////////////////////////////////
	// template data
	
	$sql = "SELECT * FROM doc_templates WHERE id = {$tmp}";
	
	$query_result = $db_conn->query($sql);
	
	$template = $query_result->fetch_array(MYSQLI_NUM);
	
	//////////////////////////////////////////////////////////////////////////
	// client data
	
	$sql = "SELECT * FROM clients WHERE id = {$cid}";
	
	$query_result = $db_conn->query($sql);
	
	$c_info = $query_result->fetch_array(MYSQLI_NUM);
	
	//////////////////////////////////////////////////////////////////////////
	// client extra data
	
	$sql = "SELECT * FROM client_extra_info WHERE clients_id = {$cid}";
	
	$query_result = $db_conn->query($sql);
	
	$c_extra = $query_result->fetch_array(MYSQLI_NUM);
	
	//////////////////////////////////////////////////////////////////////////
	// client vehicles
	
	$vehicles = array();
	
	$sql = "Select vehicles.id, vehicles.clients_id, vehicles.make, vehicles.year, vehicles.gvw, vehicles.vin, vehicles.model, vehicles.tractor_v, vehicles.tractor_d from vehicles where model = 'Tractor' And clients_id = {$cid}
	Union
	Select vehicles.id, vehicles.clients_id, vehicles.make, vehicles.year, vehicles.gvw, vehicles.vin, vehicles.model, vehicles.trailer_v, vehicles.trailer_d from vehicles where model = 'Trailer' And clients_id = {$cid}
	Union
	Select vehicles.id, vehicles.clients_id, vehicles.make, vehicles.year, vehicles.gvw, vehicles.vin, vehicles.model, vehicles.non_v, vehicles.non_d from vehicles where model = 'Non Owned' And clients_id = {$cid}
	Union
	Select vehicles.id, vehicles.clients_id, vehicles.make, vehicles.year, vehicles.gvw, vehicles.vin, vehicles.model, vehicles.inter_v, vehicles.inter_d from vehicles where model = 'Interchange' And clients_id = {$cid}";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$vehicles[] = $result;
		endwhile;
	
	//////////////////////////////////////////////////////////////////////////
	// client drivers
	
	$drivers = array();
	
	$sql = "SELECT * FROM drivers WHERE clients_id = {$cid}";
	
	$query_result = $db_conn->query($sql);
	
	while($result = $query_result->fetch_array(MYSQLI_NUM)):
		$drivers[] = $result;
		endwhile;
	
	//////////////////////////////////////////////////////////////////////////
	// client coverages
	
	$sql = "SELECT * FROM client_covers WHERE clients_id = {$cid}";
	
	$query_result = $db_conn->query($sql);
	
	$c_covers = $query_result->fetch_array(MYSQLI_NUM);
	
	//////////////////////////////////////////////////////////////////////////
	// Agency data
	$sql = "SELECT * FROM companies WHERE id = {$c_info[1]}";
	
	$query_result = $db_conn->query($sql);
	
	$agency_info = $query_result->fetch_array(MYSQLI_NUM);

	//////////////////////////////////////////////////////////////////////////
	// Db Conection Closing
	$query_result->free_result();
	mysqli_close($db_conn);


	//Date
	$nowDate = array('dtM' => date("m"), 'dtD' => date("d"), 'dtY' => date("y"));
	$nowDate['fullDate'] = date("m/d/Y");

	//Agency Info
	$agency_names = explode(":", $agency_info[1]);
	$agency_contacts = explode(":", $agency_info[3]);

	$agency = array(
				'agnProd' => $agency_names[0],
				'agnName' => $agency_names[1]
				);
	
	$agency['agnFon'] = $agency_contacts[0]; // Phone
	$agency['agnEml'] = $agency_contacts[1]; // Email

	//Client General Info
	$clientInfo = array(
					'cName' => $c_info[2] . " " . $c_info[3],
					'cName1' => $c_info[2] . " " . $c_info[3],
					'cName2' => $c_info[2] . " " . $c_info[3],
					'cName3' => $c_info[2] . " " . $c_info[3],
					'cName4' => $c_info[2] . " " . $c_info[3],
					'cName5' => $c_info[2] . " " . $c_info[3],
					'cBsn' => $c_info[4],
					'cCa' => $c_info[21], // Code CA
					'cMc' => $c_info[22], // Code MC
					'cDot' => $c_info[23], // Code UsDot
					'gAd' => $c_info[7],
					'gCt' => $c_info[8],
					'gSt' => $c_info[9],
					'gZp' => $c_info[10],
					'gAd+' => $c_info[7],
					'gCt+' => $c_info[8],
					'gSt+' => $c_info[9],
					'gZp+' => $c_info[10],
					'mAd' => $c_info[11],
					'mCt' => $c_info[12],
					'mSt' => $c_info[13],
					'mZp' => $c_info[14],
					'cFon' => $c_info[5],
					'cFonBsn' => $c_info[5], //Temp, not registrered in db. Using common phone
					'cMail' => $c_info[6],
					'yBsn' => $c_extra[2],
					'yInd' => $c_extra[4],
					'Cmd1' => $c_extra[5], //Comoditys
					'Cmd2' => $c_extra[6],
					'Cmdv1' => $c_extra[19], // Comoditys´ values
					'Cmdv2' => $c_extra[20],
					'priCar' => $c_extra[4], // Prior Carrier
					'priPly' => $c_extra[12], // Prior Carrier - Policy
					'priLos' => $c_extra[14] // Prior Carrier - Losses
					);
	
	//Coverages Info
	$clientInfo['cvr1v'] = "$" . number_format($c_covers[2]); //Liability Value
	$clientInfo['cvr1d'] = "$" . number_format($c_covers[3]); //Liability Deductible
	$clientInfo['cvr2v'] = "$" . number_format($c_covers[4]); //Cargo Value
	$clientInfo['cvr2d'] = "$" . number_format($c_covers[5]); //Cargo Deductible
	$clientInfo['cvr3v'] = "$" . number_format($c_covers[6]); //General Value
	$clientInfo['cvr3d'] = "$" . number_format($c_covers[7]); //General Deductible
	
	//Full Adresses
	$clientInfo['fullMail'] = $c_info[11] . " " . $c_info[12] . "," . $c_info[13] . " " . $c_info[14];

	//hystory info
	$clientInfo['hCompany'] = $c_extra[4];
	
	$termFrom = date("m/d/Y", strtotime($c_extra[10]));
	$termTo = date("m/d/Y", strtotime($c_extra[11]));
	
	$clientInfo['priFrom'] = date("m/d/Y", strtotime($c_extra[10]));
	$clientInfo['priFromM'] = date("m", strtotime($c_extra[10]));
	$clientInfo['priFromD'] = date("d", strtotime($c_extra[10]));
	$clientInfo['priFromY'] = date("y", strtotime($c_extra[10]));

	$clientInfo['priTo'] = date("m/d/Y", strtotime($c_extra[11]));
	$clientInfo['priToM'] = date("m", strtotime($c_extra[11]));
	$clientInfo['priToD'] = date("d", strtotime($c_extra[11]));
	$clientInfo['priToY'] = date("y", strtotime($c_extra[11]));

	$clientInfo['hPoliTerm'] = $termFrom . " - " . $termTo;

	$clientInfo['hLoss'] = $c_extra[14];

	//Vehicles info
	$vInfo = array();

	$tltTrailer = 0;
	$tltTractor = 0;
	$tltInterchange = 0;
	$tltNon = 0;

	$valTrailer = 0;
	$valTractor = 0;
	$valInterchange = 0;
	$valNon = 0;

	$dedTrailer = 0;
	$dedTractor = 0;
	$dedInterchange = 0;
	$dedNon = 0;

	for($r = 0; $r < count($vehicles); $r++)
	{
		$vInfo['vM'.$r] = $vehicles[$r][2];
		$vInfo['vY'.$r] = $vehicles[$r][3];
		$vInfo['vW'.$r] = $vehicles[$r][4];
		$vInfo['vV'.$r] = $vehicles[$r][5];
		$vInfo['vT'.$r] = $vehicles[$r][6];
		$vInfo['vC'.$r] = "$" . number_format($vehicles[$r][7]); //Deductible it in index 8
		$vSize = strlen($vehicles[$r][5]);
		$vTxt = $vehicles[$r][5];

		for($v = 0; $v < $vSize; $v++)
		{
			$vInfo["vV". $v . "v" . $r] = $vTxt[$v];
		}
	}
	
	for($r = 0; $r < count($vehicles); $r++)
	{
		switch($vehicles[$r][6])
		{
			case "Tractor":
				$tltTractor += 1;
				$valTractor = $vehicles[$r][7] > $valTractor ? $vehicles[$r][7] : $valTractor;
				$dedTractor = $vehicles[$r][8] > $dedTractor ? $vehicles[$r][8] : $dedTractor;
				break;
			case "Trailer":
				$tltTrailer += 1;
				$valTrailer = $vehicles[$r][7] > $valTrailer ? $vehicles[$r][7] : $valTrailer;
				$dedTrailer = $vehicles[$r][8] > $dedTrailer ? $vehicles[$r][8] : $dedTrailer;
				break;
			case "Non Owned":
				$tltNon += 1;
				$valNon = $vehicles[$r][7] > $valNon ? $vehicles[$r][7] : $valNon;
				$dedNon = $vehicles[$r][8] > $dedNon ? $vehicles[$r][8] : $dedNon;
				break;
			case "Interchange":
				$tltInterchange += 1;
				$valInterchange = $vehicles[$r][7] > $valInterchange ? $vehicles[$r][7] : $valInterchange;
				$dedInterchange = $vehicles[$r][8] > $dedInterchange ? $vehicles[$r][8] : $dedInterchange;
				break;
		}

	}

	$vInfo["tltTrailer"] = strval($tltTrailer);
	$vInfo["tltTractor"] = strval($tltTractor);
	$vInfo["tltNon"] 	 = strval($tltNon);
	$vInfo["tltInter"]   = strval($tltInterchange);

	$vInfo["valTrailer"] = strval($valTrailer);
	$vInfo["valTractor"] = strval($valTractor);
	$vInfo["valNon"] 	 = strval($valNon);
	$vInfo["valInter"]   = strval($valInterchange);

	$vInfo["dedTrailer"] = strval($dedTrailer);
	$vInfo["dedTractor"] = strval($dedTractor);
	$vInfo["dedNon"]  	 = strval($dedNon);
	$vInfo["dedInter"]   = strval($dedInterchange);
	
	//Drivers
	
	$dInfo = array();
	
	for($r = 0; $r < count($drivers); $r++)
	{
		$dInfo['dNm'.$r] = $drivers[$r][2];
		$dInfo['dLc'.$r] = $drivers[$r][3];
		$dInfo['dSt'.$r] = $drivers[$r][4];
		$dInfo['dDb'.$r] = date("m/d/Y", strtotime($drivers[$r][5]));
		$dInfo['dDh'.$r] = date("m/d/Y", strtotime($drivers[$r][6]));
		$dInfo['dEx'.$r] = $drivers[$r][7];
		$dInfo['dCm'. $r] = ""; //Year in company, not in db
	}
	
	$dInfo['cCon'] = $drivers[0][2]; //Contactac name
	$dInfo['cCon1'] = $drivers[0][2]; //Contactac name
	$dInfo['cCon2'] = $drivers[0][2]; //Contactac name
	$dInfo['cCon3'] = $drivers[0][2]; //Contactac name
	$dInfo['cCon4'] = $drivers[0][2]; //Contactac name
	
	$FinalData = array();

	$FinalData += $nowDate;
	$FinalData += $clientInfo;
	$FinalData += $vInfo;
	$FinalData += $dInfo;
	$FinalData += $agency;
	//Files to fill
	
	$fTmp = explode("_", $template[2]);
	
	$fCount = $fTmp[3];
	
	$fNames = array();
	
	for($r = 0; $r < $fCount; $r++)
	{
		$tmpName = $fTmp[0] . "_" . $fTmp[1] . "_" . $fTmp[2] . "_" . ($r + 1) . ".pdf";
		$fNames[] = $tmpName;
	}

	$obj->data = $FinalData;
	$obj->files = $fNames;
	
	$jsnObj = json_encode($obj);
	echo($jsnObj);
	exit();
?>