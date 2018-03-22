<?php
define('GUSER', 'nzoiawaterservices@gmail.com'); // Gmail username

//2011agentzl
define('GPWD', 'Kitale1010'); // Gmail password
require_once('../phpmailer/class.phpmailer.php');
//include('../template/functions/menuLinks.php');
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
require_once('../Connections/cf4_HH.php');
getSendForAllPatients();

function checkObsDateDiff($person_id){
$sql="SELECT CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ',admin_person.last_name ) fullname,
DATEDIFF(date_format(patient_obs.obs_date,\"%Y%m%d\"),date_format(now(),\"%Y%m%d\")) days
FROM patient_obs
inner join admin_person on admin_person.person_id=patient_obs.person_id
where admin_person.person_id='$person_id'
order by patient_obs.obs_id desc limit 1
";

$results_stmt1=mysql_query($sql) or die($sql);                                          
$cntreg_stmnt=mysql_num_rows($results_stmt1); 
	if($cntreg_stmnt){
       $count=0;
	   
	     $i=0;
			while($foundrecordsarr=mysql_fetch_assoc($results_stmt1)){ 
		  		$primayRlst=$foundrecordsarr['days'];
				$fullname=$foundrecordsarr['fullname'];
				
				//echo $DynamicArr[$resultKey];
		  		}
	}

if($primayRlst>35){
$emailfrom="tbmonitoringprogram@gmail.com";
$mailto="lilyngeno@gmail.com";
$namefrom="TB Monitoring Program";
$emailsubject="Missed Visit Notification";
$emailbody=$fullname." missed his/her scheduled visit for ".$primayRlst." Days";
		if (smtpmailer($mailto, $emailfrom, $namefrom, $emailsubject, $emailbody)) {
			   echo "Mail sent successfully. Confirm with your inbox";
		}
}
else{
echo "\n No defaulters found";
}

///
return $primayRlst;

}

function getSendForAllPatients(){
$sql="SELECT  distinct person_id from patient_obs";

$results_stmt1=mysql_query($sql) or die($sql);                                          
$cntreg_stmnt=mysql_num_rows($results_stmt1); 
	if($cntreg_stmnt){
       $count=0;
	   
	     $i=0;
			while($foundrecordsarr=mysql_fetch_assoc($results_stmt1)){ 
		  		$pid=$foundrecordsarr['person_id'];
				checkObsDateDiff($pid);
				}
	}


///
return $primayRlst;

}


?>