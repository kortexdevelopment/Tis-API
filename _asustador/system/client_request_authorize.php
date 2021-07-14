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
		<title>TIS - REQUEST REGISTRATION</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>

	<body>

		<!-- Navigation Bar -->
		<div id="navBar" class="w3-bar w3-border w3-blue-gray w3-padding-small">
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">(MINI-ICON) TSI </a>
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">RETURN TO MAIN </a>
			<a href="/system/client_request.php" class="w3-bar-item w3-button w3-border-right">REQUEST MENU</a>
			<a href="/system/client_request_history.php" class="w3-bar-item w3-button w3-border-right">REQUEST HISTORY</a>
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
				<h2>AUTHORIZATION UPLOAD</h2>
			</header>

			<form class="w3-container" action="/system/functions/upload_authorization.php?rid=<?php echo $_REQUEST["rid"]; ?>&cid=<?php echo $_REQUEST["cid"]; ?>" method="post" enctype="multipart/form-data">
                <br>
                <div class="w3-row-padding">
                    <div class="w3-rest">
                        <label class="w3-text-blue-gray">Select File <span class="w3-tiny w3-text-blue-gray">* Just PDF forms</span></label>
                        <input class="w3-input" type="file" name="file" accept=".pdf" required>
                    </div>
                </div>
                
                <br>
                
                <button class="w3-btn w3-blue-gray w3-block w3-round-xxlarge">UPLOAD AUTHORIZATION</button></p>
                
                <br>
            </form>

		</div>

	</body>

</html>