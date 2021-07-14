<?php
	
	$sql = "INSERT INTO cert_log VALUES (0,?,?,?,?)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("isss", $client_id, $main["holder"], $main["date"], $content);

		if($stmt->execute())
		{
			$lid = $db_conn->insert_id;
			$header = "";
			
			if(isset($_GET["panel"]))
			{
				$header = "location:/system/filer/pdf_renderer.php?lid=$lid&panel=1";
			}
			else
			{
				$header = "location:/system/filer/pdf_renderer.php?lid=$lid";
			}
			header($header);
			exit;
		}
	}
	
	$stmt->close();

	$db_conn->close();
	
?>