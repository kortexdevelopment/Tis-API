<?php
	session_start();

	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}

	$client_id = $_GET["client_id"];
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/client_coverages_data.php";
	
	$data_exist = count($client_coverages_data) > 0;
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - CLIENT COVERAGES</title>
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
				<h2>CLIENT COVERAGES</h2>
			</header>
			
			<div class="w3-container w3-border w3-small">
				
				<form class="w3-container w3-small" action="/system/functions/<?php echo $data_exist ? "update" : "create"; ?>_client_covers.php?client_id=<?php echo $client_id; ?><?php echo $data_exist? "&cover_id=".$client_coverages_data[0][0] : ""?>" method="post">
					
					<label class="w3-text-blue-gray w3-large">LIABILITY</label>
					<div class="w3-row-padding">
						<div class="w3-half">
							<label class="w3-text-blue-gray">Value</label>
							<select class="w3-select" name="liab_v">
								<?php if($data_exist){;?>
									<option value="<?php echo $client_coverages_data[0][2]; ?>" selected><?php echo number_format($client_coverages_data[0][2]); ?></option>
								<?php }; ?>
								<option value="750000" <?php echo $data_exist ? "" : "selected"?>>750,000.00</option>
								<option value="1000000">1,000,000.00</option>
							</select>
						</div>
						<div class="w3-half">
							<label class="w3-text-blue-gray">Deductible</label>
							<select class="w3-select" name="liab_d">
								<?php if($data_exist){;?>
									<option value="<?php echo $client_coverages_data[0][3]; ?>" selected><?php echo $client_coverages_data[0][3] == 0 ? "N/A" : number_format($client_coverages_data[0][3]); ?></option>
								<?php }; ?>
								<option value="0" <?php echo $data_exist ? "" : "selected"?>>N/A</option>
								<option value="1000">1,000.00</option>
								<option value="2500">2,500.00</option>
								<option value="5000">5,000.00</option>
							</select>
						</div>
					</div>
					<br>
					
					<label class="w3-text-blue-gray w3-large">CARGO</label>
					<div class="w3-row-padding">
						<div class="w3-half">
							<label class="w3-text-blue-gray">Value</label>
							<input class="w3-input w3-border" name="cargo_v" type="text" value="<?php echo $data_exist ? $client_coverages_data[0][4] : "0"; ?>" placeholder="Enter desired value, just numbers" pattern="[0-9]+(.[0-9]{0,2})*" required>
						</div>
						<div class="w3-half">
							<label class="w3-text-blue-gray">Deductible</label>
							<select class="w3-select" name="cargo_d">
								<?php if($data_exist){;?>
									<option value="<?php echo $client_coverages_data[0][5]; ?>" selected><?php echo $client_coverages_data[0][5] == 0 ? "N/A" : number_format($client_coverages_data[0][5]); ?></option>
								<?php }; ?>
								<option value="0" <?php echo $data_exist ? "" : "selected"?>>N/A</option>
								<option value="1000">1,000.00</option>
								<option value="2500">2,500.00</option>
								<option value="5000">5,000.00</option>
							</select>
						</div>
					</div>
					<br>
					
					<label class="w3-text-blue-gray w3-large">GRAL. LIABILITY</label>
					<div class="w3-row-padding">
						<div class="w3-half">
							<label class="w3-text-blue-gray">Value</label>
							<input class="w3-input w3-border" name="gral_v" type="text" value="<?php echo $data_exist ? $client_coverages_data[0][6] : "0"; ?>" placeholder="Enter desired value, just numbers" pattern="[0-9]+(.[0-9]{0,2})*" required>
						</div>
						<div class="w3-half">
							<label class="w3-text-blue-gray">Deductible</label>
							<select class="w3-select" name="gral_d">
								<?php if($data_exist){;?>
									<option value="<?php echo $client_coverages_data[0][7]; ?>" selected><?php echo $client_coverages_data[0][7] == 0 ? "N/A" : number_format($client_coverages_data[0][7]); ?></option>
								<?php }; ?>
								<option value="0" <?php echo $data_exist ? "" : "selected"?>>N/A</option>
								<option value="1000">1,000.00</option>
								<option value="2500">2,500.00</option>
								<option value="5000">5,000.00</option>
							</select>
						</div>
					</div>
					<br>
					
					<button class="w3-btn w3-blue-gray w3-block w3-round-xxlarge"><?php echo $data_exist ? "UPDATE" : "REGISTER DATA"; ?></button></p>
					
					<br>
					
				</form>
				
			</div>
			
		</div>

	</body>

</html>