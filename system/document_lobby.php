<?php
	session_start();
	
	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
	
	$client_id = $_GET["client_id"];
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/docs_templates.php";
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - DOCUMENT LOBBY</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	
	<script> 
		function OpenDoc()
		{
			window.open("/system/ready_files/request_"+<?php echo $_GET["request_id"]; ?>+".docx", "_blank"); 
		}
	</script>
	
	<body>
		<?php echo isset($_GET["request_id"]) ? '<script type="text/javascript"> OpenDoc(); </script>' : ''; ?>
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
				<h2>SELECT APPLICATION</h2>
			</header>
			
			<header class="w3-red w3-center" style="display: <?php echo isset($_GET["error"]) ? "block" : "none"; ?>">
				<h3>Select minimum 1 coverage to generate application</h3>
			</header>
			
			<br>
			
			<?php for($rows = 0; $rows < count($templates_data); $rows++){; ?>
			<?php $covers = explode(",", $templates_data[$rows][4]); ?>
			<div class="w3-row-padding w3-border-bottom">
				
				<div class="w3-col s2 m2 l2">
					<div class="w3-center">
						<img src="<?php echo $templates_data[$rows][2]; ?>" alt="COMPANY LOGO" style="max-width:15%">
					</div>
				</div>
				
				<div class="w3-col s3 m3 l3">
					<h3>
						<?php echo $templates_data[$rows][1]; ?>
					</h3>
				</div>
				
				<div class="w3-col s1 m1 l1">
					<h4 class="w3-right">
						COVERAGES :
					</h4>
				</div>
				
				<form action="/system/functions/create_doc_request.php?<?php echo "client_id=$client_id&company_id={$templates_data[$rows][0]}"; ?>" method="post">
				
				<div class="w3-col s5 m5 l5 w3-tiny">
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
					
				</div>
				
				<div class="w3-col s1 m1 l1 w3-center w3-small">
					<button class="w3-button w3-blue-gray">GENERATE</button>
				</div>
				
				</form>
				
			</div>
			
			<br>
			<?php }; ?>
			
		</div>
		
	</body>
	
	<?php $db_conn->close(); ?>
	
</html>