<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/client_login.php";

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>TIS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<style>
			.sticky 
			{
				position: fixed;
				top: 0;
				width: 100%;
			}
		</style>

		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
		<link rel="manifest" href="/site.webmanifest">
		<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="theme-color" content="#ffffff">
		<meta charset="UTF-8">

	</head>
	
	

	<body>
		
		<!-- Header image -->
		<div class="w3-row" id="topHome">
			<img src="/img/test/topBanner.jpg" alt="Top Banner" style="width:100%">
		</div>
		
		<!-- Navigation Bar -->
		<div id="navBar" class="w3-bar w3-border w3-blue-gray w3-padding-small">
			<!-- Add Image and remove text -->
			<a href="#topHome" class="w3-bar-item w3-button">(MINI-ICON) Truck Insurance Solutions</a>
		</div>
		
		<!-- Stiky Navbar -->
		<script>
			window.onscroll = function() {myFunction()};

			var navbar = document.getElementById("navBar");
			var sticky = navbar.offsetTop;

			function myFunction() 
			{
				if (window.pageYOffset >= sticky) 
				{
				navbar.classList.add("sticky");
				} 
				else 
				{
				navbar.classList.remove("sticky");
				}
			}
		</script>
		
		<br>
		<br>
		
		<!-- Login Modal -->
		<div id="loginModal" class="w3-card-2 w3-padding">
			<div class="w3-container">
				<!-- Modal content -->
				<header class="w3-container w3-blue-gray">
					<h2>Client Log-in</h2>
				</header>
				
				<form class="w3-container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<br>
					<label class="w3-text-blue-gray"><b>User Name</b></label>
					<input class="w3-input w3-border w3-round-xlarge" placeholder="Enter user name or registered e-mail" type="text" name="user_name">
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
		
		<!-- Login Error Modal -->
		<div id="loginErrorModal" class="w3-modal">
			<div class="w3-modal-content">
				<!-- Modal content -->
				<header class="w3-container w3-red">
					<h2>Log In</h2>
				</header>
				
				<form class="w3-container w3-center">
					<br>
					<i class="fa fa-user-times w3-jumbo"></i>
					<h3>User / Password invalid. Please try again.</h3>
					<br>
				</form>
				
				<footer class="w3-container w3-red w3-padding-small">
						<div class="w3-center">
							<button onclick="document.getElementById('loginErrorModal').style.display='none'" class="w3-button w3-border w3-round-xxlarge w3-blue-gray" style="width:50%">Close</button>
						</div>
				</footer>
				
			</div>
		</div>
		
		<!-- Conection Error Modal -->
		<div id="connErrorModal" class="w3-modal">
			<div class="w3-modal-content">
				<!-- Modal content -->
				<header class="w3-container w3-red">
					<h2>Log In</h2>
				</header>
				
				<form class="w3-container w3-center">
					<br>
					<i class="fa fa-sitemap w3-jumbo"></i>
					<h3>Cannot connect to server. Please try again later.</h3>
					<br>
				</form>
				
				<footer class="w3-container w3-rad w3-padding-small">
						<div class="w3-center">
							<button onclick="document.getElementById('connErrorModal').style.display='none'" class="w3-button w3-border w3-round-xxlarge w3-blue-gray" style="width:50%">Close</button>
						</div>
				</footer>
				
			</div>
		</div>
		
		<?php
			switch($errorType)
			{
				case 0:
					//Everything did work
					break;
				case 1:
					echo "<script> document.getElementById('loginErrorModal').style.display='block'; </script>";
					break;
				case 2:
					echo "<script> document.getElementById('connErrorModal').style.display='block'; </script>";
					break;
			}
		?>
		
		<br>
		
		<!-- Footer container -->
		<footer class="w3-container w3-hide-small w3-blue-gray w3-padding">
			<br>
		</footer>
		
	</body>

</html>