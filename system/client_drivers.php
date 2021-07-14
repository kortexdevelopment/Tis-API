<?php
	session_start();
	
	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
	
	$client_id = $_GET["client_id"];

	if(isset($_GET["driver_id"]))
	{
		require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/driver_data.php";
		//Date convertion
		$temp_date = new DateTime($driver_data[5]);
		$dob = $temp_date->format('m/d/Y');
		$temp_date = new DateTime($driver_data[6]);
		$doh = $temp_date->format('m/d/Y');
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/drivers_data.php";
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - CLIENT DRIVERS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>

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
				<h2>CLIENT DRIVERS</h2>
			</header>
			
			<br>
			
			<div class="w3-container w3-border w3-small" style="display:<?php echo isset($_GET["driver_id"]) ? "none" : "block"; ?>">
				
				<header class="w3-container w3-center w3-border-bottom">
					<h4 id="add">DRIVER REGISTRATION</h4>
				</header>
				
				<form class="w3-container" action="/system/functions/create_driver.php?client_id=<?php echo $client_id; ?>" method="post">
					<br>
					<div class="w3-row-padding">
						<div class="w3-half">
							<label class="w3-text-blue-gray">Driver Name</label>
							<input class="w3-input w3-border" name="name" type="text" placeholder="Driver Name" autofocus required>
						</div>
						<div class="w3-half">
							<label class="w3-text-blue-gray">Driving Licence</label>
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
				
			</div>
			
			<div class="w3-container w3-border w3-small" style="display:<?php echo isset($_GET["driver_id"]) ? "block" : "none"; ?>">
				
				<header class="w3-container w3-center w3-border-bottom">
					<h4 id="add">DRIVER UPDATE</h4>
				</header>
				
				<form class="w3-container" action="/system/functions/update_driver.php?client_id=<?php echo $client_id; ?>&driver_id=<?php echo $driver_id; ?>" method="post">
					<br>
					<div class="w3-row-padding">
						<div class="w3-half">
							<label class="w3-text-blue-gray">Driver Name</label>
							<input class="w3-input w3-border" name="name" type="text" placeholder="Driver Name" value="<?php echo $driver_data[2]; ?>" autofocus required>
						</div>
						<div class="w3-half">
							<label class="w3-text-blue-gray">Driving Licence</label>
							<input class="w3-input w3-border" name="licence" type="text" placeholder="Licence Number" value="<?php echo $driver_data[3]; ?>" required>
						</div>
					</div>
					
					<br>
					
					<label class="w3-text-blue-gray">State</label>
					<div class="w3-row-padding">
						<div class="w3-quarter">
							<input class="w3-radio" type="radio" name="state" value="CA" required <?php echo $driver_data[4] == "CA" ? "checked" : ""; ?>>
							<label>CA - California</label>
						</div>
						<div class="w3-quarter">
							<input class="w3-radio" type="radio" name="state" value="AZ" required <?php echo $driver_data[4] == "AZ" ? "checked" : ""; ?>>
							<label>AZ - Arizona</label>
						</div>
						<div class="w3-quarter">
							<input class="w3-radio" type="radio" name="state" value="NV" required <?php echo $driver_data[4] == "NV" ? "checked" : ""; ?>>
							<label>NV - Nevada</label>
						</div>
						<div class="w3-quarter">
							<input class="w3-radio" type="radio" name="state" value="OTHER" required <?php echo $driver_data[4] == "OTHER" ? "checked" : ""; ?>>
							<label>OTHER</label>
						</div>
					</div>
					
					<br>
					
					<label class="w3-text-blue-gray">Additional Information</label>
					<div class="w3-row-padding">
						<div class="w3-third">
							<label class="w3-text-blue-gray">Driving Exp.</label>
							<input class="w3-input w3-border" name="driver_exp" type="text" placeholder="Number of years (e.g. 5)" required value="<?php echo $driver_data[7]; ?>">
						</div>
						<div class="w3-third">
							<label class="w3-text-blue-gray">Date of Birth</label>
							<input class="w3-input w3-border" name="dob" type="date" pattern="[0-1][0-9]\/[0-3][0-9]\/[0-9]{4}" placeholder="Enter Date MM/DD/YYYY" title="Please enter Date in format: MM/DD/YYYY" required value="<?php echo $dob?>">
						</div>
						<div class="w3-third">
							<label class="w3-text-blue-gray">Date of Hire</label>
							<input class="w3-input w3-border" name="doh" type="date" pattern="[0-1][0-9]\/[0-3][0-9]\/[0-9]{4}" placeholder="Enter Date MM/DD/YYYY" title="Please enter Date in format: MM/DD/YYYY" required value="<?php echo $doh?>">
						</div>
					</div>
					
					<br>
					
					<button class="w3-btn w3-blue-gray w3-block w3-round-xxlarge">UPDATE</button></p>
					
					<br>
				</form>
				
			</div>
			
			<br>
			
			<div class="w3-container w3-border">
				
				<header class="w3-container w3-center w3-border-bottom">
						<h4>REGISTERED DRIVERS</h4>
				</header>
				
				<br>
				
				<!-- Table goes here -->
				<table class="w3-table w3-striped w3-small">
					<tr class="w3-blue-gray">
						<th>NAME</th>
						<th>LICENCE NUMBER</th>
						<th>STATE</th>
						<th>D.O.B.</th>
						<th>D.O.H.</th>
						<th>EXPERIENCE</th>
						<th class="w3-center" colspan="2">ACTION</th>
					</tr>
					
					<?php for($rows = 0; $rows < count($drivers_data); $rows++){; ?>
					<tr>
						
						<?php for($cols = 2; $cols < 8; $cols++){; ?>
						<td>
							<?php echo in_array($cols, array(5,6)) ? date("m/d/Y", strtotime($drivers_data[$rows][$cols])) : $drivers_data[$rows][$cols];} ?>
						</td>
						
						<!-- Delete funciton -->
						<td class="w3-center">
							<a href="/system/functions/delete_driver.php?client_id=<?php echo $client_id; ?>&driver_id=<?php echo $drivers_data[$rows][0]; ?>">
								<button class="w3-button w3-round-xxlarge w3-blue-gray">DELETE <i class="fa fa-trash-o" style="color:red"></i></button>
							</a>
						</td>
						
						<!-- Update funciton -->
						<td class="w3-center">
							<a href="/system/client_drivers.php?client_id=<?php echo $client_id; ?>&driver_id=<?php echo $drivers_data[$rows][0]; ?>">
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
					<button class="w3-button w3-round-xxlarge w3-blue-gray">GO TO REGISTRATION FORM <i class="fa fa-user" style="color:lime"></i></button>
				</a>
			</div>
			<br>
			<br>
			
		</div>
		
	</body>
	
	<?php $db_conn->close(); ?>
	
</html>