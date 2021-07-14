<?php
	session_start();

	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
	
	$id = $_SESSION["client_id"];
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/certificates/client_logs.php";
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - Certificates Logs</title>
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
			<a href="/system/certificates_panel.php" class="w3-bar-item w3-button w3-border-right">RETURN TO CERTIFICATE CREATION</a>
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
				<h2>CERTIFICATES HISTORY</h2>
			</header>
			
			<div class="w3-row">
					
				<!-- Registered logs table -->
				<table class="w3-table w3-striped w3-small">
					
					<col width="40$">
					<col width="40%">
					<col width="20%">
					<tr class="w3-blue-gray">
						<th class="w3-center">CETIFICATE HOLDER</th>
						<th class="w3-center">DATE OF CREATION </th>
						<th class="w3-center">ACTION</th>
					</tr>
					
					<?php for($r = 0; $r < count($client_logs); $r++){; ?>
					
						<tr>
							<td><?php echo $client_logs[$r][2]; ?></td>
							<td class="w3-center"><?php echo $client_logs[$r][3]; ?></td>
							<td class="w3-center">
								<a href="/system/filer/pdf_renderer.php?panel=1&lid=<?php echo $client_logs[$r][0]; ?>" class="w3-button w3-round w3-blue-gray" target="_blank">GET COPY <i class="fa fa-files-o" aria-hidden="true"></i></a>
							</td>
						</tr>
						
					<?php }; ?>
					
				</table>
			</div>
			
		</div>

	</body>

</html>