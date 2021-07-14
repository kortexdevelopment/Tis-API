<?php
	session_start();
	
	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
	
	$client_id = $_GET["client_id"];
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/client_extra_data.php";
	
	$db_conn->close();
	
	// $data_aviable = $client_data_extra == null;
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - ADDITIONAL INFO</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	
	<body>
		
		<!-- Navigation Bar -->
		<div id="navBar" class="w3-bar w3-border w3-blue-gray w3-padding-small">
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">(MINI-ICON) TSI </a>
			<a href="/system/clients.php" class="w3-bar-item w3-button w3-border-right">CLIENTS</a>
			<a href="/system/client_profile.php?client_id=<?php echo $client_id?>" class="w3-bar-item w3-button w3-border-right">RETURN TO PROFILE</a>
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
			<form class="w3-card-4" action="/system/functions/<?php echo $client_data_extra[0] != null ? "update" : "create"?>_client_extra_data.php?client_id=<?php echo $client_id; ?><?php echo $client_data_extra[0] != null ? "&id={$client_data_extra[0]}" : ""?>" autocomplete="off" method="post">
				<header class="w3-blue-gray w3-center">
					<h2>ADDITIONAL INFORMATION</h2>
				</header>
				
				<br>
				
				<div class="w3-row-padding">
					<div class="w3-half">
						<label class="w3-text-blue-gray">Years in Bussines</label>
						<input class=" w3-input w3-border-bottom" type="text" name="bsn_year" placeholder="Enter data" value="<?php echo $client_data_extra[2]; ?>"  >
					</div>
					<div class="w3-half">
						<label class="w3-text-blue-gray">Year Bussines Started</label>
						<input class=" w3-input w3-border-bottom" type="text" name="bsn_start" placeholder="Enter data" value="<?php echo $client_data_extra[3]; ?>"  >
					</div>
				</div>
				<br>
				<div class="w3-row-padding">
					<div class="w3-rest">
						<label class="w3-text-blue-gray w3-leftbar">Commodity #1</label>
						<input class=" w3-input w3-border-bottom" type="text" name="commodity_a" placeholder="Enter data" value="<?php echo $client_data_extra[5]; ?>"  >
					</div>
				</div>
				
				<div class="w3-row-padding">
					<div class="w3-half">
						<label class="w3-text-blue-gray">Average Value</label>
						<input class="w3-input w3-border-bottom" type="text" name="value_average_a" placeholder="Enter data" value="<?php echo $client_data_extra[17]; ?>"  >
					</div>
					<div class="w3-half">
						<label class="w3-text-blue-gray">Max Value</label>
						<input class="w3-input w3-border-bottom" type="text" name="value_max_a" placeholder="Enter data" value="<?php echo $client_data_extra[19]; ?>"  >
					</div>
				</div>
				<br>
				
				<div class="w3-row-padding">
					<div class="w3-rest">
						<label class="w3-text-blue-gray w3-leftbar">Commodity #2</label>
						<input class=" w3-input w3-border-bottom" type="text" name="commodity_b" placeholder="Enter data" value="<?php echo $client_data_extra[6]; ?>"  >
					</div>
				</div>
				<div class="w3-row-padding">
					<div class="w3-half">
						<label class="w3-text-blue-gray">Average Value</label>
						<input class="w3-input w3-border-bottom" type="text" name="value_average_b" placeholder="Enter data" value="<?php echo $client_data_extra[18]; ?>"  >
					</div>
					<div class="w3-half">
						<label class="w3-text-blue-gray">Max Value</label>
						<input class="w3-input w3-border-bottom" type="text" name="value_max_b" placeholder="Enter data" value="<?php echo $client_data_extra[20]; ?>"  >
					</div>
				</div>
				<br>
				<div class="w3-row-padding">
					<div class="w3-third">
						<label class="w3-text-blue-gray">No. of Moving Violations</label>
						<input class=" w3-input w3-border-bottom" type="text" name="moving_violations" placeholder="Enter data" value="<?php echo $client_data_extra[7]; ?>"  >
					</div>
					<div class="w3-third">
						<label class="w3-text-blue-gray">No. of Accidents</label>
						<input class=" w3-input w3-border-bottom" type="text" name="accidents" placeholder="Enter data" value="<?php echo $client_data_extra[8]; ?>"  >
					</div>
					<div class="w3-third">
						<label class="w3-text-blue-gray">No. of Estimated Annual Miles</label>
						<input class=" w3-input w3-border-bottom" type="text" name="anual_miles" placeholder="Enter data" value="<?php echo $client_data_extra[9]; ?>"  >
					</div>
				</div>
				<br>
				<div class="w3-row-padding">
					<div class="w3-rest">
						<label class="w3-text-blue-gray w3-leftbar">Prior Carrier</label>
						<input class=" w3-input w3-border-bottom" type="text" name="prior_carrier" placeholder="Enter data" value="<?php echo $client_data_extra[4]; ?>"  >
					</div>
				</div>
				<br>
				<label class="w3-text-blue-gray w3-leftbar">Effective Dates</label>
				<div class="w3-row-padding">
					<div class="w3-half">
						<label class="w3-text-blue-gray">From Date</label>
						<input class="w3-input w3-border-bottom" name="date_from" type="text" pattern="[0-1][0-9]\/[0-3][0-9]\/[0-9]{4}|[0-9]{4}-[0-1][0-9]-[0-3][0-9]" placeholder="Enter Date MM/DD/YYYY" title="Please enter Date in format: MM/DD/YYYY"  value="<?php echo $client_data_extra[10] != null ? date("m/d/Y", strtotime($client_data_extra[10])) : ""; ?>" required>
					</div>
					<div class="w3-half">
						<label class="w3-text-blue-gray">To Date</label>
						<input class="w3-input w3-border-bottom" name="date_to" type="text" pattern="[0-1][0-9]\/[0-3][0-9]\/[0-9]{4}|[0-9]{4}-[0-1][0-9]-[0-3][0-9]" placeholder="Enter Date MM/DD/YYYY" title="Please enter Date in format: MM/DD/YYYY"  value="<?php echo $client_data_extra[11] != null ? date("m/d/Y", strtotime($client_data_extra[11])) : ""; ?>" required>
					</div>
				</div>
				<br>
				<div class="w3-row-padding">
					<div class="w3-half">
						<label class="w3-text-blue-gray">Policy Number</label>
						<input class="w3-input w3-border-bottom" type="text" name="policy" placeholder="Enter data" value="<?php echo $client_data_extra[12]; ?>"  >
					</div>
					<div class="w3-half">
						<label class="w3-text-blue-gray">Coverage Type</label>
						<input class="w3-input w3-border-bottom" type="text" name="coverage_type" placeholder="Enter data" value="<?php echo $client_data_extra[13]; ?>"  >
					</div>
				</div>
				<br>
				<label class="w3-text-blue-gray w3-leftbar">Losses</label>
				<div class="w3-row-padding">
					<div class="w3-third">
						<label class="w3-text-blue-gray">No. of Losses</label>
						<input class=" w3-input w3-border-bottom" type="text" name="losses" placeholder="Enter data" value="<?php echo $client_data_extra[14]; ?>"  >
					</div>
					<div class="w3-third">
						<label class="w3-text-blue-gray">Loss Amount</label>
						<input class=" w3-input w3-border-bottom" type="text" name="loss_amount" placeholder="Enter data" value="<?php echo $client_data_extra[15]; ?>"  >
					</div>
					<div class="w3-third">
						<label class="w3-text-blue-gray">Driver Involved</label>
						<input class=" w3-input w3-border-bottom" type="text" name="loss_drivers" placeholder="Enter data" value="<?php echo $client_data_extra[16]; ?>"  >
					</div>
				</div>
				
				<br>
				
				<div class="container w3-center">
					<button class="w3-btn w3-blue-gray w3-round-xxlarge" <?php echo $_SESSION["user_type"] <= 1 ? "title='Only admin users can edit client information' disabled" : ""?>>UPDATE INFORMATION</button>
				</div>
				
			</form>
		</div>
		
	</body>
	
</html>