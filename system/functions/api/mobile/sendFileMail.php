<?php
$to = $_GET["to"];
$file = $_GET["file"];
$link = $_SERVER["DOCUMENT_ROOT"] . "/system/ready_files/" . $file ;

// Sender 
$from = 'certifications@truckinsurancesolutions.org'; 
$fromName = 'TIS Service'; 
 
// Email subject 
$subject = 'TIS Service';  
 
// Attachment file 
$file = $link; 
 
// Email body content 
$htmlContent = ' 
    <h3>TIS Service</h3> 
    <p>Your file is attached in this mail.</p> 
'; 
 
// Header for sender info 
$headers = "From: $fromName"." <".$from.">"; 
$headers .= "\nBcc: <carlos.reyes.llamas.2008@gmail.com>";
 
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
}
else
{
    $obj->success = false;
}

$jsnObj = json_encode($obj);
echo($jsnObj);

?>