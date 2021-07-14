<?php
	session_start();
	
	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
	
	$client_id = $_GET["client_id"];
	
	if(isset($_GET["vehicle_id"]))
	{
		require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/vehicle_data.php";
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/vehicles_data.php";
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - CLIENT VEHICLES</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	
	<script>
		
		function TypeChange()
		{
			var eType = document.getElementById("cType");
			var vType = eType.options[eType.selectedIndex].value;
			
			var e1 = document.getElementById("cTractor");
			var e2 = document.getElementById("cTrailer");
			var e3 = document.getElementById("cNon");
			var e4 = document.getElementById("cInter");
			
			switch(vType)
			{
				case "Tractor":
					e1.style.display = "block";
					e2.style.display = "none";
					e3.style.display = "none";
					e4.style.display = "none";
					break;
				case "Trailer":
					e1.style.display = "none";
					e2.style.display = "block";
					e3.style.display = "none";
					e4.style.display = "none";
					break;
				case "Non Owned":
					e1.style.display = "none";
					e2.style.display = "none";
					e3.style.display = "block";
					e4.style.display = "none";
					break;
				case "Interchange":
					e1.style.display = "none";
					e2.style.display = "none";
					e3.style.display = "none";
					e4.style.display = "block";
					break;
			}
			
		}
		
	</script>
	
	<body>
		
		<!-- Navigation Bar -->
		<div id="navBar" class="w3-bar w3-border w3-blue-gray w3-padding-small">
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">(MINI-ICON) TSI </a>
			<a href="/system/clients.php" class="w3-bar-item w3-button w3-border-right">CLIENTS</a>
			<a href="/system/client_profile.php?client_id=<?php echo $client_id; ?>" class="w3-bar-item w3-button w3-border-right">CLIENT PROFILE</a>
			<button onclick="document.getElementById('logoutModal').style.display='block'" class=" w3-bar-item w3-button w3-border w3-round-xxlarge w3-right w3-hover-red">
				<i class="fa fa-user"></i> Log Out
			</button>
			
		</div>
		
		<!-- Log out moddal -->
		<div id="logoutModal" class="w3-modal">
			<div class="w3-modal-content">
				<!-- Modal content -->
				<header class="w3-container w3-blue-gray">
					<h2>Log Out</h2>
				</header>
				
				<div class="w3-container w3-padding-small w3-center">
					<h3>Are you sure you want to log out?</h3>
					<a href="/system/functions/logout.php"><button class="w3-button w3-round-xxlarge w3-border w3-red" style="width:50%">Log out</button></a>
				</div>
				 
				<br>
				 
				<footer class="w3-container w3-blue-gray w3-padding-small">
						<div class="w3-center">
							<button onclick="document.getElementById('logoutModal').style.display='none'" class="w3-button w3-border w3-round-xxlarge w3-blue-gray">Cancel</button>
						</div>
				</footer>
				
			</div>
		</div>
		
		<br>
		
		<div class="w3-container">
			<header class="w3-blue-gray w3-center">
				<h2>CLIENT VEHICLES</h2>
			</header>
			
			<br>
			
			<div class="w3-container w3-border w3-small" style=<?php echo isset($_GET["vehicle_id"]) ? "display:none" : ""?>>
				
				<header class="w3-container w3-center w3-border-bottom">
					<h4 id="add">VEHICLE REGISTRATION</h4>
				</header>
				
				<form class="w3-container w3-small" action="/system/functions/create_vehicle.php?client_id=<?php echo $client_id; ?>" method="post">
					<br>
					<label class="w3-text-blue-gray w3-large">Vehicle Info</label>
					<br>
					<div class="w3-row-padding">
						<div class="w3-third">
							<label class="w3-text-blue-gray">Make</label>
							<input class="w3-input w3-border" name="make" type="text" placeholder="Vehicle Make" autofocus required>
						</div>
						<div class="w3-third">
							<label class="w3-text-blue-gray">Year</label>
							<input class="w3-input w3-border" name="year" type="text" placeholder="Vehicle Year" required>
						</div>
						<div class="w3-third">
							<label class="w3-text-blue-gray">G.V.W.</label>
							<input class="w3-input w3-border" name="gvw" type="text" placeholder="Vehicle GVW" required>
						</div>
					</div>
					
					<br>
					
					<div class="w3-row-padding">
						<div class="w3-half">
							<label class="w3-text-blue-gray">VIN</label>
							<label class="w3-text-blue-gray w3-tiny">*17 Digits required</label>
							<input maxlength="17" class="w3-input w3-border" name="vin" type="text" placeholder="Vehicle Id. Number" required pattern="[0-9A-Za-z]{17}">
						</div>
						<div class="w3-half">
							<label class="w3-text-blue-gray">Model</label>
							<select id="cType" class="w3-select" name="model" onchange="TypeChange()" required>
								<option value="" disabled selected>Choose one option</option>
								<option value="Tractor">TRACTOR</option>
								<option value="Trailer">TRAILER</option>
								<option value="Non Owned">NON OWNED</option>
								<option value="Interchange">INTERCHANGE</option>
							</select>
						</div>
					</div>
					
					<br>
					
					<br>
					<label class="w3-text-blue-gray w3-large">Physical Damage Coverages</label>
					<br>
					
					<div class="w3-row">
						
						<div id="cTractor" class="w3-col s6 m6 l6" style="display:none">
						
							<label class="w3-text-blue-gray">Tractor</label>
							<br>
							<div class="w3-row-padding">
								<div class="w3-half">
									<label class="w3-text-blue-gray">Value</label>
									<input class="w3-input" type="text" name="tractor_v" value="0" placeholder="Enter desired value, just numbers" pattern="[0-9]+(.[0-9]{0,2})*" required>
								</div>
								<div class="w3-half">
									<label class="w3-text-blue-gray">Deductible</label>
									<select class="w3-select" name="tractor_d" required>
										<option value="0" selected>N/A</option>
										<option value="1000">1,000.00</option>
										<option value="2500">2,500.00</option>
										<option value="5000">5,000.00</option>
									</select>
								</div>
							</div>
							<br>
							 
						</div>
						
					</div>
					
					<div class="w3-row">
						
						<div id="cTrailer" class="w3-col s6 m6 l6 " style="display:none">
						
							<label class="w3-text-blue-gray">Trailer</label>
							<br>
							<div class="w3-row-padding">
								<div class="w3-half">
									<label class="w3-text-blue-gray">Value</label>
									<input class="w3-input" type="text" name="trailer_v" value="0" placeholder="Enter desired value, just numbers" pattern="[0-9]+(.[0-9]{0,2})*" required>
								</div>
								<div class="w3-half">
									<label class="w3-text-blue-gray">Deductible</label>
									<select class="w3-select" name="trailer_d" required>
										<option value="0" selected>N/A</option>
										<option value="1000">1,000.00</option>
										<option value="2500">2,500.00</option>
										<option value="5000">5,000.00</option>
									</select>
								</div>
							</div>
							<br>
							
						</div>
						
					</div>
					
					<div class="w3-row">
						
						<div id="cNon" class="w3-col s6 m6 l6" style="display:none">
						
							<label class="w3-text-blue-gray">Non Owned</label>
							<br>
							<div class="w3-row-padding">
								<div class="w3-half">
									<label class="w3-text-blue-gray">Value</label>
									<input class="w3-input" type="text" name="non_v" value="0" placeholder="Enter desired value, just numbers" pattern="[0-9]+(.[0-9]{0,2})*" required>
								</div>
								<div class="w3-half">
									<label class="w3-text-blue-gray">Deductible</label>
									<select class="w3-select" name="non_d" required>
										<option value="0" selected>N/A</option>
										<option value="1000">1,000.00</option>
										<option value="2500">2,500.00</option>
										<option value="5000">5,000.00</option>
									</select>
								</div>
							</div>
							<br>
							 
						</div>
						
					</div>
					
					<div class="w3-row">
						
						<div id="cInter" class="w3-col s6 m6 l6" style="display:none">
						
							<label class="w3-text-blue-gray">Trailer Interchange</label>
							<br>
							<div class="w3-row-padding">
								<div class="w3-half">
									<label class="w3-text-blue-gray">Value</label>
									<input class="w3-input" type="text" name="inter_v" value="0" placeholder="Enter desired value, just numbers" pattern="[0-9]+(.[0-9]{0,2})*" required>
								</div>
								<div class="w3-half">
									<label class="w3-text-blue-gray">Deductible</label>
									<select class="w3-select" name="inter_d" required>
										<option value="0" selected>N/A</option>
										<option value="1000">1,000.00</option>
										<option value="2500">2,500.00</option>
										<option value="5000">5,000.00</option>
									</select>
								</div>
							</div>
							<br>
							
						</div>
						
					</div>
					
					<br>
					
					<button class="w3-btn w3-blue-gray w3-block w3-round-xxlarge">REGISTER</button></p>
					
					<br>
				</form>
				
			</div>
			
			<div class="w3-container w3-border w3-small" style=<?php echo isset($_GET["vehicle_id"]) ? "" : "display:none"?>>
				
				<header class="w3-container w3-center w3-border-bottom">
					<h4 id="add">VEHICLE UPDATE</h4>
				</header>
				
				<form class="w3-container w3-small" action="/system/functions/update_vehicle.php?client_id=<?php echo $client_id; ?>&vehicle_id=<?php echo $vehicle_id?>" method="post">
					<br>
					<label class="w3-text-blue-gray w3-large">Vehicle Info</label>
					<br>
					<div class="w3-row-padding">
						<div class="w3-third">
							<label class="w3-text-blue-gray">Make</label>
							<input class="w3-input w3-border" name="make" type="text" placeholder="Vehicle Make" autofocus required value=<?php echo $vehicle_data[2];?>>
						</div>
						<div class="w3-third">
							<label class="w3-text-blue-gray">Year</label>
							<input class="w3-input w3-border" name="year" type="text" placeholder="Vehicle Year" required value=<?php echo $vehicle_data[3];?>>
						</div>
						<div class="w3-third">
							<label class="w3-text-blue-gray">G.V.W.</label>
							<input class="w3-input w3-border" name="gvw" type="text" placeholder="Vehicle GVW" required value=<?php echo $vehicle_data[4];?>>
						</div>
					</div>
					
					<br>
					
					<div class="w3-row-padding">
						<div class="w3-half">
							<label class="w3-text-blue-gray">VIN</label>
							<label class="w3-text-blue-gray w3-tiny">*17 Digits required</label>
							<input maxlength="17" class="w3-input w3-border" name="vin" type="text" placeholder="Vehicle Id. Number" required pattern="[0-9A-Za-z]{17}" value=<?php echo $vehicle_data[6];?>>
						</div>
						<div class="w3-half">
							<label class="w3-text-blue-gray">Model</label>
							<select class="w3-select" name="model">
								<option value="Tractor" <?php echo $vehicle_data[5] == "Tractor" ? "selected" : ""; ?>>TRACTOR</option>
								<option value="Trailer" <?php echo $vehicle_data[5] == "Trailer" ? "selected" : ""; ?>>TRAILER</option>
								<option value="Non Owned" <?php echo $vehicle_data[5] == "Non Owned" ? "selected" : ""; ?>>NON OWNED</option>
								<option value="Interchange" <?php echo $vehicle_data[5] == "Interchange" ? "selected" : ""; ?>>INTERCHANGE</option>
							</select>
						</div>
					</div>
					
					<br>
					
					<br>
					<label class="w3-text-blue-gray w3-large">Physical Damage Coverages</label>
					<br>
					
					<div class="w3-row">
						
						<div class="w3-col s6 m6 l6 ">
						
							<label class="w3-text-blue-gray">Tractor</label>
							<br>
							<label class="w3-text-blue-gray w3-tiny">* Leave 0 for undesired values</label>
							<div class="w3-row-padding">
								<div class="w3-half">
									<label class="w3-text-blue-gray">Value</label>
									<input class="w3-input" type="text" name="tractor_v" value=<?php echo $vehicle_data[7]; ?> placeholder="Enter desired value, just numbers" pattern="[0-9]+(.[0-9]{0,2})*" required>
								</div>
								<div class="w3-half">
									<label class="w3-text-blue-gray">Deductible</label>
									<select class="w3-select" name="tractor_d" required>
										<option value="0" <?php echo $vehicle_data[8] == "0" ? "selected" : ""; ?>>N/A</option>
										<option value="1000" <?php echo $vehicle_data[8] == "1000" ? "selected" : ""; ?>>1,000</option>
										<option value="2500" <?php echo $vehicle_data[8] == "2500" ? "selected" : ""; ?>>2,500</option>
										<option value="5000" <?php echo $vehicle_data[8] == "5000" ? "selected" : ""; ?>>5,000</option>
									</select>
								</div>
							</div>
							<br>
							 
						</div>
						
						<div class="w3-col s6 m6 l6 ">
						
							<label class="w3-text-blue-gray">Trailer</label>
							<br>
							<label class="w3-text-blue-gray w3-tiny">* Leave 0 for undesired values</label>
							<div class="w3-row-padding">
								<div class="w3-half">
									<label class="w3-text-blue-gray">Value</label>
									<input class="w3-input" type="text" name="trailer_v" value=<?php echo $vehicle_data[9]; ?> placeholder="Enter desired value, just numbers" pattern="[0-9]+(.[0-9]{0,2})*" required>
								</div>
								<div class="w3-half">
									<label class="w3-text-blue-gray">Deductible</label>
									<select class="w3-select" name="trailer_d" required>
										<option value="0" <?php echo $vehicle_data[10] == "0" ? "selected" : ""?>>N/A</option>
										<option value="1000" <?php echo $vehicle_data[10] == "1000" ? "selected" : ""?>>1,000</option>
										<option value="2500" <?php echo $vehicle_data[10] == "2500" ? "selected" : ""?>>2,500</option>
										<option value="5000" <?php echo $vehicle_data[10] == "5000" ? "selected" : ""?>>5,000</option>
									</select>
								</div>
							</div>
							<br>
							
						</div>
						
					</div>
					<br>
					
					<div class="w3-row">
						
						<div class="w3-col s6 m6 l6">
						
							<label class="w3-text-blue-gray">Non Owned</label>
							<br>
							<label class="w3-text-blue-gray w3-tiny">* Leave 0 for undesired values</label>
							<div class="w3-row-padding">
								<div class="w3-half">
									<label class="w3-text-blue-gray">Value</label>
									<input class="w3-input" type="text" name="non_v" value=<?php echo $vehicle_data[11]; ?> placeholder="Enter desired value, just numbers" pattern="[0-9]+(.[0-9]{0,2})*" required>
								</div>
								<div class="w3-half">
									<label class="w3-text-blue-gray">Deductible</label>
									<select class="w3-select" name="non_d" required>
										<option value="0" <?php echo $vehicle_data[12] == "0" ? "selected" : ""?>>N/A</option>
										<option value="1000" <?php echo $vehicle_data[12] == "1000" ? "selected" : ""?>>1,000</option>
										<option value="2500" <?php echo $vehicle_data[12] == "2500" ? "selected" : ""?>>2,500</option>
										<option value="5000" <?php echo $vehicle_data[12] == "5000" ? "selected" : ""?>>5,000</option>
									</select>
								</div>
							</div>
							<br>
							 
						</div>
						
						<div class="w3-col s6 m6 l6">
						
							<label class="w3-text-blue-gray">Trailer Interchange</label>
							<br>
							<label class="w3-text-blue-gray w3-tiny">* Leave 0 for undesired values</label>
							<div class="w3-row-padding">
								<div class="w3-half">
									<label class="w3-text-blue-gray">Value</label>
									<input class="w3-input" type="text" name="inter_v" value=<?php echo $vehicle_data[13]; ?> placeholder="Enter desired value, just numbers" pattern="[0-9]+(.[0-9]{0,2})*" required>
								</div>
								<div class="w3-half">
									<label class="w3-text-blue-gray">Deductible</label>
									<select class="w3-select" name="inter_d" required>
										<option value="0" <?php echo $vehicle_data[14] == "0" ? "selected" : ""?>>N/A</option>
										<option value="1000" <?php echo $vehicle_data[14] == "1000" ? "selected" : ""?>>1,000</option>
										<option value="2500" <?php echo $vehicle_data[14] == "2500" ? "selected" : ""?>>2,500</option>
										<option value="5000" <?php echo $vehicle_data[14] == "5000" ? "selected" : ""?>>5,000</option>
									</select>
								</div>
							</div>
							<br>
							
						</div>
						
					</div>
					<br>
					
					<br>
					
					<button class="w3-btn w3-blue-gray w3-block w3-round-xxlarge">UPDATE</button></p>
					
					<br>
				</form>
				
			</div>
			
			<br>
			
			<div class="w3-container w3-border">
				
				<header class="w3-container w3-center w3-border-bottom">
						<h4>REGISTERED VEHICLES</h4>
				</header>
				
				<br>
				
				<!-- Table goes here -->
				<table class="w3-table w3-striped w3-small">
					<tr class="w3-blue-gray">
						<th><br>MAKE</th>
						<th><br>YEAR</th>
						<th><br>GVW</th>
						<th><br>VIN</th>
						<th><br>MODEL</th>
						<th>UNIT<br>VALUE</th>
						<th>UNIT<br>DEDUCTIBLE</th>
						<th class="w3-center" colspan="2"><br>ACTION</th>
					</tr>
					
					<?php for($rows = 0; $rows < count($vehicles_data); $rows++){; ?>
					<tr>
						
						<td>
							<?php echo $vehicles_data[$rows][2]; ?>
						</td>
						
						<td>
							<?php echo $vehicles_data[$rows][3]; ?>
						</td>
						
						<td>
							<?php echo $vehicles_data[$rows][4]; ?>
						</td>
						
						<td>
							<?php echo $vehicles_data[$rows][5]; ?>
						</td>
						
						<td>
							<?php echo $vehicles_data[$rows][6]; ?>
						</td>
						
						<td>
							<?php echo "$".number_format($vehicles_data[$rows][7]); ?>
						</td>
						
						<td>
							<?php echo "$".number_format($vehicles_data[$rows][8]); ?>
						</td>
						
						<!-- Delete vehicle funciton -->
						<td class="w3-center">
							<a href="/system/functions/delete_vehicle.php?client_id=<?php echo $client_id; ?>&vehicle_id=<?php echo $vehicles_data[$rows][0]; ?>">
								<button class="w3-button w3-round-xxlarge w3-blue-gray">DELETE <i class="fa fa-trash-o" style="color:red"></i></button>
							</a>
						</td>
						
						<!-- Update funciton -->
						<td class="w3-center">
							<a href="/system/client_vehicles.php?client_id=<?php echo $client_id; ?>&vehicle_id=<?php echo $vehicles_data[$rows][0]; ?>">
								<button class="w3-button w3-round-xxlarge w3-blue-gray">UPDATE <i class="fa fa-pencil" style="color:green"></i></button>
							</a>
						</td>
						
					</tr>
					
					<?php }; ?>
					
				</table>
				
				<br>
				
			</div>
			
			<!-- List Bottom Bookmark -->
			<br>
			<br>
			<div id="list" class="w3-center">
				<a href="#add">
					<button class="w3-button w3-round-xxlarge w3-blue-gray">GO TO REGISTRATION FORM <i class="fa fa-truck" style="color:lime"></i></button>
				</a>
			</div>
			<br>
			<br>
			
		</div>
		
	</body>
	
	<?php $db_conn->close(); ?>
	
</html>