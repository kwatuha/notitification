<?php

	?><?php
function findPersonGeneralViewGroupRoles(){
$currentuser=trim($_SESSION['my_useridloggened']);
$sql=$_SESSION['admin_generaview_SearchSQL']." where admin_generaview.role_id in(select role_id  from admin_roleperson where person_id='$currentuser')";

$alertQueryResults=mysql_query($sql) or die($sql);
$cntAlert=mysql_num_rows($alertQueryResults);
$roleinformation='';
$i=0;
$msg='';
 while ($rows=mysql_fetch_array($alertQueryResults)){
    $privilegeid='';
    $sview_id=$rows['sview_id'];
	$group=$rows['tblgroup_name'];
	$menu_caption=$rows['menu_caption'];
	$roleinformation[$i]=$group;
	$i++;
			if($cntAlert==$i){
			$comma='';
			}else{
			$comma=',';
			}
			if($group!=$processedgrp)
	$msg.='{message:'."'".trim($group)."'}".$comma;
	$processedgrp=$group;

				
	}
	return $msg;
}
?><?php
function findPersonViewRoles(){
$currentuser=trim($_SESSION['my_useridloggened']);
$sql=$_SESSION['admin_generaview_SearchSQL']." where admin_generaview.role_id in(select role_id  from admin_roleperson where person_id='$currentuser')";

$alertQueryResults=mysql_query($sql) or die($sql);
$cntAlert=mysql_num_rows($alertQueryResults);
$roleinformation='';
$i=0;
 while ($rows=mysql_fetch_array($alertQueryResults)){
    $privilegeid='';
    $sview_id=$rows['sview_id'];
	$group=$rows['tblgroup_name'];
	$menu_caption=$rows['menu_caption'];
	$roleinformation[$i]=$privilegeid.'^^'.$activity;
	$i++;
			if($cntAlert==$i){
			$comma='';
			}else{
			$comma=',';
			}
	 if($sview_id){
	 $tablename='admin_generaview';
				$sections.="{ tbl:'".$menu_caption."||".$group."||"
				.'createFormTabs("Save",'.$sview_id.',"'.$tablename.'",1)'."'}".$comma;
				//.$msgback='createFormTabs('."'Save'".",$sview_id,'admin_generaview',1".');';
				}
				
	}
	return $sections;
}
?><?php
function createAccounts($accountName,$accountid,$sourcetable){
//,$sourcetable
$accaccount_name=$accountName;

if($sourcetable=='admin_person'){
$arryIn=fillPrimaryData('admin_person',$accountid);
$accountname=$arryIn['last_name'].' '.$arryIn['middle_name'].' '.$arryIn['first_name'];
}

if($sourcetable=='admin_company'){
$arryIn=fillPrimaryData('admin_company',$accountid);
$accountname=$arryIn['company_name'];
}

if($sourcetable=='admin_persongroup'){
$arryIn=fillPrimaryData('admin_persongroup',$accountid);
$accountname=$arryIn['persongroup_name'];
}

if($sourcetable=='insurance_policygroup'){
$arryIn=fillPrimaryData('insurance_policygroup',$accountid);
$accountname=$arryIn['policygroup_name'];
}

if($sourcetable=='insurance_underwriter'){
$arryIn=fillPrimaryData('insurance_underwriter',$accountid);
$accountname=$arryIn['underwriter_name'];
}

$accountscategory_id=$category;
$syowner=$sourcetable;
$syownerid=$accountid;
$created_by=$_SESSION['my_useridloggened'];
$date_created=date('Y-m-d');
$uuid=gen_uuid();
$nature='Active';
$sql="Insert into accounts_accaccount (
accaccount_name	,
syowner	,
accountname,
syownerid	,
opening_balance	,
closing_balance	,
credit_limit	,
nature	,
created_by	,
date_created	,
uuid	
)values('$accaccount_name',
'$syowner',
'$accountname',
'$syownerid',
'$opening_balance',
'$closing_balance',
'$credit_limit',
'$nature',
'$created_by',
'$date_created',
'$uuid')";
$results_stmt=mysql_query($sql) or die($sql); 
$lastid=mysql_insert_id();
return $lastid;
}
?><?php
function insertCashTransaction(){
$cashtrans_name=$_POST['accountactivity_name'];
$accountscategory_id=$_POST['accountscategory_id'];
$currency_id=$_POST['currency_id'];
$dbcr=$_POST['transaction_type'];
$amount=$_POST['amount'];
if($dbcr=='Debit')
$transaction_type='Credit';

if($dbcr=='Credit')
$transaction_type='Debit';

$posttype=$_POST['accountactivity_name'];
$naration=$_POST['naration'];
$voucher_number=$_POST['voucher_number'];
$accaccount_id=$_POST['accaccount_id'];
$created_by=$_SESSION['my_useridloggened'];
$date_created=date('Y-m-d');
$uuid=gen_uuid();
$insertStr=" INSERT INTO accounts_cashtrans(accaccount_id		,
cashtrans_name		,
voucher_number		,
accountscategory_id		,
currency_id		,
amount		,
transaction_type		,
naration		,
created_by		,
date_created		,
uuid) VALUES ('$accaccount_id',
'$cashtrans_name',
'$voucher_number',
'$accountscategory_id',
'$currency_id',
'$amount',
'$transaction_type',
'$naration',
'$created_by',
'$date_created',
'$uuid')";

$results_stmt=mysql_query($insertStr) or die($insertStr); 
$lastid=mysql_insert_id();
return $lastid;
}

function insertBankTransaction(){
$banktrans_name=$_POST['accountactivity_name'];
$accountscategory_id=$_POST['accountscategory_id'];
$currency_id=$_POST['currency_id'];
$dbcr=$_POST['transaction_type'];
$amount=$_POST['amount'];
$check_number=$_POST['check_number'];
$check_date=$_POST['check_date'];
$voucher_number=$_POST['voucher_number'];
$bankaccount_id=$_POST['bankaccount_id'];
if($dbcr=='Debit')
$transaction_type='Credit';

if($dbcr=='Credit')
$transaction_type='Debit';

$posttype=$_POST['accountactivity_name'];
$naration=$_POST['naration'];
$accaccount_id=$_POST['accaccount_id'];
$created_by=$_SESSION['my_useridloggened'];
$date_created=date('Y-m-d');
$uuid=gen_uuid();
$insertStr=" INSERT INTO accounts_banktrans(accaccount_id		,
banktrans_name		,
voucher_number		,
check_number,
check_date,
bankaccount_id,
accountscategory_id		,
currency_id		,
amount		,
transaction_type		,
naration		,
created_by		,
date_created		,
uuid) VALUES ('$accaccount_id',
'$banktrans_name',
'$voucher_number',
'$check_number',
'$check_date',
'$bankaccount_id',
'$accountscategory_id',
'$currency_id',
'$amount',
'$transaction_type',
'$naration',
'$created_by',
'$date_created',
'$uuid')";

$results_stmt=mysql_query($insertStr) or die($insertStr); 
$lastid=mysql_insert_id();
return $lastid;
}
?><?php
function updateEmailFile($sendemail,$sendemailfile){
$photonamearr=explode('_',$photoname);
$sql="update com_sendemail set attachments='$sendemailfile' where sendemail_id='$sendemail'";
$alertQueryResults=mysql_query($sql) or die($sql);
}
?><?php
function uploadEmailFile($file_id, $folder="", $types="",$otherdetails,$sendemailid) {
    if(!$_FILES[$file_id]['name']) return array('','No file specified');

    $file_title = $_FILES[$file_id]['name'];
    //Get file extension
    $ext_arr = split("\.",basename($file_title));
    $ext = strtolower($ext_arr[count($ext_arr)-1]); //Get the last extension

    //Not really uniqe - but for all practical reasons, it is
    $uniqer = substr(md5(uniqid(rand(),1)),0,5);
    $file_name = $uniqer . '_' .$otherdetails.$file_title;//Get Unique Name
	
    updateEmailFile($sendemailid,$file_name);
	//now send email with the attachment
	
				
    $all_types = explode(",",strtolower($types));
    if($types) {
        if(in_array($ext,$all_types));
        else {
            $result = "'".$_FILES[$file_id]['name']."' is not a valid file."; //Show error if any.
            return array('',$result);
        }
    }

    //Where the file must be uploaded to
    if($folder) $folder .= '/';//Add a '/' at the end of the folder
    $uploadfile = $folder . $file_name;

    $result = '';
    //Move the file from the stored location to the new location
    if (!move_uploaded_file($_FILES[$file_id]['tmp_name'], $uploadfile)) {
        $result = "Cannot upload the file '".$_FILES[$file_id]['name']."'"; //Show error if any.
        if(!file_exists($folder)) {
            $result .= " : Folder don't exist.";
        } elseif(!is_writable($folder)) {
            $result .= " : Folder not writable.";
        } elseif(!is_writable($uploadfile)) {
            $result .= " : File not writable.";
        }
        $file_name = '';
        
    } else {
        if(!$_FILES[$file_id]['size']) { //Check if the file is made
            @unlink($uploadfile);//Delete the Empty file
            $file_name = '';
            $result = "Empty file found - please use a valid file."; //Show the error message
        } else {
            chmod($uploadfile,0777);//Make it universally writable.
        }
    }

    return array($file_name,$result);
}
?><?php
function customizeFieldItem($tablenameat,$tablefield){
                    $fieldname=$tablefield;
					$fieldfillwidthpval='';
					$inputvaleu='';
					$fieldcaption=$_SESSION[$tablenameat.$tablefield];
					
					if($_SESSION['custcp'.$tablenameat.$tablefield])
					$fieldcaption=$_SESSION['custcp'.$tablenameat.$tablefield];
					 $val='';
					 if($_SESSION['coptions'.$tablenameat.$tablefield]){
					 $val=trim($_SESSION['coptions'.$tablenameat.$tablefield]);
					 $fieldfillwidthpval="value:'$val',";
					 }
					 
					 $fieldtype=$_SESSION['ctype'.$tablenameat.$tablefield];
					 $inputvaleu='';
					 
					 //echo "$tablenameat $tablefield if(!='visible')".$_SESSION['cvisible'.$tablenameat.$tablefield];
					 if($_SESSION['cvisible'.$tablenameat.$tablefield]!='visible')
					 $fieldtype='hidden';
		 if($fieldtype=='checkbox')
		 $inputvaleu="inputValue:'$val',";
		 //,boxLabel:'Is $fieldcaption'
			$formfield="{
            xtype: '$fieldtype',
			$fieldfillwidthpval
			$fillsecondarykeyval
			$inputvaleu
            name: '$fieldname',
            fieldLabel: '$fieldcaption'
            
        
		    }";
		
		
		
	return $formfield;	
}
?><?php
function createTableGridSummaries($activetableBody,$tablefield){
$sqldefineAutofill="select * from admin_autofill where primary_tablelist='$activetableBody' AND fieldname='$tablefield'";

//echo $sqldefineAutofill;
$Rcd_autofill_results = mysql_query($sqldefineAutofill) or die($sqldefineAutofill);
$cnt_autorows=mysql_num_rows($Rcd_autofill_results);
$fillvalueArr='';
$digit_number='';
			 if($cnt_autorows){
			
					 while($table_autofillrows=mysql_fetch_array($Rcd_autofill_results)){
					 $autofill_id=$table_autofillrows[autofill_id];
					 $tablename=$table_autofillrows[primary_tablelist];
					 $tablefield=$table_autofillrows[fieldname];
					 $prefix=$table_autofillrows[prefix];
					 $sufix=$table_autofillrows[surfix];
					 $caption=$table_autofillrows[caption];
					 $regex=$table_autofillrows[regex];
					 $editable=$table_autofillrows[editable];
					 $min_len=$table_autofillrows[min_len];
					 $max_len=$table_autofillrows[max_len];
					 $is_visible=$table_autofillrows[is_visible];
					
					
					 $digit_number=trim($table_autofillrows[digit_number]);
					 
				$fillvalueArr['caption']=$caption;
				$fillvalueArr['regex']=$regex;
				$fillvalueArr['max_len']=$max_len;
				$fillvalueArr['regex']=$regex;
				$fillvalueArr['editable']=$editable;
				$fillvalueArr['min_len']=$min_len;
				$fillvalueArr['is_visible']=$is_visible;
				
					 
					 
					 }
			 
			}
$cnt_autorows='';
$query_Rcdcount= "select count('person_id') as rowscount from  $activetableBody ";

//mysql_error()//
$Rcd_rcdn_results = mysql_query($query_Rcdcount) or die($query_Rcdcount);
$cnt_rows=mysql_num_rows($Rcd_rcdn_results);
$foundrecordsarr=mysql_fetch_assoc($Rcd_rcdn_results);
$existingcolumns=$foundrecordsarr['rowscount'];
$existingcolumns=$existingcolumns+1;
$digitnum=leading_zeros($existingcolumns, $digit_number);
$fillvalue=$prefix.$digitnum.$sufix;

$fillvalueArr['filval']=$fillvalue;


///print"<input type=\"text\" id=\"$activetableBody$tablefield\"  name=\"$activetableBody$tablefield\" value=\"$fillvalue\">";
return $fillvalueArr;
}

?><?php
function createSingleCheckgroup($type,$tablename){

$accrgts=getSingleGroupItems($tablename);

//$rdgitems.="{ boxLabel: '".$table_caption."', name: '".$table_name."', inputValue: '".$table_name."' }".$comma;


$rlts="{
 xtype: 'checkboxgroup',
 fieldLabel: 'Privileges',
 columns: 2,
 vertical: true,
 items: [$accrgts]
 }";
 
 return $rlts;
 }
function getSingleGroupItems($tablename){

     if ($tablename){
		$searchcolmn=explode('_',$tablename);
		$searchcolmn_name=$searchcolmn[1].'_name';
		$searchcolmn_id=$searchcolmn[1].'_id';
		$query=$_GET["query"];
		$addclause='';
		if($query){
		$query=trim($query);
		$addclause="  WHERE $searchcolmn_name like '%$query%'  ";
		}
		$query_Rcd_getbody= "SELECT $searchcolmn_id, $searchcolmn_name  FROM $tablename  $addclause";
		
		//echo $query_Rcd_getbody;
		$alertQueryResults=mysql_query($query_Rcd_getbody) or die($query_Rcd_getbody);
		$cntAlert=mysql_num_rows($alertQueryResults);
		if($cntAlert>0){
		$ct=0;
		$str='';
		 while($e=mysql_fetch_array($alertQueryResults)){
		 $ct++;
		 if($ct==$cntAlert){
		 $comma='';
		 }else{
		 $comma=',';
		 }
		 
		 $str.= "{ boxLabel: '$e[1]', name: '$e[0]', inputValue: '$e[0]' }".$comma;
		 }
		 
	   }
		
		
	
}

 return $str;
 }?><?php
function getPrefferedEmailSender(){


$where="  where  com_emailsettings.preferred='preferred'  limit 1";
$searchBenefits=$_SESSION['com_emailsettings_SearchSQL'].$where;


$results_stmt=mysql_query($searchBenefits) or die($searchBenefits);                                          
$cntreg_stmnt=mysql_num_rows($results_stmt); 
if($cntreg_stmnt){
       $count=0;
	   $DynamicArr='';
	   $headd=getHeaderDetails('com_emailsettings');
	    
		while($foundrecordsarr=mysql_fetch_assoc($results_stmt)){ 
		    foreach ( $headd as $i ){
			
             $DynamicArr[$i]=$foundrecordsarr[$i];
              }
		
  		}
	}
	
	return 	$DynamicArr;
	
	



}
function smtpmailer($to, $from, $from_name, $subject, $body,$emailusername,$emailpassword,$docs) {
       //$mail->AddAttachment('../sysdocs/email/ampath_social_work_household_assessment_form_v3_20120523_clean.doc'); 
       global $error;
       $mail = new PHPMailer();  // create a new object
       $mail->IsSMTP(); // enable SMTP
       $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
       $mail->SMTPAuth = true;  // authentication enabled
       $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
       $mail->Host = 'smtp.googlemail.com';
       $mail->Port = 465;
	   $mail->IsHTML(true);
       $mail->Username = $emailusername;//GUSER; 
	   $mail->AddAttachment($docs);      // attachment
	   $mail->AddBCC("kwatuha@yahoo.com", "Copy of emails send out"); 
       $mail->Password = $emailpassword;//GPWD;          
       $mail->SetFrom($from, $from_name);
       $mail->Subject = $subject;
       $mail->Body = $body;
       $mail->AddAddress($to);
       if(!$mail->Send()) {
               $error = 'Mail error '.$mail->ErrorInfo;
               return false;
       } else {
               $error = 'Message sent!';
               return true;
       }
}
?><?php
function getPrefferedContact($tablename,$contactid){
$tablename=trim($tablename);
$contactid=trim($contactid);
$where="  where admin_contactdetails.syowner='$tablename' AND admin_contactdetails.syownerid=$contactid  and admin_contactdetails.preferred='preferred'  limit 1";
$searchBenefits=$_SESSION['admin_contactdetails_SearchSQL'].$where;


$results_stmt=mysql_query($searchBenefits) or die($searchBenefits);                                          
$cntreg_stmnt=mysql_num_rows($results_stmt); 
if($cntreg_stmnt){
       $count=0;
	   $DynamicArr='';
	   $headd=getHeaderDetails('admin_contactdetails');
	    
		while($foundrecordsarr=mysql_fetch_assoc($results_stmt)){ 
		    foreach ( $headd as $i ){
			
             $DynamicArr[$i]=$foundrecordsarr[$i];
              }
		
  		}
	}
	
	return 	$DynamicArr;
}
?><?php
function createRepeatingFormFields($tablename,$fieldafter){
$lable=$_SESSION[$tablename.$fieldafter];
$rf="{xtype:'fieldset',
		   title:'More Attachments',
		   collapsible:true,
		   id:'mysuser',
		   items:[{
            xtype: 'button',
			margin: '5 5 5 5',
			text:'Add item',
			handler: function() {
			
								var container = this.up('fieldset');
								var itemnum=0;
								var config = Ext.apply({}, container.initialConfig.items[1]);
								config.fieldName = container.items.length + 1;
								var fieldnamed=container.items.length + 1;
								itemnum=fieldnamed-2;
								
										container.add({
												xtype: 'filefield',
												name: '$fieldafter',
												width:400,
												fieldLabel: '$lable '+ fieldnamed,
												allowBlank: false,
												minLength: 1
											
											});
										
								}}
		]}";

if($tablename=='com_sendemail' && $fieldafter!='attachments')
$rf='NOT';

return $rf; 
}
?>
<?php

function searchByUuid($primarytable,$uuid){
$pidcolmn='uuid';
$where=" where $primarytable".'.'.$pidcolmn."='$uuid' ";
$photoid=trim($photoid);

$searchBenefits=$_SESSION[$primarytable.'_SearchSQL'].$where;
$results_stmt=mysql_query($searchBenefits) or die($searchBenefits);                                          
$cntreg_stmnt=mysql_num_rows($results_stmt); 
if($cntreg_stmnt){
       $count=0;
	   $DynamicArr='';
	   $headd=getHeaderDetails($primarytable);
		while($foundrecordsarr=mysql_fetch_assoc($results_stmt)){ 
		    foreach ( $headd as $i ){
             $DynamicArr[$i]=$foundrecordsarr[$i];
              }
		
  		}
	}
	return 	$DynamicArr;
}
?><?php
function checkNextStep($tablename,$fieldlist,$actiontypevalue){
		/*switch ($tablename)
		{
		case admin_person:
		  if($actiontypevalue=='Save'){
		  $actiontypevalue=
		  }
		  break;
		case label2:
		  code to be executed if n=label2;
		  break;
		default:
		 
		} */
}
?><?php
function updateAdminPhoto($photoname){
$photonamearr=explode('_',$photoname);
$sql="update admin_photo set photo_name='$photoname' where photo_name='$photonamearr[0]'";
$alertQueryResults=mysql_query($sql) or die($sql);
}

function updateAdminPhotoPreferred($pid,$photoname){
$photonamearr=explode('_',$photoname);
$sql="update admin_photo set prefered='false' where source_ref=$pid and photo_name not like '$photoname%' ";
$alertQueryResults=mysql_query($sql) or die($sql);
}
function createPhotoDirectories($tablename,$sourcetable,$pid,$photoname){
if($tablename=='admin_photo'){
	  $sourcetable=str_replace('_','',$sourcetable);
	  $newfilefolder='../sysdocs/'.strtolower($sourcetable);
      $directorytest=is_dir($newfilefolder);
				
		if(!$directorytest){
		mkdir($newfilefolder, 0700);
		}
			
		upload('photo', $newfilefolder, $typesofpotos,$photoname);
		if($_POST['prefered'])
		updateAdminPhotoPreferred($pid,$photoname);
		
		
  }
}

//

?><?php
function findGroupRolesprivileges($roleid){
$sql=" select privilegeid,activity from admin_roleprivilege where role_id='$roleid' ";
$alertQueryResults=mysql_query($sql) or die($sql);
$cntAlert=mysql_num_rows($alertQueryResults);
$roleinformation='';
$i=0;
 while ($rows=mysql_fetch_array($alertQueryResults)){
    $privilegeid='';
    $privilegeid=$rows['privilegeid'];
	$activity=$rows['activity'];
	$roleinformation[$privilegeid]=$privilegeid.'^^'.$activity;
	$i++;
	}
	return $roleinformation;
}
function findPersonSystemRoles(){
$currentuser=trim($_SESSION['my_useridloggened']);
$sql="select privilegeid,activity from admin_roleprivilege where role_id in(select role_id  from admin_roleperson where person_id='$currentuser')";

//echo $sql;
$alertQueryResults=mysql_query($sql) or die($sql);
$cntAlert=mysql_num_rows($alertQueryResults);
$roleinformation='';
$i=0;
 while ($rows=mysql_fetch_array($alertQueryResults)){
    $privilegeid='';
    $privilegeid=$rows['privilegeid'];
	$activity=$rows['activity'];
	$roleinformation[$i]=$privilegeid.'^^'.$activity;
	$i++;
	}
	return $roleinformation;
}
function saveRolePrivilegeInfo($roleid,$groupid){
$del=" delete from admin_roleprivilege where role_id=$roleid and privilegeid in(select uuid from admin_controller where displaygroup='$groupid')  ";

mysql_query($del) or die($del);

$itemstoinsertstm=" select tablename from admin_controller where displaygroup='$groupid' ";

$alertQueryResults=mysql_query($itemstoinsertstm) or die($itemstoinsertstm);
$cntAlert=mysql_num_rows($alertQueryResults);

 while ($rows=mysql_fetch_array($alertQueryResults)){
    $privilegeid='';
    $tablename=$rows['tablename'];
	$roleprivilege_id	='';
	$role_id=$roleid;
	$created_by=$_SESSION['my_useridloggened'];
    $date_created=date('Y-m-d');
	$uuid=gen_uuid();
		if($_POST[$tablename.'m']){  
		  $privilegeid	=$_POST[$tablename.'m'];
		  $activity='Manage';
		 
		 }
		 if($_POST[$tablename.'v']){  
		  $privilegeid	=$_POST[$tablename.'v'];
		  $activity='View';
		 
		 }
		  $insertsql="insert into 
		  admin_roleprivilege(
		  
		            roleprivilege_id,
					role_id,
					privilegeid,
					activity,
					created_by,
					date_created,
					changed_by,
					date_changed,
					voided,
					voided_by,
					date_voided,
					uuid
					
					)
					
		  values(
		        '$roleprivilege_id',
				'$role_id',
				'$privilegeid',
				'$activity',
				'$created_by',
				'$date_created',
				'$changed_by',
				'$date_changed',
				'$voided',
				'$voided_by',
				'$date_voided',
				'$uuid')";
				if($privilegeidprcoessed!=$privilegeid){
				if($privilegeid)
				mysql_query($insertsql);
				}
				$privilegeidprcoessed=$privilegeid;
				$lastsaved=mysql_insert_id();
				if($lastsaved)
				$response='{success:true, savemsg:'.json_encode("Privileges added to the role").'}';
 
 }
 
 echo $response;
 
}
?>
<?php
function insertPrivilegeInfo($cruuid,$tablename){
$roleactions[0]='Manage';
$roleactions[1]='View';
$statestetus_id=1;
$section=$tablename;
$refid=$cruuid;
$created_by=$_SESSION['my_useridloggened'];
$date_created=date('Y-m-d');
$uuid=gen_uuid();

foreach($roleactions as $action){
$privilege_name=$cruuid.' '.$action;
$privilege_id='';
$statestetus_id=1;
$refid=$cruuid;


$insertPrivilege="Insert into admin_privilege(privilege_id,
privilege_name,
statestetus_id,
section,
refid,
created_by,
date_created,
changed_by,
date_changed,
voided,
voided_by,
date_voided,
uuid) 
values('$privilege_id',
'$privilege_name',
'$statestetus_id',
'$section',
'$refid',
'$created_by',
'$date_created',
'$changed_by',
'$date_changed',
'$voided',
'$voided_by',
'$date_voided',
'$uuid')";
mysql_query($insertPrivilege);
}




}
?><?php
function createGroupItemsRights($dispgrp,$roleid){

$privlegesexists=findGroupRolesprivileges($roleid);
$grpOriginal=trim($dispgrp);
//$grp=strtoupper(trim($dispgrp));
$addclause=" WHERE section not in(select distinct sytable_tablelist from designer_sytable where ucase(invisible)='Y') AND section in(select tablename from admin_controller where ucase(displaygroup)='$grp') ";
$query_Rcd_getbody= "SELECT privilege_name,uuid, section  FROM admin_privilege ";

$alertQueryResults=mysql_query($query_Rcd_getbody) or die($query_Rcd_getbody);



$cntAlert=mysql_num_rows($alertQueryResults);
//
 $counters=0;
 $rdgitems='';

 while ($rows=mysql_fetch_array($alertQueryResults)){
 //start exclusion
 $addtosec='d'; 
 $grp=strtoupper(trim($dispgrp));
 $sectgrp=strtoupper(trim($_SESSION['tablegroup'.$rows['section']]));
 if($sectgrp!=$grp)
 $addtosec='';
if( $_SESSION["syintt".$rows['section']])
 $addtosec='';
 
 if($addtosec){
  $counters++;
  if( $counters==$cntAlert){
  $comma='';
  }else{
  $comma=',';
  }
  
 $uuid=$rows['uuid'];
 $section=$rows['section'];
 $privilegeArr=explode(' ',$rows['privilege_name']);
 
 if($privilegeArr[1]=='Manage')
 $activitycat='m';
 
 if($privilegeArr[1]=='View')
 $activitycat='v';
 $ctrluuid=$privilegeArr[0];
 $table_caption=$_SESSION['stm'.$section];
 $checkthisitm='';
 if($privlegesexists[$ctrluuid]){
 $pvr=explode('^^',$privlegesexists[$ctrluuid]);
 if($privilegeArr[1]==$pvr[1]){
 $checkthisitm=' , checked: true ';
 }
 }
 $rdgitems.="{ boxLabel: '".$privilegeArr[1].' '.$table_caption."',id: '".$section.$activitycat."', name: '".$section.$activitycat."', inputValue: '".$ctrluuid."',handler:function(){
 


   var ctractivity='$privilegeArr[1]';
  if(ctractivity=='Manage'){
   var ccbxval = Ext.getCmp('".$section."v').setValue(false);
   
  }
   if(ctractivity=='View'){
   var ccbxvalView = Ext.getCmp('".$section."m').setValue(false);
   
  }
 
 
 } $checkthisitm }".$comma;
 
 }//end of exclusion
 
 }
 
 return $rdgitems;
}
?><?php
function createPrivilegeAssigmentform($dispgrp){
$grpOriginal=trim($dispgrp);
$grp=strtoupper(trim($dispgrp));
$addclause=" WHERE table_name not in(select distinct sytable_tablelist from designer_sytable where ucase(invisible)='Y') AND table_name in(select tablename from admin_controller where ucase(displaygroup)='$grp') ";
$query_Rcd_getbody= "SELECT table_name, table_caption  FROM admin_table $addclause";

$alertQueryResults=mysql_query($query_Rcd_getbody) or die($query_Rcd_getbody);
$cntAlert=mysql_num_rows($alertQueryResults);
//
 $counters=0;
 $rdgitems='';
 while ($rows=mysql_fetch_array($alertQueryResults)){
  $counters++;
  if( $counters==$cntAlert){
  $comma='';
  }else{
  $comma=',';
  }
  
 $table_name=$rows['table_name'];
 $table_caption=$rows['table_caption'];
 $rdgitems.="{ boxLabel: '".$table_caption."', name: '".$table_name."', inputValue: '".$table_name."' }".$comma;
 }

$Informa= "
function dynamicRadioGroup(ccgroup){ 
Ext.onReady(function() {
var viewdiv=document.getElementById('detailinfo');
viewdiv.innerHTML='';
}
 Ext.define('cmbGroupGeneralDatadata', {
    extend: 'Ext.data.Model',
	fields:['displaygroup']
	});

var secondarytableListdata = Ext.create('Ext.data.Store', {
    model: 'cmbGroupGeneralDatadata',
    proxy: {
        type: 'ajax',
        url : 'cmbdesgn.php?tbgp=1',
        reader: {
            type: 'json'
        }
    }
});
secondarytableListdata.load();

 Ext.define('cmbRoledataDatadata', {
    extend: 'Ext.data.Model',
	fields:['role_id','role_name']
	});

var roledata = Ext.create('Ext.data.Store', {
    model: 'cmbRoledataDatadata',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_role',
        reader: {
            type: 'json'
        }
    }
});
roledata.load();
accrgts=[$rdgitems];
 Ext.create('Ext.form.Panel', {
 title: 'Assign Privileges',
 width: 600,
 bodyPadding: 10,
 draggable:true,
 shadow :true,
 stateEvents:['click', 'customerchange'],
 renderTo:'tabsdv',
 items:[{
    xtype: 'combobox',
	name:'tablelist_secondary',
	id:'tablelist_secondary',
	forceSelection:true,
    fieldLabel: 'Section Filter',
    store: secondarytableListdata,
      queryMode: 'remote',
	  value:ccgroup,
    displayField: 'displaygroup',
    valueField: 'displaygroup',
	listeners: { select: function(combo, record, index ) { 
	var secelVal = Ext.getCmp('tablelist_secondary').getValue();
	createCheckitesm(secelVal);
	 }}
	}, {
    xtype: 'combobox',
	name:'role_id',
	id:'role_id',
	forceSelection:true,
    fieldLabel: 'Role',
    store: roledata,
      queryMode: 'remote',
	 // value:'role_id,
    displayField: 'role_name',
    valueField: 'role_id',
	listeners: { select: function(combo, record, index ) { 
	//var secelVal = Ext.getCmp('tablelist_secondary').getValue();
	//createCheckitesm(secelVal);
	 }}
	},{
 xtype: 'checkboxgroup',
 fieldLabel: 'Privileges',
 columns: 2,
 vertical: true,
 items: [accrgts]
 },{
            xtype: 'toolbar',
            dock: 'bottom',
            ui: 'footer',
            defaults: {
                minWidth: 75
            },
            items: ['->',  {
                text: 'Clear',
                handler: function(){
                    var field = Ext.getCmp(fieldId);
                    if (!field.readOnly && !field.disabled) {
                        field.clearValue();
                    }
                }
            }, {
                text: 'Reset',
                handler: function() {
                    Ext.this.up('form').getForm().reset();
                }
            }, {
		xtype: 'button',
        text: 'Save',
        handler: function() {
            var form = this.up('form').getForm();
            if(form.isValid()){
                form.submit({
                    url: 'bodysave.php',
                    waitMsg: 'saving changes...',
                    success: function(fp, o) {
                        //Ext.Msg.alert('Success', '' + o.result.savemsg + '\"');
						eval(o.result.savemsg);
                    }
                });
            }
        }
    }]}]
 
 });
 
 }dynamicRadioGroup('$grpOriginal');";
////////////////////////

return $Informa;
}

?><?php
function getTableContextMenus($tablename){
$sql="
select distinct  designer_sview.sview_id , designer_sview.context_menu  from designer_fasttbldesign  inner join designer_sview on designer_sview.sview_id = designer_fasttbldesign.sview_id ";

$where= "  where designer_fasttbldesign.primary_tablelist='$tablename' ";
$searchBenefits=$sql.$where;
$results_stmt=mysql_query($searchBenefits) or die($searchBenefits);                                          
$cntreg_stmnt=mysql_num_rows($results_stmt); 
$hasviews='';
if($cntreg_stmnt){
$hasviews="";
$ctn=0;
while($foundrecordsarr=mysql_fetch_array($results_stmt)){
$ctn++; 
		$context_menu=$foundrecordsarr['context_menu'];
		$sview_id=$foundrecordsarr['sview_id'];
		$hasviews[$ctn]=$sview_id.'|'.$context_menu;
  		}
		/*if($tablename=='housing_housinglandlord'){
		$len=sizeof($hasviews)+1;
		$hasviews[$len]='Contract|Contract';
		}*/
	}
	return 	$hasviews;
}
?><?php
function getPrimaryTableView($tablename){
$where= "  where designer_fasttbldesign.primary_tablelist='$tablename' ";
$searchBenefits=$_SESSION['designer_fasttbldesign_SearchSQL'].$where;
$results_stmt=mysql_query($searchBenefits) or die($searchBenefits);                                          
$cntreg_stmnt=mysql_num_rows($results_stmt); 
$hasviews='';
if($cntreg_stmnt){
$hasviews="has views";
	}
	return 	$hasviews;
}


function fillPrimaryData($primarytable,$primaryselector){
$primarytable=trim($primarytable);
$clArr=explode('_',$primarytable);
$pidcolmn=$clArr[1].'_id';
$where=" where $primarytable".'.'.$pidcolmn."='$primaryselector' ";
$photoid=trim($photoid);

$searchBenefits=$_SESSION[$primarytable.'_SearchSQL'].$where;

$results_stmt=mysql_query($searchBenefits) or die($searchBenefits);                                          
$cntreg_stmnt=mysql_num_rows($results_stmt); 
if($cntreg_stmnt){
       $count=0;
	   $DynamicArr='';
	   $headd=getHeaderDetails($primarytable);
		while($foundrecordsarr=mysql_fetch_assoc($results_stmt)){ 
		    foreach ( $headd as $i ){
             $DynamicArr[$i]=$foundrecordsarr[$i];
              }
		
  		}
	}
	return 	$DynamicArr;
}


function createTabbedForm($primarytable,$primaryselector,$formview,$primaryphoto,$detailinfo,$tabbedformtitle,$tabbedformwidth,$primarywidth,$photowidth,$primarymargins,$primarysectitle,$photosectitle){


$formview=trim($formview);
$formview=str_replace(' ','_',$formview);
$type='primary';

//$primarytable='admin_person';
$photoid=1;
//echo $primarytable.'======';
$primaryitems=createFormItemObject($primarytable,$type,$primarytable,$primaryselector,$tabcaption);
$primaryCombodata=createFormItemObject($primarytable,'getcombodata',$primarytable,$primaryselector,$tabcaption);
$dataArray=getTabbedFormItems($formview,$primarytable,$primaryselector);
$formtabitems=$dataArray['tabdetails'];
$secondarycombodada=$dataArray['combodata'];
$combodata=$primaryCombodata.$secondarycombodada;



//<img src=\"../template/images/default_employee_image.gif\" alt=\"photo\" width=\"95\" height=\"112\" />

if(!$picture){
$photobutton='Add Photo';
}else{
$photobutton='Edit Photo';
$photobuttonHandle="primaryPicture('$formview','$primaryid')";
}

$photodetails="{
            html: '<div id=\"personpicture\">'
			+'$picture</div>'
        },{
            xtype: 'button',
            name: 'addphoto',
            text: '$photobutton',
            allowBlank: false,
            minLength: 1,
			handler:function(){
			$photobuttonHandle
			}
        
		}";
		$cphoto="../template/images/default_employee_image.gif";
			
		$cphoto="../template/images/smart_lady_02.gif";
		$picture=getPhotoImage($primarytable,$primaryselector);	
		if($picture){
		$srcrevised=str_replace('_','',$primarytable);
		$cphoto='../sysdocs/'.strtolower($srcrevised).'/'.$picture;
		}
		$photoname=$primaryselector.rand(0,99999);
		$photocaptionArr=fillPrimaryData($primarytable,$primaryselector);
		$photocaption='';
		if($primarytable=='admin_person')
		$photocaption=$photocaptionArr['last_name'].' '.$photocaptionArr['middle_name'].' '.$photocaptionArr['first_name'];
		
		
		
$photodiv="html:'<div id=\"currentImage\" style=\"width: 150px; height: auto; overflow: hidden;\">'
+'<div id=\"cngphotodiv\"></div>'
    +'<center>'
        +'<a href=\"#\" onClick=\"'
		+'showPhotoMenu(\'$primarytable\',$primaryselector,\'$photoname\',$formview);\">'
		 +' <img visibility=\"visible\" alt=\"Employee Photo\" '
		 +' src=\"$cphoto\" id=\"empPic\"'
		 +' style=\"width:100%;\" border=\"0\"'
		 +'height=\"150\" width=\"150\">'
       +' </a><span class=\"smallHelpText\"><strong>'
	   +'$photocaption</strong></span>'
    +'</center>'
+'</div>'";		
					
$tabfunction= "
function createTabbed$formview(){
var obj=document.getElementById('detailinfo');
obj.innerHTML='';
   loadtype='Save';
   //**************************************************************************************
  $combodata
  //*************************************************************************************
   
   admin_contactdata='kwasdasd';
   $combodata
   Ext.create('Ext.panel.Panel', {
    renderTo: '$detailinfo',
    width: $tabbedformwidth,
	bodyPadding:10,
    title: '$tabbedformtitle',
    items: [
			     {
	layout:'column',
    items: [{
        title: false,
        columnWidth: $primarywidth,
		bodyPadding: 10,
		border:false,
		items:[{
						xtype: 'fieldset',
						title: '$primarysectitle',
						width:380,
						collapsible:true,
						iconCls:'usergroup',
						items: [$primaryitems]
		      }]
    },{
        title:false,
		margin: '5 5 5 5',
        columnWidth: $photowidth,
		border:false,
		bodyPadding: 10,
		
		
		items:[{
		        xtype: 'fieldset',
				collapsible:true,
				title:'Photo',
				width:160,
				
				$photodiv
				}
		/*$photodetails*/]
    }]
			/////////////////////////////////////////////////
					},
				 //
				 {xtype:'tabpanel',
				 title:false,
				 bodyPadding: 10,
				 items:[$formtabitems]
				 }
				 ]}
				 );

 
 }
 createTabbed$formview();";
 echo $tabfunction;
 $extPrimaryModels='../template/functions/tabb_current'.'.js';
file_put_contents($extPrimaryModels,$tabfunction);

 return $tabfunction;
 }
 
?><?php
function getPhotoImage($primarytable,$photoid){
$primarytable=trim($primarytable);
$photoid=trim($photoid);
$searchBenefits=" select photo_name from admin_photo where source_tablelist='$primarytable' AND source_ref=$photoid  and prefered='Preferred' order by photo_id desc  limit 1 ";
$results_stmt=mysql_query($searchBenefits) or die($searchBenefits);                                          
$cntreg_stmnt=mysql_num_rows($results_stmt); 
if($cntreg_stmnt){
       $count=0;
	   $employyeeArray='';
	   	$photo_name='';
		while($foundrecordsarr=mysql_fetch_array($results_stmt)){ 
		$photo_name=$foundrecordsarr['photo_name'];
  		}
	}
	return 	$photo_name;
}
?><?php
function getTabbedFormItems($formview,$primarytable,$primaryselector){
$primarytable=trim($primarytable);
$photoid=trim($photoid);
$searchBenefits=" select * from designer_fasttbldesign where  sview_id=$formview  order by tab_index  ";
$results_stmt=mysql_query($searchBenefits) or die($searchBenefits);                                          
$cntreg_stmnt=mysql_num_rows($results_stmt); 
if($cntreg_stmnt){
       $count=0;
	   $employyeeArray='';
	   $secondarycombodada='';
	   	$tabs='';
		$dataArray='';
		while($foundrecordsarr=mysql_fetch_array($results_stmt)){ 
		$secondary_tablelist=$foundrecordsarr['secondary_tablelist'];
		$tabcaption=$foundrecordsarr['tabcaption'];
		$type='secondary';
		$tab=createFormItemObject($secondary_tablelist,$type,$primarytable,$primaryselector,$tabcaption);
		
		$secondarycombodada.=createFormItemObject($secondary_tablelist,'getcombodata',$primarytable,$primaryselector,$tabcaption);
		
		
		$count++;
	
		if($cntreg_stmnt==$count){
		$comma='';
		}else{
		$comma='
		
	,';
		}
		
		$tabs.=$tab.$comma;
  		}
	}
	
	
	$dataArray['combodata']=$secondarycombodada;
	$dataArray['tabdetails']=$tabs;
	return $dataArray;	
}
function createFormItemObject($tablename,$type,$primarytable,$primaryselector,$tabcaption){
/*if($tablename=='housing_housingtenant')
$tablename='housing_housingtenant';*/

$primarycolmn=explode('_',$primarytable);
$primaryid=$primarycolmn[1].'_id';
$query_Rcd_getbody= " show columns from  $tablename ";
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die($query_Rcd_getbody);
$requiredclasses='';
$tfunction='';
$combodata='';
$initialform='';
$formftbl="{xtype:'hidden',
             name:'t',
			 value:'$tablename'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },"
			 ;
			 $formfield=$formftbl;
$stdinfo='';
while ($rows=mysql_fetch_array($Rcd_tbody_results)){
$tfname=$count_cls['Field'];
$tfname=$count_cls['Null'];
$tfname=$count_cls['Key'];
$tfname=$count_cls['Extra'];
}

$sqlmain="select groupfolder,
groupfolder	,
showgroup	,
fieldname	,
fieldcaption	,
required	,
control_position	,
infshow	,
displaysize	,
primarykeyidentifier	,
isautoincrement	,
dataformat,
accessrights
from admin_controller where tablename='$tablename'  and infshow='Show' order by infpos";

$sqlmain_results = mysql_query($sqlmain) or die(mysql_error());
$fndCols=mysql_num_rows($sqlmain_results);
$tableslist='';
$availableOptions='';
$defaultview='';
while ($rows=mysql_fetch_array($sqlmain_results)){
$dataformat=$rows['dataformat'];
$groupfolder=$rows['groupfolder'];
$showgroup=$rows['showgroup'];
$fieldname=$rows['fieldname'];
$fieldcaption=$rows['fieldcaption'];
$required=$rows['required'];
$control_position=$rows['control_position'];
$infshow=$rows['infshow'];
$displaysize=$rows['displaysize'];
$primarykeyidentifier=$rows['primarykeyidentifier'];
$isautoincrement=$rows['isautoincrement'];
$accessrights=$rows['accessrights'];

$datatype=substr($dataformat,0,3);
$fldsplit=explode('_',$fieldname);

if((!$isautoincrement)&&($fldsplit[1]!='id')){
$fieldtype='numberfield';
}

$fillsecondarykeyval='';
if(($primaryid==$fieldname)&&($tablename!=$primarytable)){
$fieldtype='hidden';
$fillArray=fillPrimaryData($primarytable,$primaryselector);
$fillsecondarykeyval=$fillArray[$fieldname];
$fillsecondarykeyval=" value:'".$primaryselector."',";
$datatype='hidden';
}



/*/$fieldtype=$datatype*/
if(($datatype=='int') || ($datatype=='tin')|| ($datatype=='dou')||($datatype=='sma') 
|| ($datatype=='med')|| ($datatype=='big')|| ($datatype=='flo')|| ($datatype=='num')
|| ($datatype=='dec')){

if($isautoincrement){
$fieldtype='hidden';
}

/*if(($fieldname=='date_created')||($fieldname=='changed_by')||($fieldname=='date_changed')||($fieldname=='voided')||($fieldname=='voided_by')||($fieldname=='date_voided')||($fieldname=='uuid')){
$fieldtype='hidden';
}*/

if((!$isautoincrement)&&($fldsplit[1]=='id')){
$fieldtype='combobox';
}

}

$disdiv='detailinfo';
$referebysub=$_GET['dcrspdn'];
$selected='';
if($referebysub){
$disdiv='dynamicchild';
$selected=$selected;
}
$initializetheform=$tablename."Form('$disdiv','Save','NOID');";

if($fieldname=='syowner'){
$referebysub=$_GET['rbs'];
$defaultview=createFlexColumnDefault($tablename);
$target='form';
$availableOptions=createFlexColumnOptions($tablename,$selected,$target);

if($availableOptions){
//$initializetheform='';
}
$disdiv='dataentry';
  $tableslist='
'."Ext.define('cmbtableListdata', {
    extend: 'Ext.data.Model',
	fields:['table_caption','table_name']
	});

var tableListdata = Ext.create('Ext.data.Store', {
    model: 'cmbtableListdata',
    proxy: {
        type: 'ajax',
        url : 'cmbdesgn.php?tbp=admin_table',
        reader: {
            type: 'json'
        }
    }
});
tableListdata.load();
".'
'
;
  }
  
if($datatype=='sel'){
$fieldtype='itemselector';
}
if($datatype=='mul'){
$fieldtype='multiselect';
}


if($datatype=='var'){
   
  $fieldtype='textfield';
  if($fieldname=='password'){
    $fieldtype='password';
  }
  $vrem=explode('_',$fieldname);
  if($vrem[0]=='email'){
    $fieldtype='email';
  }
}
if($datatype=='tex'){
$fieldtype='textareafield';
}

if($datatype=='dat'){
$fieldtype='datefield';
}


$fieldnameArr=explode('_',$fieldname);
if(($datatype=='tli')||($fieldnameArr[1]=='tablelist')){
$fieldtype='comboboxtablelist';
}
if($datatype=='fli'){
$fieldtype='comboboxtablefieldlist';
}


$referebysub=$_GET['dcrspdn'];
if($referebysub){
$comboFields=explode('_',$referebysub);
$combodata.="

Ext.define('cmb".ucfirst($referebysub)."', {
    extend: 'Ext.data.Model',
	fields:['".$comboFields[1]."_id','".$comboFields[1]."_name']
	});

var ".$referebysub."data = Ext.create('Ext.data.Store', {
    model: 'cmb".ucfirst($referebysub)."',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=".$referebysub."',
        reader: {
            type: 'json'
        }
    }
});

".$referebysub."data.load();
";
}

if($fieldtype=='combobox'){
$comboFields=explode('_',$_SESSION[$fieldname]);
$combodata.="

Ext.define('cmb".ucfirst($_SESSION[$fieldname])."', {
    extend: 'Ext.data.Model',
	fields:['".$comboFields[1]."_id','".$comboFields[1]."_name']
	});

var ".$_SESSION[$fieldname]."data = Ext.create('Ext.data.Store', {
    model: 'cmb".ucfirst($_SESSION[$fieldname])."',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=".$_SESSION[$fieldname]."',
        reader: {
            type: 'json'
        }
    }
});

".$_SESSION[$fieldname]."data.load();
";
}

/*//////////////if it is a tablelist */
if($fieldtype=='comboboxtablelist'){
$combodata.="
Ext.define('cmbdesgn".ucfirst($fieldname)."', {
    extend: 'Ext.data.Model',
	fields:['table_name','table_caption']
	});

var ".$fieldname."data = Ext.create('Ext.data.Store', {
    model: 'cmbdesgn".ucfirst($fieldname)."',
    proxy: {
        type: 'ajax',
        url : 'cmbdesgn.php?tbp=admin_table',
        reader: {
            type: 'json'
        }
    }
});

".$fieldname."data.load();
";



}

if($fieldtype=='comboboxtablefieldlist'){
$combodata.="

Ext.define('cmb".ucfirst($fieldname)."', {
    extend: 'Ext.data.Model',
	fields:['fieldname','fieldcaption']
	});

var ".$fieldname."data = Ext.create('Ext.data.Store', {
    model: 'cmb".ucfirst($fieldname)."',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?myfields=admin_controller&vt=".$tablename."', 
        reader: {
            type: 'json'
        }
    }
});

".$fieldname."data.load();
";



}

if($fieldtype=='itemselector'){
$combodata.="

Ext.define('cmb".ucfirst($fieldname)."', {
    extend: 'Ext.data.Model',
	fields:['fieldname','fieldcaption']
	});

var ".$fieldname."data = Ext.create('Ext.data.Store', {
    model: 'cmb".ucfirst($fieldname)."',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=".$tablename."&find=thistable',
        reader: {
            type: 'json'
        }
    }
});

".$fieldname."data.load();
";



}
/*/////////////////////*/
$colnum++;

if($type=='primary'){
$datafn=fillPrimaryData($primarytable,$primaryselector);
$fieldfillwidthpval="readOnly:true,value:'$datafn[$fieldname]',";
}
if($fndCols==$colnum){
if($type=='primary'){
$commadelimiter='';
}else{
$commadelimiter='],';
}
//changed to terminate form

}else{
$commadelimiter=',';
}

$referebysub=$_GET['dcrspdn'];
if($fieldtype=='combobox'){
$formfield.="
   {
    xtype: 'combobox',
	name:'$fieldname',
	forceSelection:true,
	$fieldfillwidthpval
    fieldLabel: '$fieldcaption',
    store: ".$_SESSION[$fieldname]."data,
	$fillsecondarykeyval
    queryMode: 'remote',
    displayField: '$comboFields[1]_name',
    valueField: '$comboFields[1]_id'
	}".$commadelimiter;
}elseif($fieldtype=='comboboxtablefieldlist'){
$formfield.="
   {
    xtype: 'combobox',
	name:'$fieldname',
	forceSelection:true,
    fieldLabel: '$fieldcaption',
	$fieldfillwidthpval
	$fillsecondarykeyval
    store: ".$fieldname."data,
    queryMode: 'remote',
    displayField: 'fieldcaption',
    valueField: 'fieldname'
	}".$commadelimiter;

}elseif($fieldtype=='itemselector'){
$formfield.="
   {
    xtype: 'itemselector',
	name:'$fieldname',
	forceSelection:true,
	$fieldfillwidthpval
	$fillsecondarykeyval
    fieldLabel: '$fieldcaption',
    store: ".$fieldname."data,
    queryMode: 'remote',
    displayField: 'sectionCaption',
    valueField: 'sectionValue',
	allowBlank: false,
    msgTarget: 'side'
	}".$commadelimiter;

}


elseif($fieldtype=='comboboxtablelist'){

$formfield.="
   {
    xtype: 'combobox',
	name:'$fieldname',
	forceSelection:true,
    fieldLabel: '$fieldcaption',
    store: ".$fieldname."data,
    queryMode: 'remote',
    displayField: 'table_caption',
	$fieldfillwidthpval
	$fillsecondarykeyval
    valueField: 'table_name'
	}".$commadelimiter;
}

elseif($fieldtype=='password'){
$formfield.="{
            xtype: 'textfield',
            name: '$fieldname',
			$fieldfillwidthpval
			$fillsecondarykeyval
            fieldLabel: '$fieldcaption',
			 inputType: 'password',
            allowBlank: false,
            minLength: 1
        
		}".$commadelimiter;
}
elseif($fieldtype=='email'){
$formfield.="{
            xtype: 'textfield',
			$fieldfillwidthpval
			$fillsecondarykeyval
            name: '$fieldname',
            fieldLabel: '$fieldcaption',
			allowBlank: false,
            minLength: 1
        
		}".$commadelimiter;
}
elseif($fieldname=='syowner'){
		if($referebysub){
				$formfield.="{
					xtype: 'hidden',
					name: '$fieldname',
					value: '$referebysub'
				
				}".$commadelimiter;
		
		}
}elseif($fieldname=='syownerid'){
		if($referebysub){
					$comboFVals=explode('_',$referebysub);
					$fcpn=$comboFVals[1].'_name';
					$fcpnid=$comboFVals[1].'_id';
					$fildcptionnew=$_SESSION[$referebysub.$fcpn];
		$formfield.="
		   {
			xtype: 'combobox',
			name:'$fieldname',
			forceSelection:true,
			$fieldfillwidthpval
			$fillsecondarykeyval
			fieldLabel: '$fildcptionnew',
			store: ".$referebysub."data,
			queryMode: 'remote',
			displayField: '$fcpn',
			valueField: '$fcpnid'
			}".$commadelimiter;
		
		}
}else{
$formfield.="{
            xtype: '$fieldtype',
			$fieldfillwidthpval
			$fillsecondarykeyval
            name: '$fieldname',
            fieldLabel: '$fieldcaption',
            allowBlank: false,
            minLength: 1
        
		}".$commadelimiter;
}



$tfunction="


";

}

/*//other standard infor*/
$stdinfo=" dockedItems: [{
            xtype: 'container',
            dock: 'bottom',
            layout: {
                type: 'hbox',
                align: 'middle'
            },
            padding: '10 10 5',

            items: [{
                xtype: 'component',
                id: 'formErrorState',
                baseCls: 'form-error-state',
                flex: 1,
                validText: 'Form is valid',
                invalidText: 'Form has errors',
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for=\".\"><li><span class=\"field-name\">{name}</span>: '
				+ '<span class=\"error\">{error}</span></li></tpl></ul>'),

                getTip: function() {
                    var tip = this.tip;
                    if (!tip) {
                        tip = this.tip = Ext.widget('tooltip', {
                            target: this.el,
                            title: 'Error Details:',
                            autoHide: false,
                            anchor: 'top',
                            mouseOffset: [-11, -2],
                            closable: true,
                            constrainPosition: false,
                            cls: 'errors-tip'
                        });
                        tip.show();
                    }
                    return tip;
                },

                setErrors: function(errors) {
                    var me = this,
                        baseCls = me.baseCls,
                        tip = me.getTip();

                    errors = Ext.Array.from(errors);

                    /* Update CSS class and tooltip content*/
                    if (errors.length) {
                        me.addCls(baseCls + '-invalid');
                        me.removeCls(baseCls + '-valid');
                        me.update(me.invalidText);
                        tip.setDisabled(false);
                        tip.update(me.tipTpl.apply(errors));
                    } else {
                        me.addCls(baseCls + '-valid');
                        me.removeCls(baseCls + '-invalid');
                        me.update(me.validText);
                        tip.setDisabled(true);
                        tip.hide();
                    }
                }
            }, 
			
			
	/*now submit*/
	{
		xtype: 'button',
        text: 'Save',
        handler: function() {
            var form = this.up('form').getForm();
            if(form.isValid()){
                form.submit({
                    url: 'bodysave.php',
                    waitMsg: 'saving changes...',
                    success: function(fp, o) {
                        //Ext.Msg.alert('Success', 'Your changes has been saved.');
						eval(o.result.savemsg);
                    }
                });
            }
        }
    }
	/*end of cols*/
		]
		
		 }]
    });";
	
	$formtabtitle= $tabcaption;//$_SESSION['stm'.$tablename]
	$displayWindow="var win = Ext.create('Ext.Window', {
					 
        title: '".$formtabtitle."',
       
        layout: 'fit',
		autoScroll :true,
		items: formPanel,
		 tbar:[{
                    text:'Add Something',
                    tooltip:'Add a new row',
                    iconCls:'add'
                }, '-', {
                    text:'Options',
                    tooltip:'Blah blah blah blaht',
                    iconCls:'option'
                },'-',{
                    text:'Search',
                    tooltip:'Delete Record',
                    iconCls:'find'
                }]
    }).show();
	

});";

$toolbars="[{
                    text:'Add new',
                    tooltip:'Add a new row',
                    iconCls:'add'
                }, '-', {
                    text:'Options',
                    tooltip:'Configure options',
                    iconCls:'option'
                },'-',{
                    text:'Search',
                    tooltip:'Delete selected item',
                    iconCls:'search'
                },'-',{
                    text:'View',
                    tooltip:'View table Grid',
                    iconCls:'grid',
					handler:function(buttonObj, eventObj) { 
									createFormGrid('Save','NOID','$tablename','g')
									}
                }]";
$displayWindow='';
$initialform="
        {
        xtype: 'form',
		tbar:$toolbars,
		resizable:true,
        frame: true,
		url:'bodysave.php',
        width: 550,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: '".ucfirst($formtabtitle)."',

        defaults: {
            anchor: '100%'
        },
        fieldDefaults: {
            labelAlign: 'left',
            msgTarget: 'none',
            /*invalidCls: '' 
			unset the invalidCls so individual fields do not get styled as invalid*/
        },

        /*
         * Listen for validity change on the entire form and update the combined error icon
         */
        listeners: {
            fieldvaliditychange: function() {
                this.updateErrorState();
            },
            fielderrorchange: function() {
                this.updateErrorState();
            }
        },

        updateErrorState: function() {
            var me = this,
                errorCmp, fields, errors;

            if (me.hasBeenDirty || me.getForm().isDirty()) { "./*//prevents showing global error when form first loads*/
			"
                errorCmp = me.down('#formErrorState');
                fields = me.getForm().getFields();
                errors = [];
                fields.each(function(field) {
                    Ext.Array.forEach(field.getErrors(), function(error) {
                        errors.push({name: field.getFieldLabel(), error: error});
                    });
                });
                errorCmp.setErrors(errors);
                me.hasBeenDirty = true;
            }
        },

        items: [
		
		";
		
	$lastpart=" dockedItems: [{
            xtype: 'container',
            dock: 'bottom',
            layout: {
                type: 'hbox',
                align: 'middle'
            },
            padding: '10 10 5',

            items: [{
                xtype: 'component',
                id: 'formErrorState',
                baseCls: 'form-error-state',
                flex: 1,
                validText: 'Form is valid',
                invalidText: 'Form has errors',
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for="."><li><span class=\"field-name\">{name}</span>:'
				+' <span class=\"error\">{error}</span></li></tpl></ul>'),

                getTip: function() {
                    var tip = this.tip;
                    if (!tip) {
                        tip = this.tip = Ext.widget('tooltip', {
                            target: this.el,
                            title: 'Error Details:',
                            autoHide: false,
                            anchor: 'top',
                            mouseOffset: [-11, -2],
                            closable: true,
                            constrainPosition: false,
                            cls: 'errors-tip'
                        });
                        tip.show();
                    }
                    return tip;
                },

                setErrors: function(errors) {
                    var me = this,
                        baseCls = me.baseCls,
                        tip = me.getTip();

                    errors = Ext.Array.from(errors);

                    "./*Update CSS class and tooltip content*/
					"
                    if (errors.length) {
                        me.addCls(baseCls + '-invalid');
                        me.removeCls(baseCls + '-valid');
                        me.update(me.invalidText);
                        tip.setDisabled(false);
                        tip.update(me.tipTpl.apply(errors));
                    } else {
                        me.addCls(baseCls + '-valid');
                        me.removeCls(baseCls + '-invalid');
                        me.update(me.validText);
                        tip.setDisabled(true);
                        tip.hide();
                    }
                }
            }, 
			
			
	/*now submit*/
	{
		xtype: 'button',
        text: 'Submit Data',
        handler: function() {
            var form = this.up('form').getForm();
            if(form.isValid()){
                form.submit({
                    url: 'bodysave.php',
                    waitMsg: 'saving changes...',
                    success: function(fp, o) {
                        //Ext.Msg.alert('Success', '' + o.result.savemsg + '\"');
						eval(o.result.savemsg);
                    }
                });
            }
        }
    }
	"./*///end of cols*/"
		]
        }]
   


}/*launchForm()*/
$initializetheform;
";

/*.'} end of '.$_SESSION['stm'.$tablename].' form;*/
/*$availableOptions='';
$defaultview='';*/
//$outputinfo=
$formbuttonsdocked="dockedItems: [{
            xtype: 'container',
            dock: 'bottom',
            layout: {
                type: 'hbox',
                align: 'middle'
            },
            padding: '10 10 5',

            items: [{
                xtype: 'component',
                id: 'formErrorState',
                baseCls: 'form-error-state',
                flex: 1,
                validText: 'Form is valid',
                invalidText: 'Form has errors',
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for=><li><span class=\"field-name\">{name}</span>: '
				+ '<span class=\"error\">{error}</span></li></tpl></ul>'),

                getTip: function() {
                    var tip = this.tip;
                    if (!tip) {
                        tip = this.tip = Ext.widget('tooltip', {
                            target: this.el,
                            title: 'Error Details:',
                            autoHide: false,
                            anchor: 'top',
                            mouseOffset: [-11, -2],
                            closable: true,
                            constrainPosition: false,
                            cls: 'errors-tip'
                        });
                        tip.show();
                    }
                    return tip;
                },

                setErrors: function(errors) {
                    var me = this,
                        baseCls = me.baseCls,
                        tip = me.getTip();

                    errors = Ext.Array.from(errors);

                    
                    if (errors.length) {
                        me.addCls(baseCls + '-invalid');
                        me.removeCls(baseCls + '-valid');
                        me.update(me.invalidText);
                        tip.setDisabled(false);
                        tip.update(me.tipTpl.apply(errors));
                    } else {
                        me.addCls(baseCls + '-valid');
                        me.removeCls(baseCls + '-invalid');
                        me.update(me.validText);
                        tip.setDisabled(true);
                        tip.hide();
                    }
                }
            }, 
			
			
	/*now submit*/
	{
		xtype: 'button',
        text: 'Submit Data',
        handler: function() {
            var form = this.up('form').getForm();
            if(form.isValid()){
                form.submit({
                    url: 'bodysave.php',
                    waitMsg: 'saving changes...',
                    success: function(fp, o) {
                       // Ext.Msg.alert('Success', '' + o.result.savemsg + '\"');
					   eval(o.result.savemsg);
                    }
                });
            }
        }
    }
	
		]
        }]
   
						
						";
	
						
$tableform=$tfunction.$combodata.$initialform.$formfield;//.$lastpart;
$tableform=$initialform.$formfield.$formbuttonsdocked.'}';

if($type=='primary'){
$tableform=$formfield;
}
$dynamicfile='../template/functions/formcontents.js';
//file_put_contents($dynamicfile,$tableform);


if($availableOptions){
$tview='radiogroup';
$div='detailinfo';
$cols=2;
$optlabel="false";
$optwidth=550;
$target='form';
$showcolumnsdynamic=createFormDisplayColumns($tablename,$tview,$div,$cols,$optlabel,$optwidth,$selected,$target);
if(!$referebysub){
//echo $showcolumnsdynamic;
}else{
echo $showcolumnsdynamic;
//echo $tableform;
}

}else{
//echo $tableform;
}


if($type=='getcombodata'){
$tableform=$combodata;
}
return $tableform;
}
?><?php
function reviseSQLToDynamic($currentTable,$vardynami,$dynamiccolmnval){
						$tArr=explode('_',$vardynami);
						$dyncolmnname=$tArr[1].'_name';
						$dyncolmnid=$tArr[1].'_id';
						
						if(($vardynami!='')&&($dynamiccolmnval!='')){
						$selectdynamic=" select $vardynami.$dyncolmnid, $vardynami.$dyncolmnname , ";
						$innerJoin=" inner join $vardynami b on b.$dyncolmnid = $currentTable.$dynamiccolmnval ";
						//echo $selectdynamic.'llllllllllllllllllllllllllllllllll<br>';
						$reviseString=str_replace('select ',$selectdynamic,$_SESSION[$currentTable."_SearchSQL"]);
						
						}else{
						$selectdynamic='';
						$innerJoin='';
						$reviseString=$_SESSION[$currentTable."_SearchSQL"];
						}
						
						return $reviseString.$innerJoin;
						
						}
?><?php
function reviseTenantLandlordSQL($ptable,$part){
						if(($part=='admin_person')&&($ptable=='housing_housingtenant')){
						$reviseString="select admin_person.person_id, admin_person.person_name , 
housing_housingtenant.housingtenant_id , housing_housingtenant.housingtenant_name , 
admin_person.person_id ,CONCAT(admin_person.last_name,' ',admin_person.first_name,' ',admin_person.middle_name ) syowner , admin_person.person_name , 
housing_housinglandlord.housinglandlord_id , housing_housinglandlord.housinglandlord_name , housing_housingtenant.contract_day , admin_month.month_id , admin_month.month_name , 
housing_housingtenant.contract_year , housing_housingtenant.property_description , housing_housingtenant.rent , housing_housingtenant.electricity_water ,
 housing_rentperiod.rentperiod_id , housing_rentperiod.rentperiod_name , housing_housingtenant.deposit_description , housing_housingtenant.tenancy_period ,
 housing_housingtenant.period_starts , housing_housingtenant.period_startdate , housing_housingtenant.period_months , housing_housingtenant.contract_dated , 
housing_housingtenant.created_by , housing_housingtenant.date_created , housing_housingtenant.changed_by , housing_housingtenant.date_changed , 
housing_housingtenant.voided , housing_housingtenant.voided_by , housing_housingtenant.date_voided , housing_housingtenant.uuid  from housing_housingtenant 
 inner join admin_person b on b.person_id = housing_housingtenant.syownerid
  inner join housing_housinglandlord on housing_housinglandlord.housinglandlord_id = housing_housingtenant.housinglandlord_id  inner join 
admin_month on admin_month.month_id = housing_housingtenant.month_id  inner join housing_rentperiod on housing_rentperiod.rentperiod_id = housing_housingtenant.rentperiod_id
 inner join admin_person on admin_person.person_id = housing_housingtenant.syownerid  order by housing_housingtenant.housingtenant_id desc  Limit 15 

 	
 ";
						}
						
						if(($part=='admin_person')&&($ptable=='housing_housinglandlord')){
						$reviseString="select admin_person.person_id, 
admin_person.person_name , housing_housinglandlord.housinglandlord_id , 
housing_housinglandlord.housinglandlord_name ,CONCAT(admin_person.last_name,' ',admin_person.first_name,' ',admin_person.middle_name ) syowner ,
 housing_housinglandlord.syownerid , housing_housinglandlord.contract_day , admin_month.month_id , 
admin_month.month_name , housing_housinglandlord.contract_year , housing_housinglandlord.term_period , 
housing_housinglandlord.term_months , housing_housinglandlord.commission ,
 housing_housinglandlord.commission_alternative , housing_housinglandlord.excess_amount , 
housing_housinglandlord.payment_day , housing_housinglandlord.property , housing_housinglandlord.contract_dated , 
housing_rentperiod.rentperiod_id , housing_rentperiod.rentperiod_name , housing_housinglandlord.created_by ,
 housing_housinglandlord.date_created , housing_housinglandlord.changed_by , housing_housinglandlord.date_changed ,
 housing_housinglandlord.voided , housing_housinglandlord.voided_by , housing_housinglandlord.date_voided , housing_housinglandlord.uuid 
 from housing_housinglandlord  inner join admin_month on admin_month.month_id = housing_housinglandlord.month_id 
inner join admin_person on admin_person.person_id = housing_housinglandlord.syownerid
 inner join housing_rentperiod on housing_rentperiod.rentperiod_id = housing_housinglandlord.rentperiod_id

 inner join admin_person b on b.person_id = housing_housinglandlord.syownerid  order by housing_housinglandlord.housinglandlord_id desc  Limit 15 ";
						}
						return $reviseString;
						
						}
?><?php
function createFormDisplayColumns($tablename,$tview,$div,$cols,$optlabel,$optwidth,$selected,$target){
$availableOptions=createFlexColumnOptions($tablename,$selected,$target);
$title=$_SESSION['stm'.$tablename].' '.$target;
$frameresult='';
if($target=='form'){
$frameresult='frame: true,';
}
$toolbars="[{
                    text:'Add new',
                    tooltip:'Add a new row',
                    iconCls:'add'
                }, '-', {
                    text:'Options',
                    tooltip:'Configure options',
                    iconCls:'option'
                },'-',{
                    text:'Search',
                    tooltip:'Delete selected item',
                    iconCls:'search'
                },'-',{
                    text:'View',
                    tooltip:'View table Grid',
                    iconCls:'grid',
					handler:function(buttonObj, eventObj) { 
									createFormGrid('Save','NOID','$tablename','g')
									}
                }]";
$columms="
function createDynamicColumns(){
Ext.onReady(function() {
var obj=document.getElementById('detailinfo');
obj.innerHTML='';

Ext.create('Ext.form.Panel', {
 title: '$title',
 closable:true,
 //tbar:$toolbars_offs,
 margin: '10 5 5 5',
        columnWidth: 0.6,
		$frameresult
 width: $optwidth,
 bodyPadding: 10,

 shadow :true,
 bodyBorder: true,
 renderTo:'$div',
 items:[
 {
 xtype: '$tview',
 collapsible:true,
 bodyBorder: true,
 fieldLabel: 'mo',
 columns: $cols,
 vertical: true,
 items: [$availableOptions
 ]}] });
 });
}
createDynamicColumns();
";

return $columms;
}

/*
var obj=document.getElementById('detailinfo');
obj.innerHTML='';
Ext.create('Ext.panel.Panel', {
    title: 'Column Layout - Percentage Only',
    width: 650,
    height: 250,
    layout:'column',
    items: [{
        title: 'Options',
        columnWidth: .4,
		margin: '10 5 5 5',
		bodyPadding: 10,
		bodyBorder: true,
		items:[$availableOptions]
    },{
        title:'Entries',
		margin: '10 5 5 5',
        columnWidth: 0.6,
		frame: true,
		html: '<div id=\"dataentry\">My data response</div>',
		bodyPadding: 10,
		bodyBorder: true,
		items:[{ xtype:'radiobuttongroup',
		 title:'Options',
		 items:[{ boxLabel: ' admin person', name: 'rb', inputValue: 'admin_person', 
		handler:function(){ alert(' admin person' ); 
		} }]
		
		}]
		
    }],
    renderTo: 'detailinfo'
});".
$tablename."Form('dataentry','Save','NOID');"."*/
?><?php 
function createFlexColumnOptions($tablename,$selected,$target){

   $title=$_SESSION[$tablename];


 $order=" order by designer_flexcolumn.orderby	" ;		
 $where= " where  designer_flexcolumn.primary_tablelist='$tablename' ";
     $sqltbcols=$_SESSION["designer_flexcolumn_SearchSQL"].$where.$order; 
	 
	 $results_tbc=mysql_query($sqltbcols)or die($sqltbcols);
	 $cnt_cols=mysql_num_rows($results_tbc); 
 
 if( $cnt_cols>0){
 $it=0;
 $options='';
 
			while($count_cls=mysql_fetch_array($results_tbc)){
					$it++;
						if($cnt_cols==$it){
						$comma='';
						}else{
						$comma=',';
						}
			$options_tablelist=$count_cls['options_tablelist'];
			 $setchecked='';
			if($selected==$options_tablelist){
             $setchecked="checked:true,";
             }
			
			$label=$_SESSION[$options_tablelist];
			if($target=='form'){
			$runfnc="opendChildElem('$tablename','$options_tablelist');";
			}
			if($target=='grid'){
			$runfnc="opendChildElemGrid('$tablename','$options_tablelist');";
			}
			 $options.="{ boxLabel: '$label',
			  iconCls:'user-girl', id:'$options_tablelist', name: 'rb',  $setchecked inputValue: '$options_tablelist',
			handler:function(){
			$runfnc
			}
			 					
		}".$comma;
			
			}
  }
 /*handler:function(){
						 
						 
						 },*/
 return  $options;
 
}
?><?php
function createFlexColumnDefault($tablename){
		$default =" and designer_flexcolumn.default_section='Yes' "	;
		$order=" order by designer_flexcolumn.orderby	" ;		
 $where= " where  designer_flexcolumn.primary_tablelist='$tablename' ";
     $sqltbcols=$_SESSION["designer_flexcolumn_SearchSQL"].$where.$order;
	 
	 
	 $results_tbc=mysql_query($sqltbcols);
	 $cnt_cols=mysql_num_rows($results_tbc); 
 
		 if( $cnt_cols>0){
		 $it=0;
			  $options='';
			  $defaulttble='';
								while($count_cls=mysql_fetch_array($results_tbc)){
										
								$options_tablelist=$count_cls['options_tablelist'];
								$defaulttble=$options_tablelist;
								}
		 }
 return  $defaulttble;
 
}
?><?php
function removeEffectiveDateColumn($database){
	 $sqltbcols=" show tables "; 
	 $results_tbc=mysql_query($sqltbcols);
	 $cnt_cols=mysql_num_rows($results_tbc); 

	while($count_cls=mysql_fetch_array($results_tbc)){
			$table_name=$count_cls[0]; 
					  $SQL="SELECT COLUMN_NAME 
						   FROM information_schema.COLUMNS 
						  WHERE 
						  TABLE_SCHEMA = '$database' 
					  AND TABLE_NAME = '$table_name' 
					  AND COLUMN_NAME like 'effective_d%'";
		
		
		
			 $rlstc=mysql_query($sql) or die($sql);
			 $cnt_colrlstc=mysql_num_rows($rlstc); 
			 
			  $SQL2="SELECT COLUMN_NAME 
						   FROM information_schema.COLUMNS 
						  WHERE 
						  TABLE_SCHEMA = '$database' 
					  AND TABLE_NAME = '$table_name' 
					  AND COLUMN_NAME like 'effectived%'";
		
		
		
			 $rlstc2=mysql_query($SQL2);
			 $cnt_colrlstc2=mysql_num_rows($rlstc2); 
			 
			 
			 if($cnt_colrlstc>0){
						while($count_clsrlstc=mysql_fetch_array($rlstc)){
						$eefield=$count_clsrlstc[0]; 
						  $sqlRemoveColumns="alter table $table_name drop $eefield";
						   $rlstcDropted=mysql_query($sqlRemoveColumns);
						
						}
			}
			
			if($cnt_colrlstc2>0){
						while($count_effective=mysql_fetch_array($rlstc2)){
						  $eefield2=$count_effective[0]; 
						  $sqlRemoveColumns="alter table $table_name drop $eefield2";
						   $rlstcDropted=mysql_query($sqlRemoveColumns);
						
						}
			}
	 }
}
?><?php

function createDefaultTableFields(){
	 $sqltbcols=" show tables "; 
	 $results_tbc=mysql_query($sqltbcols);
	 $cnt_cols=mysql_num_rows($results_tbc); 

	while($count_cls=mysql_fetch_array($results_tbc)){
			$table_name=$count_cls[0]; 
			
			$sqlCheckExists="show columns from $table_name  where ucase(field ) in ('DATE_CREATED','CHANGED_BY','DATE_CHANGED','VOIDED','VOIDED_BY','DATE_VOIDED','UUID')";
			
			$sqlAddColumns="alter table $table_name  
							add column created_by varchar(38),
							add column date_created date,
							add column changed_by varchar(38),
							add column date_changed date,
							add column voided varchar(38), 
							add column voided_by varchar(38),
							add column date_voided date,
							add column uuid varchar(38)";
		
					 $colsExistsResults=mysql_query($sqlCheckExists);
					 $cnt_colsExists=mysql_num_rows($colsExistsResults);
					 if(!$cnt_colsExists){
					 $colsAddCols=mysql_query($sqlAddColumns);
				
					 } 
	 }
			  
}
?><?php
function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}

?><?php
function createPrimaryDataModels(){
$sql="select tablename,fieldname from admin_controller where fieldname rlike '_name' ";


$query_Rcd_getbody= $sql;
//echo $query_Rcd_getbody;
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
$cmdata='';

while ($rows=mysql_fetch_array($Rcd_tbody_results)){
$tablenmeModel='Model'.ucfirst($rows['tablename']);
$fieldname=$rows['fieldname'];
$arr=explode('_',$fieldname);
$id=$arr[0].'_id';
$fieldcaption=$rows['fieldcaption'];

$cmdata.="

Ext.define('cmb".$tablenmeModel."', {
    extend: 'Ext.data.Model',
	fields:['".$id."','".$fieldname."']
	});

var ".$tablenmeModel."data = Ext.create('Ext.data.Store', {
    model: 'cmb".ucfirst($tablenmeModel)."',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=".$rows['tablename']."',
        reader: {
            type: 'json'
        }
    }
});

";
}
$extPrimaryModels='../template/functions/pdm.js';
file_put_contents($extPrimaryModels,$cmdata);
}
		

?><?php
function getDataFieldDataType($type,$fieldname,$fieldcaption,$fieldsize,$displayformat){
if($datatype=='combo'){
$fieldtype='combobox';
}
if($datatype=='sel'){
$fieldtype='itemselector';
}
if($datatype=='mul'){
$fieldtype='multiselect';
}
if($datatype=='tli'){
$fieldtype='comboboxtablelist';
}
if($datatype=='fli'){
$fieldtype='comboboxtablefieldlist';
}

if($datatype=='var'){
$fieldtype='textfield';
}
if($datatype=='tex'){
$fieldtype='textareafield';
}

if($datatype=='dat'){
$fieldtype='datefield';
}

}

?><?php
function getFormFieldType($datatype,$fieldname){

if(($datatype=='int') || ($datatype=='tin')|| ($datatype=='dou')||($datatype=='sma') 
|| ($datatype=='med')|| ($datatype=='big')|| ($datatype=='flo')|| ($datatype=='num')
|| ($datatype=='dec')){

$fieldtype='numberfield';
}

if($datatype=='hidden'){
$fieldtype='hidden';
}

if($datatype=='tex'){
$fieldtype='textareafield';
}
if($datatype=='combo'){
$fieldtype='combobox';
}
if($datatype=='sel'){
$fieldtype='itemselector';
}
if($datatype=='mul'){
$fieldtype='multiselect';
}
if($datatype=='tli'){
$fieldtype='comboboxtablelist';
}
if($datatype=='fli'){
$fieldtype='comboboxtablefieldlist';
}

if($datatype=='var'){
$fieldtype='textfield';
}
if($datatype=='tex'){
$fieldtype='textareafield';
}

if($datatype=='dat'){
$fieldtype='datefield';
}

//echo $datatype.'  >>>'.$fieldname.'='.$fieldtype.'<<<=<br>';
return $fieldtype;
}

function createFormFieldRemoteData($fieldtype,$fieldname,$tablename){
if($fieldtype=='combobox'){
$comboFields=explode('_',$_SESSION[$fieldname]);
$cmdata="

Ext.define('cmb".ucfirst($_SESSION[$fieldname])."', {
    extend: 'Ext.data.Model',
	fields:['".$comboFields[1]."_id','".$comboFields[1]."_name']
	});

var ".$_SESSION[$fieldname]."data = Ext.create('Ext.data.Store', {
    model: 'cmb".ucfirst($_SESSION[$fieldname])."',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=".$_SESSION[$fieldname]."',
        reader: {
            type: 'json'
        }
    }
});

".$_SESSION[$fieldname]."data.load();
";



}
/*//////////////if it is a tablelist */
if($fieldtype=='comboboxtablelist'){
$cmdata="
Ext.define('cmb".ucfirst($fieldname)."', {
    extend: 'Ext.data.Model',
	fields:['table_name','table_name']
	});

var ".$fieldname."data = Ext.create('Ext.data.Store', {
    model: 'cmb".ucfirst($fieldname)."',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?mytables=admin_table&vt=$tablename',
        reader: {
            type: 'json'
        }
    }
});

".$fieldname."data.load();
";



}

if($fieldtype=='comboboxtablefieldlist'){
$cmdata="

Ext.define('cmb".ucfirst($fieldname)."', {
    extend: 'Ext.data.Model',
	fields:['fieldname','fieldcaption']
	});

var ".$fieldname."data = Ext.create('Ext.data.Store', {
    model: 'cmb".ucfirst($fieldname)."',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?myfields=admin_controller&vt=".$tablename."', 
        reader: {
            type: 'json'
        }
    }
});

".$fieldname."data.load();
";



}

if($fieldtype=='itemselector'){
$cmdata="

Ext.define('cmb".ucfirst($fieldname)."', {
    extend: 'Ext.data.Model',
	fields:['fieldname','fieldcaption']
	});

var ".$fieldname."data = Ext.create('Ext.data.Store', {
    model: 'cmb".ucfirst($fieldname)."',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=".$tablename."&find=thistable',
        reader: {
            type: 'json'
        }
    }
});

".$fieldname."data.load();
";



}
//echo $cmdata;

return $cmdata;
}

?><?php
function createActualFormFields($fieldtype,$fieldname,$fieldcaption){
if($fieldtype=='combobox'){
$comboFields=explode('_',$_SESSION[$fieldname]);
$formfield="
   {
    xtype: 'combobox',
	name:'$fieldname',
	forceSelection:true,
    fieldLabel: '$fieldcaption',
    store: ".$_SESSION[$fieldname]."data,
    queryMode: 'local',
    displayField: '$comboFields[1]_name',
    valueField: '$comboFields[1]_id'
	}";
}elseif($fieldtype=='comboboxtablefieldlist'){
$formfield="
   {
    xtype: 'combobox',
	name:'$fieldname',
	forceSelection:true,
    fieldLabel: '$fieldcaption',
    store: ".$fieldname."data,
    queryMode: 'local',
    displayField: 'fieldcaption',
    valueField: 'fieldname'
	}";

}elseif($fieldtype=='itemselector'){
$formfield="
   {
    xtype: 'itemselector',
	name:'$fieldname',
	forceSelection:true,
    fieldLabel: '$fieldcaption',
    store: ".$fieldname."data,
    queryMode: 'local',
    displayField: 'sectionCaption',
    valueField: 'sectionValue',
	allowBlank: false,
    msgTarget: 'side'
	}";

}
elseif($fieldtype=='comboboxtablelist'){

$formfield="
   {
    xtype: 'combobox',
	name:'$fieldname',
	forceSelection:true,
    fieldLabel: '$fieldcaption',
    store: ".$fieldname."data,
    queryMode: 'local',
    displayField: 'table_caption',
    valueField: 'table_name'
	}";
}
else{
$formfield="{
            xtype: '$fieldtype',
            name: '$fieldname',
            fieldLabel: '$fieldcaption',
            allowBlank: false,
            minLength: 1
        
		}";
}
return $formfield;
} 
?><?php
function upload($file_id, $folder="", $types="",$photoid) {
    if(!$_FILES[$file_id]['name']) return array('','No file specified');

    $file_title = $_FILES[$file_id]['name'];
    //Get file extension
    $ext_arr = split("\.",basename($file_title));
    $ext = strtolower($ext_arr[count($ext_arr)-1]); //Get the last extension

    //Not really uniqe - but for all practical reasons, it is
    $uniqer = substr(md5(uniqid(rand(),1)),0,5);
    $file_name = $photoid . '_' . $file_title;//Get Unique Name
    updateAdminPhoto($file_name);
    $all_types = explode(",",strtolower($types));
    if($types) {
        if(in_array($ext,$all_types));
        else {
            $result = "'".$_FILES[$file_id]['name']."' is not a valid file."; //Show error if any.
            return array('',$result);
        }
    }

    //Where the file must be uploaded to
    if($folder) $folder .= '/';//Add a '/' at the end of the folder
    $uploadfile = $folder . $file_name;

    $result = '';
    //Move the file from the stored location to the new location
    if (!move_uploaded_file($_FILES[$file_id]['tmp_name'], $uploadfile)) {
        $result = "Cannot upload the file '".$_FILES[$file_id]['name']."'"; //Show error if any.
        if(!file_exists($folder)) {
            $result .= " : Folder don't exist.";
        } elseif(!is_writable($folder)) {
            $result .= " : Folder not writable.";
        } elseif(!is_writable($uploadfile)) {
            $result .= " : File not writable.";
        }
        $file_name = '';
        
    } else {
        if(!$_FILES[$file_id]['size']) { //Check if the file is made
            @unlink($uploadfile);//Delete the Empty file
            $file_name = '';
            $result = "Empty file found - please use a valid file."; //Show the error message
        } else {
            chmod($uploadfile,0777);//Make it universally writable.
        }
    }

    return array($file_name,$result);
}
?><?php
function validateTableInfo($postcolns,$insertStr,$tablename){
echo $postcolns.'<br>';
echo $insertStr;
//$tablename

}
?><?php

function creatDataArray($activetableBody){
$headerfields=getHeaderCaptionSizeDetails($activetableBody);
//$headerfields=getHeaderDetails($activetableBody);
$fieldresunt='';
foreach ($headerfields as $field){

$fieldresunt.= $field.'^';
}
//$fieldresunt=sizeof($headerfields).'|###|'.$fieldresunt;
return $fieldresunt;
}
?><?PHP
function getHeaderCaptionSizeDetails($activetablelinked){
$sqlcontrols="select distinct fieldname , fieldcaption, gridwidth from admin_controller where tablename='$activetablelinked' and detailsvisiblepdf='Show' order by position";   
			
			
			//echo $sqlcontrols;
			$results_ctrls=mysql_query($sqlcontrols);
	        $cnt_cols=mysql_num_rows($results_ctrls);
			$countcurrentfield=0; 
			$displayvalues='';
			if($cnt_cols>0){
			$countlns=0;
			while($table_formcontrols=mysql_fetch_array($results_ctrls)){
			  $table_field=$table_formcontrols['fieldname'];
			  
			  $tarr=explode('_',$activetablelinked);
			  $varCol=explode('_', $table_field);
			  
			  
			  $tfield=$tarr[1].'_id';
			  
			  if( ($varCol[1]=='id')&&($table_field!=$tfield)){
			  $table_field=$varCol[0].'_name';
			  }
			  
			  $table_col_caption=$table_formcontrols['fieldcaption'];
			  $table_col_colnwidth=$table_formcontrols['gridwidth'];
			  $headerfields[$countcurrentfield]=$table_col_caption.'|'.$table_col_colnwidth.'|'.$table_field;
			  $countcurrentfield++;
			  }
			   
			 
			  
			  }//end of while
			  
	return $headerfields;
	
	}		  
	?><?php
function getAllDBTables(){
$Rcd_tall_results=mysql_query($query_RcdAll_getbody);
$count_tballfound=mysql_num_rows($Rcd_tall_results);
$tablesArray;
$ctn=0;
while($count_tballrows=mysql_fetch_array($Rcd_tall_results)){
$tablesArray[$ctn]=$count_tballrows[0];
$ctn++;
}

return $tablesArray;
}
?><?php
function buildDBFromList($currenttbl,$fildcontrol,$fillnum,$changecontrolcaption,$value){
if($fillnum=='nsf'){
$otherfil= "fillActivitySuccessActionControl('$currenttbl',this.value,'$changecontrolcaption'); ";

}
 $atarray=explode('_',$currenttbl);
 $group_id=$atarray[1].'_id';
 $group_name=$atarray[1].'_name';
 $addwherecluz='';
 if($currenttbl=='admin_alert'){
 $addwherecluz=" where alert_id!='$value' ";
 }
$Sql="SELECT $group_id, $group_name FROM $currenttbl   $addwherecluz  order by $group_name ";

//echo $Sql;
 $row = mysql_query($Sql) or die("Could Not Perform The Query");
print $_SESSION[$group_tbl]."<select class=\"listView\" name=\"$group_name\" id=\"dropdn$currenttbl$fildcontrol\" onchange=\"$otherfil\">";
print"<option>Select Group</option>";
 while($count=mysql_fetch_array($row)){$i++; $group_id_display=$count['0']; 
 $group_name_display=ucwords($count['1']); print"<option value=$group_id_display>$group_name_display</option>";                                                        
}
print"</select>";  }?><?php
function getDuplicates($tablename,$searchStr,$fields,$message,$checktype){

/*$fieldListARR='';
$ANDclasuse='';
$selectstmtstri='';
$fieldListARR=explode('|',$fields);
$fieldItemcont=1;
$fieldItem='';

foreach($fieldListARR as $fieldItem){
	if(($fieldItemcont==sizeof($fieldListARR))){
	$ANDclasuse='';
	}else{
	  if($fieldItemcont>1){
		$ANDclasuse=' AND ';
		}
	}
$selectstmt=$ANDclasuse.$fieldItem."='".strtoupper(trim($_GET[$fieldItem]))."'";
$selectstmtstri.=$selectstmt;
$fieldItemcont++;
}*/
$fieldListARR=explode('_',$tablename);
$actualstmt="Select ucase($fieldListARR[1]_name) from $tablename where $fieldListARR[1]_name='".strtoupper($searchStr)."'";

$resultsDups=mysql_query($actualstmt) or die($actualstmt);
$cntdups=mysql_num_rows($resultsDups);
			if($cntdups){
				if($checktype=='Custom'){
							echo $message;
				  }
			}
			
	return $cntdups;
}
?><?php
function getCurrentDisplayGroup($tablename){
$sql_getdgroupTableSQL="select displaygroup  from admin_controller where tablename='$tablename' limit 1"; 
$resultsGroupTble=mysql_query( $sql_getdgroupTableSQL);
$cntregDefaultTbl=mysql_num_rows($resultsGroupTble);
			if($cntregDefaultTbl){
			$countgrouptbl=mysql_fetch_array($resultsGroupTble);
			$displaygroup=$countgrouptbl[0];
}
return $displaygroup;
}						
function getEmployeeLoaninfo($employeedid)
{
$searchBenefits="select loans_emploan.emploan_id , pim_employee.person_id , pim_employee.employee_name , loans_loan.loan_id , loans_loan.loan_name ,loans_loan.interest_rate , loans_emploan.loan_amount , loans_emploan.repayment_period , loans_emploan.start_date , loans_emploan.end_date , loans_emploan.comment , loans_emploan.effective_dt  from loans_emploan  inner join pim_employee on pim_employee.person_id = loans_emploan.person_id  inner join loans_loan on loans_loan.loan_id = loans_emploan.loan_id
	

Where pim_employee.person_id=$employeedid";

$results_stmt=mysql_query($searchBenefits) or die($searchBenefits);                                          
$cntreg_stmnt=mysql_num_rows($results_stmt); 

if($cntreg_stmnt){
       $count=0;
	   $employyeeArray='';
		while($foundrecordsarr=mysql_fetch_array($results_stmt)){ 
		$loan_name=$foundrecordsarr['loan_name'];
		$loan_id=$foundrecordsarr['loan_id'];
		$start_date=$foundrecordsarr['start_date'];
		$repayment_period=$foundrecordsarr['repayment_period'];
		$loan_amount=$foundrecordsarr['loan_amount'];
			$interest_rate=$foundrecordsarr['interest_rate'];
		
		$employloanArray[$count]=$loan_name.'||'.$start_date.'||'.$loan_amount.'||'.$repayment_period.'||'.$interest_rate.'||'.$loan_id;
		$count++;
		}
}
return $employloanArray;					
}?>
<?php						
function insertRepaymentDetails($employeedid,$loanId,$datetaken,$installmtn,$loanamount)
{
$effective_date=date('Y-m-d');
$getloatoalt="select sum(amount_paid) as totalpaid from loans_repmnt where person_id=$employeedid AND loan_id=$loanId";
$results_stmt=mysql_query($getloatoalt);                                          
$cntreg_stmnt=mysql_num_rows($results_stmt); 

$totalpaid='';
if($cntreg_stmnt){
       $count=0;
	   $employyeeArray='';
		while($foundrecordsarr=mysql_fetch_array($results_stmt)){ 
		$totalpaid=$foundrecordsarr['totalpaid'];
		}
}
$balance=$loanamount-$totalpaid;
$insertLoannRepa="Insert Into loans_repmnt(
person_id,
loan_id,
amount_paid,
loan_balance,
effective_date
) values(
'$employeedid',
'$loanId',
'$installmtn',
'$balance',
'$effective_date'
)";
$results_stmt=mysql_query($insertLoannRepa);                                          

					
}?><?php						
function getCompanyInfo()
{
$searchBenefits="select * from admin_company limit 1";

$results_stmt=mysql_query($searchBenefits) or die($searchBenefits);                                          
$cntreg_stmnt=mysql_num_rows($results_stmt); 
if($cntreg_stmnt){
       $count=0;
	   $employyeeArray='';
		while($foundrecordsarr=mysql_fetch_array($results_stmt)){ 
		$company_name=$foundrecordsarr['company_name'];
		$pin_num=$foundrecordsarr['pin_num'];
		$vat_num=$foundrecordsarr['vat_num'];
		$incorp_dt=$foundrecordsarr['incorp_dt'];
		$postal_address=$foundrecordsarr['postal_address'];
		$postal_code=$foundrecordsarr['postal_code'];
		$town=$foundrecordsarr['town'];
		$telephone=$foundrecordsarr['tel'];
		$fax=$foundrecordsarr['fax'];
		$mobile=$foundrecordsarr['mobile'];
		$email_address=$foundrecordsarr['email_address'];
		$website=$foundrecordsarr['website'];
		$effective_dt=$foundrecordsarr['effective_dt'];
		$institution_reg=$foundrecordsarr['institution_reg'];
		
		$building=$foundrecordsarr['building'];
		$location_description=$foundrecordsarr['location_description'];
        $street=$foundrecordsarr['street'];
		$email_address2=$foundrecordsarr['email_address2'];
		

		
		$companyArray[$count]=$company_name.'||'.$pin_num.'||'.$vat_num.'||'.$incorp_dt.'||'.$postal_address.
		'||'.$postal_code.'||'.$town.'||'.$telephone.'||'.$fax.'||'.$mobile.'||'.$email_address.'||'.$website.'||'.$institution_reg.'||'.$building.'||'.$location_description.'||'.$street.'||'.$email_address2;
		
		
		$count++;
		}
}
return $companyArray;					
}?>
<?php 
//function val($pvalue,$scale){
function PayeCal($pvalue){
$qry="SELECT *  FROM settings_taxsetup order by taxsetup_id asc";

$results=mysql_query($qry) or die('Could not execute the query');
$llimit=array();
$ulimit=array();
$rate=array();

while($rws=mysql_fetch_array($results)){

$llimit[]=$rws['lower_limit'];
$ulimit[]=$rws['upper_limit'];
$rate[]=$rws['rate'];
}
$rowsize=sizeof($llimit);
//echo $rowsize;
$totalvalcost=0;
$pvalue=$pvalue;
for($i=0;$i<$rowsize;$i++){
$lower=$llimit[$i];
$upper=$ulimit[$i];
$r=$rate[$i];
#####
if($i==($rowsize-1)){
$levelcharge=($r*$pvalue)/100;
//$levelcharge=number_format($levelcharge,0);	
		$totalvalcost=$totalvalcost + $levelcharge;
		//echo"Level Last $i:".$levelcharge." pval=$pvalue <br>"; 
}
else{

		if($i==0){
		
		if($pvalue<=$upper){
      $levelcharge=($r*$pvalue)/100; 
      //$levelcharge=number_format($levelcharge,0);
		  $totalvalcost=$totalvalcost + $levelcharge;
		
  		//echo"Level First once $i:".$levelcharge."<br>"; 
  		break;
    }
    else{
      $levelcharge=($r*$upper)/100; 
      //$levelcharge=number_format($levelcharge,0);
		  $totalvalcost=$totalvalcost + $levelcharge;
		  $pvalue=$pvalue-$upper;
		 // echo"Level First more  $i:".$levelcharge."<br>"; 
		//break;
    }
		
		
		}
		else{ 
   
      $range= ($upper-$lower) + 1;
   
    if($pvalue<=$range){
		$levelcharge=($r*$pvalue)/100;
		//$levelcharge=number_format($levelcharge,0);
		$totalvalcost=$totalvalcost + $levelcharge;
		$pvalue=$pvalue-$pvalue;
		//break;
		//"Level Middle last $i:".$levelcharge."  bal:$pvalue <br> ";
		break;
		}
		else{
		$levelcharge=($r*$range)/100;
    //$levelcharge=number_format($levelcharge,0); 
		$totalvalcost=$totalvalcost + $levelcharge;
		
		$pvalue=$pvalue-$range;
	  //echo"Level Middle m $i:".$levelcharge." Range:$range  bal:$pvalue <br>";
		}
	   }
}

#####

}
return $totalvalcost;
}
?><?php						
function getEmployeeInfo($employeedid)
{
$searchBenefits="select pim_employee.person_id , pim_employee.employee_number , pim_employee.employee_name , pim_employee.DOB , pim_employee.national_ID , pim_employee.gender , pim_employee.address , pim_employee.phone_number , pim_employee.town , pim_employee.email_address , pim_employee.postal_code , pim_employee.effective_dt, pim_employee.nssf_number , pim_employee.pin_number , pim_employee.nhif_number  from pim_employee

Where pim_employee.person_id=$employeedid";
$results_stmt=mysql_query($searchBenefits) or die($searchBenefits);                                          
$cntreg_stmnt=mysql_num_rows($results_stmt); 

if($cntreg_stmnt){
       $count=0;
	   $employyeeArray='';
		while($foundrecordsarr=mysql_fetch_array($results_stmt)){ 
		$employee_number=$foundrecordsarr['employee_number'];
		$employee_name=$foundrecordsarr['employee_name'];
		$national_ID=$foundrecordsarr['national_ID'];
		$nssf_number=$foundrecordsarr['nssf_number'];
		$pin_number=$foundrecordsarr['pin_number'];
		$nhif_number=$foundrecordsarr['nhif_number'];
		  
		
$employyeeArray[$count]=$employee_name.'||'.$employee_number.'||'.$national_ID.'||'.$nssf_number.'||'.$pin_number.'||'.$nhif_number;
		$count++;
		}
}
return $employyeeArray;					
}?><?php						
function getEmployeeBankinfo($employeedid)
{
$searchBenefits="select pim_employee.person_id , pim_employee.employee_number , pim_employee.employee_name , pim_employee.DOB , pim_employee.national_ID , pim_employee.gender , pim_employee.address , pim_employee.phone_number , pim_employee.town , pim_employee.email_address , pim_employee.postal_code , pim_employee.effective_dt  from pim_employee

Where pim_employee.person_id=$employeedid";

$results_stmt=mysql_query($searchBenefits) or die($searchBenefits);                                          
$cntreg_stmnt=mysql_num_rows($results_stmt); 

if($cntreg_stmnt){
       $count=0;
	   $employyeeArray='';
		while($foundrecordsarr=mysql_fetch_array($results_stmt)){ 
		$employee_number=$foundrecordsarr['employee_number'];
		$employee_name=$foundrecordsarr['employee_name'];
		$national_ID=$foundrecordsarr['national_ID'];
		
		$employyeeArray[$count]=$employee_name.'||'.$employee_number.'||'.$national_ID;
		$count++;
		}
}
return $employeeBankArray;					
}?>
<?php
function getPaygradeLevel($employeedid)
{
$searchBenefits="select pim_paygrades.paygrades_id , pim_employee.person_id , pim_employee.employee_name , admin_paygradedecr.paygradedecr_id , admin_paygradedecr.paygradedecr_name , admin_plevel.plevel_id , admin_plevel.plevel_name , pim_paygrades.annual_increment , pim_paygrades.salary_basic , pim_paygrades.comments , pim_paygrades.effective_dt  from pim_paygrades  inner join pim_employee on pim_employee.person_id = pim_paygrades.person_id  inner join admin_paygradedecr on admin_paygradedecr.paygradedecr_id = pim_paygrades.paygradedecr_id  inner join admin_plevel on admin_plevel.plevel_id = pim_paygrades.plevel_id

Where pim_employee.person_id=$employeedid";

//echo $searchBenefits;
$results_stmt=mysql_query($searchBenefits) or die($searchBenefits);                                          
$cntreg_stmnt=mysql_num_rows($results_stmt); 

if($cntreg_stmnt){
       $count=0;
	   $infoArray='';
		while($foundrecordsarr=mysql_fetch_array($results_stmt)){ 
		$paygradedecr_name=$foundrecordsarr['paygradedecr_name'];
		//$company_name=$foundrecordsarr['company_name'];
		$plevel_name=$foundrecordsarr['plevel_name'];
		$salary_basic=$foundrecordsarr['salary_basic'];
		
		$infoArray[$count]=$paygradedecr_name.'||'.$plevel_name.'||'.$salary_basic;
		$count++;
		}
}

return $infoArray;					
}?>
<?php
function getDepartment($employeedid)
{
$searchBenefits="select pim_empdept.empdept_id , pim_employee.person_id , pim_employee.employee_name , admin_dept.dept_id , admin_dept.dept_name , pim_empdept.date_joined , pim_empdept.effective_date  from pim_empdept  inner join pim_employee on pim_employee.person_id = pim_empdept.person_id  inner join admin_dept on admin_dept.dept_id = pim_empdept.dept_id
Where pim_employee.person_id=$employeedid";


$results_stmt=mysql_query($searchBenefits) or die($searchBenefits);                                          
$cntreg_stmnt=mysql_num_rows($results_stmt); 

if($cntreg_stmnt){
       $count=0;
	   $infoArray='';
		while($foundrecordsarr=mysql_fetch_array($results_stmt)){ 
		$dept_name=$foundrecordsarr['dept_name'];
		//$company_name=$foundrecordsarr['company_name'];
		$date_joined=$foundrecordsarr['date_joined'];
		
		$infoArray[$count]=$dept_name.'||'.$date_joined;
		$count++;
		}
}

return $infoArray;					
}?>
<?php
function getDeductions($employeedid)
{
$searchBenefits="select 
hiring_employeededuction.employeededuction_id , pim_employee.person_id , pim_employee.employee_name , pim_deduction.deduction_id , pim_deduction.deduction_name , hiring_employeededuction.deduction_value , hiring_employeededuction.status , hiring_employeededuction.effective_date  from hiring_employeededuction  inner join pim_employee on pim_employee.person_id = hiring_employeededuction.person_id  inner join pim_deduction on pim_deduction.deduction_id = hiring_employeededuction.deduction_id

Where pim_employee.person_id=$employeedid";

$results_stmt=mysql_query($searchBenefits) or die($searchBenefits);                                          
$cntreg_stmnt=mysql_num_rows($results_stmt); 

if($cntreg_stmnt){
       $count=0;
	   $deductionArray='';
		while($foundrecordsarr=mysql_fetch_array($results_stmt)){ 
		$deduction_name=$foundrecordsarr['deduction_name'];
		$deduction_value=$foundrecordsarr['deduction_value'];
		$deductionArray[$count]=$deduction_value.'||'.$deduction_name;
		$count++;
		}
}
return $deductionArray;					
}?><?php
function getAllowance($employeedid) 
{
$searchBenefits="select hiring_employeebenefit.employeebenefit_id , pim_employee.person_id , pim_employee.employee_name , hiring_benefit.benefit_id , hiring_benefit.benefit_name , hiring_employeebenefit.benefit_value , hiring_employeebenefit.status , hiring_employeebenefit.effective_date  from hiring_employeebenefit  inner join pim_employee on pim_employee.person_id = hiring_employeebenefit.person_id  inner join hiring_benefit on hiring_benefit.benefit_id = hiring_employeebenefit.benefit_id
Where pim_employee.person_id=$employeedid";

$results_stmt=mysql_query($searchBenefits) or die($searchBenefits);                                          
$cntreg_stmnt=mysql_num_rows($results_stmt); 

if($cntreg_stmnt){
       $count=0;
	   $benefitsArray='';
	   $totalallowance='';
		while($foundrecordsarr=mysql_fetch_array($results_stmt)){ 
		$benefit_name=$foundrecordsarr['benefit_name'];
		$benefit_value=$foundrecordsarr['benefit_value'];
		
		$benefitsArray[$count]=$benefit_value.'||'.$benefit_name;
		$count++;
		}
}
return $benefitsArray;					
}?><?PHP 
function display_statement_options($table_name){													
 $sql_available_stmt_rcds="select * from admin_statement 
 where tablename='$table_name' order by tablename,pdfvisible,position 
 "; 
                                             
$results_stmt=mysql_query( $sql_available_stmt_rcds);                                          
$cntreg_stmnt=mysql_num_rows($results_stmt);  
$cntreg_stmnt_count=$cntreg_stmnt;
if ($cntreg_stmnt>0){ 
$num_found_stmnts=$cntreg_stmnt;
echo("<form name =\"frm$table_name\" action=\"\" method=\"post\"><tr><td class='Stable_td' colspan=\"4\">");
echo("</p></td></tr>");
print( "<input type=\"submit\" class=\"savebutton\"    size=\"20\" name=\"ctrupdate$table_name\" value=\"Print\"> ");
$hiddenText.="<input type=\"hidden\"   name=\"num_found_controls_stmnt\" value=\"$num_found_stmnts\">";                      
echo("<table width='98%' class='Stable_table'> ");  		               
$rec_count_stmnt=0;
$stmnt_count=0;          
while($foundrecordsarr=mysql_fetch_array($results_stmt)){ 
$stmnt_count++;                                  
$controller_id=$foundrecordsarr[statement_id];
$tablename_stmnt=$foundrecordsarr['tablename']; 
$statement_caption=$foundrecordsarr[statement_caption];
$statement_link=$foundrecordsarr[statement_link];
$show_identifier=$foundrecordsarr[show_identifier];
$first_only=$foundrecordsarr[first_only];
$pdfvisible_stmnt=$foundrecordsarr[pdfvisible];
$position_stmnt=$foundrecordsarr[position];
$ctr_currentPos=$stmnt_count;
echo("<h3>$_SESSION[$statement_link]</h3></td></tr>");
$hiddenText.= "<input type=\"hidden\"   name=\"num_found_controls\" value=\"$num_found_stmnts\"> ";
                        
echo("<table width='98%' class='Stable_table'> ");  
echo("<tr class='Stable_th'>");
print "<td colspan=\"5\"><hr></td >";
echo("</tr>");
display_found_stmnt_records($statement_link,$ctr_currentPos);
print "<td colspan=\"5\"><p class=\"date\" ></p><br></td >";
print" </td></tr>";
echo("</table>");

}//end of while for stmnt tbl
print "<td colspan=\"5\">&nbsp;</td >";
echo("</tr>");
echo("<tr> <td><input type=\"submit\" class=\"savebutton\"    size=\"20\" name=\"ctrupdate$table_name\" value=\"Save wwwwwww\"><p>");
print"</td><tr><td>";
print" </td></tr>";
print" <tr><td><td>";
echo("</table>");
echo("</form>");		
} //end if
print"<div id=\"myhidiv\">$hiddenText</div>";
}//end function
?>
<?php
function display_found_stmnt_records($table_name,$ctr_currentPos){													
 $sql_available_rcds="select * from admin_controller 
 where tablename='$table_name' order by tablename,detailsvisiblepdf,position 
  
   
  "; 
                                             
	$results=mysql_query( $sql_available_rcds);                                          
	$cntreg=mysql_num_rows($results);  
	$cntreg_count=$cntreg;
			if ($cntreg_count>0){
	
	 }		
if ($cntreg>0){ 
$num_found_contacts=$cntreg;
echo("</p></td></tr>");
print("<input type=\"hidden\"   name=\"num_found_controls$ctr_currentPos\" value=\"$num_found_contacts\"> ");
echo("<table width='98%' class='Stable_table' border='0'> "); 
echo("<tr class='Stable_th'>"); 		     
print "<th align=left>Field Caption </td >";     
print "<th align=left>Show</td >";     
print "<th align=left>Position</td >";
print "<th align=left>Width</td >";
echo("</tr>"); 
echo("<tr class='Stable_th'>");
print "<td colspan=\"5\"><hr></td >";
echo("</tr>");
          
			$rec_count=0;
			$emp_count=0;          
			while($count_ctrls=mysql_fetch_array($results)){ 
			$emp_count++;                                  
			 $controller_id=$count_ctrls['controller_id'];
	          $tablename=$count_ctrls['tablename']; 
			  $table_caption=$count_ctrls['tablecaption'];
			  $table_field=$count_ctrls['fieldname'];
			  $table_col_caption=$count_ctrls['fieldcaption'];
			  $table_col_viewdetails=$count_ctrls['detailsvisiblepdf'];
              $table_col_viewonpdf=$count_ctrls['pdfvisible'];
			  $table_col_positionb=$count_ctrls['position'];
	          $table_col_colnwidth=$count_ctrls['colnwidth'];
	//ended		            	
if(isset($emp_count)){

$even_row=$emp_count%2;
}

if($table_col_viewonpdf=='Show'){
$pdfdiso='checked';
$pdfdisVal="Show";
}
if($table_col_viewdetails=='Show'){
$listdiso='checked';
$listdisVal="Show";
}

if($even_row<=0){

print ("<tr class='Stable_even_row'>");
}
if($even_row>0){
	print "<tr class='Stable_non_even_row'>";
	}
	//$listdiso $pdfdiso
echo"
</td><td class='Stable_td'>			  
<input type=\"hidden\"    size=\"30\" name=\"ctrlerfound$ctr_currentPos$rec_count\" value=\"$controller_id\">		  
<input type=\"text\"    size=\"20\" name=\"fieldcaption$ctr_currentPos$rec_count\" value=\"$table_col_caption\">
</td>
<td class='Stable_td'> 
<input type=\"checkbox\"  $pdfdiso  size=\"20\" name=\"pdf$ctr_currentPos$rec_count\" value=\"Show\">
</td>  
<td class='Stable_td'>
<input type=\"text\"    size=\"3\" name=\"position$ctr_currentPos$rec_count\" value=\"$table_col_positionb\"> 
</td>
<td class='Stable_td'>
<input type=\"text\"    size=\"4\" name=\"colnwidth$ctr_currentPos$rec_count\" value=\"$table_col_colnwidth\"> 
</td>";
print"</tr>";
$rec_count++; 
$listdiso='';
$pdfdiso='';

}
print "<td colspan=\"4\">&nbsp;</td >";
echo("</tr>");
echo("</table>");



}

		
}

?>
<?PHP 
function display_found_search_records($table_name,$displayDiv,$sortbyINF){
$sql_available_rcds="select * from admin_controller 
 where tablename='$table_name' order by tablename,detailsvisiblepdf,$sortbyINF "; 
$results=mysql_query( $sql_available_rcds);                                          
$cntreg=mysql_num_rows($results);  
$cntreg_count=$cntreg;
			if ($cntreg_count>0){
	
	 }		
if ($cntreg>0){ 
$num_found_contacts=$cntreg;
echo("<form name =\"frm$table_name\" action=\"\" method=\"post\"><tr><td class='Stable_td' colspan=\"4\">");
//echo("<hr>");
echo("<h3>$_SESSION[$table_name]</h3></p></td></tr>");
$hiddenText.="<input type=\"hidden\"   name=\"num_found_controls\" value=\"$num_found_contacts\"> ";
                        
echo("<table border=\"1\"> "); 
echo("<tr class='Stable_th'>");
print "<td colspan=\"7\"> '___________________________________________________________________________________________________________________'
</td >";
echo("<tr class='Stable_th'>"); 		     
print "<th align=left>Field Caption </td >";
print "<th  align=left>List </td >";      
print "<th align=left>PDF</td >";     
print "<th  align=left>Position</td >";
print "<th  align=left>Width</td >";

print "<th  align=left>INF</td >";
print "<th  align=left>INFPos</td >";
print "<th  align=left>INFDT</td >";
echo("</tr>"); 
echo("<tr class='Stable_th'>");
print "<td colspan=\"7\"><hr></td >";
echo("</tr>");
          
			$rec_count=0;
			$emp_count=0;  
			$tablenameFolder=explode('_',$table_name);        
			while($count_ctrls=mysql_fetch_array($results)){ 
			$emp_count++;                                  
			 $controller_id=$count_ctrls['controller_id'];
	          $tablename=$count_ctrls['tablename']; 
			  $table_caption=$count_ctrls['tablecaption'];
			  $table_field=$count_ctrls['fieldname'];
			  $table_col_caption=$count_ctrls['fieldcaption'];
			  $table_col_viewdetails=$count_ctrls['detailsvisiblepdf'];
              $table_col_viewonpdf=$count_ctrls['pdfvisible'];
			  $table_col_positionb=$count_ctrls['position'];
	          $table_col_colnwidth=$count_ctrls['colnwidth'];
			  $table_col_infpos=$count_ctrls['infpos'];
			  $table_col_viewinf=$count_ctrls['infshow'];
			  $isautoincrement=$count_ctrls['isautoincrement'];
	//ended		            	
if(isset($emp_count)){
$even_row=$emp_count%2;
}

if($table_col_viewonpdf=='Show'){
$pdfdiso='checked';
$pdfdisVal="Show";
}
if($table_col_viewdetails=='Show'){
$listdiso='checked';
$listdisVal="Show";
}

if($table_col_viewinf=='Show'){
$infdiso='checked';
}
$textinf='text';
$checkinf='checkbox';
if($isautoincrement){
$infdiso='';
$textinf='hidden';
$checkinf='hidden';
}
if($even_row<=0){

print ("<tr class='Stable_even_row'>");
}
if($even_row>0){
	print "<tr class='Stable_non_even_row'>";
	}
	//$listdiso $pdfdiso
$hiddenText.="<input type=\"hidden\"    size=\"30\" name=\"ctrlerfound$rec_count\" value=\"$controller_id\">";
echo"
</td><td class='Stable_td'>			  
		  
<input type=\"text\"    size=\"20\" name=\"$table_field"."1\" id=\"$table_name$table_field"."1\" value=\"$table_col_caption\">
</td>
<td class='Stable_td'>			  
<input type=\"checkbox\"  $listdiso size=\"20\" name=\"details$rec_count\" id=\"$table_name$table_field"."2\" value=\"Show\">
</td>
<td class='Stable_td'> 
<input type=\"checkbox\"  $pdfdiso  size=\"20\" id=\"$table_name$table_field"."3\" name=\"pdf$rec_count\" value=\"Show\">
</td>  
<td class='Stable_td'>
<input type=\"text\"    size=\"3\" id=\"$table_name$table_field"."4\" name=\"position$rec_count\" value=\"$table_col_positionb\"> 
</td>
<td class='Stable_td'>
<input type=\"text\"    size=\"4\" id=\"$table_name$table_field"."5\" name=\"colnwidth$rec_count\" value=\"$table_col_colnwidth\"></td>";
echo"<td class='Stable_td'>			  
<input type=\"$checkinf\"   $infdiso size=\"3\" id=\"$table_name$table_field"."6\" value=\"Show\">
</td>";
echo"<td class='Stable_td'>			  
<input type=\"$textinf\"   size=\"3\" id=\"$table_name$table_field"."7\" value=\"$table_col_infpos\">
</td>";

if(!$isautoincrement){
echo"<td class='Stable_td'>			  
<a href=\"#\" onclick=\"DisplayGroupINF('".$table_name."','".$table_field."','"."fielddisplayGroups".$table_name."')\">Set</a>
</td>";
}else{
echo"<td class='Stable_td'>&nbsp;</td>";
}
print"</tr>";
$rec_count++; 
$listdiso='';
$pdfdiso='';
$infdiso='';

}
print"<tr><td colspan=\"7\"><p class=\"date\"></p></td></tr>";
print"<tr><td>Section Title</td><td colspan=\"4\"><input type=\"text\"    size=\"40\" id=\"$tablename"."\" name=\"$tablename\" value=\"".$_SESSION[$tablename]."\"></td></tr>";

print"<tr><td>Report Title</td><td colspan=\"5\"><input type=\"text\"    size=\"40\" id=\"statementcpn$tablename"."\" name=\"statementcpn$tablename\" value=\"".$_SESSION['stm'.$tablename]."\"></td></tr>";

echo("</tr>");
echo("<tr> <td><input type=\"button\" class=\"savebutton\"    size=\"20\" name=\"ctrupdate$table_name\" value=\"Save\"  onclick=\"savedisplyOptions$tablename('".$tablename."','".$tablename."displayOptionsSaveUpdate')\">");
print"</td><tr><td>";
print" </td></tr>";
print" <tr><td><td>";
echo("</table>");
print "<div id=\"fielddisplayGroups".$tablename."\"></div>";
print "<div id=\"fielddisplay".$tablename."\"></div>";


}

echo "<div id='hiddenOptionsDiv'>$hiddenText</div>";		
echo("</form>");
}

?><?php

function calculate_tax($taxable_income)
{
$sql="SELECT * FROM settings_taxsetup";
$results_qry=mysql_query($sql) or die('Could not execute the query on tax_table');
$lowelimit=array();
$upperlimit=array();
$rate=array();

while($results=mysql_fetch_array($results_qry)){
//define array of data

$lowelimit[]=$results['lower_limit'];
$upperlimit[]=$results['upper_limit'];
$active[]=$results['active'];
$rate[]=$results['rate'];



}//end while
$total_tax=0;
$tcount=sizeof($lowelimit);
$ctrack=0;
for($i=0;$i<sizeof($lowelimit);$i++){ //beginning of for loop
$l_limit=$lowelimit[$i];
$u_limit=$upperlimit[$i];
$r=$rate[$i];

if($lowelimit[$i]<=$taxable_income){
$taxcal=$taxcal+$lowelimit[$i]*($r/100);
$taxable_income=$taxable_income-$taxcal;

//$employeedidecho $taxcal.'  '.$taxable_income;
}
$ctrack++;

if($ctrack==$tcount){
//$taxcal=$taxcal+($taxable_income*$r);
}

}//end for loop
return $taxcal;

}//end function calculate_tax
?><?php


function insertNotification($tablename,$lastsaved){
$sqlcontrols="select distinct alert_id from admin_groupnotification where tablename='$tablename'";   
			$results_ctrls=mysql_query($sqlcontrols);
	        $cnt_cols=mysql_num_rows($results_ctrls);
        if($cnt_cols>0){
			$countlns=0;
			while($table_formcontrols=mysql_fetch_array($results_ctrls)){
					$alert_id=$table_formcontrols['alert_id'];
					$countlns++;
					$effective_date=date('m-d-Y');
					$status=0;
					$actioned_by=$_SESSION['my_useridloggened'];
					$recordid=$lastsaved;
					$action='';
					if($alert_id==1){
					$status=1;
					$action='Initiated';
					}
					$comment='';
					$flashed='No';
				$insertSQLNh=" Insert into admin_groupnotificationhist
				(groupnotificationhist_id,alert_id,actioned_by,action,tablename,recordid,status,flashed,comment,effective_date) 
				values(
				'','$alert_id'
				,'$actioned_by'
				,'$action'
				,'$tablename'
				,'$recordid'
				,'$status'
				,'$flashed'
				,'$comment'
				,'$effective_date')	
				";
				
				$results_fornotification=mysql_query($insertSQLNh);
				
				//$lastsaved=mysql_insert_id();
				
			}
			}
}
?><?php
function updateLevelNotification($action, $status, $comments, $groupnotificationhistId){
$effective_date=date('m-d-Y');
$actioned_by=$_SESSION['my_useridloggened'];				
$sqlUpdateNotificartion="update admin_groupnotificationhist set 
action='$action',
status='$status',
actioned_by='$actioned_by',
actioned_by='$effective_date',
comment='$comments'
where groupnotificationhist_id=$groupnotificationhistId";   
$results_ctrls=mysql_query($sqlUpdateNotificartion);
$cnt_cols=mysql_num_rows($results_ctrls);


}
?>
<?php
function getHeaderDetails($activetablelinked){
$sqlcontrols="select distinct fieldname , fieldcaption, tablecaption , detailsvisiblepdf , position,colnwidth,primarykeyidentifier from admin_controller where tablename='$activetablelinked' and detailsvisiblepdf='Show' order by position";   
			
			//echo $sqlcontrols;
			$results_ctrls=mysql_query($sqlcontrols);
	        $cnt_cols=mysql_num_rows($results_ctrls);
			$countcurrentfield=0; 
			$displayvalues='';
			if($cnt_cols>0){
			$countlns=0;
			$foundforeingperons='';
			while($table_formcontrols=mysql_fetch_array($results_ctrls)){
			$countlns++;
			
			 
			  $tablename=$table_formcontrols['tablename']; 
			  $table_caption=$table_formcontrols['tablecaption'];
			  $table_field=$table_formcontrols['fieldname'];
			  if(($table_field=='person_id')&&($tablename!='admin_person'))
			  $foundforeingperons='True';
			  $table_col_caption=$table_formcontrols['fieldcaption'];
			  $table_col_viewdetails=$table_formcontrols['detailsvisiblepdf'];
              $table_col_viewonpdf=$table_formcontrols['detailsvisiblepdf'];
			  $table_col_positionb=$table_formcontrols['position'];
              $displayvalues[$countcurrentfield]=$table_formcontrols[0];
			  $header[$countcurrentfield]=$table_formcontrols[1];
			  $table_col_colnwidth=$table_formcontrols['colnwidth'];
			  if($table_formcontrols[3]=='Show'){
			  $headerWidth[$countcurrentfield]=$table_formcontrols[5];
			  }else{
			  $headerWidth[$countcurrentfield]=0;}
			  $headerfields[$countcurrentfield]=$table_formcontrols[0];
			  $countcurrentfield++;
			  }
			   
			 
				//}//checking foreign keys
			  
			  }//end of whileperson_fullname
			  if( $foundforeingperons){
			  $len=sizeof($headerfields)+1;
			  $headerfields[$len]='person_fullname';
			  $headerfields[$len+1]='NoShow';
			  }
			  
			  
	return $headerfields;
	
	}		  
function LoadTableData($activetablelinked,$headerfields)
{

$sql=$_SESSION[$activetablelinked.'_SearchSQL'];

//$sqlvdym=reviseSQLToDynamic('payment_receivablepayment','admin_person','syownerid');

$results_qry=mysql_query($sql) or die('Could not execute the query');
$countrowsfoundfordesplay=mysql_num_rows($results_qry);
$cntcols=0;
$countouter=0;
$activetablelinkedArray=explode('_',$activetablelinked);
$myfolder=$activetablelinkedArray[0];

//print"<input type=\"hidden\" id=\"tokenid\" value=\"$activetablelinked\">";
//print"<input type=\"text\" id=\"folderid\" value=\"".$myfolder." ppp\">";
while($count=mysql_fetch_array($results_qry)){
$countinner=1;

$multidataColumns[$countouter][0]=$count[$activetablelinkedArray[1].'_id'];
$numcolmnsfnd=0;
foreach($headerfields as $pdffielditem){
$currid=$activetablelinkedArray[1];
$numcolmnsfnd++;

$nmr=explode('_',$pdffielditem);

if(($nmr[1]=='id')&&($currid!=$nmr[0])){

$arrDataRow[$cntcols]=$count[$nmr[0].'_name'];
$processedfieldname=$pdffielditem;
$dataColumns[$cntcols]=$count[$nmr[0].'_name'];
$multidataColumns[$countouter][$countinner]=$count[$nmr[0].'_name'];
$countinner++;
$cntcols++;

}


else{
$arrDataRow[$cntcols]=$count[$pdffielditem];
$processedfieldname=$pdffielditem;
$dataColumns[$cntcols]=$count[$pdffielditem];
$multidataColumns[$countouter][$countinner]=$count[$pdffielditem];


$countinner++;
$cntcols++;

}

}
$countouter++;
//$data[]=array_unique($arrDataRow);
}

return $multidataColumns;
}
?><?php
function buildlangTopMenuLinksDetailsV2(){	
	$mytabs=0;	
	$whereclause ="where  controller_id in(select controller_id from admin_rights where usergroup_id='". $_SESSION['my_usergroup_id']."')";									
    $sql_available_tables="select  distinct displaygroup from admin_controller ".$whereclause."  order by displaygroup"; 
    $results=mysql_query( $sql_available_tables);
	$cntreg=mysql_num_rows($results);  

if ($cntreg>0){ 
while($count=mysql_fetch_array($results)){                                   
$table_name=$count[0]; 
$sql_getdefaultTableSQL="select tablename  from admin_controller where displaygroup='$table_name' AND showgroup='show' limit 1"; 
$resultsDefaultTble=mysql_query( $sql_getdefaultTableSQL);
$cntregDefaultTbl=mysql_num_rows($resultsDefaultTble);
			if($cntregDefaultTbl){
			$countDefaulttbl=mysql_fetch_array($resultsDefaultTble);
			$defaulttable_name=$countDefaulttbl[0];
			}
			$foldnamelinks=explode('_',$defaulttable_name);
			$foldnamelinkTo=$foldnamelinks[0];
			
				if($foldnamelinkTo==$prevfoloder){
				  $i++;
				  
				  } 
				  else  {
$mytabs++;	
$active_tbl_php=$defaulttable_name;
//echo "loadTableInfo('".$defaulttable_name."','NOID','Save','".$_SESSION['tablegroup'.$active_tbl_php]."')";
$detailsTopMenu.='
'."<li><a href=\"#tabs-$mytabs"."\" onclick=\"loadActiveMenuDetails('".$_SESSION['tablegroup'.$active_tbl_php]."');showHidConfDIV('viewconfig','show');".$defaulttable_name."Form('alertdata')\""." >".$_SESSION['tablegroup'.$active_tbl_php]."</a></li>";
$tabsguide.= '
<div id="tabs-'.$mytabs.'"><div id="save'.$_SESSION['tablegroup'.$active_tbl_php].'"></div><div id="'.$_SESSION['tablegroup'.$active_tbl_php].'">'.'</div></div>';
//echo "loadTableInfo('".$defaulttable_name."','NOID','Save','".$_SESSION['tablegroup'.$active_tbl_php]."')<br>";
				// }
				 }
                $prevfoloder=$foldnamelinkTo; 
		
               }
			 }
	
$r=$mytabs+1;	
$a=$mytabs+2;
$h=$mytabs+3; 
$otherdivs='
<div id="tabs-'.$r.'"><div id="savereport"></div><div id="report"></div></div>
<div id="tabs-'.$a.'"><div id="saveanalysis"></div><div id="analysis"></div></div>
<div id="tabs-'.$h.'"><div id="savehelp"><div id="help"></div></div>';
$systab='./template/functions/hometabs.php';
$otherdetails="<li><a onClick=\"displayAvailableReports('report');\" href=\"#tabs-".$r."\">Reports</a></li>
<li><a onClick=\"showHidConfDIV('viewconfig','hide');\" href=\"#tabs-".$a."\" >Analysis</a></li>
<li><a onClick=\"showHidConfDIV('viewconfig','hide');\" href=\"#tabs-".$h."\" >Help</a></li>
</ul>";
/*file_put_contents($systab,$tabsguidea.$tabsguide.$otherdivs);

	
$sysfunc='./template/functions/topMenu.php';
file_put_contents($sysfunc,'<ul>  
'.$detailsTopMenu.$otherdetails);*/

$menuandbody='<ul>'.$detailsTopMenu.$otherdetails.$tabsguidea.$tabsguide.$otherdivs;
echo $menuandbody;
} //end func select tables 

?><?PHP 
function getUserGroupCurrentRigths($usrgrp){
$query_Rcd_rgt= "select *  from admin_rights where usergroup_id='$usrgrp'";
$Rcd_rgt_results = mysql_query($query_Rcd_rgt) or die(mysql_error());
$cntrgt=mysql_num_rows($Rcd_rgt_results);
		if($cntrgt>0){
		     $cntrgt_items=0;
			 $arrItems='';
				while($count_rtg=mysql_fetch_array($Rcd_rgt_results)){                     
				$controller_id=$count_rtg['controller_id'];
				$view=$count_rtg['view'];
                $edit=$count_rtg['edit'];
				$del=$count_rtg['del'];
				$arrItems[$controller_id]=$view.'#'.$edit.'#'.$del;
				}
		}
return $arrItems;
}
function build_DbTableList($activetableBody,$fieldname,$displaytype){
$row = mysql_query("SELECT distinct table_name, table_caption FROM admin_table ") or die("Could Not Perform The Query");
print "<select class=\"listView\" name=\"$activetableBody$fieldname\" id=\"$activetableBody$fieldname\" onChange=\" NotificationTypes('$activetableBody','$fieldname','$displaytype')\" >";
print"<option value='NoGroup'>Select Section</option>";
 while($count=mysql_fetch_array($row)){$i++; 
 $group_id_display=$count['table_name']; 
 $group_name_display=$count['table_caption']; 
 print"<option value=$group_id_display>$group_name_display
 </option>";
 }
print"</select>";  }
?><?
function leading_zeros($value, $places){
// Function written by Marcus L. Griswold (vujsa)
// Can be found at http://www.handyphp.com
// Do not remove this header!

    if(is_numeric($value)){
        for($x = 1; $x <= $places; $x++){
            $ceiling = pow(10, $x);
            if($value < $ceiling){
                $zeros = $places - $x;
                for($y = 1; $y <= $zeros; $y++){
                    $leading .= "0";
                }
            $x = $places + 1;
            }
        }
        $output = $leading . $value;
    }
    else{
        $output = $value;
    }
    return $output;
}
?>
<?php

function printphoto($fieldname){

print"<div id=\"photoDiv\" style=\"  
    position:absolute;  
     width:100px;height:140px;top:150px;right:10px;
	  border:0px solid #333333;  
     z-index:120\" > ";
print"<img class=\"formFileInput\" src=\"../template/images/default_employee_image.gif\" width=\"100\" height=\"120\">";
print"<a href=\"#\" onclick=\"savePhotoHandler()\" title=\"Click to edit photo\">
<span id=\"empname\">Add photo</span>
";

/*print"</div>";
$fieldname='photo';
echo "<form id=\"file_upload_form\" method=\"post\" enctype=\"multipart/form-data\" action=\"saveAttachments.php\">
<div id='photoedit".$fieldname."' >
<input name=\"$fieldname\" id=\"$fieldname\" size=\"27\" type=\"file\" /><br />
<input type=\"submit\" name=\"action\" value=\"Upload\" /><br />
<iframe id=\"upload_target\" name=\"upload_target\" src=\"\" style=\"width:0;height:0;border:0px solid #fff;\"></iframe>
</div>
</form>";*/
}


?><?php 
function create2dcode($data,$filename){
require_once('tobiko/qrlib.php');
$matrixPointSize=2;
$errorCorrectionLevel='H';
//$data="ctp#".$idno."#".$fname.".".$lname."#".$telephone;
if(!is_dir('../codes')){
	mkdir('../codes');
	chmod('../codes',777);
}

$filename="../codes/".$filename.".png";
QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);

}
?><?PHP 
function build_DisplayList($table,$id,$caption,$groupname,$onchange,$userid){

$row = mysql_query("SELECT $id, $caption FROM $table ") or die("Could Not Perform The Query");
print "<select class=\"listView\"  onChange=\"$onchange\"   name=\"$groupname\" id=\"$id\" >";

print"<option value='NoGroup'>Select ".$_SESSION[$table]."</option>";

 while($count=mysql_fetch_array($row)){$i++; 
 $group_id_display=$count['0']; 
 $group_name_display=ucwords($count['1']);
 if($group_id_display==$userid){
 print"<option value=$group_id_display selected=\"selected\">$group_name_display
 </option>";
 } 
 else{
 print"<option value=$group_id_display>$group_name_display
 </option>";
 }
 }
print"</select>";  }?>
<?php
function fillAutoFillController($activetableBody,$tablefield){
$sqldefineAutofill="select * from admin_autofill where primary_tablelist='$activetableBody' AND fieldname='$tablefield'";

//echo $sqldefineAutofill;
$Rcd_autofill_results = mysql_query($sqldefineAutofill) or die(mysql_error());
$cnt_autorows=mysql_num_rows($Rcd_autofill_results);
$fillvalueArr='';
$digit_number='';
$fill_combination='';
			 if($cnt_autorows){
			
					 while($table_autofillrows=mysql_fetch_array($Rcd_autofill_results)){
					 $autofill_id=$table_autofillrows[autofill_id];
					 $tablename=$table_autofillrows[primary_tablelist];
					 $tablefield=$table_autofillrows[fieldname];
					 $prefix=$table_autofillrows[prefix];
					 $sufix=$table_autofillrows[surfix];
					 $caption=$table_autofillrows[caption];
					 $regex=$table_autofillrows[regex];
					 $editable=$table_autofillrows[editable];
					 $min_len=$table_autofillrows[min_len];
					 $max_len=$table_autofillrows[max_len];
					 $is_visible=$table_autofillrows[is_visible];
					 $fill_combination=$table_autofillrows[fill_combination];
					
					
					 $digit_number=trim($table_autofillrows[digit_number]);
					 
				$fillvalueArr['caption']=$caption;
				$fillvalueArr['regex']=$regex;
				$fillvalueArr['max_len']=$max_len;
				$fillvalueArr['regex']=$regex;
				$fillvalueArr['editable']=$editable;
				$fillvalueArr['min_len']=$min_len;
				$fillvalueArr['is_visible']=$is_visible;
				
					 
					 
					 }
			 
			}
$cnt_autorows='';
if($fill_combination){
$varsin=explode(',',$fill_combination);
$accrows='';
foreach($varsin as $includedtbl){

$fildccomn=explode('_',$includedtbl);
$fildccomnfield=$fildccomn[1].'_id';
$query_Rcdcount= "select count('$fildccomnfield') as rowscount from  $includedtbl ";
$Rcd_rcdn_results = mysql_query($query_Rcdcount) or die(mysql_error());
$cnt_rows=mysql_num_rows($Rcd_rcdn_results);
$foundrecordsarr=mysql_fetch_assoc($Rcd_rcdn_results);
$accrows+=$foundrecordsarr['rowscount'];
}
$existingcolumns=$accrows;
}
else{
$query_Rcdcount= "select count('person_id') as rowscount from  $activetableBody ";
$Rcd_rcdn_results = mysql_query($query_Rcdcount) or die(mysql_error());
$cnt_rows=mysql_num_rows($Rcd_rcdn_results);
$foundrecordsarr=mysql_fetch_assoc($Rcd_rcdn_results);
$existingcolumns=$foundrecordsarr['rowscount'];
}


$existingcolumns=$existingcolumns+1;
$digitnum=leading_zeros($existingcolumns, $digit_number);
$fillvalue=$prefix.$digitnum.$sufix;

$fillvalueArr['filval']=$fillvalue;


///print"<input type=\"text\" id=\"$activetableBody$tablefield\"  name=\"$activetableBody$tablefield\" value=\"$fillvalue\">";
return $fillvalueArr;
}

?>
<?php
function fillOptionsFillController($activetableBody,$currentTbl){
$sqldefineAutofill="select * from admin_autofill where tablename='$activetableBody'";

$Rcd_autofill_results = mysql_query($sqldefineAutofill) or die(mysql_error());
$cnt_autorows=mysql_num_rows($Rcd_autofill_results);
 
			 if($cnt_autorows){
			$tablefieldRetrieved='';
			
					 while($table_autofillrows=mysql_fetch_array($Rcd_autofill_results)){
					 $autofill_id=$table_autofillrows[autofill_id];
					 $tablenameRetrieved=$table_autofillrows[tablename];
					 $tablefieldRetrieved=$table_autofillrows[tablefield];
					 
					 
					 
					 }
			 
			}
$cnt_autorows='';
if($tablefieldRetrieved){
$fieldArrs=explode('_',$tablefieldRetrieved);
if($fieldArrs[1]=='name'){
$field_id=$fieldArrs[0].'_id';
$query_Rcdcount= "select $field_id,$tablefieldRetrieved from  $tablenameRetrieved ";
$Rcd_rcdn_results = mysql_query($query_Rcdcount) or die(mysql_error());
$cnt_rows=mysql_num_rows($Rcd_rcdn_results);
}


}
					if($cnt_rows>0){
					 $fieldValues='';
					 print'<form name="frm_body'.$field_id.'_fkhidden'.'">';
					while($table_rows=mysql_fetch_array($Rcd_rcdn_results)){
						   $fieldCaptions=ucwords($table_rows[$tablefieldRetrieved]); 
						   $fieldValues=$table_rows[$field_id];
						   $optionName=$currentTbl.$field_id.'_fkhidden';
      print"<input name=\"$optionName\" id=\"$optionName\" type=radio value=\"$fieldValues\" />$fieldCaptions<br>";
						  }
					print'</form>';
	
				}		
}

?>
<?php
function fillListFillController($activetableBody,$currentTbl){
$sqldefineAutofill="select * from admin_autofill where tablename='$activetableBody'";
$Rcd_autofill_results = mysql_query($sqldefineAutofill) or die(mysql_error());
$cnt_autorows=mysql_num_rows($Rcd_autofill_results);
 
			 if($cnt_autorows){
			        $tablefieldRetrieved='';
					 while($table_autofillrows=mysql_fetch_array($Rcd_autofill_results)){
					 $autofill_id=$table_autofillrows[autofill_id];
					 $tablenameRetrieved=$table_autofillrows[tablename];
					 $tablefieldRetrieved=$table_autofillrows[tablefield];
				     }
			 
			   }
                        $cnt_autorows='';
				if($tablefieldRetrieved){
						$fieldArrs=explode('_',$tablefieldRetrieved);
						if($fieldArrs[1]=='name'){
						$field_id=$fieldArrs[0].'_id';
						$groupname=$currentTbl.$field_id.'_fkhidden';
						$onchange='';
						build_DisplayList($tablenameRetrieved,$field_id,$tablefieldRetrieved,$groupname,$onchange);
						}
				
				
				}
			
				
}

?>
<?php
function fillCustomDataFillController($activetableBody,$fieldname,$displaytype){
$sqldefineAutofill="select * from admin_custom where tablename='$activetableBody' AND fieldname='$fieldname'";
$Rcd_autofill_results = mysql_query($sqldefineAutofill) or die(mysql_error());
$cnt_autorows=mysql_num_rows($Rcd_autofill_results);
 if($cnt_autorows){
			        $tablefieldRetrieved='';
					$displaytypeARR=explode('|',$displaytype);
					$optionslist='';
					$listdisplay="<select name=\"$activetableBody$fieldname"."\" id=\"$activetableBody$fieldname"."\">";
					$display_caption='';
					$stored_value='';
					 print'<form name="frm_body'.$fieldname.'_fkhidden'.'">';
					 while($table_autofillrows=mysql_fetch_array($Rcd_autofill_results)){
					 $stored_value=$table_autofillrows[stored_value];
					 $display_caption=$table_autofillrows[display_caption];
					 $displaytype=$table_autofillrows[displaytype];

$optionslist.="<input name=\"$activetableBody$fieldname"."_fkhidden\" id=\"$activetableBody$fieldname"."_fkhidden\" type=radio value=\"$stored_value\" />$display_caption<br>";
$listdisplay.="<option value=\"".$stored_value."\">".$display_caption."</option>";
 }
}
                 
			if($displaytypeARR[0]=='list'){
			print $listdisplay.'</select>';
			}
			if($displaytypeARR[0]=='options'){
			print $optionslist;
			}
			if($displaytypeARR[0]=='ajax'){
			
			}
			print'</form>';
				
}

?>
<?php
function print_date_picker($table,$field_name,$field_caption,$existingdate){
$control=$table.$field_name;
if($existingdate==''){
$effective_dt=date('Y-m-d');
}else{
$effective_dt=$existingdate;
}

print"
<input name=\"$control\" type=\"text\" size=\"12\" id=\"".$control."\"  value=\"$effective_dt\" readonly=\"readonly\"/>
<a href=\"javascript:NewCal('$control','yyyymmmdd')\" title=\"click to pick dates\"><img src=\"../template/images/cal.gif\" width= \"16\" height=\"16\" border=\"0\" alt=\"Pick a date\"></a>
";
}

?><?php
require_once('determinelinks.php');
function print_ajax_search_box($fieldIdenfier,$jstablename){
print"<div class=\"suggestionsBox\" id=\"".$jstablename.$fieldIdenfier."suggestions\" style=\"display: none;\">
 <div class=\"suggestionList\" id=\"".$jstablename.$fieldIdenfier."autoSuggestionsList\">
 </div>";
 
 }
?><?PHP 
function getEssMenuOptionsNew(){
            $essSQL="select distinct tablename,tablecaption from admin_tablerole where usergroup_id=1  ";
            $results_ess=mysql_query($essSQL);
	        $cnt_colsess=mysql_num_rows($results_ess);
			
			if($cnt_colsess>0){
			$uls= '<ul>';
					while($table_essArr=mysql_fetch_array($results_ess)){
					  $essMenuOptions=$table_essArr["tablename"];
					  $essMenuOptionsArr=explode('_',$essMenuOptions); 
					$allinks.='<li>'.'<a href="../'.$essMenuOptionsArr[0].'/'.$essMenuOptions.'.php">'
					.$table_essArr['tablecaption'].'</a></li>';
				
					  }
					  $ule= '</ul>';
            }


$essMenuOptionsPages=$uls.$allinks.$ule;
return  $essMenuOptionsPages;
}
?><?php
function build_db_table_list($group_tbl){
 $atarray=explode('_',$group_tbl);
 $group_id=$atarray[1].'_id';
 $group_name=$atarray[1].'_name';
 //onchange=\"disp(this.name)     myfillControl('currentscreen','".$currentTbl."')
 $row = mysql_query("SELECT $group_id, $group_name FROM $group_tbl  order by $group_name") or die("Could Not Perform The Query");
print $_SESSION[$group_tbl]."<select class=\"listView\" name=\"$group_name\" id=\"old$group_id\" onchange=\"myfillControl('selectedEMPID',this.value)\">";
print"<option>Select Group</option>";
 while($count=mysql_fetch_array($row)){$i++; $group_id_display=$count['0']; 
 $group_name_display=ucwords($count['1']); print"<option value=$group_id_display>$group_name_display</option>";                                                        
		 }
print"</select>";  }?>
<?PHP 
function build_db_usergroup(){
 $atarray=explode('_','admin_usergroup');
 $group_id='usergroup_id';
 $group_name='usergroup_name';
 
 $row = mysql_query("SELECT $group_id, $group_name FROM admin_usergroup  order by $group_name") or die("Could Not Perform The Query");
print $_SESSION[$group_tbl]."<select class=\"listView\" name=\"mygroup\" >";
print"<option value=''>Select Group</option>";
 while($count=mysql_fetch_array($row)){$i++; 
 $group_id_display=$count['0']; 
 $group_name_display=ucwords($count['1']); print"<option value=$group_id_display>$group_name_display</option>";                                                        
		 }
print"</select>";  }?>
<?PHP 
function build_db_allTables(){
 $row = mysql_query("Show tables") or die("Could Not Perform The Query");
print "Activity <select class=\"listView\" name=\"mytable\" >";
print"<option value=''>Select Activity</option>";
 while($count=mysql_fetch_array($row)){$i++; $group_id_display=$count['0']; 
 $tbl=$count[0];
 $group_name_display=ucwords($_SESSION[$tbl]); 
 print"<option value=$tbl>$tbl</option>";                                                        
		 }
print"</select>";  }?><?php


if (isset($_POST["submit_company_employee"])) {

addcontactdetail($phonNumber,$employee_name,'Employees');

}
if (isset($_POST["submit_housing_landlord"])) {

addcontactdetail($phonNumber,$landlord_name,'Landlords');

}
if (isset($_POST["submit_housing_tenant"])) {

addcontactdetail($phonNumber,$tenant_name,'Tenants');

}

$_SESSION["statements"]="bank_bank bank_branch company_agent company_employee contact frontline_group housing_tenant housing_landlord housing_property  insurance_client insurance_insurer insurance_policy ";
function insertintostmentadmin(){$output = array('Pass' => 0, 'Fail' => 0);

ini_set('auto_detect_line_endings',1);

$handle = fopen('../files/stmnts.csv', 'r');

while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
  
$tablename = trim(mysql_real_escape_string($data[0]));
$stslink= trim(mysql_real_escape_string($data[1]));

if($tablename==$processedscrpt)	{
$itemcntprocessed++;
}	
else{$itemcntprocessed=1;}

$processedscrpt=$tablename;

$tablename=$tablename;
$statement_captionr=explode('_',$tablename);
foreach($statement_captionr as $arritemizedarr){
$statement_caption.=$arritemizedarr;
}
$statement_link=$stslink;
$show_identifier='No';
$show_first_only='No';
$pdfvisible='Yes';
$position=$itemcntprocessed;
$insertSQLadmin_statement = "INSERT INTO admin_statement VALUES (''
,'$tablename'
,'$statement_caption'
,'$statement_link'
,'$show_identifier'
,'$show_first_only'
,'$pdfvisible'
,'$position')";

$statement_caption='';
$Result1 = mysql_query($insertSQLadmin_statement) or die(mysql_error());

 
}

}
?>
<?php
function addcontactdetail($phonNumber,$name,$groupdetailsfnd){ 
$groupdetailsfnd='/'.$groupdetailsfnd;
$datedd=date('Y-m-d');
$name=trim($name);
$phonNumber=trim($phonNumber);

if((trim($name)!='')&&(trim($phonNumber)!='')){
$insertSQLContes = "INSERT INTO contact (name, phoneNumber, otherPhoneNumber, emailAddress, active, notes) VALUES ('$name','$phonNumber',' ',' ','1','Registered')";
$Result1 = mysql_query($insertSQLContes) or die(mysql_error());


$qryrcont="select contact_id  from contact where phoneNumber='$phonNumber'";
$rowscnt = mysql_query($qryrcont) or die(mysql_error());
if($rowscnt){
While ($resultIdcnt=mysql_fetch_array($rowscnt))
{
$rowidNumCont= $resultIdcnt[contact_id];
$insert_detailsgr="INSERT INTO groupmembership 
VALUES ('','$rowidNumCont','$groupdetailsfnd')";
$results=mysql_query($insert_detailsgr);
}
}
}
}
?><?PHP 
function contactGroups(
$drop_down_name ,
$drop_down_caption,
$group_tbl  ,
$group_name ,
$group_id
){
$row = mysql_query("SELECT $group_id, $group_name FROM $group_tbl WHERE path!='/CGCN' order by $group_name") or die("Could Not Perform The Query");
print "$drop_down_caption <select class=\"listView\" name=$drop_down_name >";
print"<option value=''>Select Group</option>";
 while($count=mysql_fetch_array($row)){$i++; $group_id_display=$count['0']; 
 $group_name_display=ucwords($count['1']); print"<option value=$group_id_display>$group_name_display</option>";                                                        
		 }
print"</select>";  }?>
<?PHP 
$landloardgroupcontact="where  phoneNumber  in (select phoneNumber from housing_landlord where phoneNumber!='')";
$tenantgroupcontact="where  phoneNumber  in    (select phoneNumber from housing_tenant where phoneNumber!='')";
$employeegroupcontact="where  phoneNumber  in  (select phoneNumber from housing_tenant where phoneNumber!='')";

function display_found_SMSGroup($specificgroupconditions){													
 $sql_available_rcds="Select
  contact.contact_id,
  contact.name,
  contact.phoneNumber,
  contact.emailAddress
  From   contact
  $specificgroupconditions
  
  Order by 
  contact.name,
  contact.phoneNumber,
  contact.emailAddress, contact.contact_id desc Limit 1000
  
   
  "; 
  //(select contact_contact_id from groupmembership where group_path like '/Men%') 
  //phoneNumber in (select phone from pledges_rec where amount>amountRedeemed and phone Not Like 'N%')
  /*where contact_id in (SELECT  distinct (contact_contact_id)  FROM groupmembership  where group_path='/ confirmed' )*/                                            
						$results=mysql_query( $sql_available_rcds);                                          
						$cntreg=mysql_num_rows($results);  
	$cntreg_count=$cntreg;
			if ($cntreg_count>0){
	
	 }		
if ($cntreg>0){ 
$num_found_contacts=$cntreg;
print "<input type=\"hidden\"   name=\"num_found_contacts\" value=\"$num_found_contacts\"> ";                        
echo("<table width='98%' class='Stable_table'>"); 
echo("<tr class='Stable_th'>"); 		
print "<th> Phone Number </td >";
print "<th> Name </td >";      
print "<th>Email Address</td >";      

echo("</tr>");            
			$emp_count=0;          
			while($count=mysql_fetch_array($results)){                                   
			$emp_count++;  
			$em_num_row=$count['contact_id'];             $cphone=trim($count['phoneNumber']);                                               
	$em_name= ucwords($count['name']);
    $contact_id=$count['contact_id'];
	$emailadd=trim($count['emailAddress']);		            	
if(isset($emp_count)){
$even_row=$emp_count%2;
}

if($even_row<=0){

print ("<tr class='Stable_even_row'>");
}
if($even_row>0){
	print "<tr class='Stable_non_even_row'>";
	}
print"<td class='Stable_td'><input type=\"checkbox\"   checked=\"true\" size=\"11\" name=\"checked_contact_id$emp_count\" value=\"  $contact_id\">$cphone<td class='Stable_td'>$em_name </td><td class='Stable_td'>$emailadd</td>";
$selected_contact_id="'".$contact_id."',";
$selected_contact_id=$selected_contact_id.$selected_contact_id;
print"</tr>";
}

echo("<tr> <td>&nbsp;");
print"<tr><td>";

print" </td></tr>";
print" <tr><td><td>";
echo("</table>");

}

		
}

?>
<?PHP 
function build_default_table_list(){
$group_id='path';                      
$drop_down_name='path'; 
$drop_down_caption='Select to Group';            
$group_name='path';  
$group_tbl='frontline_group';
$row = mysql_query("SELECT $group_id, $group_name FROM $group_tbl WHERE path!='/CGCN' order by $group_name") or die("Could Not Perform The Query");
print "<select class=\"listView\" name=\"groupName\" >";
print"<option value=''>Select Group</option>";
 while($count=mysql_fetch_array($row)){$i++; $group_id_display=$count['0']; 
 $group_name_display=ucwords($count['1']); print"<option value=$group_id_display>$group_name_display</option>";                                                        
		 }
print"</select>";  }?><?php
function display_available_scheme_assign_options(
$drop_down_name , 
$drop_down_caption,             
$group_tbl  ,                  
$group_name ,                  
$group_id ){
echo("<table class='Stable_table'>");
echo("<tr bgcolor='#483B8D'> <th class='Stable_th' >Group Membership ");
print"<tr><td class='Stable_td'>";
build_db_table_list(           
$drop_down_name , 
$drop_down_caption,             
$group_tbl  ,                  
$group_name ,                  
$group_id                      
);  
print"</td ></tr>";

print"<tr><td >";
print "<P  class=\"date\"></p>";
print"<input  class=\"savebutton\"type=\"submit\"   size=\"6\" name=\"submit_button_$drop_down_name\" value=\"Save Group Members\"> ";
print "<P  class=\"date\"></p>";
print"</td ></tr>";
echo("</table>");
}
function submit_options($table_name){
      
      $num_of_ctrls=$_POST["num_found_controls"];
		if (isset($num_of_ctrls)){
		   if(isset($_POST["ctrupdate$table_name"])){
				
			  for ($i=0;$i<$num_of_ctrls;$i++){
				$ctrl_details=trim($_POST["ctrlerfound$i"]);
			    if (isset($ctrl_details)){
				$effective_dt=date('Y-m-d');
				$tablecaption=$_POST["tablecaptionVals"];
				$fieldcaption=$_POST["fieldcaption$i"];
				$detailsvisiblepdf=$_POST["details$i"];
				if($detailsvisiblepdf==''){$detailsvisiblepdf='Do Not Show';}
				$pdfvisible=$_POST["pdf$i"];
				if($pdfvisible==''){$pdfvisible='Do Not Show';}
				$position=$_POST["position$i"];
				$colnwidth=$_POST["colnwidth$i"];
				$controller_id=$ctrl_details;
		        $UpdateSQLadmin_controller = " 
		   UPDATE admin_controller SET 
		   tablecaption='$tablecaption' , fieldcaption='$fieldcaption' ,  detailsvisiblepdf='$detailsvisiblepdf' , 
		   pdfvisible='$pdfvisible' , position='$position', colnwidth='$colnwidth'  WHERE  controller_id=$controller_id";
$UpdateSQLadmin_crltbl = " UPDATE admin_controller SET tablecaption='$tablecaption'  WHERE  tablename='$table_name'";
/*$UpdateSQLadmin_crlemployee = " UPDATE admin_controller SET $fieldcaption='$tablecaption'  WHERE  tablefield='person_id' and tablename!='company_employee' ";*/

$Result_update = mysql_query($UpdateSQLadmin_controller) or die(mysql_error());
$Result_updatectr = mysql_query($UpdateSQLadmin_crltbl) or die(mysql_error());
//$Result_updatectr = mysql_query($UpdateSQLadmin_crlemployee) or die(mysql_error());

											
											}
							}
				}
		}
}
?>