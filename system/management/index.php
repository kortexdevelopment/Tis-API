<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/console_login.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - CONSOLE LOGIN</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>

    
    
	<body>

        <!-- Navigation Bar -->
        <div id="navBar" class="w3-bar w3-border w3-blue-gray w3-padding-small">
            <a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">(MINI-ICON) TSI </a>
        </div>

        <br>

		<div class="w3-container">

            <div class="w3-container">
				<header class="w3-container w3-blue-gray">
					<h2>Console Log-in</h2>
				</header>
				
				<form class="w3-container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<br>
					<label class="w3-text-blue-gray"><b>User Name</b></label>
					<input class="w3-input w3-border w3-round-xlarge" placeholder="Enter user name" type="text" name="user_name">
					<br>
					<label class="w3-text-blue-gray"><b>Password</b></label>
					<input class="w3-input w3-border w3-round-xlarge" placeholder="Enter Password" type="password" name="user_password">
					<br>
					<div class="w3-center">
						<button class="w3-button w3-block w3-border w3-round-xxlarge w3-blue-gray">Log In</button>
					</div>
					<br>
				</form>
				
			</div>

		</div>

	</body>

</html>