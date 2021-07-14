<?php
	session_start();
    
    if(isset($_SESSION["company_id"]))
    {
        unset($_SESSION["company_id"]);
    }

	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
    
    require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/agencies_data.php";
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
                <h2>REGISTER NEW AGENCY</h2>
            </header>

            <form action="/system/functions/create_agency.php" method="post" class="w3-border">

            <label class="w3-text-blue-gray w3-padding w3-large">General Info</label>
            <div class="w3-row-padding">
                <div class="w3-third">
                    <label class="w3-text-blue-gray">Producer´s Name</label>
                    <input type="text" name="prod" class="w3-input" placeholder="Enter Producer´s Name" required>
                </div>
                <div class="w3-third">
                    <label class="w3-text-blue-gray">Agency´s Name</label>
                    <input type="text" name="agen" class="w3-input" placeholder="Enter Agency´s Name" required>
                </div>
                <div class="w3-third">
                    <label class="w3-text-blue-gray">Agency´s Licence</label>
                    <input type="text" name="lic" class="w3-input" placeholder="Enter Licence Number" required>
                </div>
            </div>

            <br>

            <label class="w3-text-blue-gray w3-padding w3-large">Contact Info</label>
            <div class="w3-row-padding">
                <div class="w3-third">
                    <label class="w3-text-blue-gray">Phone Number</label>
                    <input type="text" name="fon" class="w3-input" placeholder="Enter Phone Number" required>
                </div>
                <div class="w3-third">
                    <label class="w3-text-blue-gray">Fax Number</label>
                    <input type="text" name="fax" class="w3-input" placeholder="Enter Fax Number"   required>
                </div>
                <div class="w3-third">
                    <label class="w3-text-blue-gray">E-Mail</label>
                    <input type="email" name="email" class="w3-input" placeholder="Enter E-mail"    required>
                </div>
            </div>

            <br>

            <label class="w3-text-blue-gray w3-padding w3-large">Location Info</label>
            <div class="w3-row-padding">
                <div class="w3-quarter">
                    <label class="w3-text-blue-gray">Addres</label>
                    <input type="text" name="add" class="w3-input" placeholder="Enter Addres"   required>
                </div>
                <div class="w3-quarter">
                    <label class="w3-text-blue-gray">City</label>
                    <input type="text" name="cty" class="w3-input" placeholder="Enter City"     required>
                </div>
                <div class="w3-quarter">
                    <label class="w3-text-blue-gray">State</label>
                    <input type="text" name="sta" class="w3-input" placeholder="Enter State"    required>
                </div>
                <div class="w3-quarter">
                    <label class="w3-text-blue-gray">Zip</label>
                    <input type="text" name="zip" class="w3-input" placeholder="Enter ZIP"      required>
                </div>
            </div>

            <br>

            <label class="w3-text-blue-gray w3-padding w3-large">Licence Info</label>
            <div class="w3-row-padding">
                <div class="w3-half">
                    <label class="w3-text-blue-gray">Master Password</label>
                    <input type="text" name="pas" class="w3-input" placeholder="Enter Master Password" required>
                </div>
                <div class="w3-half">
                    <label class="w3-text-blue-gray">Licence Duration (YEARS)</label>
                    <input type="number" name="dur" min="1" class="w3-input" value="1" required>
                </div>
            </div>

            <br>
            
            <div class="w3-container w3-center">
                <input type="submit" class="w3-button w3-blue-gray w3-round" value="REGISTER AGENCY">
            </div>
            
            <br>

            </form>

        </div>

        <br>
        <br>

        <div class="w3-container">
            <header class="w3-blue-gray w3-center">
                <h2>REGISTERED AGENCIES</h2>
            </header>

            <br>
				
				<!-- Table goes here -->
				<table class="w3-table w3-striped w3-small">
					<tr class="w3-blue-gray">
						<th>AGENCY NAME</th>
						<th>PRODUCER NAME</th>
						<th>LICENCE NUMBER</th>
						<th>EXP. DATE</th>
                        <th>STATUS</th>
						<th class="w3-center" colspan="3">ACTION</th>
					</tr>
					
					<?php for($rows = 0; $rows < count($agencies_data); $rows++){; ?>
					<tr>
						
                        <?php $names = explode(":", $agencies_data[$rows][1]); ?>

                        <td>
							<?php echo $names[count($names) - 1]; ?>
						</td>

                        <td>
							<?php echo $names[0]; ?>
						</td>
                        
						<td>
							<?php echo $agencies_data[$rows][2]; ?>
						</td>
                        
                        <td>
							<?php echo date("M-d-Y", strtotime($agencies_data[$rows][9])); ?>
						</td>

                        <td>
							<?php echo $agencies_data[$rows][10] == 1 ? "ACTIVE" : "INACTIVE"; ?>
						</td>

						<!-- Delete funciton -->
						<td class="w3-center">
							<a href="/system/functions/cancel_agency.php?aid= <?php echo $agencies_data[$rows][0]; ?>">
								<button class="w3-button w3-round-xxlarge w3-blue-gray" <?php echo $agencies_data[$rows][10] == 0 ? "disabled" : ""; ?>>CANCEL <i class="fa fa-trash-o" style="color:red"></i></button>
							</a>
						</td>
						
						<!-- Update funciton -->
						<td class="w3-center">
							<a href="/system/management/agency_renew.php?aid= <?php echo $agencies_data[$rows][0]; ?>">
								<button class="w3-button w3-round-xxlarge w3-blue-gray">RENEW <i class="fa fa-pencil" style="color:green"></i></button>
							</a>
						</td>
						
                        <!-- Update funciton -->
						<td class="w3-center">
							<a href="/system/management/agency_users.php?aid=<?php echo $agencies_data[$rows][0]; ?>">
								<button class="w3-button w3-round-xxlarge w3-blue-gray">AGENCY USERS <i class="fa fa-users" aria-hidden="true"></i></i></button>
							</a>
						</td>

					</tr>
					<?php }; ?>
					
				</table>
				
				<br>
        </div>

	</body>
	
</html>