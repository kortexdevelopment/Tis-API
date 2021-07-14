<?php
	session_start();

	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}
    
    if(isset($_GET["aid"]))
    {
        $_SESSION["company_id"] = $_GET["aid"];
    }
    
    require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/agency_users_management.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - AGENCY USERS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>

	<body>

		<!-- Navigation Bar -->
		<div id="navBar" class="w3-bar w3-border w3-blue-gray w3-padding-small">
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">(MINI-ICON) TSI </a>
			<a href="/system/management/agencies.php" class="w3-bar-item w3-button w3-border-right">RETURN TO MAIN</a>
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
				<h2>USER REGISTRATION</h2>
                <br>

                <?php if(isset($_GET["error"])) {; ?>
                    <h2 class="w3-red">ERROR: <?php echo $_GET["error"] == 1 ? "Access E-mail already exist!" : "You cannot delete logged user!"; ?> </h2>
                <?php }; ?>

			</header>

            <form action="/system/functions/create_user.php" method="post" class="w3-border">
                
                <div class="w3-row-padding w3-container">
                    <div class="w3-quarter">
                        <label class="w3-text-blue-gray">Personal Name</label>
                        <input type="text" class="w3-input" name="name" required>
                    </div>
                    <div class="w3-quarter">
                        <label class="w3-text-blue-gray">Access E-mail</label>
                        <input type="email" class="w3-input" name="mail" required>
                    </div>
                    <div class="w3-quarter">
                        <label class="w3-text-blue-gray w3-tooltip">Password* <label class="w3-text w3-tiny"> *Just letters and numbers</label></label>
                        <input type="text" class="w3-input" pattern="^[a-zA-Z0-9]*$" name="pass" required>
                    </div>
                    <div class="w3-quarter">
                        <label class="w3-text-blue-gray">Access Level</label>
                        <select class="w3-select" name="level" required>
                            <option value="" disabled selected>Choose your option</option>
                            <option value="2">Admin</option>
                            <option value="1">Normal</option>
                        </select>
                    </div>
                </div>

                <br>

                <div class="w3-container w3-center">
                    <input class="w3-button w3-round w3-blue-gray" type="submit" value="Register">
                </div>
                
                <br>

                <div class="w3-container">
                    <label class="w3-text-blue-gray">Access Level Info</label>
                    <div class="w3-container">
                        <p>Admin  : Total access and control</p>
                        <p>Normal : Users need admin authorization for high value data access</p>
                    </div>
                </div>

            </form>

            
            <br>
            
		</div>

		<br>
		<br>

		<div id="list" class="w3-container">
			<header class="w3-blue-gray w3-center">
				<h2>AGENCY USERS</h2>
			</header>

            <br>

            <table class="w3-table w3-striped w3-small">
                <tr class="w3-blue-gray">
                    <th>NAME</th>
                    <th>ACCESS MAIL</th>
                    <th>PASSWORD</th>
                    <th>LEVEL</th>
                    <th class="w3-center">ACTION</th>
                </tr>
                
                <?php $adminCnt = 0; ?>

                <?php for($rows = 0; $rows < count($users_data); $rows++){; ?>
                    <?php $adminCnt += $users_data[$rows][5] == 2 ? 1 : 0; ?>
                <?php }; ?>
                    
                <?php for($rows = 0; $rows < count($users_data); $rows++){; ?>
                
                <?php $canDelete = true; ?>
                <?php $admin = $users_data[$rows][5] == 2; ?>
                <?php $canDelete = count($users_data) > 1 && $adminCnt >= 1; ?>

                <tr>
                    
                    <td>
                        <?php echo $users_data[$rows][2]; ?>
                    </td>
                    
                    <td>
                        <?php echo $users_data[$rows][3]; ?>
                    </td>

                    <td>
                        <?php echo $_SESSION["admin"] == true ? $users_data[$rows][4] : "*****"; ?>
                    </td>

                    <td>
                        <?php echo $admin == 2 ? "ADMIN" : "NORMAL"; ?>
                    </td>

                    <!-- Delete funciton -->
                    <td class="w3-center">
                        <a href="/system/functions/delete_user.php?uid=<?php echo $users_data[$rows][0]; ?>">
                            <button class="w3-button w3-round-xxlarge w3-blue-gray" <?php echo $canDelete ? ($canDelete && $admin && $adminCnt == 1) ? "disabled" : "" : "disabled"; ?> >DELETE <i class="fa fa-trash-o" style="color:red" ></i></button>
                        </a>
                    </td>
                    
                </tr>
                <?php }; ?>
                
            </table>

		</div>

		<br>
		<br>

	</body>

</html>