<?php
	session_start();

	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}

	$id = $_GET["cid"];
	
	$coversError = false;
	
	if(isset($_GET["covers"]))
	{
		$coversError = true;
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/policies_data.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - POLICIES MENU</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script type="text/javascript" src="/system/Js/formaters.js"></script>
	</head>

	<body>
		
		
		
		<!-- Navigation Bar -->
		<div id="navBar" class="w3-bar w3-border w3-blue-gray w3-padding-small">
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">(MINI-ICON) TSI </a>
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">(MINI-ICON) TSI </a>
			<a href="/system/clients.php" class="w3-bar-item w3-button w3-border-right">CLIENTS</a>
			<a href="/system/client_profile.php?client_id=<?php echo $id; ?>" class="w3-bar-item w3-button w3-border-right">RETURN TO CLIENT PROFILE</a>
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
				<h2>CLIENT POLICIES</h2>
			</header>

			<!-- Registration From -->
			<div class="w3-row w3-border">
				<header class="w3-container w3-center w3-border-bottom w3-blue-gray">
					<h3>REGISTER NEW POLICY</h3>
				</header>
				
				<br>
				
				<form action="/system/functions/create_policy.php" method="post">

					<input type="hidden" value="<?php echo $id; ?>" name="cid" required>

					<div class="w3-row-padding">
						<div class="w3-third">
							<label class="w3-text-blue-gray w3-border-bottom">INSURANCE COMPANY NAME</label>
							<input class="w3-input" type="text" placeholder="Enter Company Name" name="name" required>
						</div>
						<div class="w3-third">
							<label class="w3-text-blue-gray w3-border-bottom">INSURANCE COMPANY NAIC</label>
							<input class="w3-input" type="text" placeholder="Enter Company NAIC" name="naic" required>
						</div>
						<div class="w3-third">
							<label class="w3-text-blue-gray w3-border-bottom">POLICY NUMBER</label>
							<input class="w3-input" type="text" placeholder="Enter Policy Number" name="number" required>
						</div>
					</div>
					
					<br>
					
					<div class="w3-row-padding">
						<div class="w3-half">
							<label class="w3-text-blue-gray w3-border-bottom">EFFECTIVE DATE</label>
							<input class="w3-input" type="text" name="start" maxlength="10" placeholder="MM/DD/YYYY" pattern="[0-1][0-9]\/[0-3][0-9]\/[0-9]{4}" onkeyup="Dater(this)" required>
						</div>
						<div class="w3-half">
							<label class="w3-text-blue-gray w3-border-bottom">EXPIRATION DATE</label>
							<input class="w3-input" type="text" name="end" maxlength="10" placeholder="MM/DD/YYYY" pattern="[0-1][0-9]\/[0-3][0-9]\/[0-9]{4}" onkeyup="Dater(this)" required>
						</div>
					</div>
					
					<br>
					
					<div class="w3-row-padding w3-border-bottom">
						<label class="w3-text-blue-gray w3-border-bottom">POLICY COVERAGES</label>
						<br>
						<input class="w3-check" type="checkbox" id="c1" name="covers[]" value="Liability">
						<label for="c1"> Liability</label>
						<br>
						<input class="w3-check" type="checkbox" id="c2" name="covers[]" value="Cargo">
						<label for="c2"> Cargo</label>
						<br>
						<input class="w3-check" type="checkbox" id="c3" name="covers[]" value="Gral. Liability">
						<label for="c3"> Gral. Liability</label>
						<br>
						<input class="w3-check" type="checkbox" id="c8" name="covers[]" value="Damage">
						<label for="c8"> Physical Damage</label>
						<br>
						<input class="w3-check" type="checkbox" id="c4" name="covers[]" value="Trailer Interchange">
						<label for="c4"> T. Interchange</label>
						<br>
						<input class="w3-check" type="checkbox" id="c5" name="covers[]" value="Non Owned Trailer">
						<label for="c5"> T. Non Owned</label>
						<br>
						<input class="w3-check" type="checkbox" id="c6" name="covers[]" value="Unisured Motorist">
						<label for="c6"> Unisured Motorist</label>
						<br>
						<br>
					</div>
					
					<br>
					
					<div class="w3-row w3-center"> 
						<input class="w3-button w3-blue-gray w3-round" type="submit" value="REGISTER POLICY">
					</div>
					
					<br>
					
				</form>
				
			</div>
			
			<br>
			
			<!-- Registered Policies -->
			<div class="w3-row w3-responsive">
			
				<header class="w3-blue-gray w3-center">
					<h3>REGITRERED POLICIES</h3>
				</header>
				
				<!-- Registered clients table -->
				<table class="w3-table w3-striped w3-small">
					
					
					<tr class="w3-blue-gray">
						<th class="w3-center" colspan="2">COMPANY</th>
						<th>POLICY NUMBER</th>
						<th class="w3-center" colspan="2">POLICY TERM</th>
						<th>COVERAGE</th>
						<th class="w3-center">ACTION</th>
					</tr>
					
					<?php for($r = 0; $r < count($plc_data); $r++){; ?>
					
						<tr>
							<td><?php echo $plc_data[$r][2]; ?></td>
							<td><?php echo "NAIC: " . $plc_data[$r][8]; ?></td>
							<td><?php echo $plc_data[$r][3]; ?></td>
							<td>EFFECTIVE : <?php echo date("m/d/Y", strtotime($plc_data[$r][4])); ?></td>
							<td>EXPIRATION : <?php echo date("m/d/Y", strtotime($plc_data[$r][5])); ?></td>
							<td><?php echo str_replace(",", "<br>", str_replace("Damage", "Ph. Damage", $plc_data[$r][6])); ?></td>
							<td class="w3-center">
								<a href="/system/functions/cancel_policy.php?<?php echo "pid=".$plc_data[$r][0]."&cid=".$id; ?>" class="w3-button w3-round w3-red" >CANCELED POLICY <i class="fa fa-ban" aria-hidden="true"></i></a>
							</td>
						</tr>
						
					<?php }; ?>
					
					
					
				</table>

				<?php if(count($plc_data) <= 0) {; ?>
					<br>
					<h3 class="w3-text-blue-gray w3-center">NO POLICIES REGITRERED</h3>
					<br>
				<?php }; ?>
					
			</div>
			
			<br>
			
		</div>
		
		<!-- Error po-up -->
		<?php if($coversError) {; ?>
			<script>
				alert("Error! \nNo covers selected in form!");
			</script>
		<?php }; ?>
		
	</body>

</html>