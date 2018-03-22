<?php 
require_once('../PHPMailer/class.phpmailer.php');
define('GUSER', 'ojwangwachiaje@gmail.com'); // Gmail username
define('GPWD', 'wachiaje'); // Gmail password

function smtpmailer($to, $from, $from_name, $subject, $body) { 
	global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
	$mail->Host = 'smtp.gmail.com';
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

if (smtpmailer('ojwangantony@yahoo.com', 'ojwangwachiaje@gmail.com', 'Wuo Nyar Asego', 'testing the mail functionality', 'Is it working!')) {
	echo "Mail sent successfully. Confirm with your inbox";
}
if (!empty($error)) echo $error;


?>