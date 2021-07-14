<?php
	session_start();

	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false || !isset($_SESSION["client_id"]))
	{
		header("location: /_index.php");
		exit;
	}

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/client_users_data.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - APP CREDENTIALS</title>
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
				<h2>CLIENT MOBILE APP ACCESS</h2>
			</header>

			<div class="w3-row w3-border">
				<header class="w3-container w3-center w3-blue-gray">
					<h3 class="w3-center">CREATE ACCESS CREDENTIALS</h3>
				</header>
				<br>

				<form class="w3-container" action="/system/functions/create_client_user.php" method="post">
					
					<?php if(isset($_GET["error"])){; ?>
					
						<header class="w3-container w3-center w3-red">
							<h4 class="w3-center">SUBMITED USER ALREADY EXIST</h4>
						</header>
					
					<?php }; ?>
					
					<div class="w3-row-padding">
						<div class="w3-third">
							<label class="w3-text-blue-gray">USER NAME</label>
							<input class="w3-input" type="text" name="name" placeholder="Enter User Name" required>
						</div>
						<div class="w3-third">
							<label class="w3-text-blue-gray">ASSIGNED DOMAIN</label>
							<input class="w3-input" type="text" name="domain" placeholder="Enter Name" value="<?php echo "@". $_SESSION["client_id"] . ".tis"; ?>"required readonly>
						</div>
						<div class="w3-third">
							<label class="w3-text-blue-gray">USER PASSWORD</label>
							<input class="w3-input" type="text" name="pass" placeholder="Enter Password" required>
						</div>
					</div>
				
					<br>
					
					<input class="w3-btn w3-blue-gray w3-block w3-round-xxlarge" type="submit" value="REGISTER CREDENTIALS">
					
					<br>
					
				</form>
				
			</div>
			
			<br>
			
			<div class="w3-container">
				
				<header class="w3-container w3-center w3-border-bottom w3-blue-gray">
						<h3>REGISTERED CREDENTIALS</h3>
				</header>
				
				<br>
				
				<!-- Table goes here -->
				<table class="w3-table w3-striped">
					<tr class="w3-blue-gray">
						<th>USER</th>
						<th>PASSWORD</th>
						<th class="w3-center">ACTION</th>
					</tr>
					
					<?php for($rows = 0; $rows < count($users_data); $rows++){; ?>
					<tr>
						
						<td>
							<?php echo $users_data[$rows][2]; ?>
						</td>
						
						<td>
							<?php echo $users_data[$rows][3]; ?>
						</td>
						
						<!-- Delete vehicle funciton -->
						<td class="w3-center">
							<a href="/system/functions/delete_client_user.php?uid=<?php echo $users_data[$rows][0]; ?>">
								<button class="w3-button w3-round-xxlarge w3-blue-gray">DELETE <i class="fa fa-trash-o" style="color:red"></i></button>
							</a>
						</td>
						
					</tr>
					
					<?php }; ?>
					
				</table>
				
				<br>
				
			</div>
			
		</div>

	</body>

</html>