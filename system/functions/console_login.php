<?php
	$errorType = 0;
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
		
		if(!empty(trim($_POST["user_name"])) && !empty(trim($_POST["user_password"])))
		{
			
			$user = trim($_POST["user_name"]);
			$password = trim($_POST["user_password"]);
			$sql = "SELECT * FROM managers WHERE user = ? AND pass = ?";
			
			if($stmt = $db_conn->prepare($sql))
			{
				$stmt->bind_param("ss", $user, $password);
				
				if($stmt->execute())
				{
					$stmt->store_result();
					
					if($stmt->num_rows == 1)
					{
						$stmt->bind_result($id, $name, $us, $ps, $level);
						
						if($stmt->fetch())
						{
							session_start();
							
							$_SESSION["logged"] = true;
							$_SESSION["user_id"] = $id;
							$_SESSION["user_name"] = $name;
							$_SESSION["admin"] = $level == 1 ? true : false;
							$_SESSION["console"] = true;
							header ("location: /system/management/agencies.php");
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
			
			// $stmt->close();
		}
		else
		{
			$errorType = 1;
		}
		
		$db_conn->close();
	}
	
	
?>