<?php
	session_start();
	
	if(!isset($_SESSION["client_id"]))
	{
		$_SESSION["client_id"] = $_GET["id"];
	}
	
	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] == false)
	{
		header("location: /_index.php");
		exit;
	}
	
	$create = false; //Temporal for debug
	$cid = 0;
	
	if(isset($_GET["cid"]))
	{
		$create = true;
		$cid = $_GET["cid"];
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/certificates/clients_data.php";
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - Certificates</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>

	<body>

		<!-- Navigation Bar -->
		<div id="navBar" class="w3-bar w3-border w3-blue-gray w3-padding-small">
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">(MINI-ICON) TSI </a>
			<a href="/system/clients.php" class="w3-bar-item w3-button w3-border-right">CLIENTS</a>
			<a href="/system/client_profile.php?client_id=<?php echo $_SESSION["client_id"]; ?>" class="w3-bar-item w3-button w3-border-right">CLIENT PROFILE</a>
			<button onclick="document.getElementById('logoutModal').style.display='block'" class=" w3-bar-item w3-button w3-border w3-round-xxlarge w3-right w3-hover-red">
				<i class="fa fa-user"></i> Log Out
			</button>

		</div>
		
		<?php if($create){; ?>
			
			<script>
				window.open("/system/filer/pdf_cert.php?panel=1&cid=" + <?php echo $cid; ?>, "_blank");
				window.location = "/system/certificates_panel.php";
			</script>
			
		<?php }; ?>
		
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
						<h2>CERTIFICATES</h2>
					</header>
					
					<a  class="w3-button w3-round-xxlarge w3-right w3-padding-small w3-blue-gray w3-padding-small" href="/system/certificates_panel_logs.php">CERTIFICATES HISTORY LIST <i class="fa fa-file-text" aria-hidden="true"></i></a>
					<a  class="w3-button w3-round-xxlarge w3-right w3-padding-small w3-blue-gray w3-padding-small" href="/system/client_profile.php?client_id=<?php echo $_SESSION["client_id"];?>">RETURN TO PROFILE</i></a>
					<br>
					<br>
					
					<div class="w3-row w3-border">
						<header class="w3-container w3-center w3-blue-gray">
							<h3 class="w3-center">CREATE CERTIFICATE FOR NEW COMPANY</h3>
						</header>
						<br>

						<form class="w3-container" action="/system/functions/certificates/create_client.php" method="post">
						
							<div class="w3-row">
								<div class="w3-rest">
									<label class="w3-text-blue-gray">CETIFICATE HOLDER / COMPANY NAME</label>
									<input class="w3-input" type="text" name="name" placeholder="Enter Name" required>
								</div>
							</div>
						
							<br>
							
							<label class="w3-text-blue-gray">CETIFICATE HOLDER / COMPANY ADDRESS</label>
							<div class="w3-row-padding">
								<div class="w3-quarter">
									<label class="w3-text-blue-gray">STREET</label>
									<input class="w3-input" type="text" name="location[]" placeholder="Enter Street" required>
								</div>
								<div class="w3-quarter">
									<label class="w3-text-blue-gray">CITY</label>
									<input class="w3-input" type="text" name="location[]" placeholder="Enter City" required>
								</div>
								<div class="w3-quarter">
									<label class="w3-text-blue-gray">STATE</label>
									<input class="w3-input" type="text" name="location[]" placeholder="Enter State" required>
								</div>
								<div class="w3-quarter">
									<label class="w3-text-blue-gray">ZIP</label>
									<input class="w3-input" type="text" name="location[]" placeholder="Enter ZIP" required>
								</div>
							</div>
							
							<br>
							
							<input class="w3-btn w3-blue-gray w3-block w3-round-xxlarge" type="submit" value="REGISTER COMPANY AND CREATE CERTIFICATE">
							
							<br>
							
						</form>
						
					</div>
					
					<br>
					
					<div class="w3-row">
					
						<header class="w3-blue-gray w3-center">
							<h3>REGITRERED COMPANIES</h3>
						</header>
						
						<!-- Registered clients table -->
						<table class="w3-table w3-striped w3-small">
							
							<col width="20$">
							<col width="50%">
							<col width="15%">
							<col width="15%">
							<tr class="w3-blue-gray">
								<th>CETIFICATE HOLDER</th>
								<th>ADDRESS</th>
								<th class="w3-center" colspan="2">ACTION</th>
							</tr>
							
							<?php for($r = 0; $r < count($clients_record); $r++){; ?>
							
								<?php 
									$final = "";
									$add = explode("::",$clients_record[$r][3]);
									for($a = 0; $a < count($add); $a++)
									{
										$final = $final . $add[$a] . " ";
									}
								?>
								<tr>
									<td><?php echo $clients_record[$r][2]; ?></td>
									<td><?php echo $final; ?></td>
									<td class="w3-center">
										<a href="?cid=<?php echo $clients_record[$r][0]; ?>" class="w3-button w3-round w3-blue-gray" >CREATE CERTIFICATE <i class="fa fa-id-card-o w3-large" aria-hidden="true"></i></a>
									</td>
									<td class="w3-center">
										<a href="/system/functions/certificates/delete_client.php?panel=1&cdl=<?php echo $clients_record[$r][0]; ?>" class="w3-button w3-round w3-blue-gray" >DELETE COMPANY <i class="fa fa-trash w3-large" aria-hidden="true"></i></a>
									</td>
								</tr>
								
							<?php }; ?>
							
						</table>
					</div>
					
			<br>
			<br>
			
		</div>

	</body>

</html>