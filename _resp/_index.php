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
	</head>
	
	<body>
		
		<!-- Header image -->
		<div class="w3-row" id="topHome">
			<img src="/img/test/topBanner.jpg" alt="Top Banner" style="width:100%">
		</div>
		
		<!-- Navigation Bar -->
		<div id="navBar" class="w3-bar w3-border w3-blue-gray w3-padding-small">
			<!-- Add Image and remove text -->
			<a href="#topHome" class="w3-bar-item w3-button">(MINI-ICON) TSI </a>
			<a href="#SectionA" class="w3-bar-item w3-button w3-border-left">Services</a>
			<a href="#SectionB" class="w3-bar-item w3-button w3-border-left">Products</a>
			<a href="#SectionC" class="w3-bar-item w3-button w3-border-left">About Us</a>
			<button onclick="document.getElementById('loginModal').style.display='block'" class=" w3-bar-item w3-button w3-border w3-round-xxlarge w3-right w3-hover-red">Log In</button>
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
			
			<div class="w3-col s8 m8 l8 w3-padding-small w3-center">
				<p>Sample text to test. Sample text to test.Sample text to test.Sample text to test.<br></p>
				<p>Sample text to test. Sample text to test.Sample text to test.Sample text to test.<br></p>
				<p>Sample text to test. Sample text to test.Sample text to test.Sample text to test.<br></p>
				<p>Sample text to test. Sample text to test.Sample text to test.Sample text to test.<br></p>
				<p>Sample text to test. Sample text to test.Sample text to test.Sample text to test.<br></p>
				<p>Sample text to test. Sample text to test.Sample text to test.Sample text to test.<br></p>
				<p>Sample text to test. Sample text to test.Sample text to test.Sample text to test.<br></p>
			</div>
			
			<div class="w3-col s3 m4 l4">
				<img src="/img/test/2x3.jpg" alt="Image for testing" class="w3-center">
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
				<div class="w3-col w3-padding">
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
			
			<div class="w3-center">
				<img src="/img/test/8x6.jpg" alt="Image for testing">
			</div>
			
		</div>
		
		<br>
		
		<!-- Section container -->
		<div class="w3-row" id="SectionC">
		
			<header class="w3-container w3-blue-gray w3-padding-small w3-center">
				<h2>About Us</h2>
			</header>
			<br>
			
			<div class="w3-display-container w3-center">
				<img src="/img/test/13x4.jpg" alt="Image for testing" style="width:75%">
				<div class="w3-display-bottommiddle w3-container">
					<p>Sample text for test over image</p>
				</div>
			</div>
			<br>
			
		</div>
		
		<br>
		
		<!-- Footer container -->
		<footer class="w3-container w3-blue-gray w3-padding">
			<br>
			<div class="w3-row">
				<div class="w3-col s3 m3 l3 w3-center">
					<img src="/img/test/2x3.jpg" alt="Footer img" style="width:30%">
				</div>
				
				<div class="w3-col s2 m2 l2 w3-border-right w3-center">
					<h4>Contact</h4>
					<p>Link</p>
					<p>Link</p>
					<p>Link</p>
				</div>
				
				<div class="w3-col s2 m2 l2 w3-border-right w3-center">
					<h4>Privacy</h4>
					<p>Link</p>
					<p>Link</p>
					<p>Link</p>
				</div>
				
				<div class="w3-col s2 m2 l2 w3-border-right w3-center">
					<h4>Jobs</h4>
					<p>Link</p>
					<p>Link</p>
					<p>Link</p>
				</div>
				
			</div>
		</footer>
		
	</body>
	
</html>