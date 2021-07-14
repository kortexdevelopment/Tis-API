<?php
	session_start();

	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false || !isset($_SESSION["client_app"]))
	{
		header("location: /_index.php");
		exit;
	}

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$client_id = $_SESSION["client_id"];
	
	$sql = "SELECT * FROM clients WHERE id = {$client_id}";
	
	$query_result = $db_conn->query($sql);
	
	$client_data = $query_result->fetch_array(MYSQLI_NUM);
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - Client App Index</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>

	<body>

		<!-- Navigation Bar -->
		<div id="navBar" class="w3-bar w3-border w3-blue-gray w3-padding-small">
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">(MINI-ICON) TSI </a>
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
					<h3>Are you sure you want to log out from the app?</h3>
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
				<h2>MAIN MENU</h2>
			</header>
			
			<br>
			
			<div class="w3-row w3-border">
				<header class="w3-container w3-center w3-border-bottom w3-blue-gray">
					<h3>Welcome</h3>
				</header>
				<br>
				<label class="w3-text-blue-gray">CONCTACT INFO</label>
				<div class="w3-row-padding">
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">Name</label>
						<input class="w3-input w3-border-bottom" type="text" value="<?php echo $client_data[2]; ?>" readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">Last Name</label>
						<input class="w3-input w3-border-bottom" type="text" value="<?php echo $client_data[3]; ?>" readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">B.S.N.</label>
						<input class="w3-input w3-border-bottom" type="text" value="<?php echo $client_data[4]; ?>" readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">Contact Phone</label>
						<input class="w3-input w3-border-bottom" type="text" value="<?php echo $client_data[5]; ?>" readonly>
					</div>
				</div>

				<label class="w3-text-blue-gray">ADDRES INFO</label>
				<div class="w3-row-padding">
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">Address</label>
						<input class="w3-input w3-border-bottom" type="text" value="<?php echo $client_data[11]; ?>" readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">City</label>
						<input class="w3-input w3-border-bottom" type="text" value="<?php echo $client_data[12]; ?>" readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">State</label>
						<input class="w3-input w3-border-bottom" type="text" value="<?php echo $client_data[13]; ?>" readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">ZIP</label>
						<input class="w3-input w3-border-bottom" type="text" value="<?php echo $client_data[14]; ?>" readonly>
					</div>
				</div>
					
				<br>
				
			</div>
			
			<br>
			<br>
			
			<div class="w3-row">
				<header class="w3-container w3-center w3-border-bottom">
					<h3>Please select the task you want</h3>
				</header>
				<br>
				<div class="w3-col w3-hide-small w3-container s2 m2 l2"></div>
				
				<div class="w3-col w3-container w3-mobile s6 m4 l4">
					<div class="w3-card-4 w3-border w3-center">
						<header class="w3-container w3-center w3-blue-gray">
							<h4>CERTIFICATES</h3>
						</header>
						<br>
						<i class="fa fa-id-card-o w3-jumbo" aria-hidden="true"></i>
						<br>
						<br>
						<a href="/system/certificates_index.php" class="w3-center">
							<button class="w3-button w3-blue-gray w3-round-xxlarge">GENERATE</button>
						</a>
						<br>
						<br>
					</div>
				</div>
				
				<div class="w3-col w3-hide-small w3-container s2 m2 l2"></div>
				
				<div class="w3-col w3-container w3-mobile s6 m4 l4">
					<div class="w3-card-4 w3-border w3-center">
						<header class="w3-container w3-center w3-blue-gray">
							<h4>DOCUMENTATION</h3>
						</header>
						<br>
						<i class="fa fa-files-o w3-jumbo" aria-hidden="true"></i>
						<br>
						<br>
						<a href="/system/client_docs_stored.php?client_id=<?php echo $_SESSION["client_id"]; ?>" class="w3-center">
							<button class="w3-button w3-blue-gray w3-round-xxlarge">GO TO LIBRARY</button>
						</a>
						<br>
						<br>
					</div>
				</div>
				
				<div class="w3-col w3-hide-small w3-container s2 m2 l2"></div>
			</div>
		</div>
		
		<br>
		<br>
		<br>
		
	</body>

</html>