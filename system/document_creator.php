<?php
	session_start();
	
	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
	
	$client_id = $_GET["client_id"];
	
	$onAgent = isset($_GET["agent"]);
	$onVendor = isset($_GET["vendor"]);
	$onDocs = $onVendor && $onAgent;

	if(!$onAgent)
	{
		// Load Agents
		require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/list_agents.php";
	}

	if($onAgent && !$onVendor)
	{
		// Load agent´s vendors
		require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/list_vendors.php";
	}

	if($onDocs)
	{
		// Load vendors´ docs
		require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/list_doc_templates.php";
	}
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - REQUEST CREATOR</title>
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
		
		<?php if(!$onAgent){;?>

			<div class="w3-container w3-round">
				<header class="w3-blue-gray w3-center">
					<h2>SELECT AGENT</h2>
				</header>
				
				<br>

				<?php $c_counter = 0; ?>
				<?php for($rows = 0; $rows < count($list_agents); $rows++){; ?>
					

					<?php if($c_counter == 0) {; ?>
					
						<div class="w3-row-padding">

					<?php }; ?>	

					<a href="<?php echo "?client_id=$client_id&agent=".$list_agents[$rows][0]; ?>" class="w3-col m4 w3-button w3-border-left w3-border-blue">
						<img src="/img/agents/<?php echo $list_agents[$rows][2]; ?>" alt="Agent Image" style="max-width:15%" class="w3-left">
						<h3 class="w3-center"><?php echo $list_agents[$rows][1]; ?></h3>
					</a>

					<?php $c_counter++; ?>

					<?php if($c_counter > 2) {; ?>
						</div>
						<br>
						<?php $c_counter = 0; ?>
					<?php }; ?>	

				<?php }; ?>
				
			</div>
		<?php }; ?>

		<?php if($onAgent && !$onVendor){;?>

			<div class="w3-container">
				<header class="w3-blue-gray w3-center">
					<h2>SELECT INSURANCE COMPANY</h2>
					<a href="<?php echo "?client_id=$client_id" ;?>" class="w3-button w3-round w3-border w3-right">Return to Agents</a>
				</header>

				<br>
				
				<?php $c_counter = 0; ?>
				<?php for($rows = 0; $rows < count($list_vendors); $rows++){; ?>

					<?php if($c_counter == 0) {; ?>
					
					<div class="w3-row-padding">

					<?php }; ?>	
					
					<a href="<?php echo "?client_id=$client_id&agent=".$_GET["agent"]."&vendor=".$list_vendors[$rows][0]; ?>" class="w3-col m4 w3-button w3-border-left w3-border-blue">
						<img src="/img/agents/<?php echo $list_vendors[$rows][2]; ?>" alt="Agent Image" style="max-width:15%" class="w3-left">
						<h3 class="w3-center"><?php echo $list_vendors[$rows][1]; ?></h3>
					</a>

					<?php $c_counter++; ?>

					<?php if($c_counter > 2) {; ?>
						</div>
						<br>
						<?php $c_counter = 0; ?>
					<?php }; ?>	

				<?php }; ?>
				
			</div>
		<?php }; ?>

		<?php if($onDocs){;?>

			<div class="w3-container">
				<header class="w3-blue-gray w3-center">
					<h2>SELECT APPLICATION</h2>
				</header>
				
				<header class="w3-red w3-center" style="display: <?php echo isset($_GET["error"]) ? "block" : "none"; ?>">
					<h3>Select minimum 1 coverage to generate application</h3>
				</header>
				
				<header class="w3-green w3-center" style="display: <?php echo isset($_GET["doc"]) ? "block" : "none"; ?>">
					<h3>Application created succesfully</h3>
					<a href="/system/filer/pdf_application.php?doc=<?php echo $_GET["doc"]; ?>" target="_blank" class="w3-button w3-round w3-right w3-border">Preview Created Application</a>
				</header>

				<a href="<?php echo "?client_id=$client_id&agent=".$_GET["agent"] ;?>" class="w3-button w3-round w3-border w3-right w3-blue-gray">Return to Companies</a>

				<br>
				<br>
				
				<?php for($rows = 0; $rows < count($list_doc_templates); $rows++){; ?>
				<?php $covers = explode(",", $list_doc_templates[$rows][4]); ?>

				<div class="w3-container">
					<form method="post" action="/system/functions/create_request_link.php">

					<input type="hidden" name="client" value="<?php echo $client_id; ?>">
					<input type="hidden" name="agent" value="<?php echo $_GET["agent"]; ?>">
					<input type="hidden" name="vendor" value="<?php echo $_GET["vendor"]; ?>">
					<input type="hidden" name="link" value="<?php echo $list_doc_templates[$rows][0]; ?>">

					<header>
						<h3 class="w3-blue-gray w3-padding"> <?php echo $list_doc_templates[$rows][2];?></h3>
					</header>

					<label class="w3-text-blue-gray w3-large">Application Coverages</label>
					
					<br>
					<br>

					<label class="w3-text-blue-gray">General Coverages</label>
					<div class="w3-row-padding">
						<div class="w3-quarter">
							<input type="checkbox" name="covers[]" value="1" <?php echo in_array("1", $covers) ? "" : "disabled" ?>><label> Liability</label>
						</div>
						<div class="w3-quarter">
							<input type="checkbox" name="covers[]" value="2" <?php echo in_array("2", $covers) ? "" : "disabled" ?>><label> Cargo</label>
						</div>
						<div class="w3-quater">
							<input type="checkbox" name="covers[]" value="3" <?php echo in_array("3", $covers) ? "" : "disabled" ?>><label> Gral. Liability</label>
						</div>
					</div>
					
					<label class="w3-text-blue-gray">Physical Damage Coverages</label>
					<div class="w3-row-padding">
						<div class="w3-quarter">
							<input type="checkbox" name="covers[]" value="4" <?php echo in_array("4", $covers) ? "" : "disabled" ?>><label> Tractor</label>
						</div>
						<div class="w3-quarter">
							<input type="checkbox" name="covers[]" value="5" <?php echo in_array("5", $covers) ? "" : "disabled" ?>><label> Trailer</label>
						</div>
						<div class="w3-quarter">
							<input type="checkbox" name="covers[]" value="6" <?php echo in_array("6", $covers) ? "" : "disabled" ?>><label> Non-owned</label>
						</div>
						<div class="w3-quarter">
							<input type="checkbox" name="covers[]" value="7" <?php echo in_array("7", $covers) ? "" : "disabled" ?>><label> T. Interchange</label>
						</div>
					</div>

					<br>
					<div class="w3-center">
						<input type="submit" value="Use this template" class="w3-button w3-blue-gray">
					</div>
					<br>

					</form>

				</div>
				
				<br>

				<?php }; ?>
				
			</div>
		<?php }; ?>

	</body>
	
	<?php $db_conn->close(); ?>
	
</html>