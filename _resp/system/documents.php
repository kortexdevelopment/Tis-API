<?php
	session_start();
	
	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - DOCUMENTATION</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>

	<body>
		
		<!-- Navigation Bar -->
		<div id="navBar" class="w3-bar w3-border w3-blue-gray w3-padding-small">
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">(MINI-ICON) TSI </a>
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">RETURN TO MAIN PAGE</a>
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
				<h2>DOCUMENTATION TASKS</h2>
			</header>
			
			<br>
			
			<div class="w3-row-padding">
				<div class="w3-half w3-center">
					<header class="w3-container w3-blue-gray">
						<h4>DOWNLOAD A</h3>
					</header>
					<br>
					<i class="fa fa-file-word-o w3-jumbo" style="color:blue"></i>
					<br>
					<br>
					<a href="/system/ready_files/word.docx" class="w3-center" target="_blank" download><button class="w3-button w3-blue-gray w3-round-xxlarge">WORD FILE</button></a>
					<br>
					<br>
				</div>
				<div class="w3-half w3-center">
					<header class="w3-container w3-blue-gray">
						<h4>DOWNLOAD B</h3>
					</header>
					<br>
					<i class="fa fa-file-pdf-o w3-jumbo" style="color:red"></i>
					<br>
					<br>
					<a href="/system/ready_files/pdf.pdf" class="w3-center" target="_blank" download><button class="w3-button w3-blue-gray w3-round-xxlarge">PDF FILE</button></a>
					<br>
					<br>
				</div>
			</div>			
			
		</div>
		
	</body>
	
</html>