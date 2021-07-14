<?php
	define('wHome', dirname(dirname(__FILE__)));
		
	$errorType = 0;
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
		
		if(!empty(trim($_POST["user_name"])) && !empty(trim($_POST["user_password"])))
		{
			
			$user = trim($_POST["user_name"]);
			$password = trim($_POST["user_password"]);
			$sql = "SELECT client_user.id, client_user.clients_id, client_user.user, client_user.password, client_user.status, clients.email  FROM client_user 
			INNER JOIN clients ON client_user.clients_id = clients.id 
			WHERE client_user.user = ? AND client_user.password = ? AND client_user.status = 1";
			
			if($stmt = $db_conn->prepare($sql))
			{
				$stmt->bind_param("ss", $user, $password);
				
				if($stmt->execute())
				{
					$stmt->store_result();
					
					if($stmt->num_rows == 1)
					{
						$stmt->bind_result($id, $client_id, $user_name, $user_pass, $status, $email);
						
						if($stmt->fetch())
						{
							session_start();
							
							$_SESSION["logged"] = true;
							$_SESSION["user_id"] = $id;
							$_SESSION["client_id"] = $client_id;
							$_SESSION["email"] = $email;
							$_SESSION["client_app"] = true;
							
							header ("location: /system/client_index.php");
							exit;
						}
						else
						{
							$errorType = 1;
						}
					}
					else
					{
						$errorType = 1;
					}
				}
				else
				{
					$errorType = 2;
				}
			}
			else
			{
				$errorType = 2;
			}
			
			$stmt->close();
		}
		else
		{
			$errorType = 1;
		}
		
		$db_conn->close();
	}
	
	
?>