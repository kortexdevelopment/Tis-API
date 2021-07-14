<?php
	
	
	$doc_name = $_GET["desc"];
	$target_dir = $_SERVER["DOCUMENT_ROOT"] . "/system/ready_files/";
	$target_file = $target_dir . $doc_name;
	
	header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$doc_name");
    header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: binary");

    readfile($target_file);
	
	exit;
?>