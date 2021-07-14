<?php
	session_start();
	
	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
    
    if(!isset($_GET["aid"]))
    {
        header("location: /system/managemen/agencies.php");
		exit;
    }
    else
    {
        $_SESSION["company_id"] = $_GET["aid"];
    }

    require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/agency_data.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - AGENCIES MANAGEMENTS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	
	<body>
		
		<!-- Navigation Bar -->
		<div id="navBar" class="w3-bar w3-border w3-blue-gray w3-padding-small">
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">(MINI-ICON) TSI </a>
            <a href="/system/management/agencies.php" class="w3-bar-item w3-button w3-border-right">RETURN TO AGENCIES</a>
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
                <h2>RENEW AGENCY LICENCE</h2>
            </header>

            <?php $name = explode(":",$agency_data[1]); ?>

            <form action="/system/functions/renew_agency.php" method="post" class="w3-border">

            <input type="hidden" name="aid" value="<?php echo $agency_data[0]; ?>">
            <input type="hidden" name="date" value="<?php echo $agency_data[9]; ?>">
            <input type="hidden" name="status" value="<?php echo $agency_data[10]; ?>">

            <label class="w3-text-blue-gray w3-padding w3-large">Licence Info</label>
            <div class="w3-row-padding">
                <div class="w3-half">
                    <label class="w3-text-blue-gray">Agency Name</label>
                    <div class="w3-input"> <?php echo $name[count($name) - 1]; ?></div>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue-gray">Licence Duration Extention(YEARS)</label>
                    <input type="number" name="dur" min="1" class="w3-input" value="1" required>
                </div>
            </div>

            <br>
            
            <div class="w3-container w3-center">
                <input type="submit" class="w3-button w3-blue-gray w3-round" value="RENEW AGENCY">
            </div>
            
            <br>

            </form>

            <br>

            <div class="w3-container w3-center">
                <a href="/system/management/agencies.php" class="w3-button w3-red w3-round"> CANCEL</a>
            </div>

        </div>

        <br>

	</body>
	
</html>