<?php
restrictaccessMenu();
function restrictaccessMenu(){
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";
// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized_menu($strUsers, $strGroups, $UserName, $UserGroup) {
  // For security, start by assumiaccng the visitor is NOT authorized.
  $isValid = False;

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username.
  // Therefore, we know that a user is NOT logged in if that Session variable is blank.
  if (!empty($UserName)) {
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login.
    // Parse the strings into arrays.
    $arrUsers = Explode(",", $strUsers);
    $arrGroups = Explode(",", $strGroups);
    if (in_array($UserName, $arrUsers)) {
      $isValid = true;
    }
    // Or, you may restrict access to only certain users based on their username.
    if (in_array($UserGroup, $arrGroups)) {
      $isValid = true;
    }
    if (($strUsers == "") && true) {
      $isValid = true;
    }
  }
  return $isValid;
}

$MM_restrictGoTo = "../index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized_menu("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0)
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo);
  exit;
}
}
require_once('../Connections/cf4_HH.php');
// require_once('../Connections/bill_access.php');
require_once('../PHPMailer/class.phpmailer.php');
///sms
include('../template/functions/sms/sms_functions.php');

include('../template/functions/menuLinks.php');

//echo $_POST['q'].'  '.$_POST['t'];


if(trim($_POST['rvpmusr'])){

changePassword();
}


if(trim($_POST['tttact'])=="SaveApprovalC"){
insertApprovalProc();
//update queue

$myapptable=$_POST['table'];
if($myapptable=='medicallab_resultreview'){
				$queuid=$_POST['primary_key'];

				$is_approved=$_POST['actionFieldValue'];
				$comment=$_POST['comment'];
				if($is_approved=='Approved'){
				updateStatusTrack('medicallab_queue','queue_id',$queuid,'Results Approved');
				}else{
				updateStatusTrack('medicallab_queue','queue_id',$queuid,$comment);
				}
  }
///
}



if(trim($_POST['payriodid'])&&trim($_POST['payperiodids'])){
savePayPeriodMembers();
}
if($_POST['exps']=='saveexpense'){
saveExpense();
}

if($_POST['ctropbal']){
createopbal();
}


if($_POST['t']!=''){
$foundrecordid=trim($_POST['q']);


if(trim($_POST['tttact'])){
//echo "post trim($_POST['t']) but get =trim($_POST['t'])";
}
$activetableBody=$_POST['t'];
$query_Rcd_getbody= "SELECT distinct tablename,fieldname,dataformat FROM admin_controller where tablename='$activetableBody' order by position";
$mysql_error="function savedData(){
Ext.Msg.show({
title:'Failure',
msg: '";


$erro2="',
				 buttons: Ext.Msg.OK,
				 icon: Ext.Msg.ERROR
                   });
}
savedData();";
				//echo '{success:true, savemsg:'.json_encode($msgback).'}';
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());


$countrows=0;
$postvariables='';
$count_tbrowsfound=mysql_num_rows($Rcd_tbody_results);
$insertStr='';
$postvariables='';
$primaryid='';
$updateStrArr='';
$updateVariables='';
$postcolns='';
$updateVariables='';
$cnt=0;
$y=0;
$updateString='';
while($count_tbrows=mysql_fetch_array($Rcd_tbody_results)){
if($countrows==0){
 //$postvariables[0]="0,";
 //$postcolns=$count_tbrows[1].',';

		if($recordid!='NOID'){
		 $primaryid=$count_tbrows[fieldname];
		}


}else{
$x=$countrows+1;

if($x==$count_tbrowsfound){$comma='';}
else{$comma=',';}
$colval=trim($count_tbrows[fieldname]);

$fieldNameRetrieved=trim($count_tbrows['fieldname']);
$expectedTableArr=explode('_',$activetableBody);


$dataformat=trim($count_tbrows['dataformat']);
$updateStrArr[$y]=$fieldNameRetrieved;

/*if((substr($dataformat,1,3)=='dat')){
   $newdate=strtotime($_POST[$count_tbrows[1]]);
   $newdate=date('Y-m-d',$newdate);
}*/
$y++;
$currentDateTodat=date('Y-m-d');
/*if(($count_tbrows[1]=='effective_dt')&&($_POST[$count_tbrows[1]]=='')){
$postvariables[$countrows]="'".$currentDateTodat."'".$comma;
}*/
if((substr($dataformat,0,3)=='dat')){

        $newdate=strtotime($_POST[$count_tbrows[1]]);
        $newdate=date('Y-m-d',$newdate);
		   if($count_tbrows[1]=='date_created'){
				$datecreated=date('Y-m-d');
				$postvariables[$countrows]="'".$datecreated."'".$comma;
			}else{
		   //$postvariables[$countrows]="'".$_POST[$count_tbrows[1]]."'".$comma;
		   $postvariables[$countrows]="'".$newdate."'".$comma;
			   if(($count_tbrows[1]=='date_changed')&&($actionitem=='Save'))
			   $postvariables[$countrows]="'".$noneneedtochange."'".$comma;


		   }
}
else
{

if($count_tbrows[1]=='uuid'){
$uuid=gen_uuid();
$postvariables[$countrows]="'".$uuid."'".$comma;
}
elseif($count_tbrows[1]=='date_created'){
$datecreated=date('Y-m-d');
$postvariables[$countrows]="'".$datecreated."'".$comma;
}
elseif($count_tbrows[1]=='created_by'){
$postvariables[$countrows]="'".$_SESSION['my_useridloggened']."'".$comma;
}
elseif($count_tbrows[1]=='voided'){
$voided=0;
$postvariables[$countrows]="'".$voided."'".$comma;
}
elseif($count_tbrows[1]=='person_name'){
$fillarr=createTableGridSummaries('admin_person','person_name');
$person_name=$fillarr['filval'];
$postvariables[$countrows]="'".$person_name."'".$comma;
}
elseif($count_tbrows[1]=='dbnotetransact_name'){
$fillarr=createTableGridSummaries('insurance_dbnotetransact','dbnotetransact_name');
$dbnotetransact_name=$fillarr['filval'];
$postvariables[$countrows]="'".$dbnotetransact_name."'".$comma;
}
elseif($count_tbrows[1]=='accountactivity_name'){
$fillarr=createTableGridSummaries('accounts_accountactivity','accountactivity_name');
$accountactivity_name=$fillarr['filval'];
$postvariables[$countrows]="'".$accountactivity_name."'".$comma;
}

elseif($count_tbrows[1]=='checkregister_name'){
$fillarr=createTableGridSummaries('accounts_checkregister','checkregister_name');
$checkregister_name=$fillarr['filval'];
$postvariables[$countrows]="'".$checkregister_name."'".$comma;
}
elseif($count_tbrows[1]=='custcheckregister_name'){
$fillarr=createTableGridSummaries('accounts_custcheckregister','custcheckregister_name');
$custcheckregister_name=$fillarr['filval'];
$postvariables[$countrows]="'".$custcheckregister_name."'".$comma;
}
elseif($count_tbrows[1]=='custcashdeposit_name'){
$fillarr=createTableGridSummaries('accounts_custcashdeposit','custcashdeposit_name');
$custcashdeposit_name=$fillarr['filval'];
$postvariables[$countrows]="'".$custcashdeposit_name."'".$comma;
}
elseif($count_tbrows[1]=='compcashdeposit_name'){
$fillarr=createTableGridSummaries('accounts_compcashdeposit','compcashdeposit_name');
$compcashdeposit_name=$fillarr['filval'];
$postvariables[$countrows]="'".$compcashdeposit_name."'".$comma;
}

elseif($count_tbrows[1]=='directtransferout_name'){
$fillarr=createTableGridSummaries('accounts_directtransferout','directtransferout_name');
$directtransferout_name=$fillarr['filval'];
$postvariables[$countrows]="'".$directtransferout_name."'".$comma;
}

elseif($count_tbrows[1]=='directtransferin_name'){
$fillarr=createTableGridSummaries('accounts_directtransferin','directtransferin_name');
$directtransferin_name=$fillarr['filval'];
$postvariables[$countrows]="'".$directtransferin_name."'".$comma;
}
elseif(($count_tbrows[1]=='accaccount_id')&&($_POST['ckdins']=='Y')){
$acowner=$_POST['syowner'];
$ouwnerid=$_POST['person_id'];
$fac=getACCAccountDetails($acowner,$ouwnerid);
$postvariables[$countrows]="'".$fac."'".$comma;
}
elseif($count_tbrows[1]=='fill_combination'){
$fillcomb=$_POST['insurance_underwriter'].','.$_POST['admin_person'].','.$_POST['admin_persongroup']
.','.$_POST['admin_company'].','.$_POST['insurance_policygroup'];
$postvariables[$countrows]="'".$fillcomb."'".$comma;
}
elseif($count_tbrows[1]=='parameters' && $activetableBody=='sms_smsremotesource'){
//add remote query params
$remoteID=$_POST['datasourcetemp_id'];
$rdParams=getQueryRemoteParams($remoteID);
$rdParamsProcessed=processRemoteDBParams($rdParams);
$remoteQuerySQL=processRemoteDBQuery($remoteID,$rdParams);
// echo $remoteQuerySQL;
$nodata=executeRemoteQuery($remoteQuerySQL,$remoteID,'');

//end of remote query params
$postvariables[$countrows]="'".$rdParamsProcessed."'".$comma;
}

/*elseif(($activetableBody=='accounts_accountactivity')&&(($count_tbrows[1]=='debit')||($count_tbrows[1]=='credit'))){
$crdbval=$_POST['dbcr'];
$amount=0;
if(!$postedamount){
	if(($crdbval=='Credit')){
	$amount=$_POST['Amount'];
	$postedamount='posted';
	}
	if(($crdbval=='Debit')){
	$amount=$_POST['Amount'];
	$postedamount='posted';
	}
}

$postvariables[$countrows]="'".$amount."'".$comma;
}*/
else{
$postvariables[$countrows]="'".$_POST[$count_tbrows[1]]."'".$comma;
}
}

$postcolns.=$count_tbrows[1].$comma;
$updateVariables[$countrows]=$count_tbrows['fieldname'];

$tablename=$count_tbrows[0];
}
$countrows++;
}
$cnt=0;

foreach($postvariables as $val){
$insertStr.=$val;
$cnt++;

}
$actionitem=trim($_POST['tttact']);

$updateTableIDarr=explode('_',$activetableBody);
$updateTableI=$updateTableIDarr[1].'_id';
$updateValueID=$_POST[$updateTableI];
if($updateValueID){
$itupda=1;
$updateVal;
foreach($updateVariables as $updateVal){

			$addcomma='';

			if($updateVal!='created_by'&&$updateVal!='date_created' &&$updateVal!='uuid'&&$updateVal!='voided_by'&&$updateVal!='voided'&&$updateVal!='date_voided' &&$updateVal!='sys_track'){


			if($itupda==sizeof($updateVariables)){
			$addcomma='';
			}
			else{$addcomma=',';}


			$updateString.=$updateVariables[$itupda].'='."'".$_POST[$updateVal]."'".$addcomma;
            }
			$itupda++;



}
$tblid=explode('_',$activetableBody);
$tblidvar=$tblid[1].'_id';
$currentRecordIdentifier=$_SESSION['current'.$tablename.$tblidvar];
$tblidvalue=trim($_POST['attendance_id']);
$updateSql="Update $tablename SET ".$updateString." Where $tblidvar= $updateValueID";
//, Where
$updateSql=str_replace(", Where ",' Where ',$updateSql);

//echo $updateSql;


$un++;

$Resultsupdate = mysql_query($updateSql) or die(mysql_error().$updateSql.$_POST['t'].' '.$_POST['t']);
if($Resultsupdate){
		if(trim($_POST['mcustupdate'])){
		$msgbackUpdated="function savedData(){

				Ext.Msg.show({
				 title:'Success',
				 msg: 'Updated successfully',
				 buttons: Ext.Msg.OK,
				 icon: Ext.Msg.INFO
                   });

				}
				savedData();";
				echo $msgbackUpdated;
		}
		else{
		//echo 'Saved Successfully';
		echo '{success:true, savemsg:'.json_encode("Updated successfully").'}';
		}
/*echo"<script> alert('here '); resetform();</script>";*/
}else{
echo 'Record could not be saved';
}
}
/*if($_POST['rtb']=='rvdconcepts'){
echo $amrsconceptid.'wwwww was here wwwwwwwwwwww';
}*/

if($actionitem=='Save'){
//echo $postcolns;

$insertSQL = "INSERT INTO $tablename($postcolns) VALUES ($insertStr)";

//echo $insertSQL;

$primaryFieldARR='';
$isprimary='';

$primaryFieldARR=explode('_',$tablename);
$isprimary=strpos($postcolns,'_name');
if($primaryFieldARR[1]){
$fld=$primaryFieldARR[1].'_name';

	if($isprimary||$tablename=='admin_adminuser'){
		if($tablename=='admin_adminuser'){
		$dups=getDuplicates($tablename,$_POST['username'],'username','Username Exists','IND');
		}
		else{
		$dups=getDuplicates($tablename,$_POST[$primaryFieldARR[1].'_name'],$primaryFieldARR[1].'_name','Record Exists','IND');
		}

	////Validate


	//end of validation116
	}
	if($tablename=='admin_person'){
	$existb=searchTableValues('admin_person','idorpassport_number|'.$_POST['idorpassport_number'],Null);
	if(($dups!=0)&&$existb){
	$dups=1;
	$msgback="function savedData(){

				Ext.Msg.show({
				 title:'Failure',
				 msg: 'Record Exists',
				 buttons: Ext.Msg.OK,
				 icon: Ext.Msg.ERROR
                   });

				}
				savedData();";
				echo '{success:true, savemsg:'.json_encode($msgback).'}';

	}
	}

		if($dups==0){


		//handling single $mycusmsg
        /////////////
        ///CHECK FOR PHONE NUMBERS AND STANDARD FIELDS

        ///////////////////
        if($tablename=='sms_billhandle'||$tablename=='sms_generalsmshandle'||$tablename=='sms_indsms' ||$tablename=='sms_msgqueue'){
            //check phone number
            $phone_number=trim($_POST['phone_number']);
            $message=trim($_POST['message']);
            if($tablename=='sms_indsms')$phone_number=trim($_POST['reciepient']);
            $phone_number= padPhoneNumberWithZero($phone_number);
            $numberLen=strlen($phone_number);


             if($numberLen==10 && is_numeric($phone_number) ){

                            if($tablename=='sms_indsms'){

                                        $Result1 = mysql_query($insertSQL) or die(mysql_error());
                                        $lastsavedSms=mysql_insert_id();
                                        $credit=getSmsCreditBalance();
										//$messageId=createMsgTrack(1);//"30050000";//.$lastsavedSms;
										// createMsgTrack($source)

                                             if($credit>1&&$lastsavedSms>0){
																							      $messageCenterId = $GLOBALS['msg_center'];
                                                    $messageListTag= createSmsTag($phone_number,$message,$messageCenterId);
                                                    createSmsContent($messageListTag);
                                                    $smsData=getSmsContent();
                                                    //echo 'ssssssssssssssssssss'.$smsData;
                                                    if($smsData) {
                                                            $smsRSP=SendSms($smsData);

															$oXML = new SimpleXMLElement($smsRSP);
															$commtype=$messageId.'_'.$lastsavedSms;
															processSMSResponse($oXML,$commtype);
															insertSMSMsgByType('sms_msgsent',$message,$phone_number,$commtype,'Single SMS');
                                                            $msgback=successNotification('SMS Sent');
                                                            echo '{success:true, savemsg:'.json_encode($msgback).'}';
                                                    }

                                              }else{errorNotification('Cannot Access SMS Server!');}

                        } else { //insert without sending
                             $Result1 = mysql_query($insertSQL) or die(mysql_error());
		                     $lastsaved=mysql_insert_id();
                                    if($lastsaved>0){
                                    $msgback=successNotification('Changes Saved');
                                    echo '{success:true, savemsg:'.json_encode($msgback).'}';
                                    }
                        }
             }    //end phone number checks
            else { //incorrect phone number
                  errorNotification('Incorrect Phone Number Format')  ;
             }
             //end incorrect phone number
        }
       //end of special tables with phones

        else{

   if($nodata!='nodata')
	    $Result1 = mysql_query($insertSQL) or die(mysql_error());
		  if($nodata>1){
			   $lastsavedRD=mysql_insert_id();
			   if( $lastsavedRD)
			  $nodata=executeRemoteQuery($remoteQuerySQL,$remoteID,$lastsavedRD);
		  }
		  if($nodata=='nodata'){

				$msgback="function savedData(){
								Ext.Msg.show({
								title:'Data Rows Not Found!',
								msg: 'Data rows did not match the parameters',
								buttons: Ext.Msg.OK,
								icon: Ext.Msg.ERROR
								});

								}
								savedData();";
								echo '{success:true, savemsg:'.json_encode($msgback).'}';
								return;
		  }
		  //echo $insertSQL;

	   				 ///add any other tables header_remove
					    if($tablename=='sms_sendsmstogrp'){
									$program='smsprogramming';
									$fileToUploade='attachmentsDoc/'.$uploadResults[0];
									$smsgroup_id=trim($_POST['smsgroup_id']);
									$message=trim($_POST['sms_message']);
									$lastsavedGD=mysql_insert_id();
									$messageId=createMsgTrack(2);
										queueFromGroupMembers($smsgroup_id,$message,$messageId.'_'.$lastsavedGD);
										$msgback=executeFunction('createFormGrid("Save","NOID","'.'sms_groupqueue'.'","g")');

                                                            echo '{success:true, savemsg:'.json_encode($msgback).'}';

															return;

							}
              //end queuing contacts

		$lastsaved=mysql_insert_id();
	   //echo $insertSQL;
		//update status
		if(($tablename=='accounts_custcheckregister')&&(trim($_POST['custcdeposit']))){
		insertCustomerChecks($lastsaved);
		}
		if(($tablename=='hrpayroll_benefitbygrade')||($tablename=='hrpayroll_deductionbygrade')){
	               UpdatePaygradebenefitsdeductions($lastsaved,$tablename);
		}
		if(($tablename=='admin_persondept')||($tablename=='hrpayroll_paygrades')){
		 $udpatedstatus='Changed paygrade';
		 if($tablename=='admin_persondept')
		 $udpatedstatus='Changed Department';

		 UpdatePersonalInformation($lastsaved,$tablename,$udpatedstatus);
		}
		if($_SESSION['hasnotification'.$tablename])
		insertNotification($tablename,$lastsaved);
		// echo $lastsaved.'Was saved';
				if($lastsaved){
				$sourcetable=trim($_POST['source_tablelist']);
				$pid=trim($_POST['source_ref']);
				$photoname=trim($_POST['photo_name']);
				createPhotoDirectories($tablename,$sourcetable,$pid,$photoname);
				//echo '{success:true, savemsg:'.json_encode("Saved successfully").'}';

				$msgback= successNotification('Changes Saved');
				//////////////////////Modify

				////////////////
				//$msgback="displayNotifionIntroMsg();";
				//general file uploads

				if($tablename=='form_migratedform'){
					   $otherdetails=$_POST['migratedform_name'];
					   $file_id='attachments';
					   uploadGeneralFiles($file_id, $folder="xforms", $types="",$otherdetails,$lastsaved,$tablename,'Update');
				}
				//handling email notifications
				if($tablename=='com_sendemail'){
				$whosending=trim($_POST['syowner']);
				$contactid=trim($_POST['syownerid']);
				$prefferedContacts=getPrefferedContact($whosending,$contactid);
				$prefferedemail=$prefferedContacts['email_address'];
				$from=$prefferedemail;//$_POST['name_from'];
				$from_name=$prefferedContacts['send_from'];//$_POST['name_from'];
				$subject=$_POST['email_subject'];
				$body=$_POST['email_body'];
				$ecd=getPrefferedEmailSender();
				$emailusername=trim($ecd['email_address']);
				$emailpassword=trim($ecd['password']);

				//Uloading email info
				    $fileuploaded='';
					if($_FILES['attachments']['name']){
					$file_id='attachments';//trim($_POST['file_brouwse']);
					$otherdetails=trim($_POST['syownerid']);
					if($_POST['sendemail_name']){
					$uploadResults=uploadEmailFile($file_id, $folder="emailAttachments", $types="",$otherdetails,$lastsaved);
					}
					}

				     $docs='emailAttachments/'.$uploadResults[0];
				     $emailresult=smtpmailer($prefferedemail, $from, $from_name, $subject, $body,$emailusername,$emailpassword,$docs);

						if($emailresult==true){
						$msgback="function savedData(){

						Ext.Msg.show({
						 title:'Success',
						 msg: 'Changes Saved, an email was sent to  $prefferedemail $emailresult ',
						 buttons: Ext.Msg.OK,
						 icon: Ext.Msg.INFO
						   });

						}
						savedData();";
						}else{
						$msgback='';
						}
				}

				//end of emails
				$personid=$_POST['person_id'];

				if(($tablename=='admin_person')&&($_POST['personttypecategory_id']==3)){
//$msgback='createFormTabs('."'Save'".",1,'".$tablename."',$lastsaved,"."'NO','detailinfo');'";
				}
				//createFormTabs(loadtype,rid,tablename,pd,persontype,displaydiv)
				/*if(($tablename=='admin_person')&&($_POST['personttypecategory_id']==3)){
				$msgback='createFormTabs('."'Save'".",1,'".$tablename."',$lastsaved".');';
				}*/

				if(($_POST['personttypecategory_id']==7)&&($tablename=='admin_person')){

				$personid=$lastsaved;
				$lfullname=$_POST['first_name'].' '.$_POST['middle_name'].' '.$_POST['last_name'];
				$msgback='medicallab_queueFormRevised('.$lastsaved.",'$lfullname','detailinfo');";
				echo $msgback;
				}
				///////////////////////////////////////create other accounts

				/*if($tablename=='admin_company'){
				$autofilvalues=fillAutoFillController('admin_company','company_name');
	            $genidentifier=$autofilvalues['filval'];
				createAccounts($genidentifier,$lastsaved,'admin_company');
				}

				if($tablename=='admin_persongroup'){
				$autofilvalues=fillAutoFillController('admin_persongroup','persongroup_name');
	            $genidentifier=$autofilvalues['filval'];
				createAccounts($genidentifier,$lastsaved,'admin_persongroup');
				}

				if($tablename=='insurance_policygroup'){
				$autofilvalues=fillAutoFillController('insurance_policygroup','policygroup_name');
	            $genidentifier=$autofilvalues['filval'];
				createAccounts($genidentifier,$lastsaved,'insurance_policygroup');
				}

				if($tablename=='insurance_underwriter'){
				$autofilvalues=fillAutoFillController('insurance_underwriter','underwriter_name');
	            $genidentifier=$autofilvalues['filval'];
				createAccounts($genidentifier,$lastsaved,'insurance_underwriter');
				}
				*/


			/////////////////////////////////
			$pfids=$_POST['pfids'];
			if($pfids){
			$msgback='';
			$personttypecategory_id=$_POST['personttypecategory_id'];
			$pgrppid=insertPersonGroup($personttypecategory_id,$lastsaved);
			$llarr=fillPrimaryData('admin_personpersontype',$pgrppid);
				$grpname=$llarr['personpersontype_name'];
			}
				if($pfids=='pfid'){
				$persontyname=$person_name;
				$personid=$lastsaved;
				$lfullname=$_POST['last_name'].' '.$_POST['middle_name'].' '.$_POST['first_name'];
				createAccounts($grpname,$personid,'admin_person');
				if($_POST['personttypecategory_id']==2){
				$llarr=fillPrimaryData('admin_personpersontype',$lastsaved);

				$msgback=" Ext.getCmp('idregistrationwin').close();".'housing_housinglandlordFormRevised('."'detailinfo','Save','NOID',".$personid.','."'$grpname','$lfullname','housing_housinglandlord');";
		  echo $msgback;
				}

				}

				if($pfids=='pfid'){
				$persontyname=$person_name;
				$personid=$lastsaved;
				/*if($lastsaved){
				createAccounts($person_name,$personid,'admin_person');
				}*/

if($_POST['personttypecategory_id']==3){
$msgback=" Ext.getCmp('idregistrationwin').close();";
//$msgback.='createFormTabs('."'Save'".",1,'".$tablename."',$lastsaved,"."'NO','detailinfo');";

echo $msgback;

				}

				if($_POST['personttypecategory_id']==1){
				$persontyname=$person_name;
				$personid=$lastsaved;
				$persontyname=$person_name;
				$lfullname=$_POST['last_name'].' '.$_POST['middle_name'].' '.$_POST['first_name'];

				$msgback='selectLandLord('."'$lfullname','$grpname','housing_housingtenant',$personid".');';
				echo " Ext.getCmp('idregistrationwin').close();".$msgback;
				}

				//handling patients
				/*if($_POST['personttypecategory_id']==6){
				$lfullname=$_POST['first_name'].' '.$_POST['middle_name'].' '.$_POST['last_name'];
				$personid=$lastsaved;
				}*/
				//handling insurance clients
				if($_POST['personttypecategory_id']==4){

				$personid=$lastsaved;//$_POST['person_id'];
				$persontyname=$grpname;
				//echo $person_name.'==='.$grpname;
				$person_name=$grpname;
				$mydbnoteid=insertDBNote($person_name);
				//$_POST['personpersontype_name'];
				/*$llarr=fillPrimaryData('admin_personpersontype',$lastsaved);
				$lfullname=$llarr['person_fullname'];*/
				$lfullname=$_POST['last_name'].' '.$_POST['middle_name'].' '.$_POST['first_name'];


				//insurance_insurancedebitnoteFormRevised('Kwatuha Alfayo','IN20012','admin_person',51,2);

			$msgback='rvdib('."'$lfullname','$persontyname','admin_person',$personid,$mydbnoteid".');';

				echo " Ext.getCmp('idregistrationwin').close();".$msgback;
				}
				//end insurance clients

				}

				if(($tablename=='medicallab_histology')||($tablename=='medicallab_papsmear')||($tablename=='medicallab_labresult')){
				$queuid=$_POST['queue_id'];

				updateStatusTrack('medicallab_queue','queue_id',$queuid,'Results Entered');
				}



				if($tablename=='medicallab_queue'){

					$personid=$_POST['person_id'];
					$llarr=fillPrimaryData('medicallab_queue',$lastsaved);
					$lfullname=$llarr['person_fullname'];
					$hospitalnum=$_POST['hospital_number'];
					$queuid=$lastsaved;
					updateStatusTrack('medicallab_queue','queue_id',$queuid,'Queued');
					$labnum=$_POST['queue_name'];
					$personname=$lfullname;

							if($_POST['diagnosis_type']=='Cytology'){

$msgback="medicallab_cytologyrefFormRevised('$hospitalnum',$queuid,'$labnum','$personname','detailinfo')";
							//echo $msgback;
							}
							if($_POST['diagnosis_type']=='Histology'){
							$msgback="medicallab_histologyFormRevised('$hospitalnum',$queuid,'$labnum','$personname','detailinfo')";
							//echo $msgback;
							}
							if($_POST['diagnosis_type']=='Histology'){
							$msgback="medicallab_histologyFormRevised('$hospitalnum',$queuid,'$labnum','$personname','detailinfo')";
							//echo $msgback;
							}

						if($_POST['diagnosis_type']=='Pap Smear'){
							$msgback="medicallab_papsmearFormRevised('$hospitalnum',$queuid,'$labnum','$personname','detailinfo')";
							//echo $msgback;
							}

				}

				if($tablename=='insurance_insurancedebitnote'){
				$personid=$_POST['syownerid'];
				$persontyname=$_POST['insurancedebitnote_name'];
				$llarr=fillPrimaryData('admin_person',$personid);
				$lfullname=$llarr['last_name'] .' '.$llarr['middle_name'].' '.$llarr['first_name'];
				createInsuranceNoteItems($lastsaved);
				//$msgback='selectUnderwriter('."'$lfullname','$persontyname','admin_person',$personid".');';
				//$msgback='selectUnderwriter('."'$lfullname','$persontyname',$lastsaved".');';
				//echo $msgback;
				}
				//selectUnderwriter

				//medical lab
				/*if($tablename=='accounts_accountactivity'){
				$msgback='medicallab_queueFormRevised('.$lastsaved.');';
				}*/
				//handling account posting




				if($tablename=='accounts_checkregister'){
						if($_POST['depositchk']=='Yes'){
						  depositmycheck($lastsaved);
						}
				}

				///add cash deposit to insert record in cash trans


				/*if($tablename=='accounts_custcashdeposit'){
				$custcashdeposit_name=$_POST['custcashdeposit_name'];
				$crec=insertCashTransaction($custcashdeposit_name);
				if($crec>0){
				echo "savedData();";
				}
				}*/
				///
				if($tablename=='accounts_accountactivity'){

				if($_POST['countraccountscategory_id']==17)
				$crec=insertCashTransaction($accountactivity_name);
				if($crec>0){
				echo "savedData();";
				}
				//direct deposit to bank account
				//($_POST['countraccountscategory_id']==181)||
				if($_POST['countraccountscategory_id']==18)
				$brec=insertBankTransaction($accountactivity_name);
				if($brec>0){
				echo "savedData();";
				}
				}
				//end of account posting
				$notifyme="displayNotifionIntroMsg();";
				if($_SESSION['hasnotification'.$tablename])
				$msgback.=$notifyme;
				///////response
				$mycusmsg="function savedData(){
							//kwa
							Ext.Msg.show({
							 title:'Success',
							 msg: 'Changes saved!',
							 buttons: Ext.Msg.OK,
							 icon: Ext.Msg.INFO
							   });

							}
							savedData();";
							if($_POST['pfids']){
							$mycusmsg='';
							}
					 $msgInform='{success:true, savemsg:'.json_encode($msgback).'}';
					if(($tablename=='housing_housingtenant')&&($lastsaved)){
							 updateStatusTrack('housing_housingtenant','housingtenant_id',$lastsaved,'Active');
							 $msgInform='';
							 //echo "updateStatusTrack('housing_housingtenant','housingtenant_id',$lastsaved,'Active');";
							  }
				if(($tablename=='housing_housinglandlord')
				||($tablename=='insurance_motorisk')
				||($tablename=='admin_person')
				||($tablename=='housing_housingtenant')
				||($tablename=='insurance_insurancedebitnoteitems')
				||($tablename=='insurance_dbnotetransact')||($tablename=='accounts_accountactivity')){

				//$pfids=$_POST['pfids'];

							if($lastsaved){
						    if($tablename=='housing_housinglandlord'){
							//echo "savedData()";
							  }


							 if((($tablename=='insurance_motorisk')||($tablename=='insurance_insurancedebitnoteitems')||
							 ($tablename='insurance_dbnotetransact'))&&(!$_POST['pfids'])){
							  echo "savedData()";
							  }




							//echo $mycusmsg;
							}


							}else{

								   echo $msgInform;


							}
				//echo '{success:true, savemsg:'.json_encode('GGGGGGGGGGGGGGGGGGGGG'.$msgback).'}';
				//Notification

				$postcolns='';

				//Handling SMS sysystme


				 //Uloading schedule info
				 $fileuploaded='';
					if($_FILES['file_brouwse']['name']){
					$file_id='file_brouwse';//trim($_POST['file_brouwse']);
		            $discoSchedule=trim($_POST['disconnschedule_name']);
                    $otherdetails=trim($_POST['schedule_name']);
					$days=trim($_POST['due_after']);
					$zone=trim($_POST['zone']);
					$bill_date=trim($_POST['bill_date']);
					//echo $bill_date.' xxxxx '.$zone;
					$message_type=trim($_POST['smsmsgcust_id']);
					$uploadResults=uploadScheduleFile($file_id, $folder="attachmentsDoc", $types="",$otherdetails);

							if(($_POST['t']=='sms_schedule')||($_POST['t']=='sms_disconnschedule')){
									$program='smsprogramming';
									$fileToUploade='attachmentsDoc/'.$uploadResults[0];
									$schedule=$otherdetails;

                  if($_POST['t']=='sms_schedule'){
				  
                  uplodeFileData($fileToUploade,$program,$schedule,$days,'bill_'.$lastsaved,$message_type);
                  }

                  if($_POST['t']=='sms_disconnschedule'){
                  uplodeFileData($fileToUploade,$program,$discoSchedule,$days,'disconnection_'.$lastsaved,$message_type);
                  }

							}

              //adding email function
               if($_POST['t']=='sms_emailschedule'){

									$program='smsprogramming';
									$fileToUploade='attachmentsDoc/'.$uploadResults[0];
									$schedule=trim($_POST['emailschedule_name']);
									
								
									//queueEmailAccessData($zone,$connection_number,$year,$month,$schedule,$days);
									//uplodeEmailFileData($fileToUploade,$program,$schedule,$days);
							}

              //end email

              //adding general sms function
               if($_POST['t']=='sms_schedulegeneralsms'){

									$program='smsprogramming';
									$fileToUploade='attachmentsDoc/'.$uploadResults[0];
									$schedule=trim($_POST['schedulegeneralsms_name']);
									$message=trim($_POST['message']);
									uplodeGeneralsmsFileData($fileToUploade,$message,$schedule,$lastsaved);
                                    //$msgback='createFormTabs('."'Save'".",1,'".$tablename."',$lastsaved,"."'NO','detailinfo');'";

							}

              //end general sms

			  //Adding contacts upload
                 if($_POST['t']=='sms_uploadtogroup'){
									$program='smsprogramming';
									$fileToUploade='attachmentsDoc/'.$uploadResults[0];
									$smsgroup_id=trim($_POST['smsgroup_id']);
									uplodeGroupContactsFileData($fileToUploade,$program,$smsgroup_id,$lastsaved);
                                    //$msgback='createFormTabs('."'Save'".",1,'".$tablename."',$lastsaved,"."'NO','detailinfo');'";

							}

			  //end of contact upload
					}
				 //end of schedule upload
				 if($_POST['t']=='sms_emailschedule'){
									// uplodeEmailFileData($fileToUploade,$program,$schedule,$days);
									$billDate=trim($_POST['bill_date']);
									$zone=trim($_POST['zone']);
									
									$month=trim($_POST['billmonth_id']);
									$year=trim($_POST['billyear_id']);
									$connection_number=trim($_POST['connection_number']);
									
									$acceBillsArr=getMSAccData($zone,$connection_number,$month,$year);
									
									
									addToQueue($acceBillsArr,$zone,$month,$year,1);
									//addToQueue($bills,$zone,$month,$year,$trackType)

				}
				////////////////end of sms
				}else{

				 $msgback="function savedData(){
				Ext.Msg.show({
				 title:'Failure',
				 msg: 'Record Exists but incorrectly',
				 buttons: Ext.Msg.OK,
				 icon: Ext.Msg.ERROR
                   });

				}
				savedData();";
				echo '{success:true, savemsg:'.json_encode($msgback).'}';

				}
	   }


		}
        ///end of dups checking
        else{
		 //echo ucwords($_POST[$fld]).'Record Exists';
		 //echo '{failure:true, savemsg:'.json_encode("Record Exists").'}';
		 $msgback="function savedData(){

				Ext.Msg.show({
				 title:'Failure',
				 msg: 'Record Exists',
				 buttons: Ext.Msg.OK,
				 icon: Ext.Msg.ERROR
                   });

				}
				savedData();";
				echo '{success:true, savemsg:'.json_encode($msgback).'}';
	}
}
}
}?>