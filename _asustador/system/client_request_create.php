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

    if(isset($_GET["client_id"]))
    {
        $client = TRUE;
        $cid = $_GET["client_id"];
        
        require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/client_data.php";
        require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/vehicles_data.php";
        require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/drivers_data.php";
	    require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/client_coverages_data.php";
        
    }

	$db_conn->close();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TIS - CREATE REQUEST</title>
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

    function oldVehicles(rid, vid)
    {
        if(document.getElementById('vc' + vid).checked)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                }
            };
            xmlhttp.open("GET", "/system/functions/add_request_car.php?rid=" + rid + "&vid=" + vid, true);
            xmlhttp.send();
        }
        else
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                }
            };
            xmlhttp.open("GET", "/system/functions/remove_request_car.php?rid=" + rid + "&vid=" + vid, true);
            xmlhttp.send();
        }
    }

    function oldVehicleUpdate(btn, r, rid, vid)
    {
        if(!document.getElementById('vc' + vid).checked)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                }
            };
            xmlhttp.open("GET", "/system/functions/add_request_car.php?rid=" + rid + "&vid=" + vid, true);
            xmlhttp.send();
        }

        document.getElementById('vc' + vid).disabled = true;
        btn.disabled = true;

        var make, year, gvw, model, vin, value, ded, re, table;

        make = document.getElementById("ovmk" + r).innerText;
        year = document.getElementById("ovyr" + r).innerText;
        gvw = document.getElementById("ovgv" + r).innerText;
        vin = document.getElementById("ovvn" + r).innerText;
        model = document.getElementById("ovmd" + r).innerText;
        value = document.getElementById("ovvl" + r).innerText;
        ded = document.getElementById("ovde" + r).innerText;

        value = value.replace(/[^0-9]+/g,'');
        ded = ded.replace(/[^0-9]+/g,'');

        document.getElementById("nvMake").value = make;
        document.getElementById("nvYear").value = year;
        document.getElementById("nvGvw").value = gvw;
        document.getElementById("nvVin").value = vin;
        document.getElementById("nvModel").value = model;
        document.getElementById("nvValue").value = value;
        document.getElementById("nvDed").value = ded;

        var x, y;

        x = document.getElementById("oldVehicles");
        y = document.getElementById("newVehicles");

        x.className = x.className.replace(" w3-show", "");

        if (y.className.indexOf("w3-show") == -1) 
        {
            y.className += " w3-show";
        }

        y.focus();
    }

    function newVehicle(rid)
    {
        var make, year, gvw, model, vin, value, ded, re, table;

        make = document.getElementById("nvMake").value;
        year = document.getElementById("nvYear").value;
        gvw = document.getElementById("nvGvw").value;
        vin = document.getElementById("nvVin").value;
        model = document.getElementById("nvModel").value;
        value = document.getElementById("nvValue").value;
        ded = document.getElementById("nvDed").value;

        table = document.getElementById("tblVehicles");

        re = /[0-9A-Za-z]{17}/;

        if(!re.test(vin))
        {
            alert("Verify VIN number, must be 17 letter/number combination");
            return;
        }

        if(model == "")
        {
            alert("Verify selected MODEL , must be a valid option");
            return;
        }

        re = /[0-9]+(.[0-9]{0,2})*/;
        if(!re.test(value))
        {
            alert("Verify VALUE number, must be just numbers. No decimals");
            return;
        }

        var data = "";

        data += "rid=" + rid;
        data += "&";
        data += "mk=" + make;
        data += "&";
        data += "yr=" + year;
        data += "&";
        data += "gvw=" + gvw;
        data += "&";
        data += "vin=" + vin;
        data += "&";
        data += "md=" + model;
        data += "&";
        data += "vl=" + value;
        data += "&";
        data += "ded=" + ded;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                table.innerHTML += this.responseText;
                document.getElementById("nvMake").value = "";
                document.getElementById("nvYear").value = "";
                document.getElementById("nvGvw").value = "";
                document.getElementById("nvVin").value = "";
                document.getElementById("nvModel").value = "";
                document.getElementById("nvValue").value = "";
                document.getElementById("nvDed").value = 0;
            }
        };
        xmlhttp.open("GET", "/system/functions/add_request_car_new.php?" + data, true);
        xmlhttp.send();

    }

    function newVehicleRemove(id)
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                document.getElementById("nvr" + id).remove();                
            }
        };
        xmlhttp.open("GET", "/system/functions/remove_request_car.php?did=" + id, true);
        xmlhttp.send();
    }

    function oldDriver(rid, did)
    {
        if(document.getElementById('dv' + did).checked)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                }
            };
            xmlhttp.open("GET", "/system/functions/add_request_driver.php?rid=" + rid + "&did=" + did, true);
            xmlhttp.send();
        }
        else
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                }
            };
            xmlhttp.open("GET", "/system/functions/remove_request_driver.php?rid=" + rid + "&vid=" + did, true);
            xmlhttp.send();
        }
    }

    function oldDriverUpdate(btn , r, rid, did)
    {
        if(!document.getElementById('dv' + did).checked)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                }
            };
            xmlhttp.open("GET", "/system/functions/add_request_driver.php?rid=" + rid + "&did=" + did, true);
            xmlhttp.send();
        }
        
        btn.disabled = true;
        document.getElementById('dv' + did).disabled = true;

        var name, licence, state, dob, doh, exp, re, table;

        name = document.getElementById("odr" + r + "c2").innerText;
        licence = document.getElementById("odr" + r + "c3").innerText;
        state = document.getElementById("odr" + r + "c4").innerText;
        dob = document.getElementById("odr" + r + "c5").innerText;
        doh = document.getElementById("odr" + r + "c6").innerText;
        exp = document.getElementById("odr" + r + "c7").innerText;

        document.getElementById("ndNam").value = name;
        document.getElementById("ndLic").value = licence;
        document.getElementById("ndSta").value = state;
        document.getElementById("ndDob").value = dob;
        document.getElementById("ndDoh").value = doh;
        document.getElementById("ndExp").value = exp;

        var x, y;

        x = document.getElementById("oldDrivers");
        y = document.getElementById("newDrivers");

        x.className = x.className.replace(" w3-show", "");

        if (y.className.indexOf("w3-show") == -1) 
        {
            y.className += " w3-show";
        }

        y.focus();
    }

    function Dater(comp)
    {
        if(comp.value.length == 2)
        {
            comp.value += "/";
        }

        if(comp.value.length == 5)
        {
            comp.value += "/";
        }
    }

    function newDriver(rid)
    {
        var name, licence, state, dob, doh, exp, re, table;

        name = document.getElementById("ndNam").value;
        licence = document.getElementById("ndLic").value;
        state = document.getElementById("ndSta").value;
        dob = document.getElementById("ndDob").value;
        doh = document.getElementById("ndDoh").value;
        exp = document.getElementById("ndExp").value;

        table = document.getElementById("tblDrivers");

        if(state == "")
        {
            alert("Select valid STATE option");
            retur;
        }

        re = /[0-1][0-9]\/[0-3][0-9]\/[0-9]{4}/;

        if(!re.test(dob))
        {
            alert("Verify Date of Birth, remeber to fill all spaces included the 0´s");
            return;
        }

        if(!re.test(doh))
        {
            alert("Verify Date of Hire, remeber to fill all spaces included the 0´s");
            return;
        }

        var data = "";
        data += "rid=" + rid;
        data += "&";
        data += "nam=" + name;
        data += "&";
        data += "lic=" + licence;
        data += "&";
        data += "sta=" + state;
        data += "&";
        data += "dob=" + dob;
        data += "&";
        data += "doh=" + doh;
        data += "&";
        data += "exp=" + exp;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                table.innerHTML += this.responseText;

                document.getElementById("ndNam").value = "";
                document.getElementById("ndLic").value = "";
                document.getElementById("ndSta").value = "";
                document.getElementById("ndDob").value = "";
                document.getElementById("ndDoh").value = "";
                document.getElementById("ndExp").value = "";
            }
        };
        xmlhttp.open("GET", "/system/functions/add_request_driver_new.php?" + data, true);
        xmlhttp.send();

    }

    function newDriverRemove(id)
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                document.getElementById("ndv" + id).remove();                
            }
        };
        xmlhttp.open("GET", "/system/functions/remove_request_driver.php?did=" + id, true);
        xmlhttp.send();
    }

    function Numberer(comp)
    {
        var size = [3,7,11,15,19,23], re, txt;
        re = /[a-zA-Z$&\/+:;=?@#|'<>.^*()%!-]+/g;
        txt = comp.value;

        if(re.test(txt))
        {
            txt = txt.replace(/[a-zA-Z\/$&+:;=?@#|'<>.^*()%!-]/g, "");
        }
        comp.value = "$" + txt;
    }

    function Values(comp)
    {
        var a = document.getElementById("cvrValueA");
        var b = document.getElementById("cvrValueB");

        if(comp.value == 1)
        {
            b.className += " w3-show";
            a.className = a.className.replace(" w3-show", "");
        }
        else
        {
            a.className += " w3-show";
            b.className = b.className.replace(" w3-show", "");
        }
    }

    function cvrUpdate(rid)
    {
        var typ, val, valA, valB, ded, re, table;

        typ = document.getElementById("cvrType").value;
        valA = document.getElementById("cvrValueA").value;
        valB = document.getElementById("cvrValueB").value;
        ded = document.getElementById("cvrDed").value;
        table = document.getElementById("cvrTable");

        if(typ == "")
        {
            alert("Select a valid option for COVERAGE.");
            return;
        }

        if(typ == 1)
        {
            if(valB == "")
            {
                alert("Select a valid option for VALUE.");
                return;
            }
            val = valB;
        }
        else
        {
            val = valA;
        }

        val = val.replace(/[a-zA-Z\/$&+:,;=?@#|'<>.^*()%!-]/g, "");
        re = /[0-9]+/;
        if(!re.test(val))
        {
            alert("The value amount contains invalid characters.\nVerify that does contain just numbers");
            return;
        }

        if(ded == "")
        {
            alert("Select a valid option for DEDUCTIBLE");
            return;
        }

        var data = "";
        data += "rid=" + rid;
        data += "&";
        data += "typ=" + typ;
        data += "&";
        data += "val=" + val;
        data += "&";
        data += "ded=" + ded;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                document.getElementById("cvrType" + typ).disabled = true; 
                document.getElementById("cvrType").value = "";
                document.getElementById("cvrValueA").value = "";
                document.getElementById("cvrValueB").value = "";  
                document.getElementById("cvrDed").value = "";

                Values(document.getElementById("cvrType"));
                
                table.innerHTML += this.responseText;            
            }
        };
        xmlhttp.open("GET", "/system/functions/add_request_cover_update.php?" + data, true);
        xmlhttp.send();

    }

    function cvrUpdateRemove(id, typ)
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                document.getElementById("cvrType" + typ).disabled = false; 
                document.getElementById("cvr" + id).remove();
            }
        };
        xmlhttp.open("GET", "/system/functions/remove_request_cover_update.php?id=" + id, true);
        xmlhttp.send();
    }

    function ConfirmExit()
    {
        var result = confirm('Exiting the page will register the request.\nDo you want to exit?');
        return result;
    }

    function ConfirmRequest()
    {
        var result = confirm('Once the request is registered, no changes can be done.\nDo you want to continue?');
        return result;
    }
    
    function ConfirmCancel()
    {
        var result = confirm('If the request is canceled, all changes made would be lost.\nDo you want to continue?');
        return result;
    }

    </script>

	<body>

		<!-- Navigation Bar -->
		<div id="navBar" class="w3-bar w3-border w3-blue-gray w3-padding-small">
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right" onclick="return ConfirmExit()">(MINI-ICON) TSI </a>
			<a href="/system/main.php" class="w3-bar-item w3-button w3-border-right" onclick="return ConfirmExit()">RETURN TO MAIN </a>
			<a href="/system/client_request.php" class="w3-bar-item w3-button w3-border-right" onclick="return ConfirmExit()">REQUEST MENU</a>
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
					<a href="/system/functions/logout.php" onclick="return ConfirmExit()"><button class="w3-button w3-round-xxlarge w3-border w3-red" style="width:50%">Log out</button></a>
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
				<h2>REQUEST REGISTRATION <span class="w3-tiny">*Click headers to show/hide information</span></h2>
			</header>

            <button onclick="shower('clients')" class="w3-btn w3-block w3-blue-grey <?php echo !$client ? "" : "w3-hide"; ?>">CLIENTS LIST <i class="fa fa-level-down" aria-hidden="true"></i></button>
            <div id="clients" class="w3-hide <?php echo !$client ? "w3-show" : ""; ?> w3-container w3-padding">
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
							<a href="/system/functions/create_client_request.php?client_id=<?php echo $clients_data[$rows][0]; ?>">
								<button class="w3-button w3-round-xxlarge w3-blue-gray w3-small">SELECT CLIENT</button>
							</a>
						</td>
					</tr>
					<?php }; ?>
				</table>

            </div>
            
            <div class="w3-container <?php echo !$client ? "w3-hide" : "w3-show"; ?>">
                <div class="w3-card-4 w3-border">
                    <header class="w3-container w3-center w3-blue-gray">
                        <h4>SELECTED CLIENT</h3>
                    </header>
                    <br>
                    <div class="w3-container w3-row-padding">
                        <div class="w3-third">
                            <label class="w3-text-blue-gray w3-border-blue-gray w3-border-bottom">First Name</label>
                            <div class="w3-input"><?php echo $client_data[2]; ?></div>
                        </div>
                        <div class="w3-third">
                            <label class="w3-text-blue-gray w3-border-blue-gray w3-border-bottom">Last Name</label>
                            <div class="w3-input"><?php echo $client_data[3]; ?></div>
                        </div>
                        <div class="w3-third">
                            <label class="w3-text-blue-gray w3-border-blue-gray w3-border-bottom">D.B.A.</label>
                            <div class="w3-input"><?php echo $client_data[4]; ?></div>
                        </div>
                    </div>
                    <br>
                    <br>
                </div>
            </div>

            <br>
			
            <?php if($client) {; ?>
                <button onclick="shower('oldVehicles')" class="w3-btn w3-block w3-blue-grey">VEHICLES MODIFICATIONS <i class="fa fa-level-down" aria-hidden="true"></i></button>
                <div id="oldVehicles" class="w3-hide w3-container ">
                    <!-- Table goes here -->
                    <table class="w3-table w3-striped w3-small">
                        <tr class="w3-blue-gray">
                            <th><br>MAKE</th>
                            <th><br>YEAR</th>
                            <th><br>GVW</th>
                            <th><br>VIN</th>
                            <th><br>MODEL</th>
                            <th>UNIT<br>VALUE</th>
                            <th>UNIT<br>DEDUCTIBLE</th>
                            <th class="w3-center">ACTION</th>
                        </tr>
                        
                        <?php for($rows = 0; $rows < count($vehicles_data); $rows++){; ?>
                        <tr>
                            
                            <td id="ovmk<?php echo $rows; ?>" >
                                <?php echo $vehicles_data[$rows][2]; ?>
                            </td>
                            
                            <td id="ovyr<?php echo $rows; ?>" >
                                <?php echo $vehicles_data[$rows][3]; ?>
                            </td>
                            
                            <td id="ovgv<?php echo $rows; ?>" >
                                <?php echo $vehicles_data[$rows][4]; ?>
                            </td>
                            
                            <td id="ovvn<?php echo $rows; ?>" >
                                <?php echo $vehicles_data[$rows][5]; ?>
                            </td>
                            
                            <td id="ovmd<?php echo $rows; ?>" >
                                <?php echo $vehicles_data[$rows][6]; ?>
                            </td>
                            
                            <td id="ovvl<?php echo $rows; ?>" >
                                <?php echo "$".number_format($vehicles_data[$rows][7]); ?>
                            </td>
                            
                            <td id="ovde<?php echo $rows; ?>" >
                                <?php echo "$".number_format($vehicles_data[$rows][8]); ?>
                            </td>
                            
                            <td class="w3-center">
                                <div>
                                    <input id="vc<?php echo $vehicles_data[$rows][0]; ?>" type="checkbox" name="vc<?php echo $vehicles_data[$rows][0]; ?>" onclick="oldVehicles(<?php echo $_SESSION['request_id']; ?>,<?php echo $vehicles_data[$rows][0]; ?>)">
                                    <label class="w3-text-red"> DELETE</label>
                                </div>
                                <div>
                                    <button class="w3-button w3-blue-gray w3-center" onclick="oldVehicleUpdate(this, <?php echo $rows; ?>,<?php echo $_SESSION['request_id']; ?>,<?php echo $vehicles_data[$rows][0]; ?>)">UPDATE</button>
                                </div>
                            </td>
                        </tr>
                        
                        <?php }; ?>
                        
                    </table>
                    
                    <br>
                    
                </div>

                <br>

                <button onclick="shower('newVehicles')" class="w3-btn w3-block w3-blue-grey">VEHICLE REGISTRATION <i class="fa fa-level-down" aria-hidden="true"></i></button>
                <div id="newVehicles" class="w3-hide w3-container w3-responsive">
                    <!-- Table goes here -->
                    <br>
                    <label class="w3-text-blue-gray w3-large">ADD NEW VEHICLES</label>
                    <table class="w3-table w3-striped w3-small">
                        <tr class="w3-blue-gray">
                            <th><br>MAKE</th>
                            <th><br>YEAR</th>
                            <th><br>GVW</th>
                            <th><br>VIN</th>
                            <th><br>MODEL</th>
                            <th>UNIT<br>VALUE</th>
                            <th>UNIT<br>DEDUCTIBLE</th>
                            <th><br>ADD</th>

                        </tr>
                        
                        <tr>
                            <td>
                                <input id="nvMake" class="w3-input" type="text">
                            </td>
                            
                            <td>
                                <input id="nvYear" class="w3-input" type="text">
                            </td>
                            
                            <td>
                                <input id="nvGvw" class="w3-input" type="text">
                            </td>
                            
                            <td>
                                <input id="nvVin" class="w3-input" type="text"  maxlength="17" pattern="[0-9A-Za-z]{17}">
                            </td>
                            
                            <td>
                                <select id="nvModel" class="w3-select">
                                    <option value="" disabled selected>Options</option>
                                    <option value="Tractor">TRACTOR</option>
                                    <option value="Trailer">TRAILER</option>
                                    <option value="Non Owned">NON OWNED</option>
                                    <option value="Interchange">INTERCHANGE</option>
                                </select>
                            </td>
                            
                            <td>
                                <input id="nvValue" class="w3-input" type="text" pattern="[0-9]+(.[0-9]{0,2})*">
                            </td>
                            
                            <td>
                                <select id="nvDed" class="w3-select">
                                    <option value="0" selected>N/A</option>
                                    <option value="1000">1,000.00</option>
                                    <option value="2500">2,500.00</option>
                                    <option value="5000">5,000.00</option>
                                </select>
                            </td>
                            
                            <td>
                                <button class="w3-button w3-circle w3-green" onclick="newVehicle(<?php echo $_SESSION['request_id']; ?>)">+</button>
                            </td>

                        </tr>

                    </table>
                    
                    <label class="w3-text-blue-gray w3-large">REGISTERED NEW VEHICLES</label>
                    <table  class="w3-table w3-striped w3-small">
                        <tr class="w3-blue-gray">
                            <th><br>MAKE</th>
                            <th><br>YEAR</th>
                            <th><br>GVW</th>
                            <th><br>VIN</th>
                            <th><br>MODEL</th>
                            <th>UNIT<br>VALUE</th>
                            <th>UNIT<br>DEDUCTIBLE</th>
                            <th><br>REMOVE</th>
                        </tr>
                        <tbody id="tblVehicles">
                        </tbody>
                    </table>
                    
                    <br>
                    
                </div>

                <br>

                <button onclick="shower('oldDrivers')" class="w3-btn w3-block w3-blue-grey">DRIVERS MODIFICATIONS <i class="fa fa-level-down" aria-hidden="true"></i></button>
                <div id="oldDrivers" class="w3-container w3-hide ">
                    <!-- Table goes here -->
                    <table class="w3-table w3-striped w3-small">
                        <tr class="w3-blue-gray">
                            <th>NAME</th>
                            <th>LICENCE NUMBER</th>
                            <th>STATE</th>
                            <th>D.O.B.</th>
                            <th>D.O.H.</th>
                            <th>EXPERIENCE</th>
                            <th>ACTION</th>
                        </tr>
                        
                        <?php for($rows = 0; $rows < count($drivers_data); $rows++){; ?>
                        <tr>
                            
                            <?php for($cols = 2; $cols < 8; $cols++){; ?>
                            <td id="<?php echo "odr" . $rows . "c" .$cols; ?>" >
                                <?php echo ($cols < 5 || $cols > 6) ? $drivers_data[$rows][$cols] : date("m/d/Y", strtotime($drivers_data[$rows][$cols]));} ?>
                            </td>
                            
                            <!-- Update funciton -->
                            <td class="w3-center">
                                <div>
                                    <input id="dv<?php echo $drivers_data[$rows][0];?>" type="checkbox" onclick="oldDriver(<?php echo $_SESSION['request_id']; ?>, <?php echo $drivers_data[$rows][0];?>)" >
                                    <label class="w3-text-red"> DELETE</label>
                                </div>
                                <div>
                                    <button class="w3-button w3-blue-gray w3-center" onclick="oldDriverUpdate(this, <?php echo $rows; ?>,<?php echo $_SESSION['request_id']; ?>, <?php echo $drivers_data[$rows][0];?>)">UPDATE</button>
                                </div>
                            </td>
                            
                        </tr>
                        <?php }; ?>
                        
                    </table>
                    
                    <br>
                    
                </div>

                <br>
                
                <button onclick="shower('newDrivers')" class="w3-btn w3-block w3-blue-grey">DRIVER REGISTRATION <i class="fa fa-level-down" aria-hidden="true"></i></button>
                
                <div id="newDrivers" class="w3-container w3-hide ">

                    <br>

                    <!-- Table goes here -->
                    <label class="w3-large w3-text-blue-gray">REGISTER NEW DRIVER</label>
                    <table class="w3-table w3-striped w3-small">
                        <tr class="w3-blue-gray">
                            <th>NAME</th>
                            <th>LICENCE NUMBER</th>
                            <th>STATE</th>
                            <th>D.O.B.</th>
                            <th>D.O.H.</th>
                            <th>EXPERIENCE</th>
                            <th>ADD</th>
                        </tr>
                        
                        <tr>
                            
                            <td>
                                <input class="w3-input" id="ndNam" type="text">
                            </td>
                            <td>
                                <input class="w3-input" id="ndLic" type="text">
                            </td>
                            <td>
                                <select class="w3-select" id="ndSta" class="w3-select">
                                    <option value="" selected>Options</option>
                                    <option value="CA">CA - California</option>
                                    <option value="AZ">AZ - Arizona</option>
                                    <option value="NV">NV - Nevada</option>
                                    <option value="OTHER">OTHER</option>
                                </select>
                            </td>
                            <td>
                                <input class="w3-input" id="ndDob" type="text" placeholder="MM/DD/YYYY" maxlength="10" onkeyup="Dater(this)">
                            </td>
                            <td>
                                <input class="w3-input" id="ndDoh" type="text" placeholder="MM/DD/YYYY" maxlength="10" onkeyup="Dater(this)">
                            </td>
                            <td>
                                <input class="w3-input" id="ndExp" type="text">
                            </td>
                            <td>
                                <button class="w3-button w3-circle w3-green" onclick="newDriver(<?php echo $_SESSION['request_id']; ?>)">+</button>
                            </td>

                        </tr>

                    </table>
                    
                    <label class="w3-large w3-text-blue-gray">REGISTERED NEW DRIVERS</label>
                    <table class="w3-table w3-striped w3-small">
                        <tr class="w3-blue-gray">
                            <th>NAME</th>
                            <th>LICENCE NUMBER</th>
                            <th>STATE</th>
                            <th>D.O.B.</th>
                            <th>D.O.H.</th>
                            <th>EXPERIENCE</th>
                            <th>REMOVE</th>
                        </tr>
                        <tbody id="tblDrivers">
                        </tbody>

                    </table>

                    <br>
                    
                </div>
                
                <br>
                
                <button onclick="shower('covers')" class="w3-btn w3-block w3-blue-grey">COVERAGES MODIFICATION<i class="fa fa-level-down" aria-hidden="true"></i></button>
                
                <div id="covers" class="w3-container w3-hide ">
                    <br>

                    <div class="w3-card-4 w3-border">
                        <header class="w3-center w3-container w3-blue-gray">  
                            CURRENT COVERAGES VALUES
                        </header>
                        <div class="w3-row-padding">
                            <div class="w3-third">
                                <label class="w3-text-blue-gray">Liability</label>
                                <div class="w3-row-padding">
                                    <div class="w3-half">
                                        <label class="w3-text-blue-gray w3-small">Value</label>
                                        <div class="w3-input"><?php echo "$" . number_format($client_coverages_data[0][2]); ?></div>
                                    </div>
                                    <div class="w3-half">
                                        <label class="w3-text-blue-gray w3-small">Deductible</label>
                                        <div class="w3-input"><?php echo "$" . number_format($client_coverages_data[0][3]); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="w3-third">
                                <label class="w3-text-blue-gray">Cargo</label>
                                <div class="w3-row-padding">
                                    <div class="w3-half">
                                        <label class="w3-text-blue-gray w3-small">Value</label>
                                        <div class="w3-input"><?php echo "$" . number_format($client_coverages_data[0][4]); ?></div>
                                    </div>
                                    <div class="w3-half">
                                        <label class="w3-text-blue-gray w3-small">Deductible</label>
                                        <div class="w3-input"><?php echo "$" . number_format($client_coverages_data[0][5]); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="w3-third">
                                <label class="w3-text-blue-gray">Gral. Liability</label>
                                <div class="w3-row-padding">
                                    <div class="w3-half">
                                        <label class="w3-text-blue-gray w3-small">Value</label>
                                        <div class="w3-input"><?php echo "$" . number_format($client_coverages_data[0][6]); ?></div>
                                    </div>
                                    <div class="w3-half">
                                        <label class="w3-text-blue-gray w3-small">Deductible</label>
                                        <div class="w3-input"><?php echo "$" . number_format($client_coverages_data[0][7]); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    
                    <label class="w3-large w3-text-blue-gray">REGISTER COVERAGE UPDATE</label>
                    <table class="w3-table w3-striped w3-small">
                        <tr class="w3-blue-gray">
                            <th>COVERAGE</th>
                            <th>VALUE</th>
                            <th>DEDUCTIBLE</th>
                            <th>REGISTER</th>
                        </tr>
                        
                        <tr>
                            
                            <td>
                                <select class="w3-select" id="cvrType" class="w3-select" onchange="Values(this)">
                                    <option value="" selected disabled>Options</option>
                                    <option id="cvrType1" value="1">Liability</option>
                                    <option id="cvrType2" value="2">Cargo</option>
                                    <option id="cvrType3" value="3">Gral. Liability</option>
                                </select>
                            </td>
                            <td>
                                <input class="w3-input w3-right-align w3-hide w3-show" id="cvrValueA" type="text" onkeyup="Numberer(this)">
                                <select class="w3-select w3-hide" id="cvrValueB" class="w3-select">
                                    <option value="" selected disabled>Options</option>
                                    <option value="750000" >$750,000</option>
								    <option value="1000000">$1,000,000</option>
                                </select>
                            </td>
                            <td>
                                <select class="w3-select" id="cvrDed" class="w3-select">
                                    <option value="" selected disabled>Options</option>
                                    <option value="0">N/A</option>
                                    <option value="1000">$1,000</option>
                                    <option value="2500">$2,500</option>
                                    <option value="5000">$5,000</option>
                                </select>
                            </td>
                            <td>
                                <button class="w3-button w3-circle w3-green" onclick="cvrUpdate(<?php echo $_SESSION['request_id']; ?>)">+</button>
                            </td>
                        </tr>

                    </table>

                    <label class="w3-large w3-text-blue-gray">REGISTERED UPDATES</label>
                    <table class="w3-table w3-striped w3-small">
                        <tr class="w3-blue-gray">
                            <th>COVERAGE</th>
                            <th>VALUE</th>
                            <th>DEDUCTIBLE</th>
                            <th>REMOVE</th>
                        </tr>
                        
                        <tbody id="cvrTable">
                        </tbody>
                    </table>

                </div>

                <br>
                
                <div class="w3-container w3-row-padding">
                    <div class="w3-half">
            			<a href="/system/client_request.php" class="w3-btn w3-round w3-block w3-green" onclick="return ConfirmRequest()">REGISTER REQUEST</a>
                    </div>
                    <div class="w3-half">
            			<a href="/system/functions/cancel_client_request.php?rid=<?php echo $_SESSION["request_id"]; ?>" class="w3-btn w3-round w3-block w3-red" onclick="return ConfirmCancel()">CANCEL REQUEST</a>
                    </div>
                </div>

            <?php }; ?>

		</div>

        <br>
        <br>
        <br>

	</body>

</html>