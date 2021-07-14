<?php
	session_start();
	
	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
	
	$client_id = $_GET["client_id"];
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - Coverage Selection</title>
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
				<i class="fa fa-user"></i> <?php echo $_SESSION["user_name"]; ?>
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
				<h2>COVERAGES</h2>
			</header>
			
			<div class="w3-row">
				<header class="w3-container w3-center w3-border-bottom">
					<h3>Please select the coverage you want</h3>
				</header>
				<br>
				
				<div class="w3-row-padding">
					<div class="w3-third">
						<a class="w3-block w3-button w3-blue-gray w3-round-xxlarge w3-xlarge" href="/system/coverage_entry.php?client_id=<?php echo $client_id; ?>&cover=Liability Insurance&type=1">
							Liability Insurance
						</a>
					</div>
					<div class="w3-third">
						<a class="w3-block w3-button w3-blue-gray w3-round-xxlarge w3-xlarge" href="/system/coverage_entry.php?client_id=<?php echo $client_id; ?>&cover=Cargo Insurance Policy&type=2">
							Cargo Insurance Policy
						</a>
					</div>
					<div class="w3-third">
						<a class="w3-block w3-button w3-blue-gray w3-round-xxlarge w3-xlarge" href="/system/coverage_entry.php?client_id=<?php echo $client_id; ?>&cover=General Liability Insurance&type=3">
							General Liability Insurance
						</a>
					</div>
				</div>
				
				<br>
				<br>
				
				<div class="w3-row-padding">
					<div class="w3-third">
						<a class="w3-block w3-button w3-blue-gray w3-round-xxlarge w3-xlarge" href="/system/linked_coverage_entry.php?client_id=<?php echo $client_id; ?>&cover=Tractor Physical Damage&type=4">
							Tractor Physical Damage
						</a>
					</div>
					<div class="w3-third">
						<a class="w3-block w3-button w3-blue-gray w3-round-xxlarge w3-xlarge" href="/system/linked_coverage_entry.php?client_id=<?php echo $client_id; ?>&cover=Trailer Physical Damage&type=5">
							Trailer Physical Damage
						</a>
					</div>
					<div class="w3-third">
						<a class="w3-block w3-button w3-blue-gray w3-round-xxlarge w3-xlarge" href="/system/linked_coverage_entry.php?client_id=<?php echo $client_id; ?>&cover=Non Owned Physical Damage&type=6">
							Non Owned Physical Damage
						</a>
					</div>
				</div>
				
				<br>
				<br>
				
				<div class="w3-row-padding">
					<div class="w3-rest">
						<a class="w3-block w3-button w3-blue-gray w3-round-xxlarge w3-xlarge" href="/system/linked_coverage_entry.php?client_id=<?php echo $client_id; ?>&cover=Trailer Interchange Physical Damage&type=7">
							Trailer Interchange Physical Damage
						</a>
					</div>
				</div>
				
			</div>
		</div>
		
	</body>
	
</html>