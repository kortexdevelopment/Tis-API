<?php
	session_start();
	
	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
	
	$client_id = $_GET["client_id"];
	$request_id = $_GET["request_id"];
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/request_data.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/client_data.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/client_extra_data.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/request_vehicles.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/request_drivers.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/request_coverages.php";
	
	$types = explode(",",$request_data[9]);
	
	//Here we check if all information is in, if not, we create a modal to show missing data
	$missing = array();
	
	if($client_data_extra[0] == null)
	{
		$missing[] = 1;
	}
	
	if(count($in_vehicles) == 0 && count($out_vehicles) == 0)
	{
		$missing[] = 2;
	}
	
	if(count($in_drivers) == 0 && count($out_drivers) == 0)
	{
		$missing[] = 3;
	}
	
	if(!in_array(2, $missing) && count($in_vehicles) <= 0 && count($out_vehicles) > 0)
	{
		$missing[] = 4;
	}
	
	if(!in_array(3, $missing) && count($in_drivers) <= 0 && count($out_drivers) > 0)
	{
		$missing[] = 5;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - DOCUMENT CONFIGURATION</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	
	<body>
		
		<!-- Navigation Bar -->
		<div id="navBar" class="w3-bar w3-border w3-blue-gray w3-padding-small">
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">(MINI-ICON) TSI </a>
			<a href="/system/document_lobby.php?client_id=<?php echo $client_id; ?>" class="w3-bar-item w3-button w3-border-right">RETURN TO COMPANIES</a>
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
		
		<!-- Missing Data Modal -->
		<div id="dataModdal" class="w3-modal">
			<div class="w3-modal-content">
				<!-- Modal content -->
				<header class="w3-container w3-blue-gray">
					<h2>MISSING DATA FOR DOCUMENT <i class="fa fa-exclamation-triangle" style="color:red"></i></h2>
				</header>
				
				<?php if(in_array(1, $missing)) {; ?>
				<div class="w3-container w3-padding-small">
					<h4>Client´s additional data not registered
						<a href="/system/client_profile.php?client_id=<?php echo $client_id; ?>">
							<button class="w3-button w3-round-xxlarge w3-blue-gray w3-small">Go to profile</button>
						</a>
					</h4>
				</div>
				<?php }; ?>
				
				<?php if(in_array(2, $missing)) {; ?>
				<div class="w3-container w3-padding-small">
					<h4>Client´s vehicles not registered
						<a href="/system/client_profile.php?client_id=<?php echo $client_id; ?>">
							<button class="w3-button w3-round-xxlarge w3-blue-gray w3-small">Go to profile</button>
						</a>
					</h4>
				</div>
				<?php }; ?>
				
				<?php if(in_array(3, $missing)) {; ?>
				<div class="w3-container w3-padding-small">
					<h4>Client´s drivers not registered
						<a href="/system/client_profile.php?client_id=<?php echo $client_id; ?>">
							<button class="w3-button w3-round-xxlarge w3-blue-gray w3-small">Go to profile</button>
						</a>
					</h4>
				</div>
				<?php }; ?>
				
				<?php if(in_array(4, $missing)) {; ?>
				<div class="w3-container w3-padding-small">
					<h4>No vehicles selected for this document</h4>
				</div>
				<?php }; ?>
				
				<?php if(in_array(5, $missing)) {; ?>
				<div class="w3-container w3-padding-small">
					<h4>No drivers selected for this document</h4>
				</div>
				<?php }; ?>
				
				<footer class="w3-container w3-blue-gray w3-padding-small">
					<div class="w3-center">
						<button onclick="document.getElementById('dataModdal').style.display='none'" class="w3-button w3-border w3-round-xxlarge w3-blue-gray">Close</button>
					</div>
				</footer>
				
			</div>
		</div>
		
		<br>
		
		<div class="w3-container">
			<header class="w3-blue-gray w3-center">
				<h2>FILE REQUEST # <?php echo $request_id?></h2>
			</header>
			
			<br>
			
			<div class="w3-row-padding w3-bottombar">
				<div class="w3-twothird w3-rightbar">
					<header class="w3-blue-gray w3-center">
						<h2>CLIENT´S MAIN INFO</h2>
					</header>
					
					<label class="w3-text-blue-gray w3-leftbar">Contact Information</label>
					<div class="w3-row-padding">
						<div class="w3-quarter">
							<label class="w3-text-blue-gray w3-small">First Name</label>
							<h4 class="w3-border-bottom"><?php echo $client_data[2];?></h4>
						</div>
						<div class="w3-quarter">
							<label class="w3-text-blue-gray w3-small">Last Name</label>
							<h4 class="w3-border-bottom"><?php echo $client_data[3];?></h4>
						</div>
						<div class="w3-half">
							<label class="w3-text-blue-gray w3-small">Business Name</label>
							<h4 class="w3-border-bottom"><?php echo $client_data[4];?></h4>
						</div>
					</div>
					
					<div class="w3-row-padding">
						<div class="w3-half">
							<label class="w3-text-blue-gray w3-small">Phone Number</label>
							<h4 class="w3-border-bottom"><?php echo $client_data[5];?></h4>
						</div>
						<div class="w3-half">
							<label class="w3-text-blue-gray w3-small">E-mail Address</label>
							<h4 class="w3-border-bottom"><?php echo $client_data[6];?></h4>
						</div>
					</div>
					
					<label class="w3-text-blue-gray w3-leftbar">Garage Information</label>
					<div class="w3-row-padding">
						<div class="w3-quarter">
							<label class="w3-text-blue-gray w3-small">Address</label>
							<h4 class="w3-border-bottom"><?php echo $client_data[7];?></h4>
						</div>
						<div class="w3-quarter">
							<label class="w3-text-blue-gray w3-small">City</label>
							<h4 class="w3-border-bottom"><?php echo $client_data[8];?></h4>
						</div>
						<div class="w3-quarter">
							<label class="w3-text-blue-gray w3-small">State</label>
							<h4 class="w3-border-bottom"><?php echo $client_data[9];?></h4>
						</div>
						<div class="w3-quarter">
							<label class="w3-text-blue-gray w3-small">ZIP</label>
							<h4 class="w3-border-bottom"><?php echo $client_data[10];?></h4>
						</div>
					</div>
					
					<label class="w3-text-blue-gray w3-leftbar">Mailing Information</label>
					<div class="w3-row-padding">
						<div class="w3-quarter">
							<label class="w3-text-blue-gray w3-small">Address</label>
							<h4 class="w3-border-bottom"><?php echo $client_data[11];?></h4>
						</div>
						<div class="w3-quarter">
							<label class="w3-text-blue-gray w3-small">City</label>
							<h4 class="w3-border-bottom"><?php echo $client_data[12];?></h4>
						</div>
						<div class="w3-quarter">
							<label class="w3-text-blue-gray w3-small">State</label>
							<h4 class="w3-border-bottom"><?php echo $client_data[13];?></h4>
						</div>
						<div class="w3-quarter">
							<label class="w3-text-blue-gray w3-small">ZIP</label>
							<h4 class="w3-border-bottom"><?php echo $client_data[14];?></h4>
						</div>
					</div>
					
					<label class="w3-text-blue-gray w3-leftbar">Filing Information</label>
					<div class="w3-row-padding">
						<div class="w3-third">
							<label class="w3-text-blue-gray w3-small">MC Number</label>
							<h4 class="w3-border-bottom"><?php echo $client_data[21];?></h4>
						</div>
						<div class="w3-third">
							<label class="w3-text-blue-gray w3-small">U.S. DOT Number</label>
							<h4 class="w3-border-bottom"><?php echo $client_data[22];?></h4>
						</div>
						<div class="w3-third">
							<label class="w3-text-blue-gray w3-small">CA Number</label>
							<h4 class="w3-border-bottom"><?php echo $client_data[23];?></h4>
						</div>
					</div>
					
				</div>
				
				<div class="w3-third ">
					<header class="w3-blue-gray w3-center">
						<h2>ADDITIONAL INFO</h2>
					</header>
					
					<label class="w3-text-blue-gray w3-leftbar"> Career</label>
					<div class="w3-row-padding">
						<div class="w3-half">
							<label class="w3-text-blue-gray w3-small"> Business Start</label>
							<h4 class="w3-border-bottom"><?php echo $client_data_extra[3];?></h4>
						</div>
						<div class="w3-half">
							<label class="w3-text-blue-gray w3-small"> Years in Business</label>
							<h4 class="w3-border-bottom"><?php echo $client_data_extra[2];?></h4>
						</div>
					</div>
					
					<br>
					
					<label class="w3-text-blue-gray w3-leftbar">Registered Commodity A</label>
					<div class="w3-row-padding">
						<div class="w3-half">
							<label class="w3-text-blue-gray w3-small">Commodity</label>
							<h4 class="w3-border-bottom"><?php echo $client_data_extra[5];?></h4>
						</div>
						<div class="w3-quarter">
							<label class="w3-text-blue-gray w3-small">Avg. Value</label>
							<h4 class="w3-border-bottom"><?php echo $client_data_extra[17];?></h4>
						</div>
						<div class="w3-quarter">
							<label class="w3-text-blue-gray w3-small">Max Value</label>
							<h4 class="w3-border-bottom"><?php echo $client_data_extra[19];?></h4>
						</div>
					</div>
					
					<br>
					
					<label class="w3-text-blue-gray w3-leftbar">Registered Commodity B</label>
					<div class="w3-row-padding">
						<div class="w3-half">
							<label class="w3-text-blue-gray w3-small">Commodity</label>
							<h4 class="w3-border-bottom"><?php echo $client_data_extra[6];?></h4>
						</div>
						<div class="w3-quarter">
							<label class="w3-text-blue-gray w3-small">Avg. Value</label>
							<h4 class="w3-border-bottom"><?php echo $client_data_extra[18];?></h4>
						</div>
						<div class="w3-quarter">
							<label class="w3-text-blue-gray w3-small">Max Value</label>
							<h4 class="w3-border-bottom"><?php echo $client_data_extra[20];?></h4>
						</div>
					</div>
					
				</div>
				
			</div>
			
			<br>
			
			<!-- VEHICLES moddal -->
			<div id="vehicles" class="w3-modal w3-animate-opacity">
				<div class="w3-modal-content w3-small">
					<!-- Modal content -->
					<header class="w3-container w3-blue-gray w3-center">
						<h2>SELECT VEHICLES</h2>
					</header>

					<br>

					<form id="clientForm" class="w3-container" action="/system/functions/create_request_vehicles.php?<?php echo "client_id=$client_id&request_id=$request_id"; ?>" method="post">
						<br>
						
						<table class="w3-table w3-striped w3-small">
					
							<tr class="w3-border-bottom">
								<th>MAKE</th>
								<th>YEAR</th>
								<th>MODEL</th>
								<th>VIN</th>
								<th>ADD</th>
								<!-- Check if template covers any p.Damage, then at the column -->
								<?php if(in_array("4",$types) || in_array("5",$types) || in_array("6",$types) || in_array("7",$types)) {;?> 
								<th>P. DAMAGE VALUE</th>
								<?php }; ?>
							</tr>
						
							<?php for($rows = 0; $rows < count($out_vehicles); $rows++){; ?>
							
								<tr>

									<?php for($cols = 2; $cols < 7; $cols++){; ?>
									<?php 
											if($cols == 4)
											{
												continue;
											};
									?>
									<td>
										<?php
											echo $out_vehicles[$rows][$cols];
										}; ?>
									</td>
									<td class="w3-center">
										<input class="w3-input w3-center" type="checkbox" name="vehicles[]" value="<?php echo $out_vehicles[$rows][0]; ?>">
									</td>
									<?php if(in_array("4",$types) || in_array("5",$types) || in_array("6",$types) || in_array("7",$types)) {;?> 
										<td class="w3-center">
											<input class="w3-input" type="number" name="v_value[]" placeholder="Enter just numbers">
										</td>
									<?php }; ?>
								</tr>
								
							<?php }; ?>
						</table>
						
						<br>

						<button class="w3-btn w3-blue-gray w3-block w3-round-xxlarge">Register</button></p>

						<br>
					</form>

					<footer class="w3-container w3-blue-gray w3-padding-small">
							<div class="w3-center">
								<button onclick="document.getElementById('vehicles').style.display='none'" class="w3-button w3-border w3-round-xxlarge w3-red" style="width:50%">Cancel</button>
							</div>
					</footer>

				</div>
			</div>
			
			<!-- DRIVERS moddal -->
			<div id="drivers" class="w3-modal w3-animate-opacity">
				<div class="w3-modal-content w3-small">
					<!-- Modal content -->
					<header class="w3-container w3-blue-gray w3-center">
						<h2>SELECT DRIVERS</h2>
					</header>

					<br>

					<form id="clientForm" class="w3-container" action="/system/functions/create_request_drivers.php?<?php echo "client_id=$client_id&request_id=$request_id"; ?>" method="post">
						<br>
						
						<table class="w3-table w3-striped w3-small">
					
							<tr class="w3-border-bottom">
								<th>NAME</th>
								<th>LICENCE</th>
								<th>STATE</th>
								<th>EXPERIENCE</th>
								<th>ADD</th>
							</tr>
						
							<?php for($rows = 0; $rows < count($out_drivers); $rows++){; ?>
							
								<tr>

									<?php for($cols = 2; $cols < 8; $cols++){; ?>
									<?php 
											if($cols == 5 || $cols == 6)
											{
												continue;
											};
									?>
									<td>
										<?php
											echo $out_drivers[$rows][$cols];
										}; ?>
									</td>
									<td class="w3-center">
										<input class="w3-input w3-center" type="checkbox" name="drivers[]" value="<?php echo $out_drivers[$rows][0]; ?>">
									</td>
								</tr>
								
							<?php }; ?>
						</table>
						
						<br>

						<button class="w3-btn w3-blue-gray w3-block w3-round-xxlarge">Register</button></p>

						<br>
					</form>

					<footer class="w3-container w3-blue-gray w3-padding-small">
							<div class="w3-center">
								<button onclick="document.getElementById('drivers').style.display='none'" class="w3-button w3-border w3-round-xxlarge w3-red" style="width:50%">Cancel</button>
							</div>
					</footer>

				</div>
			</div>
			
			<!-- COVERAGES modal -->
			<div id="coverages" class="w3-modal w3-animate-opacity">
				<div class="w3-modal-content w3-small">
					<!-- Modal content -->
					<header class="w3-container w3-blue-gray w3-center">
						<h2>FILL COVERAGE INFO</h2>
					</header>

					<br>

					<form id="clientForm" class="w3-container" action="/system/functions/update_request_coverages.php?<?php echo "client_id=$client_id&request_id=$request_id"; ?>" method="post">
						<label class="w3-text-blue-gray w3-tiny">* Left empty if not requested</label>
						
						<br><br>
						
						<div style="display:<?php echo in_array("1", $types) ? "block" : "none" ?>"> 
							<label class="w3-text-blue-gray w3-large">Liability</label>
							<div class="w3-row-padding w3-leftbar">
								<div class="w3-half">
									<label class="w3-text-blue-gray w3-tiny">Coverage</label>
									<select class="w3-select" name="cover_params[]">
										<?php if($request_coverages[1] != null) {; ?>
											<option value="<?php echo $request_coverages[1]; ?>"><?php echo $request_coverages[1]; ?></option>
										<?php }; ?>
										<option value="n-a">N/A</option>
										<option value="750,000">$750,000</option>
										<option value="1,000,000">$1,000,000</option>
									</select>
								</div>
								<div class="w3-half">
									<label class="w3-text-blue-gray w3-tiny">Deductible</label>
									<select class="w3-select" name="cover_params[]">
										<?php if($request_coverages[2] != null) {; ?>
											<option value="<?php echo $request_coverages[2]; ?>"><?php echo $request_coverages[2]; ?></option>
										<?php }; ?>
										<option value="n-a">N/A</option>
										<option value="1,000">$1,000</option>
										<option value="2,500">$2,500</option>
										<option value="5,000">$5,000</option>
									</select>
								</div>
							</div>
							<br>
						</div>
						
						<div style="display:<?php echo in_array("2", $types) ? "block" : "none" ?>"> 
							<label class="w3-text-blue-gray w3-large">Cargo</label>
							<div class="w3-row-padding w3-leftbar">
								<div class="w3-half">
									<label class="w3-text-blue-gray w3-tiny">Coverage</label>
									<input class="w3-input" type="text" name="cover_params[]" placeholder="Enter Coverage Amount" <?php echo $request_coverages[3] != null ? "value='" . $request_coverages[3] ."'" : ""?>>
								</div>
								<div class="w3-half">
									<label class="w3-text-blue-gray w3-tiny">Deductible</label>
									<select class="w3-select" name="cover_params[]">
										<?php if($request_coverages[4] != null) {; ?>
											<option value="<?php echo $request_coverages[4]; ?>"><?php echo $request_coverages[4]; ?></option>
										<?php }; ?>
										<option value="n-a">N/A</option>
										<option value="1,000">$1,000</option>
										<option value="2,500">$2,500</option>
										<option value="5,000">$5,000</option>
									</select>
								</div>
							</div>
							<br>
						</div>
						
						<div style="display:<?php echo in_array("3", $types) ? "block" : "none" ?>"> 
							<label class="w3-text-blue-gray w3-large">General Liability</label>
							<div class="w3-row-padding w3-leftbar">
								<div class="w3-half">
									<label class="w3-text-blue-gray w3-tiny">Coverage</label>
									<input class="w3-input" type="text" name="cover_params[]" placeholder="Enter Coverage Amount" <?php echo $request_coverages[5] != null ? "value='" . $request_coverages[5] ."'" : ""?>>
								</div>
								<div class="w3-half">
									<label class="w3-text-blue-gray w3-tiny">Deductible</label>
									<select class="w3-select" name="cover_params[]">
										<?php if($request_coverages[6] != null) {; ?>
											<option value="<?php echo $request_coverages[6]; ?>"><?php echo $request_coverages[6]; ?></option>
										<?php }; ?>
										<option value="n-a">N/A</option>
										<option value="1,000">$1,000</option>
										<option value="2,500">$2,500</option>
										<option value="5,000">$5,000</option>
									</select>
								</div>
							</div>
							<br>
						</div>
						
						<div style="display:<?php echo in_array("4", $types) ? "none" : "none" ?>"> 
							<label class="w3-text-blue-gray w3-large">Tractor P.D.</label>
							<div class="w3-row-padding w3-leftbar">
								<div class="w3-half">
									<label class="w3-text-blue-gray w3-tiny">Coverage</label>
									<input class="w3-input" type="text" name="cover_params[]" placeholder="Enter Coverage Amount" <?php echo $request_coverages[7] != null ? "value='" . $request_coverages[7] ."'" : ""?>>
								</div>
								<div class="w3-half">
									<label class="w3-text-blue-gray w3-tiny">Deductible</label>
									<select class="w3-select" name="cover_params[]">
										<?php if($request_coverages[8] != null) {; ?>
											<option value="<?php echo $request_coverages[8]; ?>"><?php echo $request_coverages[8]; ?></option>
										<?php }; ?>
										<option value="n-a">N/A</option>
										<option value="1,000">$1,000</option>
										<option value="2,500">$2,500</option>
										<option value="5,000">$5,000</option>
									</select>
								</div>
							</div>
							<br>
						</div>
						
						<div style="display:<?php echo in_array("5", $types) ? "none" : "none" ?>"> 
							<label class="w3-text-blue-gray w3-large">Trailer P.D.</label>
							<div class="w3-row-padding w3-leftbar">
								<div class="w3-half">
									<label class="w3-text-blue-gray w3-tiny">Coverage</label>
									<input class="w3-input" type="text" name="cover_params[]" placeholder="Enter Coverage Amount" <?php echo $request_coverages[9] != null ? "value='" . $request_coverages[9] ."'" : ""?>>
								</div>
								<div class="w3-half">
									<label class="w3-text-blue-gray w3-tiny">Deductible</label>
									<select class="w3-select" name="cover_params[]">
										<?php if($request_coverages[10] != null) {; ?>
											<option value="<?php echo $request_coverages[10]; ?>"><?php echo $request_coverages[10]; ?></option>
										<?php }; ?>
										<option value="n-a">N/A</option>
										<option value="1,000">$1,000</option>
										<option value="2,500">$2,500</option>
										<option value="5,000">$5,000</option>
									</select>
								</div>
							</div>
							<br>
						</div>
						
						<div style="display:<?php echo in_array("6", $types) ? "none" : "none" ?>"> 
							<label class="w3-text-blue-gray w3-large">Non Owned P.D</label>
							<div class="w3-row-padding w3-leftbar">
								<div class="w3-half">
									<label class="w3-text-blue-gray w3-tiny">Coverage</label>
									<input class="w3-input" type="text" name="cover_params[]" placeholder="Enter Coverage Amount" <?php echo $request_coverages[11] != null ? "value='" . $request_coverages[11] ."'" : ""?>>
								</div>
								<div class="w3-half">
									<label class="w3-text-blue-gray w3-tiny">Deductible</label>
									<select class="w3-select" name="cover_params[]">
										<?php if($request_coverages[12] != null) {; ?>
											<option value="<?php echo $request_coverages[12]; ?>"><?php echo $request_coverages[12]; ?></option>
										<?php }; ?>
										<option value="n-a">N/A</option>
										<option value="1,000">$1,000</option>
										<option value="2,500">$2,500</option>
										<option value="5,000">$5,000</option>
									</select>
								</div>
							</div>
							<br>
						</div>
						
						<div style="display:<?php echo in_array("7", $types) ? "none" : "none" ?>"> 
							<label class="w3-text-blue-gray w3-large">Trailer Interchange P.D.</label>
							<div class="w3-row-padding w3-leftbar">
								<div class="w3-half">
									<label class="w3-text-blue-gray w3-tiny">Coverage</label>
									<input class="w3-input" type="text" name="cover_params[]" placeholder="Enter Coverage Amount" <?php echo $request_coverages[13] != null ? "value='" . $request_coverages[13] ."'" : ""?>>
								</div>
								<div class="w3-half">
									<label class="w3-text-blue-gray w3-tiny">Deductible</label>
									<select class="w3-select" name="cover_params[]">
										<?php if($request_coverages[14] != null) {; ?>
											<option value="<?php echo $request_coverages[14]; ?>"><?php echo $request_coverages[14]; ?></option>
										<?php }; ?>
										<option value="n-a">N/A</option>
										<option value="1,000">$1,000</option>
										<option value="2,500">$2,500</option>
										<option value="5,000">$5,000</option>
									</select>
								</div>
							</div>
							<br>
						</div>
						
						<button class="w3-btn w3-blue-gray w3-block w3-round-xxlarge" <?php echo $request_data[3] == 1 ? "disabled" : ""?>>UPDATE COVERAGES</button>
						<br>
						
					</form>

					<footer class="w3-container w3-blue-gray w3-padding-small">
							<div class="w3-center">
								<button onclick="document.getElementById('coverages').style.display='none'" class="w3-button w3-border w3-round-xxlarge w3-red" style="width:50%">Cancel</button>
							</div>
					</footer>

				</div>
			</div>
			
			<div class="w3-container w3-center w3-large">
				
				<button onclick="document.getElementById('coverages').style.display='block'" class="w3-button w3-blue-gray w3-center w3-card-4">
					SEE APPLICATION COVERAGES <i class="fa fa-window-restore" style="color:lime"></i>
				</button>
				
			</div>
			
			<br>
			
			<div class="w3-row-padding">
				
				<div class="w3-half">
					<header class="w3-blue-gray w3-center">
						<h2>SELECTED VEHICLES</h2>
					</header>
					<div class="w3-container w3-border-bottom">
						<button onclick="document.getElementById('vehicles').style.display='block'" class="w3-card-4 w3-button w3-right w3-small w3-round-xxlarge w3-blue-gray" <?php echo $request_data[3] == 1 ? "disabled" : ""?>>ADD <i class="fa fa-truck" style="color:lime"></i></button>
						<br><br>
					</div>
					
					<table class="w3-table w3-striped w3-small w3-border">
					
						<tr class="w3-border-bottom">
							<th>MAKE</th>
							<th>YEAR</th>
							<th>MODEL</th>
							<th>VIN</th>
							<th class="w3-center">REMOVE</th>
						</tr>
						
						<?php for($rows = 0; $rows < count($in_vehicles); $rows++){; ?>
							
							<tr>

								<?php for($cols = 2; $cols < 7; $cols++){; ?>
								<?php 
										if($cols == 4)
										{
											continue;
										};
								?>
								<td>
									<?php
										echo $in_vehicles[$rows][$cols];
									}; ?>
								</td>
								<td class="w3-center">
									<a href="/system/functions/delete_request_vehicle.php?<?php echo "client_id=$client_id&request_id=$request_id&vehicle_id={$in_vehicles[$rows][0]}"; ?>">
										<button class="w3-button w3-round-xxlarge w3-blue-gray" <?php echo $request_data[3] == 1 ? "disabled" : ""?>>REMOVE</button>
									</a>
								</td>
							</tr>
							
						<?php }; ?>
						
					</table>
					
				</div>
				
				<div class="w3-half">
					<header class="w3-blue-gray w3-center">
						<h2>SELECTED DRIVERS</h2>
					</header>
					<div class="w3-container w3-border-bottom">
						<button onclick="document.getElementById('drivers').style.display='block'" class="w3-card-4 w3-button w3-right w3-small w3-round-xxlarge w3-blue-gray" <?php echo $request_data[3] == 1 ? "disabled" : ""?>>ADD <i class="fa fa-user-plus" style="color:lime"></i></button>
						<br><br>
					</div>
					
					<table class="w3-table w3-striped w3-small w3-border">
					
						<tr class="w3-border-bottom">
							<th>NAME</th>
							<th>LICENCE</th>
							<th>STATE</th>
							<th>EXPERIENCE</th>
							<th class="w3-center">REMOVE</th>
						</tr>
						
						<?php for($rows = 0; $rows < count($in_drivers); $rows++){; ?>
							
							<tr>

								<?php for($cols = 2; $cols < 8; $cols++){; ?>
								<?php 
										if($cols == 5 || $cols == 6)
										{
											continue;
										};
								?>
								<td>
									<?php
										echo $in_drivers[$rows][$cols];
									}; ?>
								</td>
								<td class="w3-center">
									<a href="/system/functions/delete_request_driver.php?<?php echo "client_id=$client_id&request_id=$request_id&driver_id={$in_drivers[$rows][0]}"; ?>">
										<button class="w3-button w3-round-xxlarge w3-blue-gray" <?php echo $request_data[3] == 1 ? "disabled" : ""?>>REMOVE</button>
									</a>
								</td>
							</tr>
							
						<?php }; ?>
					
					</table>
					
				</div>
				
			</div>
			
			<br>
			
			<?php if($request_data[3] == 0) {; ?>
				<?php if(count($missing) <= 0) {; ?>
				<div class="w3-container">
					<a href="/system/functions/client_docs_generate.php?<?php echo "client_id=$client_id&request_id=$request_id"; ?>">
						<button class="w3-button w3-round-xxlarge w3-block w3-blue-gray">CREATE REQUEST DOCUMENT</button>
					</a>
				</div>
				<?php } else {; ?>
				<div class="w3-container">
					<button onclick="document.getElementById('dataModdal').style.display='block'" class="w3-block w3-button w3-small w3-round-xxlarge w3-red">MISSING DATA FOR DOCUMENT CREATION</button>
				</div>
				<?php }; ?>
			<?php } else { ;?>
			<div class="w3-container">
				<a href="/system/ready_files/request_<?php echo $request_id; ?>.docx" download>
					<button class="w3-button w3-round-xxlarge w3-block w3-blue-gray">DOWNLOAD DOCUMENT</button>
				</a>
			</div>
			<?php }; ?>
			
			<br>
			<br>
		</div>
		
	</body>
	<?php $db_conn->close(); ?>
</html>