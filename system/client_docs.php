<?php

	session_start();

	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}

	$client_id = $_GET["client_id"];
	
	if(isset($_GET["delete"]))
	{
		require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/delete_requests.php";
	}

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/list_requests.php";

?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - CLIENT DOCS</title>
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
			<header class="w3-card-2 w3-blue-gray w3-center w3-round-large">
				<h2>CLIENT DOCUMENTS</h2>
			</header>
			
			<div class="w3-row">
				<a href="/system/client_docs_stored.php?client_id=<?php echo $client_id; ?>" class="w3-right">
					<button class="w3-button w3-round-large w3-blue-gray">GO TO STORED FILES <i class="fa fa-file-text-o" style="color:lime"></i></button>
				</a>
			</div>

			<div class="w3-row">
				
				<br>

				<!-- Table goes here -->
				<table class="w3-table w3-striped">
					<tr class="w3-blue-gray">
						<th style="width:20%">AGENT</th>
						<th style="width:20%">COMPANY</th>
						<th style="width:20%">APPLICATION</th>
						<th style="width:30%">COVERAGES</th>
						<th style="width:10%" class="w3-center">PREVIEW / DELETE</th>
					</tr>
					<?php for($rows = 0; $rows < count($request_data); $rows++){; ?>
					<tr>
						<!-- Logo and Agent name-->
						<td>
							<img src="<?php echo "/img/agents/".$request_data[$rows][3]; ?>" alt="Agent Image" style="max-width:15%" class="w3-left">
							<h3><?php echo $request_data[$rows][2]; ?></h3>
						</td>
						<!-- Logo and company name -->
						<td>
							<img src="<?php echo "/img/agents/".$request_data[$rows][5]; ?>" alt="Agent Image" style="max-width:15%" class="w3-left">
							<h3><?php echo $request_data[$rows][4]; ?></h3>
						</td>
						<!-- Appliaction name -->
						<td>
							<h3><?php echo $request_data[$rows][6]; ?></h3>
						</td>
						<!-- Coverages -->
						<td class="w3-small">
							<?php $covers = explode(",",$request_data[$rows][1]); ?>
							<label class="w3-text-blue-gray">General Coverages</label>
							<div class="w3-row-padding">
								<div class="w3-col m3" style="display:<?php echo in_array("1", $covers) ? "block" : "none" ?>">
									<label> Liability</label>
								</div>
								<div class="w3-col m3" style="display:<?php echo in_array("2", $covers) ? "block" : "none" ?>">
									<label> Cargo</label>
								</div>
								<div class="w3-col m3" style="display:<?php echo in_array("3", $covers) ? "block" : "none" ?>">
									<label> Gral. Liability</label>
								</div>
								<div class="w3-col m3" style="display:<?php echo !in_array("1", $covers) && !in_array("2", $covers) && !in_array("3", $covers) ? "block" : "none" ?>">
									<label> NONE</label>
								</div>
							</div>
							
							<label class="w3-text-blue-gray">Physical Damage Coverages</label>
							<div class="w3-row-padding">
								<div class="w3-col m3" style="display:<?php echo in_array("4", $covers) ? "block" : "none" ?>">
									<label> Tractor</label>
								</div>
								<div class="w3-col m3" style="display:<?php echo in_array("5", $covers) ? "block" : "none" ?>">
									<label> Trailer</label>
								</div>
								<div class="w3-col m3" style="display:<?php echo in_array("6", $covers) ? "block" : "none" ?>">
									<label> Non-owned</label>
								</div>
								<div class="w3-col m3" style="display:<?php echo in_array("7", $covers) ? "block" : "none" ?>">
									<label> T. Interchange</label>
								</div>
								<div class="w3-col m3" style="display:<?php echo !in_array("4", $covers) && !in_array("5", $covers) && !in_array("6", $covers) && !in_array("7", $covers) ? "block" : "none" ?>">
									<label> NONE</label>
								</div>
							</div>
						</td>
						<td class="w3-center" style="display:flex-inline">
							<a href="/system/filer/pdf_application.php?doc=<?php echo $request_data[$rows][0]; ?>" target="_blank" class="w3-button w3-round-large w3-blue-gray">
								<i class="fa fa-file-pdf-o" aria-hidden="true" style="color:lime"></i>
							</a>
							<a href="<?php echo "?client_id=$client_id&delete=".$request_data[$rows][0]; ?>" class="w3-button w3-round-large w3-blue-gray">
								<i class="fa fa-trash" aria-hidden="true" style="color:red"></i>
							</a>
						</td>
					</tr>
					<?php }; ?>
				</table>
				
			</div>
		</div>

		
		<?php $db_conn->close(); ?>
		
	</body>

</html>