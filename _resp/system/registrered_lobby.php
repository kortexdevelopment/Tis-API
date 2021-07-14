<?php
	session_start();
	
	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
	
	$client_id = $_GET["client_id"];
	$mode =  isset($_GET["mode"]) ? $_GET["mode"] : 0;
	$next_mode = $mode == 0 ? 1 : 0;
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/get_pending_request.php";
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - REGISTRERED DOCUMENTS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>

	<body>
		
		<!-- Navigation Bar -->
		<div id="navBar" class="w3-bar w3-border w3-blue-gray w3-padding-small">
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">(MINI-ICON) TSI </a>
			<a href="/system/clients_docs.php" class="w3-bar-item w3-button w3-border-right">RETURN TO CLIENTS</a>
			<a href="/system/document_lobby.php?<?php echo "client_id=$client_id"; ?>" class="w3-bar-item w3-button w3-border-right">RETURN TO COMPANIES</a>
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
				<h2><?php echo $mode == 0 ? "PENDING " : "READY "; ?>DOCUMENTATION</h2>
			</header>
			
			
			
			<a href="/system/registrered_lobby.php?<?php echo "client_id=".$client_id."&mode=".$next_mode; ?>" class="w3-right w3-small">
				<button class="w3-button w3-round-xxlarge w3-blue-gray"><?php echo $mode == 0 ? "SEE READY DOCUMENTS" : "SEE PENDING DOCUMENTS"; ?></button>
			</a>
			
			<br>
			<br>
			
			<?php for($rows = 0; $rows < count($pendings_data); $rows++){; ?>
			<div class="w3-row-padding w3-leftbar w3-bottombar">
				
				<div class="w3-col s1 m1 l1 w3-center">
					<h3> <?php echo "#".$pendings_data[$rows][0]; ?> </h3>
				</div>
				
				<div class="w3-col s2 m2 l2">
					<div class="w3-center">
						<img src="<?php echo $pendings_data[$rows][2]; ?>" alt="COMPANY LOGO" style="max-width:15%">
					</div>
				</div>
				
				<div class="w3-col s1 m1 l1">
				</div>
				
				<div class="w3-col s5 m5 l5">
					<h3>
						<?php echo $pendings_data[$rows][1]; ?>
					</h3>
				</div>
				
				<div class="w3-col s1 m1 l1">
				</div>
				
				<div class="w3-col s2 m2 l2 w3-center">
					<?php if ($mode == 0) {;?>
					<a href="/system/document_config.php?<?php echo "client_id=$client_id&request_id={$pendings_data[$rows][0]}";?>" >
						<button class="w3-button w3-blue-gray">CONTINUE CONFIGURATION</button>
					</a>
					<?php }else{; ?>
					<a href="/system/ready_files/request_<?php echo $pendings_data[$rows][0];?>.docx" download>
						<button class="w3-button w3-blue-gray w3-round-xxlarge"><i class="fa fa-download w3-xxlarge" style="color:lime"></i></button>
					</a>
					<a href="/system/document_config.php?<?php echo "client_id=$client_id&request_id={$pendings_data[$rows][0]}";?>" >
						<button class="w3-button w3-blue-gray w3-round-xxlarge"><i class="fa fa-eye w3-xxlarge" style="color:black"></i></button>
					</a>
					<?php };?>
				</div>
				
			</div>
			<br>
			<?php }; ?>
			
		</div>
		
	</body>
	
	<?php $db_conn->close(); ?>
	
</html>