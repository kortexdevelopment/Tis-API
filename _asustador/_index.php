<?php
	
	require_once __DIR__ . "/system/functions/login.php";

?>

<!DOCTYPE html>
<html>
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
		<div class="w3-row w3-center" id="topHome">
			<img src="/img/logo.png" alt="Top Banner" style="width:50%">
		</div>
		
		<!-- Navigation Bar -->
		<div id="" class="w3-bar w3-border w3-blue-gray w3-padding-small">
			<!-- Add Image and remove text -->
			<a href="#topHome" class="w3-bar-item w3-button">(MINI-ICON) TSI </a>
			<a href="#SectionA" class="w3-bar-item w3-button w3-border-left">Services</a>
			<a href="#SectionB" class="w3-bar-item w3-button w3-border-left">Products</a>
			<a href="#SectionC" class="w3-bar-item w3-button w3-border-left">About Us</a>
			<a href="/system/client_login.php" class="w3-bar-item w3-button w3-border-left">Client's APP</a>
			
			<button onclick="document.getElementById('loginModal').style.display='block'" class=" w3-bar-item w3-button w3-border w3-round-xxlarge w3-right w3-hover-red w3-padding">User Log-In</button>
			
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
		
		<!-- Login Modal -->
		<div id="loginModal" class="w3-modal">
			<div class="w3-modal-content">
				<!-- Modal content -->
				<header class="w3-container w3-blue-gray">
					<h2>Log In</h2>
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
				
				<footer class="w3-container w3-blue-gray w3-padding-small">
						<div class="w3-center">
							<button onclick="document.getElementById('loginModal').style.display='none'" class="w3-button w3-border w3-round-xxlarge w3-red" style="width:50%">Cancel</button>
						</div>
				</footer>
				
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
		
		<!-- Main msg -->
		<div class="w3-center w3-padding-small">
				<p>Sample text to test. Sample text to test.Sample text to test.Sample text to test.<br></p>
				<p>Sample text to test. Sample text to test.Sample text to test.Sample text to test.<br></p>
				<p>Sample text to test. Sample text to test.Sample text to test.Sample text to test.<br></p>
				<p>Sample text to test. Sample text to test.Sample text to test.Sample text to test.<br></p>
				<p>Sample text to test. Sample text to test.Sample text to test.Sample text to test.<br></p>
				<p>Sample text to test. Sample text to test.Sample text to test.Sample text to test.<br></p>
				<p>Sample text to test. Sample text to test.Sample text to test.Sample text to test.<br></p>
		</div>
		
		<br>
		
		<!-- Section container -->
		<div class="w3-row" id="SectionA">
		
			<header class="w3-container w3-blue-gray w3-padding-small w3-center">
				<h2>Services</h2>
			</header>
			<br>
			
			<div class="w3-row w3-container">
				<div class=" w3-twothird w3-center">
					<p>Sample text to test. Sample text to test.Sample text to test.Sample text to test.<br></p>
					<p>Sample text to test. Sample text to test.Sample text to test.Sample text to test.<br></p>
					<p>Sample text to test. Sample text to test.Sample text to test.Sample text to test.<br></p>
					<p>Sample text to test. Sample text to test.Sample text to test.Sample text to test.<br></p>
					<p>Sample text to test. Sample text to test.Sample text to test.Sample text to test.<br></p>
					<p>Sample text to test. Sample text to test.Sample text to test.Sample text to test.<br></p>
					<p>Sample text to test. Sample text to test.Sample text to test.Sample text to test.<br></p>
				</div>
				<div class="w3-third w3-center">
					<img src="/img/services.jpg" alt="Image for testing" class="w3-image">
				</div>
			</div>
			

			
			
		</div>
		
		<br>
		
		<!-- Section container -->
		<div class="w3-row" id="SectionB">
		
			<header class="w3-container w3-blue-gray w3-padding-small w3-center">
				<h2>Products</h2>
			</header>
			<br>
			
			<div class="w3-row">
				<div class="w3-row w3-padding">
					<p>Sample text to test. Sample text to test.Sample text to test.Sample text to test.
					Sample text to test. Sample text to test.Sample text to test.Sample text to test.
					Sample text to test. Sample text to test.Sample text to test.Sample text to test.
					Sample text to test. Sample text to test.Sample text to test.Sample text to test.
					Sample text to test. Sample text to test.Sample text to test.Sample text to test.
					Sample text to test. Sample text to test.Sample text to test.Sample text to test.
					Sample text to test. Sample text to test.Sample text to test.Sample text to test.</p>
				</div>
			</div>
			<br>
			
			<div class="w3-container w3-center">
				<img class="mySlides w3-image w3-animate-fading" src="/img/p001.jpg" style="width:50%">
				<img class="mySlides w3-image w3-animate-fading" src="/img/p002.jpg" style="width:50%">
				<img class="mySlides w3-image w3-animate-fading" src="/img/p003.jpg" style="width:50%">
			</div>
			
			<script>
				var myIndex = 0;
				carousel();

				function carousel() {
				var i;
				var x = document.getElementsByClassName("mySlides");
				for (i = 0; i < x.length; i++) {
					x[i].style.display = "none";  
				}
				myIndex++;
				if (myIndex > x.length) {myIndex = 1}    
				x[myIndex-1].style.display = "inline";  
				setTimeout(carousel, 5000); // Change image every 2 seconds
				}
			</script>

		</div>
		
		<br>
		
		<!-- Section container -->
		<div class="w3-row" id="SectionC">
		
			<header class="w3-container w3-blue-gray w3-padding-small w3-center">
				<h2>About Us</h2>
			</header>
			<br>
			
			<div class="w3-row">
				<div class="w3-row w3-center w3-third">
					<img src="/img/aboutus.jpg" alt="Image for testing" style="width:75%">
				</div>
				<div class="w3-rest">
					<p>Sample text and info about us......</p>
					<p>Sample text and info about us......</p>
					<p>Sample text and info about us......</p>
					<p>Sample text and info about us......</p>
					<p>Sample text and info about us......</p>
					<p>Sample text and info about us......</p>
				</div>
			</div>
			<br>
			
		</div>
		
		<br>
		
		<!-- Footer container -->
		<footer class="w3-container w3-blue-gray w3-padding w3-hide-small">
			<br>
			<div class="w3-row">
				<div class="w3-quarter w3-center">
					<img src="/img/logo.png" alt="Footer img" class="w3-image">
				</div>
				
				<div class="w3-quarter w3-border-right w3-center">
					<h4>Contact</h4>
					<p>Link</p>
					<p>Link</p>
					<p>Link</p>
				</div>
				
				<div class="w3-quarter w3-border-right w3-center">
					<h4>Privacy</h4>
					<p>Link</p>
					<p>Link</p>
					<p>Link</p>
				</div>
				
				<div class="w3-quarter w3-border-right w3-center">
					<h4>Jobs</h4>
					<p>Link</p>
					<p>Link</p>
					<p>Link</p>
				</div>
				
			</div>
		</footer>
		
	</body>
	
</html>