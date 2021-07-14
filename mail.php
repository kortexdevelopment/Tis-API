<?php
$to = $_GET["to"];
$lid = $_GET["lid"];
$link = "www.truckinsurancesolutions.org/system/filer/pdf_renderer.php?lid=" . $lid;

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: TIS Certifications<certifications@truckinsurancesolutions.org>' . "\r\n";
$headers .= 'Cc: <carlos.reyes.llamas.2008@gmail.com>' . "\r\n";

$subject = "TIS Certificate";

$message = "
<html>
<head>
<title>TIS E-mail</title>
</head>
<body>
<a href=". $link.">View Certificate</a>
<br>
<p>Direct link:</p>
<p>". $link ."</p>
<br>
<p>Note:</p>
<p>Display issues in iOS devices. For more information, visit <a href=". "https://helpx.adobe.com/acrobat/using/display-pdf-in-browser.html" . ">Adobe FAQ</a></p>
<p>Problems using Microsoft Internet Explorer / Edge ? Download the latest version <a href=". "https://www.microsoft.com/en-us/edge" . ">here for PC users</a> and <a href=". "https://play.google.com/store/apps/details?id=com.microsoft.emmx&hl=en" . ">here for Android users</a></p>
";

mail($to,$subject,$message,$headers);

echo "<script>window.close();</script>"
?>