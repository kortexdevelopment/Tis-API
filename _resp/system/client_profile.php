<?php
	session_start();
	
	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
	
	$master_pass = json_encode($_SESSION["master_pass"]);
	$user_type = $_SESSION["user_type"];
	
	echo "<script>var MasterPass = $master_pass; var UserType = $user_type;</script>";
	
	$clientProfile = $_GET["client_id"];
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/client_data.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/drivers_data.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/vehicles_data.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/coverages_data.php";
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - CLIENT PROFILE</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
	</head>
	
	<script>
	
	var formStatus = true;
	var formInputs = document.getElementsByClassName("clientFormInput");
	var formButtons = document.getElementsByClassName("clientFormButtons");
	var formInputValues = [];
	
	function ClientFormStatus()
	{
		formStatus = !formStatus;
		
		if(!formStatus)
		{
			formInputValues = [];
		}
		
		var i;
		
		for(i = 0; i < formInputs.length; i++)
		{
			formInputs[i].readOnly = formStatus;
			
			if(formStatus)
			{
				formInputs[i].value = formInputValues[i];
			}
			else
			{
				formInputValues.push(formInputs[i].value);
			}
		}
		
		for(i = 0; i < formButtons.length; i++)
		{
			document.getElementById("clientFormRadius").style.display = formButtons[i].style.display = formStatus ? "none" : "inline";
			document.getElementById("clientEditButton").style.display = !formStatus ? "none" : "inline";
		}
	}
	
	</script>
	
	<body>
		
		<!-- Navigation Bar -->
		<div id="navBar" class="w3-bar w3-border w3-blue-gray w3-padding-small">
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">(MINI-ICON) TSI </a>
			<a href="/system/clients.php" class="w3-bar-item w3-button w3-border-right">CLIENTS</a>
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
		
		<!-- Admin Moddal -->
		<div id="adminModal" class="w3-modal">
			<div class="w3-modal-content">
				<!-- Modal content -->
				<header class="w3-container w3-blue-gray">
					<h2>Enter Admin Password</h2>
				</header>
				
				<br>
				
				<div class="w3-row-padding">
					<div class="w3-threequarter">
						<input id="adminPass" class="w3-input" type="password" placeholder="Enter Password">
					</div>
					<div class="w3-rest">
						<button onclick="AdminConfirm()" class="w3-button w3-block w3-round-xxlarge w3-blue-gray">Confirm</button>
					</div>
				</div>
				 
				<br>
				 
				<footer class="w3-container w3-blue-gray w3-padding-small">
						<div class="w3-center">
							<button onclick="AdminCancel()" class="w3-button w3-border w3-round-xxlarge w3-blue-gray">Cancel</button>
						</div>
				</footer>
				
			</div>
		</div>
		
		<br>
		
		<!-- Client data display and form -->
		<div class="w3-container">
			<form class="w3-card-2 w3-border" action="/system/functions/update_client.php?client_id=<?php echo $clientProfile; ?>" autocomplete="off" method="post">
				<header class="w3-container w3-blue-gray w3-center">
					<h2>CLIENT GENERAL INFORMATION</h2>
				</header>
				<br>
				
				<label class="w3-padding-small w3-leftbar w3-large w3-text-blue-gray">Contact Information</label>
				<div class="w3-row-padding">
					<div class="w3-third" style="display:<?php echo $client_data[16] == 1 ? "block" : "none"; ?>">
						<label class="w3-text-blue-gray">First Name</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="name_first" value="<?php echo $client_data[2]; ?>"  readonly>
					</div>
					<div class="w3-third" style="display:<?php echo $client_data[16] == 1 ? "block" : "none"; ?>">
						<label class="w3-text-blue-gray">Last Name</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="name_second" value="<?php echo $client_data[3]; ?>"  readonly>
					</div>
					<div class="<?php echo $client_data[16] == 1 ? "w3-third" : "w3-rest"; ?>">
						<label class="w3-text-blue-gray">Business Name</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="name_bsn" value="<?php echo $client_data[4]; ?>" required readonly>
					</div>
				</div>
				
				<div class="w3-row-padding">
					<div class="w3-half">
						<label class="w3-text-blue-gray">Phone Number</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="phone" value="<?php echo $client_data[5]; ?>" required readonly>
					</div>
					<div class="w3-half">
						<label class="w3-text-blue-gray">E-mail address</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="email" value="<?php echo $client_data[6]; ?>" required readonly>
					</div>
				</div>
				
				<label class="w3-padding-small w3-leftbar w3-large w3-text-blue-gray">Garage Information</label>
				<div class="w3-row-padding">
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">Address</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="garage_address" value="<?php echo $client_data[7]; ?>" required readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">City</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="garage_city" value="<?php echo $client_data[8]; ?>" required readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">State</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="garage_state" value="<?php echo $client_data[9]; ?>" required readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">ZIP</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="garage_zip" value="<?php echo $client_data[10]; ?>" required readonly>
					</div>
				</div>
				
				<label class="w3-padding-small w3-leftbar w3-large w3-text-blue-gray">Mail Information</label>
				<div class="w3-row-padding">
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">Address</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="mail_address" value="<?php echo $client_data[11]; ?>" required readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">City</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="mail_city" value="<?php echo $client_data[12]; ?>" required readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">State</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="mail_state" value="<?php echo $client_data[13]; ?>" required readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">ZIP</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="mail_zip" value="<?php echo $client_data[14]; ?>" required readonly>
					</div>
				</div>
				
				<label class="w3-padding-small w3-leftbar w3-large w3-text-blue-gray">Working Information</label>
				<div class="w3-row-padding">
					<div class="w3-half">
						<label class="w3-text-blue-gray">Radius</label>
						<p class="w3-border-bottom"><?php echo $client_data[15]?></p>
						<div id="clientFormRadius" class="w3-row-padding" style="display:none">
							<input class="w3-radio" type="radio" name="radius" value="100" required>
							<label>100</label>
							<input class="w3-radio" type="radio" name="radius" value="200">
							<label>200</label>
							<input class="w3-radio" type="radio" name="radius" value="300">
							<label>300</label>
							<input class="w3-radio" type="radio" name="radius" value="500">
							<label>500</label>
							<input class="w3-radio" type="radio" name="radius" value="11 West">
							<label>11 West</label>
							<input class="w3-radio" type="radio" name="radius" value="48 States">
							<label>48 States</label>
						</div>
					</div>
				</div>
				
				<br>
				
				<label class="w3-padding-small w3-leftbar w3-large w3-text-blue-gray">Finance Information</label>
				<div class="w3-row-padding">
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">Finance A</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="finance_a" value="<?php echo $client_data[17]; ?>" required readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">Finance A - Account Number</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="finance_a_account" value="<?php echo $client_data[18]; ?>" required readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">Finance B</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="finance_b" value="<?php echo $client_data[19]; ?>" required readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">Finance B - Account Number</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="finance_b_account" value="<?php echo $client_data[20]; ?>" required readonly>
					</div>
				</div>

				<br>
				
				<label class="w3-padding-small w3-leftbar w3-large w3-text-blue-gray">Filing Information</label>
				<div class="w3-row-padding">
					<div class="w3-third">
						<label class="w3-text-blue-gray">CA Number</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="filing_ca" value="<?php echo $client_data[21]; ?>" required readonly>
					</div>
					<div class="w3-third">
						<label class="w3-text-blue-gray">MC Number</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="filing_mc" value="<?php echo $client_data[22]; ?>" required readonly>
					</div>
					<div class="w3-third">
						<label class="w3-text-blue-gray">USDOT Number</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="filing_usdot" value="<?php echo $client_data[23]; ?>" required readonly>
					</div>
				</div>
				
				<br>
				
				<div class="container w3-center">
					<button class="clientFormButtons w3-btn w3-blue-gray w3-round-xxlarge" style="display:none">UPDATE CLIENT</button>
				</div>
				
				<br>
					
			</form>
		</div>
		
		<br>
		
		<div class="w3-container w3-center">
			<button id="clientEditButton" onclick="RequestAdminAction(2, new Array('ClientFormStatus'))" class="w3-card-4 w3-button w3-round-xxlarge w3-blue-gray">EDIT CLIENT <i class="fa fa-pencil" style="color:lime"></i></button>
			<button onclick="ClientFormStatus()" class="clientFormButtons w3-card-4 w3-button w3-round-xxlarge w3-red" style="display:none">CANCEL EDIT <i class="fa fa-ban"></i></button>
			<br>
			<br>
			<a href="/system/client_additional_info.php?client_id=<?php echo $clientProfile; ?>">
				<button class="w3-button w3-blue-gray w3-round-xxlarge w3-card-4"> CLIENT´S ADDITIONAL INFO <i class="fa fa-file-text-o"></i></button>
			</a>
		</div>
		<!-- Client update form ending -->
		
		<br>
		
		<!-- Coverages information -->
		<div class="w3-container w3-small">
			<div id="coverOn" class="w3-card-2 w3-border" style="display:none">
				<header class="w3-container w3-blue-gray w3-center">
					<h2><button onclick="document.getElementById('coverOff').style.display='block'; document.getElementById('coverOn').style.display='none'" class="w3-button w3-blue-gray">CLIENT COVERAGES</button></h2>
				</header>
			</div>
			<div id="coverOff" class="w3-card-2 w3-border">
				<header class="w3-container w3-blue-gray w3-center">
					<h2><button onclick="document.getElementById('coverOff').style.display='none'; document.getElementById('coverOn').style.display='block'" class="w3-button w3-blue-gray">CLIENT COVERAGES</button></h2>
				</header>
				
				<br>
				
				<div class="w3-row">
					<div class="w3-container w3-border-bottom">
						<a href="/system/coverage_selection.php?client_id=<?php echo $clientProfile; ?>">
							<button class="w3-right w3-small w3-card-4 w3-button w3-blue-gray w3-round-xxlarge">ADD COVERAGE <i class="fa fa-plus" style="color:lime"></i></button>
						</a>
						<br>
						<br>
					</div>
				</div>
					
				<br>
				
				<!-- Data goes here -->
				
				<?php for($rows = 0; $rows < count($coverages_data); $rows++){; ?>
					<label class="w3-text-blue-gray w3-padding-small w3-leftbar w3-large"><?php echo $coverages_data[$rows][2]; ?></label>
					<div class="w3-row-padding">
						<div class="w3-third">
							<label class="w3-text-blue-gray">Company Name</label>
							<p class="w3-border-bottom"><?php echo $coverages_data[$rows][3]; ?></p>
						</div>
						<div class="w3-third">
							<label class="w3-text-blue-gray">Coverage</label>
							<p class="w3-border-bottom"><?php echo $coverages_data[$rows][4]; ?></p>
						</div>
						<div class="w3-third">
							<label class="w3-text-blue-gray">Deductible</label>
							<p class="w3-border-bottom"><?php echo $coverages_data[$rows][5]; ?></p>
						</div>
					</div>
					<div class="w3-row-padding">
						<div class="w3-third">
							<label class="w3-text-blue-gray">Effective Date</label>
							<p class="w3-border-bottom"><?php echo date("m-d-Y", strtotime($coverages_data[$rows][6])); ?></p>
						</div>
						<div class="w3-third">
							<label class="w3-text-blue-gray">Expiration Date</label>
							<p class="w3-border-bottom"><?php echo date("m-d-Y", strtotime($coverages_data[$rows][7])); ?></p>
						</div>
						<div class="w3-third">
							<label class="w3-text-blue-gray">Policy Number</label>
							<p class="w3-border-bottom"><?php echo $coverages_data[$rows][8]; ?></p>
						</div>
					</div>
					
					<div class="w3-container w3-center w3-border-bottom">
						<!-- <a href="/system/functions/delete_coverage<?php //echo $coverages_data[$rows][9] == 2 ? "_linked" : ""; ?>.php?client_id=<?php //echo $clientProfile; ?>&coverage_id=<?php //echo $coverages_data[$rows][0]; ?>"> -->
							<!-- <button class="w3-small w3-card-4 w3-button w3-blue-gray w3-round-xxlarge">DELETE COVERAGE <i class="fa fa-trash" style="color:red"></i></button> -->
						<!-- </a> -->
					
						<!-- <a href=""> -->
							<!-- <button class="w3-tiny w3-card-4 w3-button w3-blue-gray w3-round-xxlarge">EDIT COVERAGE <i class="fa fa-pencil" style="color:lime"></i></button> -->
						<!-- </a> -->
						
						<button onclick="RequestAdminAction(1,new Array('/system/clients.php'))" class="w3-tiny w3-card-4 w3-button w3-blue-gray w3-round-xxlarge">EDIT COVERAGE <i class="fa fa-pencil" style="color:lime"></i></button>
						
						<p></p>
					</div>
					
					<br>
					
				<?php }; ?>
				
			</div>
		</div>
		<!-- Coverages ending -->
		
		<br>
		
		<!-- Driver information -->
		<div class="w3-container w3-small">
			<div id="driverOn" class="w3-card-2 w3-border" style="display:none">
				<header class="w3-container w3-blue-gray w3-center">
					<h2><button onclick="document.getElementById('driverOff').style.display='block'; document.getElementById('driverOn').style.display='none'" class="w3-button w3-blue-gray">DRIVERS INFORMATION</button></h2>
				</header>
			</div>
			<div id="driverOff"class="w3-card-2 w3-border">
				<header class="w3-container w3-blue-gray w3-center">
					<h2><button onclick="document.getElementById('driverOff').style.display='none'; document.getElementById('driverOn').style.display='block'" class="w3-button w3-blue-gray">DRIVERS INFORMATION</button></h2>
				</header>
				<br>
				
				<div class="w3-row">
					<header class="w3-container w3-center w3-border-bottom">
							<button onclick="document.getElementById('newDriver').style.display='block'" class="w3-card-4 w3-button w3-right w3-tiny w3-round-xxlarge w3-blue-gray">ADD NEW <i class="fa fa-user-plus w3-large" style="color:lime"></i></button>
							<br>
							<br>
					</header>
					<br>
					
					<!-- Table goes here -->
					<table class="w3-table w3-striped w3-small">
						<tr>
							<th>NAME</th>
							<th>LICENCE NUMBER</th>
							<th>STATE</th>
							<th>DATE OF BIRTH</th>
							<th>DATE OF HIRING</th>
							<th>DRIVING EXP.</th>
							<th>ACTION</th>
						</tr>
						
						<?php for($rows = 0; $rows < count($drivers_data); $rows++){; ?>
						<tr>
							<td>
								<?php echo $drivers_data[$rows][2]; ?>
							</td>
							<td>
								<?php echo $drivers_data[$rows][3]; ?>
							</td>
							<td>
								<?php echo $drivers_data[$rows][4]; ?>
							</td>
							
							<!-- Dates -->
							<td>
								<?php echo date("m-d-Y", strtotime($drivers_data[$rows][5])); ?>
							</td>
							<td>
								<?php echo date("m-d-Y", strtotime($drivers_data[$rows][6])); ?>
							</td>
							<!-- Dates ending -->
							
							<td>
								<?php echo $drivers_data[$rows][7]; ?>
							</td>
							
							<!-- Action col -->
							<td>
								<div class="w3-row-padding">
									<!-- <a class="w3-half" href="/system/functions/exclude_driver.php?client_id=<?php //echo $clientProfile; ?>&driver_id=<?php //echo $drivers_data[$rows][0]; ?>&excluded=<?php// echo $drivers_data[$rows][8] == 0 ? 1 : 0; ?>"> -->
										<!-- <button class="w3-button w3-round-xxlarge w3-blue-gray w3-small"><?php// echo $drivers_data[$rows][8] == 0 ? "EXCLUDE" : "RETURN"; ?></button> -->
									<!-- </a> -->
									<button onclick="RequestAdminAction(1,new Array('/system/clients.php'))" class="w3-button w3-round-xxlarge w3-blue-gray ">EDIT <i class="fa fa-pencil" style="color:lime"></i></button>
								</div>
							</td>
						</tr>
						<?php }; ?>
						
					</table>
					
				</div>
				
			</div>
			
		</div>
		
		<!-- New driver moddal -->
		<div id="newDriver" class="w3-modal w3-animate-opacity">
			<div class="w3-modal-content w3-small">
				<!-- Modal content -->
				<header class="w3-container w3-blue-gray">
					<h2>Driver Registration</h2>
				</header>
				
				<form class="w3-container" action="/system/functions/create_driver.php?client_id=<?php echo $clientProfile; ?>" method="post">
					<br>
					<label class="w3-text-blue-gray">Driver Name</label>
					<div class="w3-row-padding">
						<div class="w3-rest">
							<input class="w3-input w3-border" name="name" type="text" placeholder="Driver Name" autofocus required>
						</div>
					</div>
					
					<br>
					
					<label class="w3-text-blue-gray">Driving Licence</label>
					<div class="w3-row-padding">
						<div class="w3-rest">
							<input class="w3-input w3-border" name="licence" type="text" placeholder="Licence Number" required>
						</div>
					</div>
					
					<br>
					
					<label class="w3-text-blue-gray">State</label>
					<div class="w3-row-padding">
						<div class="w3-quarter">
							<input class="w3-radio" type="radio" name="state" value="CA" required>
							<label>CA - California</label>
						</div>
						<div class="w3-quarter">
							<input class="w3-radio" type="radio" name="state" value="AZ" required>
							<label>AZ - Arizona</label>
						</div>
						<div class="w3-quarter">
							<input class="w3-radio" type="radio" name="state" value="NV" required>
							<label>NV - Nevada</label>
						</div>
						<div class="w3-quarter">
							<input class="w3-radio" type="radio" name="state" value="OTHER" required>
							<label>OTHER</label>
						</div>
					</div>
					
					<br>
					
					<label class="w3-text-blue-gray">Additional Information</label>
					<div class="w3-row-padding">
						<div class="w3-third">
							<label class="w3-text-blue-gray">Driving Exp.</label>
							<input class="w3-input w3-border" name="driver_exp" type="text" placeholder="Number of years (e.g. 5)" required>
						</div>
						<div class="w3-third">
							<label class="w3-text-blue-gray">Date of Birth</label>
							<input class="w3-input w3-border" name="dob" type="date" pattern="[0-1][0-9]\/[0-3][0-9]\/[0-9]{4}" placeholder="Enter Date MM/DD/YYYY" title="Please enter Date in format: MM/DD/YYYY" required>
						</div>
						<div class="w3-third">
							<label class="w3-text-blue-gray">Date of Hire</label>
							<input class="w3-input w3-border" name="doh" type="date" pattern="[0-1][0-9]\/[0-3][0-9]\/[0-9]{4}" placeholder="Enter Date MM/DD/YYYY" title="Please enter Date in format: MM/DD/YYYY" required>
						</div>
					</div>
					
					<br>
					
					<button class="w3-btn w3-blue-gray w3-block w3-round-xxlarge">Register</button></p>
					
					<br>
				</form>
				
				<footer class="w3-container w3-blue-gray w3-padding-small">
						<div class="w3-center">
							<button onclick="document.getElementById('newDriver').style.display='none'" class="w3-button w3-border w3-round-xxlarge w3-red" style="width:50%">Cancel</button>
						</div>
				</footer>
				
			</div>
		</div>
		<!-- Driver information Ending -->
		
		<br>
		
		<!-- Vehicle information -->
		<div class="w3-container">
			<div id="vehicleOn" class="w3-card-2 w3-border" style="display:none">
				<header class="w3-container w3-blue-gray w3-center">
					<h2><button onclick="document.getElementById('vehicleOff').style.display='block'; document.getElementById('vehicleOn').style.display='none'" class="w3-button w3-blue-gray">VEHICLES INFORMATION</button></h2>
				</header>
			</div>
			<div id="vehicleOff" class="w3-card-2 w3-border">
				<header class="w3-container w3-blue-gray w3-center">
					<h2><button onclick="document.getElementById('vehicleOff').style.display='none'; document.getElementById('vehicleOn').style.display='block'" class="w3-button w3-blue-gray">VEHICLES INFORMATION</button></h2>
				</header>
				<br>
				
				<div class="w3-row">
					<header class="w3-container w3-center w3-border-bottom">
							<button onclick="document.getElementById('newVehicle').style.display='block'" class="w3-card-4 w3-button w3-right w3-small w3-round-xxlarge w3-blue-gray">ADD NEW <i class="fa fa-truck w3-large" style="color:lime"></i></button>
							<br>
							<br>
					</header>
					<br>
					
					<!-- Table goes here -->
					<table class="w3-table w3-striped w3-small">
						<tr>
							<th>MAKE</th>
							<th>YEAR</th>
							<th>GVW</th>
							<th>MODEL</th>
							<th>VIN</th>
							<th>LIABILITY</th>
							<th>CARGO INSURANCE</th>
							<th>GRAL. LIABILITY</th>
							<th>TRACTOR P.D.</th>
							<th>TRAILER P.D.</th>
							<th>NON OWNED P.D.</th>
							<th>T. INTERCHANGE P.D.</th>
							<th>ACTION</th>
						</tr>
						
						<?php for($rows = 0; $rows < count($vehicles_data); $rows++){; ?>
						<tr>
							
							<?php for($cols = 2; $cols < 7; $cols++){; ?>
							<td>
								<?php echo $vehicles_data[$rows][$cols];} ?>
							</td>
							
							<!-- Coverages -->
							<td>
								<?php 
									$clients_id = $clientProfile;
									$type_id = 1;
									
									require $_SERVER["DOCUMENT_ROOT"] . "/system/functions/coverages_cover_value.php";
									
									echo count($cover_value) > 0 ? "$".$cover_value[0][0] : "N / A";
								?>
							</td>
							<td>
								<?php 
									$clients_id = $clientProfile;
									$type_id = 2;
									
									require $_SERVER["DOCUMENT_ROOT"] . "/system/functions/coverages_cover_value.php";
									
									echo count($cover_value) > 0 ? "$".$cover_value[0][0] : "N / A";
								?>
							</td>
							<td>
								<?php 
									$clients_id = $clientProfile;
									$type_id = 3;
									
									require $_SERVER["DOCUMENT_ROOT"] . "/system/functions/coverages_cover_value.php";
									
									echo count($cover_value) > 0 ? "$".$cover_value[0][0] : "N / A";
								?>
							</td>
							<td>
								<?php 
									$vehicle_id = $vehicles_data[$rows][0];
									$clients_id = $clientProfile;
									$type_id = 4;
									
									require $_SERVER["DOCUMENT_ROOT"] . "/system/functions/coverages_cover_value_linked.php";
									
									echo count($cover_value) > 0 ? "$".$cover_value[0][0] : "N / A";
								?>
							</td>
							<td>
								<?php 
									$vehicle_id = $vehicles_data[$rows][0];
									$clients_id = $clientProfile;
									$type_id = 5;
									
									require $_SERVER["DOCUMENT_ROOT"] . "/system/functions/coverages_cover_value_linked.php";
									
									echo count($cover_value) > 0 ? "$".$cover_value[0][0] : "N / A";
								?>
							</td>
							<td>
								<?php 
									$vehicle_id = $vehicles_data[$rows][0];
									$clients_id = $clientProfile;
									$type_id = 6;
									
									require $_SERVER["DOCUMENT_ROOT"] . "/system/functions/coverages_cover_value_linked.php";
									
									echo count($cover_value) > 0 ? "$".$cover_value[0][0] : "N / A";
								?>
							</td>
							<td>
								<?php 
									$vehicle_id = $vehicles_data[$rows][0];
									$clients_id = $clientProfile;
									$type_id = 7;
									
									require $_SERVER["DOCUMENT_ROOT"] . "/system/functions/coverages_cover_value_linked.php";
									
									echo count($cover_value) > 0 ? "$".$cover_value[0][0] : "N / A";
								?>
							</td>
							
							<!-- Action col -->
							<td class="w3-center">
								<!-- <a href="/system/functions/delete_vehicle.php?client_id=<?php //echo $clientProfile; ?>&vehicle_id=<?php// echo $vehicles_data[$rows][0]; ?>"> -->
									<!-- <button class="w3-button w3-round-xxlarge w3-blue-gray" <?php// echo $vehicles_data[$rows][10] > 0 ? "disabled" : ""; ?>>DELETE <i class="fa fa-trash-o" style="color:red"></i></button> -->
								<!-- </a> -->
								<button onclick="RequestAdminAction(1,new Array('/system/clients.php'))" class="w3-button w3-block w3-round-xxlarge w3-blue-gray">EDIT <i class="fa fa-pencil" style="color:lime"></i></button>
							</td>
						</tr>
						<?php }; ?>
						
					</table>
					
				</div>
				
			</div>
			
		</div>
		
		<br>
		
		<!-- New vehicle moddal -->
		<div id="newVehicle" class="w3-modal w3-animate-opacity">
			<div class="w3-modal-content w3-small">
				<!-- Modal content -->
				<header class="w3-container w3-blue-gray">
					<h2>Vehicle Registration</h2>
				</header>
				
				<form class="w3-container" action="/system/functions/create_vehicle.php?client_id=<?php echo $clientProfile; ?>" method="post">
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
					
					<label class="w3-text-blue-gray">Model</label>
					<div class="w3-row-padding">
						<div class="w3-quarter">
							<input class="w3-radio" type="radio" name="model" value="Tractor" required>
							<label>TRACTOR</label>
						</div>
						<div class="w3-quarter">
							<input class="w3-radio" type="radio" name="model" value="Trailer" required>
							<label>TRAILER</label>
						</div>
						<div class="w3-quarter">
							<input class="w3-radio" type="radio" name="model" value="Non Owned" required>
							<label>NON OWNED</label>
						</div>
						<div class="w3-quarter">
							<input class="w3-radio" type="radio" name="model" value="Interchage" required>
							<label>INTERCHANGE</label>
						</div>
					</div>
					
					<br>
					
					<div class="w3-row-padding">
						<div class="w3-rest">
							<label class="w3-text-blue-gray">VIN</label>
							<input class="w3-input w3-border" name="vin" type="text" placeholder="Vehicle Id. Number" required>
						</div>
					</div>
					
					<br>
					
					<!-- <label class="w3-text-blue-gray">Additional Information</label> -->
					<!-- <br> -->
					<!-- <label class="w3-text-blue-gray">P. Damage</label> -->
					<div class="w3-row-padding" style="display:none">
						<div class="w3-rest">
							<input class="w3-input w3-border" name="p_damage" type="text" placeholder="P. Damage Value" value="">
						</div>
					</div>
					
					<!-- <label class="w3-text-blue-gray">Deductible</label> -->
					<div class="w3-row-padding" style="display:none">
						<div class="w3-quarter">
							<input class="w3-radio" type="radio" name="deductible" value="N / A" selected>
							<label>N / A</label>
						</div>
						<div class="w3-quarter">
							<input class="w3-radio" type="radio" name="deductible" value="1,000" >
							<label>1,000</label>
						</div>
						<div class="w3-quarter">
							<input class="w3-radio" type="radio" name="deductible" value="2,500" >
							<label>2,500</label>
						</div>
						<div class="w3-quarter">
							<input class="w3-radio" type="radio" name="deductible" value="5,000" >
							<label>5,000</label>
						</div>
					</div>
					
					<br>
					
					<button class="w3-btn w3-blue-gray w3-block w3-round-xxlarge">Register</button></p>
					
					<br>
				</form>
				
				<footer class="w3-container w3-blue-gray w3-padding-small">
						<div class="w3-center">
							<button onclick="document.getElementById('newVehicle').style.display='none'" class="w3-button w3-border w3-round-xxlarge w3-red" style="width:50%">Cancel</button>
						</div>
				</footer>
				
			</div>
		</div>
		<!-- Vehicle information Ending -->
		
		<?php $db_conn->close(); ?>
		<script src="/system/functions/admin_confirmation.js"></script>
	</body>
	
</html>