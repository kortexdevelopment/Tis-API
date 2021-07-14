<?php
	session_start();

	if(!isset($_SESSION["logged"]) || $_SESSION["logged"] === false)
	{
		header("location: /_index.php");
		exit;
	}

    require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/clients_data.php";

    $client = FALSE;
    $cid = 0;
    if(isset($_GET["cid"]))
    {
        $client = TRUE;
        $cid = $_GET["cid"];
    }

	$db_conn->close();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - REQUEST HISTORY</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>

    <script>

    function shower(id) 
    {
        var x = document.getElementById(id);
        if (x.className.indexOf("w3-show") == -1) 
        {
            x.className += " w3-show";
        } 
        else 
        { 
            x.className = x.className.replace(" w3-show", "");
        }
    }

	function SelectClient(cid, s)
	{
		if(s)
		{
			shower("clients");
		}

		var tab = document.getElementById("tblHistory");

		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                tab.innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "/system/functions/client_request_data.php?cid=" + cid, true);
        xmlhttp.send();
	}

	function CancelRequest(rid, cid)
	{
		var result = confirm("If the request is cancelled, it cannot be undone.\nDo you want to continue?");

		if(!result)
		{
			return;
		}
		
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                SelectClient(cid, false);
            }
        };
        xmlhttp.open("GET", "/system/functions/cancel_client_request.php?hst=1&rid=" + rid, true);
        xmlhttp.send();
	}

    </script>

	<body>

		<!-- Navigation Bar -->
		<div id="navBar" class="w3-bar w3-border w3-blue-gray w3-padding-small">
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">(MINI-ICON) TSI </a>
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right">RETURN TO MAIN </a>
			<a href="/system/client_request.php" class="w3-bar-item w3-button w3-border-right">REQUEST MENU</a>
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
				<h2>REQUEST HISTORY <span class="w3-tiny">*Click headers to show/hide information</span></h2>
			</header>

			<button onclick="shower('clients')" class="w3-btn w3-block w3-blue-grey">CLIENTS LIST </button>
            <div id="clients" class="w3-hide w3-show w3-container w3-padding">
                <!-- Table goes here -->
				<table class="w3-table w3-striped">
					<tr class="w3-blue-gray">
						<th>FIRST NAME</th>
						<th>LAST NAME</th>
						<th>B.S.N.</th>
						<th>PHONE</th>
						<th>E-MAIL</th>
						<th>ACTION</th>
					</tr>
					<?php for($rows = 0; $rows < count($clients_data); $rows++){; ?>
					<tr>

						<?php for($cols = 2; $cols < 7; $cols++){; ?>
						<td>
							<?php echo $clients_data[$rows][$cols];} ?>
						</td>
						<td>
							<button class="w3-button w3-round-xxlarge w3-blue-gray w3-small" onclick="SelectClient(<?php echo $clients_data[$rows][0]; ?>, true)">SELECT CLIENT</button>
						</td>
					</tr>
					<?php }; ?>
				</table>

            </div>
            
            <br>

            <div class="w3-container">
                <header class="w3-container w3-blue-gray w3-center">
					<h5>CLIENT REQUEST HISTORY</h5>
				</header>

                <div class="w3-container w3-padding w3-responsive">
                    <!-- Table goes here -->
                    <table class="w3-table w3-striped">
                        <tr class="w3-blue-gray">
                            <th>REQUEST NUMBER</th>
                            <th>DATE OF CREATION</th>
                            <th>STATUS</th>
                            <th class="w3-center">ACTION</th>
                        </tr>
                        <tbody id="tblHistory">
						</tbody>
                    </table>
                </div>

			</div>

		</div>

	</body>

</html>