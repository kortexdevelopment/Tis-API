<?php

	session_start();

	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}

	$client_id = $_GET["client_id"];
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/client_docs.php";

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
			<a href="<?php echo isset($_SESSION["client_app"]) ? "" : "/system/main.php"; ?>" class="w3-bar-item w3-button w3-border-right">(MINI-ICON) TSI </a>
			<a href="/system/clients.php" class="w3-bar-item w3-button w3-border-right" style="display:<?php echo isset($_SESSION["client_app"]) ? "none" : "block"; ?>">CLIENTS</a>
			<a href="/system/client_profile.php?client_id=<?php echo $client_id; ?>" class="w3-bar-item w3-button w3-border-right" style="display:<?php echo isset($_SESSION["client_app"]) ? "none" : "block"; ?>">CLIENT PROFILE</a>
			
			<?php if(isset($_SESSION["client_app"])){; ?>
				<a href="/system/client_index.php" class="w3-bar-item w3-button w3-border-right">RETURN TO MAIN MENU</a>
			<?php }; ?>
			
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
			
			<div class="w3-row" style="display:<?php echo isset($_SESSION["client_app"]) ? "none" : "block"; ?>">
				<a href="/system/client_docs.php?client_id=<?php echo $client_id; ?>" class="w3-right">
					<button class="w3-button w3-round-large w3-blue-gray">RETURN TO APPLICATIONS <i class="fa fa-file-text-o" style="color:lime"></i></button>
				</a>
			</div>
				
			<!-- Upload Form -->
			<br>
			
			<div class="w3-container w3-border w3-small" style="display:<?php echo isset($_SESSION["client_app"]) ? "none" : "block"; ?>">
				
				<header class="w3-container w3-center w3-border-bottom">
					<h4 id="add">FILE UPLOAD</h4>
				</header>
				
				<form class="w3-container" action="/system/functions/upload_doc.php?client_id=<?php echo $client_id; ?>" method="post" enctype="multipart/form-data">
					<br>
					<div class="w3-row-padding">
						<div class="w3-third">
							<label class="w3-text-blue-gray">Select File</label>
							<input class="w3-input" type="file" name="file" required>
						</div>
						<div class="w3-third">
							<label class="w3-text-blue-gray">File Description</label>
							<input class="w3-input" type="text" name="desc" required>
						</div>
						<div class="w3-third">
							<label class="w3-text-blue-gray">Enable to Client</label>
							<input class="w3-input" type="checkbox" name="type">
						</div>
					</div>
					
					<br>
					
					<button class="w3-btn w3-blue-gray w3-block w3-round-xxlarge">UPLOAD FILE</button></p>
					
					<br>
				</form>
				
			</div>
			
			<div class="w3-row">
				
				<br>

				<!-- Table goes here -->
				<table class="w3-table w3-striped">
					<tr class="w3-blue-gray">
						<th class="w3-center" style="width:40%">DOCUMENT</th>

						<?php if(!isset($_SESSION["client_app"])){; ?>
							<th class="w3-center" style="width:20%">PERMISION</th>
						<?php }; ?>
						
						<th style="width:40%" class="w3-center" colspan="2">ACTION</th>
					</tr>
					<?php for($rows = 0; $rows < count($client_docs); $rows++){; ?>
						<td>
							<h4><?php echo $client_docs[$rows][3]; ?></h4>
						</td>
						<?php if(!isset($_SESSION["client_app"])){; ?>
							<td>
								<h4><?php echo $client_docs[$rows][4] == 1 ? "AGENCY/CLIENT APP" : "AGENCY"; ?></h4>
							</td>
						<?php }; ?>
						<td class="w3-center">
							<a href="/system/functions/download_doc.php?desc=<?php echo $client_docs[$rows][2]; ?>" target="_blank" >
								<button class="w3-button w3-round-xxlarge w3-blue-gray w3-small">DOWNLOAD</button>
							</a>
						</td>
						<td class="w3-center" style="display:<?php echo isset($_SESSION["client_app"]) ? "none" : "block"; ?>">
							<a href="/system/functions/delete_doc.php?client_id=<?php echo $client_id; ?>&file_id=<?php echo $client_docs[$rows][0]; ?>&file_name=<?php echo $client_docs[$rows][2]; ?>">
								<button class="w3-button w3-round-xxlarge w3-red w3-small" >DELETE</button>
							</a>
						</td>
						<td class="w3-center" style="display:<?php echo isset($_SESSION["client_app"]) ? "block" : "none"; ?>">
							<a href="/doc_mail.php?to=<?php echo $_SESSION["email"];?>&name=<?php echo $client_docs[$rows][3]; ?>&link=<?php echo $client_docs[$rows][2]; ?>" target="_blank">
								<button class="w3-button w3-round-xxlarge w3-red w3-small" >E-MAIL ME</button>
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