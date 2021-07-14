<?php
	session_start();
	
	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
	
	$master_pass = json_encode($_SESSION["master_pass"]);
	$user_type = $_SESSION["user_type"];
	
	echo "<script>var MasterPass = $master_pass; var UserType = $user_type;</script>";
	
	$clientProfile = $_GET["client_id"];
	
	if(!isset($_SESSION["client_id"]) || $_SESSION["client_id"] != $clientProfile)
	{
		$_SESSION["client_id"] = $clientProfile;
	}
	
	if(isset($_SESSION["client_app"]))
	{
		unset($_SESSION["client_app"]);
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/client_data.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/drivers_data.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/vehicles_data.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/client_coverages_data.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/client_extra_data.php";
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - CLIENT PROFILE</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
	</head>
	
	<script>
	
	var formStatus = true;
	var formInputs = document.getElementsByClassName("clientFormInput");
	var formButtons = document.getElementsByClassName("clientFormButtons");
	var formInputValues = [];
	
	function ClientFormStatus()
	{
		formStatus = !formStatus;
		
		if(!formStatus)
		{
			formInputValues = [];
		}
		
		var i;
		
		for(i = 0; i < formInputs.length; i++)
		{
			formInputs[i].readOnly = formStatus;
			
			if(formStatus)
			{
				formInputs[i].value = formInputValues[i];
			}
			else
			{
				formInputValues.push(formInputs[i].value);
			}
		}
		
		for(i = 0; i < formButtons.length; i++)
		{
			document.getElementById("clientFormRadius").style.display = formButtons[i].style.display = formStatus ? "none" : "inline";
			document.getElementById("clientEditButton").style.display = !formStatus ? "none" : "inline";
		}
	}
	
	</script>
	
	<body>
		
		<!-- Navigation Bar -->
		<div id="navBar" class="w3-bar w3-border w3-blue-gray w3-padding-small">
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">(MINI-ICON) TSI </a>
			<a href="/system/clients.php" class="w3-bar-item w3-button w3-border-right">CLIENTS</a>
			<a href="#data" class="w3-bar-item w3-button w3-border-right">REGISTERED DATA</a>
			<a href="#docs" class="w3-bar-item w3-button w3-border-right">DOCUMENTATION</a>
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
		
		<!-- Admin Moddal -->
		<div id="adminModal" class="w3-modal">
			<div class="w3-modal-content">
				<!-- Modal content -->
				<header class="w3-container w3-blue-gray">
					<h2>Enter Admin Password</h2>
				</header>
				
				<br>
				
				<div class="w3-row-padding">
					<div class="w3-threequarter">
						<input id="adminPass" class="w3-input" type="password" placeholder="Enter Password">
					</div>
					<div class="w3-rest">
						<button onclick="AdminConfirm()" class="w3-button w3-block w3-round-xxlarge w3-blue-gray">Confirm</button>
					</div>
				</div>
				 
				<br>
				 
				<footer class="w3-container w3-blue-gray w3-padding-small">
						<div class="w3-center">
							<button onclick="AdminCancel()" class="w3-button w3-border w3-round-xxlarge w3-blue-gray">Cancel</button>
						</div>
				</footer>
				
			</div>
		</div>
		
		<br>
		
		<!-- Client data display and form -->
		<div class="w3-container">
			<form class="w3-card-2 w3-border" action="/system/functions/update_client.php?client_id=<?php echo $clientProfile; ?>" autocomplete="off" method="post">
				<header class="w3-container w3-blue-gray w3-center">
					<h2 id="main">CLIENT GENERAL INFORMATION</h2>
				</header>
				<br>
				
				<label class="w3-padding-small w3-leftbar w3-large w3-text-blue-gray">Contact Information</label>
				<div class="w3-row-padding">
					<div class="w3-third" style="display:<?php echo $client_data[16] == 1 ? "block" : "none"; ?>">
						<label class="w3-text-blue-gray">First Name</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="name_first" value="<?php echo $client_data[2]; ?>"  readonly>
					</div>
					<div class="w3-third" style="display:<?php echo $client_data[16] == 1 ? "block" : "none"; ?>">
						<label class="w3-text-blue-gray">Last Name</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="name_second" value="<?php echo $client_data[3]; ?>"  readonly>
					</div>
					<div class="<?php echo $client_data[16] == 1 ? "w3-third" : "w3-rest"; ?>">
						<label class="w3-text-blue-gray">Business Name</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="name_bsn" value="<?php echo $client_data[4]; ?>" required readonly>
					</div>
				</div>
				
				<div class="w3-row-padding">
					<div class="w3-half">
						<label class="w3-text-blue-gray">Phone Number</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="phone" value="<?php echo $client_data[5]; ?>" required readonly>
					</div>
					<div class="w3-half">
						<label class="w3-text-blue-gray">E-mail address</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="email" value="<?php echo $client_data[6]; ?>" required readonly>
					</div>
				</div>
				
				<label class="w3-padding-small w3-leftbar w3-large w3-text-blue-gray">Garage Information</label>
				<div class="w3-row-padding">
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">Address</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="garage_address" value="<?php echo $client_data[7]; ?>" required readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">City</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="garage_city" value="<?php echo $client_data[8]; ?>" required readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">State</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="garage_state" value="<?php echo $client_data[9]; ?>" required readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">ZIP</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="garage_zip" value="<?php echo $client_data[10]; ?>" required readonly>
					</div>
				</div>
				
				<label class="w3-padding-small w3-leftbar w3-large w3-text-blue-gray">Mail Information</label>
				<div class="w3-row-padding">
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">Address</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="mail_address" value="<?php echo $client_data[11]; ?>" required readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">City</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="mail_city" value="<?php echo $client_data[12]; ?>" required readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">State</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="mail_state" value="<?php echo $client_data[13]; ?>" required readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">ZIP</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="mail_zip" value="<?php echo $client_data[14]; ?>" required readonly>
					</div>
				</div>
				
				<label class="w3-padding-small w3-leftbar w3-large w3-text-blue-gray">Working Information</label>
				<div class="w3-row-padding">
					<div class="w3-half">
						<label class="w3-text-blue-gray">Radius</label>
						<p class="w3-border-bottom"><?php echo $client_data[15]?></p>
						<div id="clientFormRadius" class="w3-row-padding" style="display:none">
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
					</div>
				</div>
				
				<br>
				
				<label class="w3-padding-small w3-leftbar w3-large w3-text-blue-gray">Finance Information</label>
				<div class="w3-row-padding">
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">Finance A</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="finance_a" value="<?php echo $client_data[17]; ?>" required readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">Finance A - Account Number</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="finance_a_account" value="<?php echo $client_data[18]; ?>" required readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">Finance B</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="finance_b" value="<?php echo $client_data[19]; ?>" required readonly>
					</div>
					<div class="w3-quarter">
						<label class="w3-text-blue-gray">Finance B - Account Number</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="finance_b_account" value="<?php echo $client_data[20]; ?>" required readonly>
					</div>
				</div>

				<br>
				
				<label class="w3-padding-small w3-leftbar w3-large w3-text-blue-gray">Filing Information</label>
				<div class="w3-row-padding">
					<div class="w3-third">
						<label class="w3-text-blue-gray">CA Number</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="filing_ca" value="<?php echo $client_data[21]; ?>" required readonly>
					</div>
					<div class="w3-third">
						<label class="w3-text-blue-gray">MC Number</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="filing_mc" value="<?php echo $client_data[22]; ?>" required readonly>
					</div>
					<div class="w3-third">
						<label class="w3-text-blue-gray">USDOT Number</label>
						<input class="clientFormInput w3-input w3-border-bottom" type="text" name="filing_usdot" value="<?php echo $client_data[23]; ?>" required readonly>
					</div>
				</div>
				
				<br>
				
				<div class="container w3-center">
					<button class="clientFormButtons w3-btn w3-blue-gray w3-round-xxlarge" style="display:none">UPDATE CLIENT</button>
				</div>
				
				<br>
					
			</form>
		</div>
		
		<br>
		
		<div class="w3-container w3-center">
			<button id="clientEditButton" onclick="RequestAdminAction(2, new Array('ClientFormStatus'))" class="w3-card-4 w3-button w3-round-xxlarge w3-blue-gray">EDIT CLIENT <i class="fa fa-pencil" style="color:lime"></i></button>
			<button onclick="ClientFormStatus()" class="clientFormButtons w3-card-4 w3-button w3-round-xxlarge w3-red" style="display:none">CANCEL EDIT <i class="fa fa-ban"></i></button>
			<br>
			<br>
			<a href="/system/client_additional_info.php?client_id=<?php echo $clientProfile; ?>">
				<button class="w3-button <?php echo $client_data_extra[0] != null ? 'w3-blue-gray' : 'w3-red'; ?> w3-round-xxlarge w3-card-4">CLIENT´S ADDITIONAL INFO<?php echo $client_data_extra[0] == null ? " <br>--NEED ATTENTION--" : "" ; ?></button>
			</a>
		</div>
		<!-- Client update form ending -->
		
		<br>

		<div class="w3-row">
		
			<header class="w3-container w3-center w3-border-bottom w3-border-top">
				<h3 id="data">REGISTERED DATA</h3>
			</header>
			<br>
			
			<div class="w3-col w3-container s3 m3 l3">
				<div class="w3-card-4 w3-border w3-center">
					<header class="w3-container w3-center w3-blue-gray">
						<h4>COVERAGES</h3>
					</header>
					<br>
					<i class="fa fa-list-ul w3-jumbo"></i>
					<br>
					<br>
					<a href="/system/client_covers.php?client_id=<?php echo $clientProfile; ?>" class="w3-center">
						<button class="w3-button <?php echo count($client_coverages_data) > 0 ? "w3-blue-gray" : "w3-red" ?> w3-round-xxlarge"><?php echo count($client_coverages_data) > 0 ? "MANAGE" : "NEED ATTENTION" ?> </button>
					</a>
					<br>
					<br>
				</div>
			</div>
			
			<div class="w3-col w3-container s3 m3 l3">
				<div class="w3-card-4 w3-border w3-center">
					<header class="w3-container w3-center w3-blue-gray">
						<h4>MOBILE APP</h3>
					</header>
					<br>
					<i class="fa fa-mobile w3-jumbo" aria-hidden="true"></i>
					<br>
					<br>
					<a href="/system/client_app_users.php" class="w3-center">
						<button class="w3-button <?php echo count($drivers_data) > 0 ? "w3-blue-gray" : "w3-red" ?> w3-round-xxlarge"><?php echo count($drivers_data) > 0 ? "MANAGE" : "NEED ATTENTION" ?> </button>
					</a>
					<br>
					<br>
				</div>
			</div>
			
			<div class="w3-col w3-container s3 m3 l3">
				<div class="w3-card-4 w3-border w3-center">
					<header class="w3-container w3-center w3-blue-gray">
						<h4>DRIVERS</h3>
					</header>
					<br>
					<i class="fa fa-users w3-jumbo"></i>
					<br>
					<br>
					<a href="/system/client_drivers.php?client_id=<?php echo $clientProfile; ?>" class="w3-center">
						<button class="w3-button <?php echo count($drivers_data) > 0 ? "w3-blue-gray" : "w3-red" ?> w3-round-xxlarge"><?php echo count($drivers_data) > 0 ? "MANAGE" : "NEED ATTENTION" ?> </button>
					</a>
					<br>
					<br>
				</div>
			</div>
			
			<div class="w3-col w3-container s3 m3 l3">
				<div class="w3-card-4 w3-border w3-center">
					<header class="w3-container w3-center w3-blue-gray">
						<h4>VEHICLES</h3>
					</header>
					<br>
					<i class="fa fa-truck w3-jumbo"></i>
					<br>
					<br>
					<a href="/system/client_vehicles.php?client_id=<?php echo $clientProfile; ?>" class="w3-center">
						<button class="w3-button <?php echo count($vehicles_data) > 0 ? "w3-blue-gray" : "w3-red" ?> w3-round-xxlarge"><?php echo count($vehicles_data) > 0 ? "MANAGE" : "NEED ATTENTION" ?> </button>
					</a>
					<br>
					<br>
				</div>
			</div>
			
		</div>
		
		<br>
		<br>
		
		<div class="w3-row">
		
			<header class="w3-container w3-center w3-border-bottom w3-border-top">
				<h3 id="docs">DOCUMENTATION</h3>
			</header>
			
			<br>
			
			<div class="w3-col w3-container s3 m3 l3">
				<div class="w3-card-4 w3-border w3-center">
					<header class="w3-container w3-center w3-blue-gray">
						<h4>CREATE APPLIACTION</h3>
					</header>
					<br>
					<i class="fa fa-file-text w3-jumbo"></i>
					<br>
					<br>
					<a href="<?php echo $client_data_extra[0] == null ? "#main" : "/system/document_creator.php?client_id=" . $clientProfile ; ?>" class="w3-center">
						<button class="w3-button w3-blue-gray w3-round-xxlarge" <?php echo $client_data_extra[0] == null ? "disabled" : ""; ?>>APPLICATIONS LIST</button>
					</a>
					<br>
					<br>
				</div>
			</div>
			
			<div class="w3-col w3-container s3 m3 l3">
				<div class="w3-card-4 w3-border w3-center">
					<header class="w3-container w3-center w3-blue-gray">
						<h4>CERTIFICATES</h3>
					</header>
					<br>
					<i class="fa fa-book w3-jumbo" aria-hidden="true"></i>
					<br>
					<br>
					<a href="/system/certificates_panel.php?id= <?php echo $clientProfile; ?>" class="w3-center">
						<button class="w3-button w3-blue-gray w3-round-xxlarge" <?php echo $client_data_extra[0] == null ? "disabled" : ""; ?>>CERTIFICATES PANEL</button>
					</a>
					<br>
					<br>
				</div>
			</div>
			
			<div class="w3-col w3-container s3 m3 l3">
				<div class="w3-card-4 w3-border w3-center">
					<header class="w3-container w3-center w3-blue-gray">
						<h4>MANAGE CLIENT POLICIES</h3>
					</header>
					<br>
					<i class="fa fa-id-card-o w3-jumbo" aria-hidden="true"></i>
					<br>
					<br>
					<a href="/system/policies_menu.php?cid=<?php echo $clientProfile; ?>" class="w3-center">
						<button class="w3-button w3-blue-gray w3-round-xxlarge">POLICIES MENU</button>
					</a>
					<br>
					<br>
				</div>
			</div>
			
			<div class="w3-col w3-container s3 m3 l3">
				<div class="w3-card-4 w3-border w3-center">
					<header class="w3-container w3-center w3-blue-gray">
						<h4>CLIENT DOCUMENTATION</h3>
					</header>
					<br>
					<i class="fa fa-users w3-jumbo"></i>
					<br>
					<br>
					<a href="/system/client_docs.php?client_id=<?php echo $clientProfile; ?>" class="w3-center">
						<button class="w3-button w3-blue-gray w3-round-xxlarge">DOCUMENTS LIST</button>
					</a>
					<br>
					<br>
				</div>
			</div>
			
		</div>
		
		<br>
		
		<?php $db_conn->close(); ?>
		<script src="/system/functions/admin_confirmation.js"></script>
		
	</body>
	
</html>