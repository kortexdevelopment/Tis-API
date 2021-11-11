<?php
$to = $_GET["to"];
$cc = $_GET["cc"];
$pid = $_GET["pid"];
$link = $_SERVER["DOCUMENT_ROOT"] . "/system/ready_files/certs/cert". $pid . ".pdf";

require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/api/sendCertReply.php";

$dataFilter = explode(':', $_data[0]);
$reply = "{$dataFilter[1]}";
$bcc = $reply;

if($reply == 'Not Set'){
    $reply = 'certifications@truckinsurancesolutions.org'; 
    $bcc = 'certifications@truckinsurancesolutions.org'; //Dev mail
}

// Sender 
$from = 'certifications@truckinsurancesolutions.org'; 
$fromName = 'TIS Certifications'; 
 
// Email subject 
$subject = 'TIS Certificate';  
 
// Attachment file 
$file = $link; 
 
// Email body content 
$htmlContent = ' 
    <h3>TIS Certificate</h3> 
    <p>Your certificate is attached in this mail.</p> 
'; 
 
// Header for sender info 
$headers = "From: $fromName"." <".$from.">"; 
$headers .= "\nBcc: <".$bcc.">";
$headers .= "\nCc: <".$cc.">";
$headers .= "\nReply-To: <".$reply.">";
 
// Boundary  
$semi_rand = md5(time());  
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
 
// Headers for attachment  
$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
 
// Multipart boundary  
$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  
 
// Preparing attachment 
if(!empty($file) > 0){ 
    if(is_file($file)){ 
        $message .= "--{$mime_boundary}\n"; 
        $fp =    @fopen($file,"rb"); 
        $data =  @fread($fp,filesize($file)); 
 
        @fclose($fp); 
        $data = chunk_split(base64_encode($data)); 
        $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .  
        "Content-Description: ".basename($file)."\n" . 
        "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .  
        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
    } 
} 
$message .= "--{$mime_boundary}--"; 
$returnpath = "-f" . $from; 
 
// Send email 
$mail = @mail($to, $subject, $message, $headers, $returnpath);  
 
$obj;

if($mail)
{
    $obj->success = true;
    $obj->reply = $reply;
}
else
{
    $obj->success = false;
}

$jsnObj = json_encode($obj);
echo($jsnObj);

?>