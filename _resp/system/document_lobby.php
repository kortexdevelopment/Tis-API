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

	<body>
		
		<!-- Navigation Bar -->
		<div id="navBar" class="w3-bar w3-border w3-blue-gray w3-padding-small">
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">(MINI-ICON) TSI </a>
			<a href="/system/clients_docs.php" class="w3-bar-item w3-button w3-border-right">RETURN TO CLIENTS</a>
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
				<h2>SELECT THE TARGET COMPANY</h2>
			</header>
			
			<a href="/system/registrered_lobby.php?<?php echo "client_id=$client_id";?>" class="w3-right">
				<button class="w3-button w3-round-xxlarge w3-card-2 w3-small w3-blue-gray">SEE REGISTRERED DOCUMENTS <i class="fa fa-file-text-o" style="color:lime"></i></button>
			</a>
			
			<br>
			<br>
			
			<?php for($rows = 0; $rows < count($templates_data); $rows++){; ?>
			<div class="w3-row-padding w3-leftbar w3-bottombar">
				
				<div class="w3-col s3 m3 l3">
					<div class="w3-center">
						<img src="<?php echo $templates_data[$rows][2]; ?>" alt="COMPANY LOGO" style="max-width:15%">
					</div>
				</div>
				
				<div class="w3-col s1 m1 l1">
				</div>
				
				<div class="w3-col s5 m5 l5">
					<h3>
						<?php echo $templates_data[$rows][1]; ?>
					</h3>
				</div>
				
				<div class="w3-col s1 m1 l1">
				</div>
				
				<div class="w3-col s2 m2 l2 w3-center">
					<a href="/system/functions/create_doc_request.php?<?php echo "client_id=$client_id&company_id={$templates_data[$rows][0]}"; ?>" >
						<button class="w3-button w3-blue-gray">SELECT COMPANY</button>
					</a>
				</div>
				
			</div>
			<br>
			<?php }; ?>
			
		</div>
		
	</body>
	
	<?php $db_conn->close(); ?>
	
</html>