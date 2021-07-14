<?php
	session_start();
	
	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
	
	$clientProfile = $_GET["client_id"];
	$coverName = $_GET["cover"];
	$type_id = $_GET["type"];
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/uncovered_vehicles_data.php";
	
	$db_conn->close();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - COVERAGE ENTRY</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	</head>
	
	<body>
		
		<!-- Navigation Bar -->
		<div id="navBar" class="w3-bar w3-border w3-blue-gray w3-padding-small">
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">(MINI-ICON) TSI </a>
			<a href="/system/clients.php" class="w3-bar-item w3-button w3-border-right">CLIENTS</a>
			<a href="/system/coverage_selection.php?client_id=<?php echo $clientProfile?>" class="w3-bar-item w3-button w3-border-right">RETURN TO SELECTION</a>
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
		
		<!-- Coverage information -->
		<div id="newCoverage" class="w3-container">
			<div class="w3-card-2 w3-border">
				<!-- Modal content -->
				<header class="w3-container w3-blue-gray">
					<h2>Coverage Registration</h2>
				</header>
				
				<form class="w3-container" action="/system/functions/create_coverage_linked.php?client_id=<?php echo $clientProfile; ?>&type_id=<?php echo $type_id; ?>" method="post">
					<br>
					<label class="w3-text-blue-gray">Coverage Type</label>
					<div class="w3-row-padding">
						<div class="w3-rest">
							<input class="w3-input w3-border-bottom" name="cover_type" type="text" value="<?php echo $coverName; ?>" readonly>
						</div>
					</div>
					
					<br>
					
					<label class="w3-text-blue-gray">Company</label>
					<input class="w3-input w3-border" type="text" name="company" placeholder="Enter Insurance Company Name" required>
					
					<br>
					
					<label class="w3-text-blue-gray">Policy Number</label>
					<input class="w3-input w3-border" type="text" name="policy_number" placeholder="Enter Policy Number" required>
					
					<br>
					
					<label class="w3-text-blue-gray">Deductible</label>
					<div class="w3-row-padding">
						<div class="w3-quarter">
							<input class="w3-radio" type="radio" name="deductible" value="N/A" required>
							<label>N / A</label>
						</div>
						<div class="w3-quarter">
							<input class="w3-radio" type="radio" name="deductible" value="1,000" required>
							<label>1,000</label>
						</div>
						<div class="w3-quarter">
							<input class="w3-radio" type="radio" name="deductible" value="2,500" required>
							<label>2,500</label>
						</div>
						<div class="w3-quarter">
							<input class="w3-radio" type="radio" name="deductible" value="5,000" required>
							<label>5,000</label>
						</div>
					</div>
					
					<br>
					
					<label class="w3-text-blue-gray">Date Information</label>
					<div class="w3-row-padding">
						<div class="w3-half">
							<label class="w3-text-blue-gray">Effective Date</label>
							<input class="w3-input w3-border" name="eff_date" type="date" pattern="[0-1][0-9]\/[0-3][0-9]\/[0-9]{4}" placeholder="Enter Date MM/DD/YYYY" title="Please enter Date in format: MM/DD/YYYY" required>
						</div>
						<div class="w3-half">
							<label class="w3-text-blue-gray">Expiration Date</label>
							<input class="w3-input w3-border" name="exp_date" type="date" pattern="[0-1][0-9]\/[0-3][0-9]\/[0-9]{4}" placeholder="Enter Date MM/DD/YYYY" title="Please enter Date in format: MM/DD/YYYY" required>
						</div>
					</div>
					
					<br>
					<header class="w3-container w3-blue-gray">
						<h2>Covered Vehicles</h2>
					</header>
					<br>
					
					<!-- Vehicles table goes here -->
					<table class="w3-table w3-striped">
						<tr>
							<th>SELECTED</th>
							<th>MAKE</th>
							<th>YEAR</th>
							<th>MODEL</th>
							<th>VIN</th>
							<th>COVERAGE</th>
						</tr>
						<?php for($rows = 0; $rows < count($vehicles_data); $rows++){; ?>
							<?php if($vehicles_data[$rows][23] != $type_id || $vehicles_data[$rows][23] == null ){;?>
							<tr>
								<!-- Checkbox -->
								<td class="w3-center"> 
									<input class="w3-input" type="checkbox" name="vehicles[]" value="<?php echo $vehicles_data[$rows][0]; ?>" onchange="document.getElementById('btnfinal').disabled=false;
																																						document.getElementById('coverageValue<?php echo $vehicles_data[$rows][0]; ?>').disabled=this.checked ? false : true;
																																						document.getElementById('coverageValue<?php echo $vehicles_data[$rows][0]; ?>').innerHTML='';
																																						document.getElementById('coverageValue<?php echo $vehicles_data[$rows][0]; ?>').required=this.checked ? true : false;">
								</td>
								<td><?php echo $vehicles_data[$rows][2]; ?></td>
								<td><?php echo $vehicles_data[$rows][3]; ?></td>
								<td><?php echo $vehicles_data[$rows][5]; ?></td>
								<td><?php echo $vehicles_data[$rows][6]; ?></td>
								<td>
									<input id="coverageValue<?php echo $vehicles_data[$rows][0]; ?>" class="w3-input" type="number" name="cover_values[]" min="0" placeholder="Enter amount" pattern="[a-zA-Z]{0}" title="Enter just numeric values" disabled>
								</td>
							</tr>
							<?php };?>
						<?php }; ?>
					</table>
					
					<br>
					<button id="btnfinal" class="w3-btn w3-blue-gray w3-block w3-round-xxlarge" disabled>Register</button></p>
					<br>
					
				</form>
				
				<footer class="w3-container w3-blue-gray w3-padding-small">
						<div class="w3-center">
							<a href="/system/coverage_selection.php?client_id=<?php echo $clientProfile; ?>">
								<button class="w3-button w3-border w3-round-xxlarge w3-red" style="width:50%">Cancel</button>
							</a>
						</div>
				</footer>
				
			</div>
		</div>
		
	</body>
	
</html>