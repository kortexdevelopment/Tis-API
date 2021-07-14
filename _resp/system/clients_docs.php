<?php

	session_start();

	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/clients_data.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - CLIENTS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>

	<body>

		<!-- Navigation Bar -->
		<div id="navBar" class="w3-bar w3-border w3-blue-gray w3-padding-small">
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">(MINI-ICON) TSI </a>
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">RETURN TO MAIN</a>
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
				<h2>SELECT CLIENT</h2>
			</header>

			<div class="w3-row">
				<header class="w3-container w3-center w3-border-bottom">
				</header>
				<br>

				<!-- Table goes here -->
				<table class="w3-table w3-striped">
					<tr>
						<th>FIRST NAME</th>
						<th>LAST NAME</th>
						<th>B.S.N.</th>
						<th>PHONE</th>
						<th>E-MAIL</th>
						<th>ACTION</th>
					</tr>
					
					<?php for($rows = 0; $rows < count($clients_data); $rows++){; ?>
					<tr>

						<?php for($cols = 2; $cols < 7; $cols++){; ?>
						<td>
							<?php echo $clients_data[$rows][$cols];} ?>
						</td>
						<td>
							<a href="/system/document_lobby.php?client_id=<?php echo $clients_data[$rows][0]; ?>">
								<button class="w3-button w3-round-xxlarge w3-blue-gray w3-small">GENERATE DOC</button>
							</a>
						</td>
					</tr>
					<?php }; ?>
				</table>
			</div>
		</div>

	</body>

</html>