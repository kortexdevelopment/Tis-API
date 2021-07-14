<?php
	session_start();
	
	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
	
	$clientProfile = $_GET["client_id"];
	$typeid = $_GET["type"];
	$coverName = $_GET["cover"];
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
	
	<script>
	
	$(document).ready
	(
		function()
		{
			var Option = <?php echo $typeid; ?>;
			
			switch(Option)
			{
				case 1:
					$('#baseCover').show();
					$('#freeCover').hide();
					$('#coverRadio').prop('required', true);
					$('#coverText').prop('required', false);
					break;
				default:
					$('#baseCover').hide();
					$('#freeCover').show();
					$('#coverRadio').prop('required', false);
					$('#coverText').prop('required', true);
			}
		}
	);
	
	</script>
	
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
				
				<form class="w3-container" action="/system/functions/create_coverage.php?client_id=<?php echo $clientProfile; ?>&type_id=<?php echo $typeid; ?>" method="post">
					<br>
					<label class="w3-text-blue-gray">Coverage Type</label>
					<div class="w3-row-padding">
						<div class="w3-rest">
							<input class="w3-input w3-border-bottom" name="cover_type" type="text" value="<?php echo $coverName; ?>" readonly>
						</div>
					</div>
					
					<br>
					
					<label class="w3-text-blue-gray">Company</label>
					<input class="w3-input w3-border" type="text" name="company" placeholder="Insurance Company Name" required>
					
					<br>
					
					<label class="w3-text-blue-gray">Policy Number</label>
					<input class="w3-input w3-border" type="text" name="policy_number" placeholder="Insurance Company Name" required>
					
					<br>
					
					<label class="w3-text-blue-gray">Coverage</label>
					
					<div id="freeCover" style="display:none">
						<input id="coverText" class="w3-input w3-border" name="coverage" type="text" placeholder="Enter coverage amount">
					</div>
					
					<div id="baseCover" class="w3-row-padding" style="display:none">
						<div class="w3-quarter">
							<input id="coverRadio" class="w3-radio" type="radio" name="coverage" value="750,000">
							<label>750,000</label>
						</div>
						<div class="w3-quarter">
							<input class="w3-radio" type="radio" name="coverage" value="1,000,000">
							<label>1,000,000</label>
						</div>
					</div>
					
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
					
					<button class="w3-btn w3-blue-gray w3-block w3-round-xxlarge">Register</button></p>
					
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