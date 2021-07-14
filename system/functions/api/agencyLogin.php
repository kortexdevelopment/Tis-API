<?php
	header('Cache-control: no-cache, must-revalidate');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/apiDB.php";
	
	$errorType = 0;
	
	$obj;
    $jsnObj;

	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		
		if(!empty(trim($_REQUEST["user"])) && !empty(trim($_REQUEST["pass"])))
		{
			
			$email = trim($_REQUEST["user"]);
			$password = trim($_REQUEST["pass"]);
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
							$obj->userId = $id;
							$obj->userNm = $name;
							$obj->userTp = $user_type;
							$obj->compId = $company_id;
							
							mysqli_close($db_conn);
							$stmt->close();
							$jsnObj = json_encode($obj);
                            echo($jsnObj);
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
	
	mysqli_close($db_conn);
	$obj->error = $errorType;
    $jsnObj = json_encode($obj);
    echo($jsnObj);
	exit;
?>