<?php

	session_start();

	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/clients_data.php";

	$clientTypeRegistration = 1;
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - CLIENTS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>

	<script>

		function ChangeType(clientType)
		{
			var ctrlNameA = document.getElementById("nameFirst");
			var ctrlNameB = document.getElementById("nameSecond");
			var ctrlNameC = document.getElementById("bsnName");

			switch(clientType)
			{
				case 0:
					ctrlNameA.style.display = "block";
					ctrlNameB.style.display = "block";
					ctrlNameC.className = "w3-third";
					<?php $clientTypeRegistration = 1; ?>
					document.getElementById("clientForm").action = "/system/functions/create_client.php?type=" + <?php echo $clientTypeRegistration; ?>;
					alert("1");
					break;
				case 1:
					ctrlNameA.style.display = "none";
					ctrlNameB.style.display = "none";
					ctrlNameC.className = "w3-rest";
					<?php $clientTypeRegistration = 2; ?>
					document.getElementById("clientForm").action = "/system/functions/create_client.php?type=" + <?php echo $clientTypeRegistration; ?>;
					alert("2");
					break;
			}
		}

	</script>

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

		<!-- New client moddal -->
		<div id="newClient" class="w3-modal w3-animate-opacity">
			<div class="w3-modal-content w3-small">
				<!-- Modal content -->
				<header class="w3-container w3-blue-gray">
					<h2>Client Registration</h2>
				</header>

				<br>

				<div class="w3-container">
					<div class="w3-row-padding">
						<div class="w3-half">
							<button onclick="ChangeType(0)" class="w3-button w3-block w3-blue-gray w3-round-xxlarge w3-card-2">Individual</button>
						</div>
						<div class="w3-half">
							<button onclick="ChangeType(1)" class="w3-button w3-block w3-blue-gray w3-round-xxlarge w3-card-2">Corporation</button>
						</div>
					</div>
				</div>

				<form id="clientForm" class="w3-container" action="/system/functions/create_client.php?type=<?php echo $clientTypeRegistration; ?>" method="post">
					<br>
					<label class="w3-text-blue-gray">Client Name</label>
					<div class="w3-row-padding">

						<div id="nameFirst" class="w3-third">
							<input class="w3-input w3-border" name="name_first" type="text" placeholder="First Name" autofocus >
						</div>
						<div id="nameSecond" class="w3-third">
							<input class="w3-input w3-border" name="name_second" type="text" placeholder="Last Name" >
						</div>
						<div id="bsnName" class="w3-third">
							<input class="w3-input w3-border" name="name_bsn" type="text" placeholder="Business Name" required>
						</div>
					</div>

					<br>

					<label class="w3-text-blue-gray">Contact Info</label>
					<div class="w3-row-padding">

						<div class="w3-half">
							<input class="w3-input w3-border" name="phone" type="text" placeholder="Phone Number" required>
						</div>
						<div class="w3-half">
							<input class="w3-input w3-border" name="email" type="email" placeholder="E-mail" required>
						</div>
					</div>

					<br>

					<label class="w3-text-blue-gray">Garage Info</label>
					<div class="w3-row-padding">
						<div class="w3-half">
							<input class="w3-input w3-border" name="garage_address" type="text" placeholder="Garage Address" required>
						</div>
						<div class="w3-half">
							<input class="w3-input w3-border" name="garage_city" type="text" placeholder="Garage City" required>
						</div>
					</div>

					<div class="w3-row-padding">
						<div class="w3-half">
							<input class="w3-input w3-border" name="garage_state" type="text" placeholder="Garage State" required>
						</div>
						<div class="w3-half">
							<input class="w3-input w3-border" name="garage_zip" type="text" placeholder="Garage ZIP" required>
						</div>
					</div>

					<br>

					<label class="w3-text-blue-gray">Mail Info</label>
					<div class="w3-row-padding">
						<div class="w3-half">
							<input class="w3-input w3-border" name="mail_address" type="text" placeholder="Mail Address" required>
						</div>
						<div class="w3-half">
							<input class="w3-input w3-border" name="mail_city" type="text" placeholder="Mail City" required>
						</div>
					</div>

					<div class="w3-row-padding">
						<div class="w3-half">
							<input class="w3-input w3-border" name="mail_state" type="text" placeholder="Mail State" required>
						</div>
						<div class="w3-half">
							<input class="w3-input w3-border" name="mail_zip" type="text" placeholder="Mail ZIP" required>
						</div>
					</div>

					<br>

					<label class="w3-text-blue-gray">Effective radius</label>
					<div class="w3-row-padding">
						<input class="w3-radio" type="radio" name="radius" value="100" required>
						<label>100</label>
						<input class="w3-radio" type="radio" name="radius" value="200">
						<label>200</label>
						<input class="w3-radio" type="radio" name="radius" value="300">
						<label>300</label>
						<input class="w3-radio" type="radio" name="radius" value="500">
						<label>500</label>
						<input class="w3-radio" type="radio" name="radius" value="11 West">
						<label>11 West</label>
						<input class="w3-radio" type="radio" name="radius" value="48 States">
						<label>48 States</label>
					</div>

					<br>

					<label class="w3-text-blue-gray">Finance Information</label>
					<div class="w3-row-padding">
						<div class="w3-quarter">
							<label class="w3-text-blue-gray">Finance A</label>
							<input class=" w3-input w3-border-bottom" type="text" name="finance_a" required >
						</div>
						<div class="w3-quarter">
							<label class="w3-text-blue-gray">Finance A - Account Number</label>
							<input class=" w3-input w3-border-bottom" type="text" name="finance_a_account" required >
						</div>
						<div class="w3-quarter">
							<label class="w3-text-blue-gray">Finance B</label>
							<input class=" w3-input w3-border-bottom" type="text" name="finance_b" required >
						</div>
						<div class="w3-quarter">
							<label class="w3-text-blue-gray">Finance B - Account Number</label>
							<input class=" w3-input w3-border-bottom" type="text" name="finance_b_account" required >
						</div>
					</div>

					<br>

					<label class="w3-text-blue-gray">Filing Information</label>
					<div class="w3-row-padding">
						<div class="w3-third">
							<label class="w3-text-blue-gray">CA Number</label>
							<input class=" w3-input w3-border-bottom" type="text" name="filing_ca" required >
						</div>
						<div class="w3-third">
							<label class="w3-text-blue-gray">MC Number</label>
							<input class=" w3-input w3-border-bottom" type="text" name="filing_mc" required >
						</div>
						<div class="w3-third">
							<label class="w3-text-blue-gray">USDOT Number</label>
							<input class=" w3-input w3-border-bottom" type="text" name="filing_usdot" required >
						</div>
					</div>

					<br>

					<button class="w3-btn w3-blue-gray w3-block w3-round-xxlarge">Register</button></p>

					<br>
				</form>

				<footer class="w3-container w3-blue-gray w3-padding-small">
						<div class="w3-center">
							<button onclick="document.getElementById('newClient').style.display='none'" class="w3-button w3-border w3-round-xxlarge w3-red" style="width:50%">Cancel</button>
						</div>
				</footer>

			</div>
		</div>

		<br>

		<div class="w3-container">
			<header class="w3-card-2 w3-blue-gray w3-center w3-round-large">
				<h2>CLIENTS REGISTERED</h2>
			</header>

			<div class="w3-row">
				<header class="w3-container w3-center w3-border-bottom">
						<button onclick="document.getElementById('newClient').style.display='block'" class="w3-card-4 w3-button w3-right w3-small w3-round-xxlarge w3-blue-gray">ADD NEW <i class="fa fa-user-plus" style="color:lime"></i></button>
						<br>
						<br>
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
						<th>PROFILE</th>
					</tr>
					<?php for($rows = 0; $rows < count($clients_data); $rows++){; ?>
					<tr>

						<?php for($cols = 2; $cols < 7; $cols++){; ?>
						<td>
							<?php echo $clients_data[$rows][$cols];} ?>
						</td>
						<td>
							<a href="/system/client_profile.php?client_id=<?php echo $clients_data[$rows][0]; ?>">
								<button class="w3-button w3-round-xxlarge w3-blue-gray w3-small">See Profile</button>
							</a>
						</td>
					</tr>
					<?php }; ?>
				</table>
			</div>
		</div>

		<script>
			<?php $clientTypeRegistration = 1; ?>
			document.getElementById("clientForm").action = "/system/functions/create_client.php?type=" + <?php echo $clientTypeRegistration; ?>;
		</script>

	</body>

</html>