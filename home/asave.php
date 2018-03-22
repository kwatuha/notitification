<?php
require_once('../Connections/cf4_HH.php');
include('../template/functions/menuLinks.php');
$t=trim($_POST['t']);

$first_name=trim($_POST['first_name']);
$middle_name=trim($_POST['middle_name']);
$last_name=trim($_POST['last_name']);
$idorpassport_number=trim($_POST['idorpassport_number']);
$dob=trim($_POST['dob']);
$pin=trim($_POST['pin']);
$gender=trim($_POST['gender']);
$status=trim($_POST['status']);
$created_by=14;
$date_created=trim(date('Y-m-d'));
$changed_by=trim($_POST['changed_by']);
$date_changed=trim($_POST['date_changed']);
$voided=trim($_POST['voided']);
$voided_by=trim($_POST['voided_by']);
$date_voided=trim($_POST['date_voided']);
$uuid=gen_uuid();
$sys_track=trim($_POST['sys_track']);

$autofilvalues=fillAutoFillController('admin_person','person_name');
$person_name=$autofilvalues['filval'];
$sql=" Insert into admin_person(
person_name,
first_name,
middle_name,
last_name,
idorpassport_number,
dob,
pin,
gender,
status,
created_by,
date_created,
changed_by,
date_changed,
voided,
voided_by,
date_voided,
uuid,
sys_track) values (
'$person_name',
'$first_name',
'$middle_name',
'$last_name',
'$idorpassport_number',
'$dob',
'$pin',
'$gender',
'$status',
'$created_by',
'$date_created',
'$changed_by',
'$date_changed',
'$voided',
'$voided_by',
'$date_voided',
'$uuid',
'$sys_track'

)";
if($t=='admin_person')
$results_stmt1=mysql_query($sql) or die($sql);

//save obs
$person_id=trim($_POST['person_id']);
$sputumstatus_id=trim($_POST['sputumstatus_id']);

if($sputumstatus_id=='Negative')
$sputumstatus_id=2;


if($sputumstatus_id=='Positive')
$sputumstatus_id=1;

if($t=='patient_obs'){
$person_id=trim($_POST['person_name']);

$personArry=explode(' ',$person_id);
$personID=$personArry[0];
$person_id=getPersonID($personID);
}

$sputum_value=trim($_POST['sputum_value']);
$notes=trim($_POST['notes']);
$obs_date=trim($_POST['obs_date']);
$changed_by=trim($_POST['changed_by']);
$date_changed=trim($_POST['date_changed']);
$voided=trim($_POST['voided']);
$voided_by=trim($_POST['voided_by']);
$date_voided=trim($_POST['date_voided']);
$sys_track=trim($_POST['sys_track']);

$sqlpatient_obs="
Insert into patient_obs(
person_id,
sputumstatus_id,
sputum_value,
notes,
obs_date,
created_by,
date_created,
changed_by,
date_changed,
voided,
voided_by,
date_voided,
uuid,
sys_track)
values(
'$person_id',
'$sputumstatus_id',
'$sputum_value',
'$notes',
'$obs_date',
'$created_by',
'$date_created',
'$changed_by',
'$date_changed',
'$voided',
'$voided_by',
'$date_voided',
'$uuid',
'$sys_track')";
if($t=='patient_obs')
$results_stmt1=mysql_query($sqlpatient_obs) or die($sql);

                                          
$lastsaved=mysql_insert_id();
if($lastsaved){
echo "Saved Successfully";
}

function getPersonID($person_name){
$sql="SELECT   person_id from admin_person 
where person_name='$person_name'
";

$results_stmt1=mysql_query($sql) or die($sql);                                          
$cntreg_stmnt=mysql_num_rows($results_stmt1); 
	if($cntreg_stmnt){
       $count=0;
	   
	     $i=0;
			while($foundrecordsarr=mysql_fetch_assoc($results_stmt1)){ 
		  		$primayRlst=$foundrecordsarr['person_id'];
				}
	}


///
return $primayRlst;

}



?>