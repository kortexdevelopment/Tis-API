<?php
	session_start();

	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/agency_data.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - AGENCY PROFILE</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>

	<body>

		<!-- Navigation Bar -->
		<div id="navBar" class="w3-bar w3-border w3-blue-gray w3-padding-small">
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">(MINI-ICON) TSI </a>
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">RETURN</a>
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
				<h2>AGENCY INFORMATION</h2>
			</header>

			<label class="w3-text-blue-gray w3-border-bottom">GENERAL INFO</label>
			<div class="w3-row-padding w3-container">
				<div class="w3-half">
					<label class="w3-text-blue-gray">PRODUCER NAME</label>
					<div class="w3-input"><?php echo $agency_data[1]; ?></div>
				</div>
				<div class="w3-half">
					<label class="w3-text-blue-gray">LICENSE NUMBER</label>
					<div class="w3-input"><?php echo $agency_data[2]; ?></div>
				</div>
			</div>
			
			<br>

			<label class="w3-text-blue-gray w3-border-bottom">CONTACT INFO</label>
			<div class="w3-row-padding w3-container">
				<div class="w3-third">
					<label class="w3-text-blue-gray">PHONE NUMBER</label>
					<div class="w3-input"><?php echo explode(":",$agency_data[3])[0]; ?></div>
				</div>
				<div class="w3-third">
					<label class="w3-text-blue-gray">FAX NUMBER</label>
					<div class="w3-input"><?php echo $agency_data[4]; ?></div>
				</div>
				<div class="w3-third">
					<label class="w3-text-blue-gray">E-MAIL</label>
					<div class="w3-input"><?php echo explode(":",$agency_data[3])[1]; ?></div>
				</div>
			</div>

			<br>

			<label class="w3-text-blue-gray w3-border-bottom">LOCATION INFO</label>
			<div class="w3-row-padding w3-container">
				<div class="w3-quarter">
					<label class="w3-text-blue-gray">ADDRESS</label>
					<div class="w3-input"><?php echo $agency_data[5]; ?></div>
				</div>
				<div class="w3-quarter">
					<label class="w3-text-blue-gray">CITY</label>
					<div class="w3-input"><?php echo $agency_data[6]; ?></div>
				</div>
				<div class="w3-quarter">
					<label class="w3-text-blue-gray">STATE</label>
					<div class="w3-input"><?php echo $agency_data[7]; ?></div>
				</div>
				<div class="w3-quarter">
					<label class="w3-text-blue-gray">ZIP</label>
					<div class="w3-input"><?php echo $agency_data[8]; ?></div>
				</div>
			</div>

		</div>

		<br>
		<br>

		<div class="w3-container">
			<header class="w3-blue-gray w3-center">
				<h2>MANAGEMENT</h2>
			</header>

			<div class="w3-row">
				<header class="w3-container w3-center w3-border-bottom">
					<h3>Please select the task you want</h3>
				</header>
				<br>
				
				<div class="w3-col w3-container s4 m4 l4"></div>

				<div class="w3-col w3-container s4 m4 l4">
					<div class="w3-card-4 w3-border w3-center">
						<header class="w3-container w3-center w3-blue-gray">
							<h4>ACCESS CREDENTIALS</h3>
						</header>
						<br>
						<i class="fa fa-id-badge w3-jumbo" aria-hidden="true"></i>
						<br>
						<br>
						<a href="/system/agency_users.php" class="w3-center"><button class="w3-button w3-blue-gray w3-round-xxlarge">GO TO CREDENTIALS</button></a>
						<br>
						<br>
					</div>
				</div>
				
			</div>

		</div>

		<br>
		<br>

	</body>

</html>