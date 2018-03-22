<?php
define('GUSER', 'kwatuha@gmail.com'); // Gmail username

//2011agentzl
define('GPWD', 'josephkwatuha'); // Gmail password
require_once('../phpmailer/class.phpmailer.php');
function smtpmailer($to, $from, $from_name, $subject, $body) {
       global $error;
       $mail = new PHPMailer();  // create a new object
       $mail->IsSMTP(); // enable SMTP
       $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
       $mail->SMTPAuth = true;  // authentication enabled
       $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
       $mail->Host = 'smtp.googlemail.com';
       $mail->Port = 465;
       $mail->Username = GUSER;  
       $mail->Password = GPWD;          
       $mail->SetFrom($from, $from_name);
       $mail->Subject = $subject;
       $mail->Body = $body;
       $mail->AddAddress($to);
       if(!$mail->Send()) {
               $error = 'Mail error: '.$mail->ErrorInfo;
               return false;
       } else {
               $error = 'Message sent!';
               return true;
       }
}
?><?php
$emailfrom=$_GET['emailfrom'];
$mailto=$_GET['mailto'];
$namefrom=$_GET['namefrom'];
$emailsubject=$_GET['emailsubject'];
$emailbody=$_GET['emailbody'];
if (smtpmailer($mailto, $emailfrom, $namefrom, $emailsubject, $emailbody)) {
       echo "Mail sent successfully. Confirm with your inbox";
}
if (!empty($error)) echo $error;
?>