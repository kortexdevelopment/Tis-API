<?php
	define('wHome', dirname(dirname(__FILE__)));
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$errorType = 0;
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		
		if(!empty(trim($_POST["user_name"])) && !empty(trim($_POST["user_password"])))
		{
			
			$email = trim($_POST["user_name"]);
			$password = trim($_POST["user_password"]);
			$sql = "SELECT users.id, users.companies_id , users.name, companies.master_pass, users.status FROM users INNER JOIN companies ON  users.companies_id = companies.id WHERE email = ? AND password = ?";
			
			if($stmt = $db_conn->prepare($sql))
			{
				$stmt->bind_param("ss", $email, $password);
				
				if($stmt->execute())
				{
					$stmt->store_result();
					
					if($stmt->num_rows == 1)
					{
						$stmt->bind_result($id, $company_id, $name, $pass, $user_type);
						
						if($stmt->fetch())
						{
							session_start();
							
							$_SESSION["logged"] = true;
							$_SESSION["user_id"] = $id;
							$_SESSION["company_id"] = $company_id;
							$_SESSION["user_name"] = $name;
							$_SESSION["master_pass"] = $pass;
							$_SESSION["user_type"] = $user_type;
							header ("location: /system/main.php");
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
	}
	
	$db_conn->close();
?>