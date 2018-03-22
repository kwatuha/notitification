<?php
 define('GUSER', 'nzoiawaterservices@gmail.com'); // Gmail username
 define('GPWD', 'Kitale1010d'); // Gmail password
//define('GUSER', 'bills@nzoiawater.or.ke'); // Gmail username
//define('GPWD', 'bills@2017'); // Gmail password
require_once('../phpmailer/class.phpmailer.php');
// include('Function.Array-Group-By.php');
$emailfrom="bills@nzoiawater.or.ke";
    $mailto= '212aapkakai@nzoiawater.or.ke'; 
smtpMailBills($mailto, $emailfrom, 'test alfayo', 'tests', 'body',"");
function smtpMailBills($to, $from, $from_name, $subject, $body,$mailAttachment) {
       global $error;
       $mail = new PHPMailer();  // create a new object
       $mail->IsSMTP(); // enable SMTP
       $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
       $mail->SMTPAuth = true;  // authentication enabled
       //$mail->SMTPSecure = 'tls';//'ssl'; // secure transfer enabled REQUIRED for Gmail
      // $mail->Host = 'mail.nzoiawater.or.ke';
      // $mail->Port = 587;
	  $mail->SMTPSecure = 'ssl';
	   $mail->Host = 'smtp.googlemail.com';
       $mail->Port = 465;
       $mail->Username = GUSER;  
       $mail->Password = GPWD;         
      // $mail->AddStringAttachment($mailAttachment,'bill.pdf');         
       $mail->SetFrom($from, $from_name);
       $mail->Subject = $subject;
       $mail->Body = $body;
       $mail->AddAddress($to);
       if(!$mail->Send()) {
               $error = 'Mail error: '.$mail->ErrorInfo;
			   
			   echo "  Mail xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx  ".$mailto. DateTime('NOW');;
               return  $error;
       } else {
		   echo "  Message sent  ".$mailto;
               $error = 'Message sent!'. DateTime('NOW');
               return 1;
       }
}
?>