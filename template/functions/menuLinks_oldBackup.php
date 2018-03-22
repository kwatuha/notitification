
<?php

//$topmenuDetails['mainTop']="<a href=\"../comm/comm.php\">Home</a><a href=\"../comm/createUser.php\">Administration</a><a href=\"#\">Events</a><a href=\"../reports/index.php\">Reports</a>";

//$topmenuDetails['loginmainTop']="<a href=\"index.php\">Home</a><a href=\"index.php\">Administration</a><a href=\"index.php\">Events</a><a href=\"index.php\">Reports</a>";
$topmenuDetails['mainTop']="
<a href=\"index.php\">Home</a>
<a href=\"../company/company_company.php\">company</a>
<a href=\"../admin/admin_user.php\">admin	</a>
<a href=\"../bank/bank_banks.php\">banking</a>
<a href=\"../commission/commission_companyinscommission.php\">commission</a>
<a href=\"../insurance/insurance_client.php\">insurance</a>
<a href=\"../property/property_tenants.php\">property</a>
<a href=\"../comm/comm.php\">Communication</a>
<a href=\"../events/events_event.php\">Events</a>
<a href=\"#\">Reports</a>";
//////////////////////////////////////////////////////////////

$rightmenu['mainPaged']="<a href=\"#\">Manage Teams </a><a href=\"../comm/SendINP.php\">Send Message </a><a href=\"../comm/SendToMany.php\">Send SMS to Group </a><a href=\"#\">Read Message </a><a href=\"#\">Handle Exceptions </a>";

$rightmenu['reportPaged']="<a href=\"../sysReport/contactReport.php\">Received Messges </a><a href=\"../sysReport/message.php\">Send Message </a><a href=\"../comm/SendToMany.php\">Send SMS to Group </a><a href=\"#\">Read Message </a><a href=\"#\">Handle Exceptions </a>";
$rightmenu['loginPaged']="";
 
$submenuIn['mainSub']="All Events </a><img src=\"../template/images/comment.gif\" alt=\"\" /><a href=\"pastevents.php\">Past Events </a> 
<img src=\"../template/images/timeicon.gif\" alt=\"\" /> &nbsp; <a href=\"uevents.php\">Upcoming Events </a>";

$submenuIn['housingSub']="All Events </a><img src=\"../template/images/comment.gif\" alt=\"\" /><a href=\"pastevents.php\">Past Events </a> 
<img src=\"../template/images/timeicon.gif\" alt=\"\" /> &nbsp; <a href=\"uevents.php\">Upcoming Events </a>";
$submenuIn['eventsSub']="All Events </a><img src=\"../template/images/comment.gif\" alt=\"\" /><a href=\"pastevents.php\">Past Events </a> 
<img src=\"../template/images/timeicon.gif\" alt=\"\" /> &nbsp; <a href=\"uevents.php\">Upcoming Events </a>";
$submenuIn['insuranceSub']="All Events </a><img src=\"../template/images/comment.gif\" alt=\"\" /><a href=\"pastevents.php\">Past Events </a> 
<img src=\"../template/images/timeicon.gif\" alt=\"\" /> &nbsp; <a href=\"uevents.php\">Upcoming Events </a>";

$submenuIn['adminSub']="New User </a><img src=\"../template/images/comment.gif\" alt=\"\" /><a href=\"pastevents.php\">New Contact  </a> 
<img src=\"../template/images/timeicon.gif\" alt=\"\" /> &nbsp; <a href=\"uevents.php\">New Pledge </a>";

$submenuIn['revenueSub']="All Events </a><img src=\"../template/images/comment.gif\" alt=\"\" /><a href=\"pastevents.php\">Past Events </a> 
<img src=\"../template/images/timeicon.gif\" alt=\"\" /> &nbsp; <a href=\"uevents.php\">Upcoming Events </a>";

$submenuIn['monitorSub']="All Events </a><img src=\"../template/images/comment.gif\" alt=\"\" /><a href=\"pastevents.php\">Past Events </a> 
<img src=\"../template/images/timeicon.gif\" alt=\"\" /> &nbsp; <a href=\"uevents.php\">Upcoming Events </a>";

$submenuIn['viewsSub']="All Events </a><img src=\"../template/images/comment.gif\" alt=\"\" /><a href=\"pastevents.php\">Past Events </a> 
<img src=\"../template/images/timeicon.gif\" alt=\"\" /> &nbsp; <a href=\"uevents.php\">Upcoming Events </a>";

$submenuIn['housingSub']="All Events </a><img src=\"../template/images/comment.gif\" alt=\"\" /><a href=\"pastevents.php\">Past Events </a> 
<img src=\"../template/images/timeicon.gif\" alt=\"\" /> &nbsp; <a href=\"uevents.php\">Upcoming Events </a>";

$submenuIn['revenueSub']="All Events </a><img src=\"../template/images/comment.gif\" alt=\"\" /><a href=\"pastevents.php\">Past Events </a> 
<img src=\"../template/images/timeicon.gif\" alt=\"\" /> &nbsp; <a href=\"uevents.php\">Upcoming Events </a>";
$submenuIn['cyberSub']="All Events </a><img src=\"../template/images/comment.gif\" alt=\"\" /><a href=\"pastevents.php\">Past Events </a> 
<img src=\"../template/images/timeicon.gif\" alt=\"\" /> &nbsp; <a href=\"uevents.php\">Upcoming Events </a>";
$submenuIn['commSub']= "<a href=\"#\">Compose Email </a><img src=\"../template/images/comment.gif\" alt=\"\" /><a href=\"#\">Read Email </a> 
<img src=\"../template/images/timeicon.gif\" alt=\"\" /> &nbsp; <a href=\"#\">Group Email </a>";

$submenuIn['loginSub']= "Login";


$imageL['d1']="<img src=\"../template/images/comment.gif\" alt=\"\" />";
$imageL['d2']="<img src=\"../template/images/timeicon.gif\" alt=\"\"/>";
$imageL['id1']="<img src=\"../template/images/comment.gif\" alt=\"\" />";
$imageL['id2']="<img src=\"../template/images/timeicon.gif\" alt=\"\"/>";


 function buildlangfile($dbinuse,$table_name,$table_name_link_field_id){	
 
//builing recordsets
 $found_recordset = "-1";

if (isset($_GET['q'])) {
  $colname_to_name =base64_decode($_GET['q']);
  $query_recs = "SELECT * FROM $table_name WHERE $table_name_link_field_id = $colname_to_name";



$found_recordset = mysql_query($query_recs) or die(mysql_error());
$row_found_recordset = mysql_fetch_assoc($found_recordset);
$totalRows_recordRetrievePayment = mysql_num_rows($found_recordset);
}

 //end of building recordsets
 												
            $sqltbcols="Show columns from $table_name";   
			$results_tbc=mysql_query($sqltbcols);
	        $cnt_cols=mysql_num_rows($results_tbc);
			echo"<form name =\"frm$table_name\" action=\"\" method=\"post\"> ";
			echo"<p class=\"date\">"; echo $_SESSION["$table_name"]; echo"</p>";
  echo"<div align=\"left\">";
  echo "<table width=\"400\" border=\"0\">
    <tr>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>";
			while($count_cls=mysql_fetch_array($results_tbc)){
			  $table_col_Name=$count_cls['Field']; 
			  $table_col_Type=$count_cls['Type']; 
			  $table_col_Null=$count_cls['Null'];
         $sectionty=substr($table_col_Type,0,3);
	     $fkcheck=substr($table_col_Name,0,3);
		 $row_found_recordsetvalue='';
		 $sub_cption='Save';
		 $btn_name='submit_'.$table_name;
		 if ($totalRows_recordRetrievePayment>0){
		 $row_found_recordsetvalue=$row_found_recordset["$table_col_Name"];
		 $sub_cption='Update';
		 $btn_name='Update_'.$table_name;
		 }
    
	
	//$fkcheck='test';
	if( $fkcheck=='fk_'){
	$ctrlTypeTP='hidden';
	
	}
	
	if( $fkcheck!='fk_'){
	print"<tr>";
    echo"<td>";
	echo $_SESSION["$table_name$table_col_Name"];
	echo "</td>";
	echo "<td>";
	$ctrlTypeTP='text';
	} 
	
	
	
	if( $sectionty=='dat'){
	//echo $table_col_Name;
	print_date_picker($table_col_Name,$_SESSION["$table_name$table_col_Name"]);
	}
	if( $sectionty=='int'){
	//echo $table_col_Name;
	//echo "$row_found_recordset['EmployeeID']";
	print"<input type=\"$ctrlTypeTP\"  size=\"32\" id=\"$table_col_Name\" name=\"$table_col_Name\" value=\"$row_found_recordsetvalue\">";
	}
	if( $sectionty=='var'){
	//echo $table_col_Name;
	print"<input type=\"$ctrlTypeTP\"  size=\"32\" id=\"$table_col_Name\" name=\"$table_col_Name\" value=\"$row_found_recordsetvalue\">";
	}
	 
	 if( $sectionty=='dou'){
	//echo $table_col_Name;
	print"<input type=\"$ctrlTypeTP\"  size=\"32\" id=\"$table_col_Name\" name=\"$table_col_Name\" value=\"$row_found_recordsetvalue\">";
	}
	
	if( $fkcheck!=='fk_'){
	echo "</td>";
	echo"</tr>";
	$fkcheck='';
	$ctrlTypeTP='';
	}
	
  
  } 
      echo "<tr>
    <td>&nbsp;</td><td>&nbsp;</td></tr><tr>
    <td>&nbsp;</td>
    <td><input type=\"submit\" class=\"savebutton\" id=\"submit_$table_name\" name=\"$btn_name\" value=\"$sub_cption\"> <input type=\"reset\" class=\"resetbutton\"id=\"rst$table_name\" name=\"rst$table_name\" value=\"Cancel \"></td>
  </tr>
</table><p class=\"date\"></div></div></form>";
  
//mysql_free_result($table_name);

} //end func select tables  

function buildlangfileRSV($dbinuse){													
    $sql_available_tables="show tables"; 
    $results=mysql_query( $sql_available_tables);
	$cntreg=mysql_num_rows($results);  

if ($cntreg>0){ 
//print "<input type=\"text\" name=\"num_found_contacts\" value=\"$cntreg\">";                        
            while($count=mysql_fetch_array($results)){                                   
			$table_name=$count[0]; 
	echo '//********** Starting  '.$table_name.'***********************<p><br>';  
			$sqltbcols="Show columns from $table_name";   
			$results_tbc=mysql_query($sqltbcols);
	        $cnt_cols=mysql_num_rows($results_tbc); 
			while($count_cls=mysql_fetch_array($results_tbc)){
			  $table_col_Name=$count_cls['Field']; 
			  $table_col_Type=$count_cls['Type']; 
			  $table_col_Null=$count_cls['Null'];
			 
echo '$_SESSION'."['".$table_name.$table_col_Name."']='".$table_col_Name."'; <br>";
          
			} echo '//END '.$table_name ."<p><br>";
  
} //end while
} //end if
} //end func select tables 

function buildlangfileRSVTb($dbinuse){													
    $sql_available_tables="show tables"; 
    $results=mysql_query( $sql_available_tables);
	$cntreg=mysql_num_rows($results);  

if ($cntreg>0){ 
                        
            while($count=mysql_fetch_array($results)){                                   
			$table_name=$count[0]; 
			//echo $table_name.'<br>';  
			$sqltbcols="Show columns from $table_name";   
			$results_tbc=mysql_query($sqltbcols);
	        $cnt_cols=mysql_num_rows($results_tbc); 
			while($count_cls=mysql_fetch_array($results_tbc)){
			  $table_col_Name=$count_cls['Field']; 
			  $table_col_Type=$count_cls['Type']; 
			  $table_col_Null=$count_cls['Null'];
			 

          
			}  echo '$_SESSION'."['".$table_name."']='".$table_name."'; <br>";
  
} //end while
} //end if
} //end func select tables   
?>
<?php

function print_date_picker($field_name,$field_caption){
$effective_dt=date('Y-m-d');
print"

<input name=\"$field_name\" type=\"text\" size=\"32\" id=\"$field_name\"  value=\"$effective_dt\" readonly=\"readonly\"/>
<a href=\"javascript:NewCal('$field_name','yyyymmmdd')\" title=\"click to pick dates\"><img src=\"../template/images/cal.gif\" width= \"16\" height=\"16\" border=\"0\" alt=\"Pick a date\"></a>
</td>
                     
</tr>";
}

?>
<?php 
//Vital Sessions
$_SESSION['admin_user']='admin_user'; 
$_SESSION['attachments_attachments']='attachments_attachments'; 
$_SESSION['attachments_sysattachments']='attachments_sysattachments'; 
$_SESSION['bank_banks']='bank_banks'; 
$_SESSION['bank_branch']='bank_branch'; 
$_SESSION['bank_insuranceaccount']='bank_insuranceaccount'; 
$_SESSION['commission_companyinscommission']='commission_companyinscommission'; 
$_SESSION['commission_insuranceagentcommission']='commission_insuranceagentcommission'; 
$_SESSION['company_agent']='company_agent'; 
$_SESSION['company_audit_trail']='company_audit_trail'; 
$_SESSION['company_company']='company_company'; 
$_SESSION['company_employee']='company_employee'; 
$_SESSION['events_event']='events_event'; 
$_SESSION['insurance_client']='insurance Client Details'; 
$_SESSION['insurance_insurer']='insurance_insurer'; 
$_SESSION['insurance_insurerpayment']='insurance_insurerpayment'; 
$_SESSION['insurance_policy']='insurance_policy'; 
$_SESSION['insurance_policy_claims']='insurance_policy_claims'; 
$_SESSION['insurance_policy_compensation']='insurance_policy_compensation'; 
$_SESSION['insurance_policyrenew']='insurance_policyrenew'; 
$_SESSION['insurance_policytype']='insurance_policytype'; 
$_SESSION['insurance_product']='insurance_product'; 
$_SESSION['insurance_property']='insurance_property'; 
$_SESSION['insurance_risks_mortorvehice']='insurance_risks_mortorvehice'; 
$_SESSION['insurance_risks_policyrisks']='insurance_risks_policyrisks'; 
$_SESSION['payment_payement']='payment_payement'; 
$_SESSION['payment_receipts']='payment_receipts'; 
$_SESSION['property_housedetails']='property_housedetails'; 
$_SESSION['property_housepayment']='property_housepayment'; 
$_SESSION['property_houseproperty']='property_houseproperty'; 
$_SESSION['property_ownercontactdetails']='property_ownercontactdetails'; 
$_SESSION['property_tenants']='property_tenants'; 
//********** Starting admin_user***********************

$_SESSION['admin_userid']='id'; 
$_SESSION['admin_useruser_id']='user_id'; 
$_SESSION['admin_useruser_password']='user_password'; 
$_SESSION['admin_userName']='Name'; 
$_SESSION['admin_useruser_priviledge']='user_priviledge'; 
$_SESSION['admin_usersecurity_question']='security_question'; 
$_SESSION['admin_usersecurity_q_answer']='security_q_answer'; 
$_SESSION['admin_useruser_active_status']='user_active_status'; 
$_SESSION['admin_usereffective_dt']='effective_dt'; 
//END admin_user


//********** Starting attachments_attachments***********************


$_SESSION['attachments_attachmentsAttachmentID']='AttachmentID'; 
$_SESSION['attachments_attachmentsEmployeeId']='EmployeeId'; 
$_SESSION['attachments_attachmentsAttachmentName']='AttachmentName'; 
$_SESSION['attachments_attachmentsAttachmentPath']='AttachmentPath'; 
$_SESSION['attachments_attachmentseffectiveDate']='effectiveDate'; 
//END attachments_attachments


//********** Starting attachments_sysattachments***********************


$_SESSION['attachments_sysattachmentsAttachmentid']='Attachmentid'; 
$_SESSION['attachments_sysattachmentsEmployeeId']='EmployeeId'; 
$_SESSION['attachments_sysattachmentsAttachmentRelatedTo']='AttachmentRelatedTo'; 
$_SESSION['attachments_sysattachmentseffectiveDate']='effectiveDate'; 
//END attachments_sysattachments


//********** Starting bank_banks***********************


$_SESSION['bank_banksbank_id']='bank_id'; 
$_SESSION['bank_banksEmployeeId']='EmployeeId'; 
$_SESSION['bank_banksbank_name']='bank_name'; 
$_SESSION['bank_bankscode']='code'; 
$_SESSION['bank_bankseffectiveDate']='effectiveDate'; 
//END bank_banks


//********** Starting bank_branch***********************


$_SESSION['bank_branchbranch_id']='branch_id'; 
$_SESSION['bank_branchEmployeeId']='EmployeeId'; 
$_SESSION['bank_branchbranch_name']='branch_name'; 
$_SESSION['bank_branchbank_id']='bank_id'; 
$_SESSION['bank_branchbranch_cde']='branch_cde'; 
$_SESSION['bank_branchdeleted']='deleted'; 
$_SESSION['bank_brancheffectiveDate']='effectiveDate'; 
//END bank_branch


//********** Starting bank_insuranceaccount***********************


$_SESSION['bank_insuranceaccountaccountId']='accountId'; 
$_SESSION['bank_insuranceaccountEmployeeId']='EmployeeId'; 
$_SESSION['bank_insuranceaccountInsurerID']='InsurerID'; 
$_SESSION['bank_insuranceaccountbank_id']='bank_id'; 
$_SESSION['bank_insuranceaccountbranch_id']='branch_id'; 
$_SESSION['bank_insuranceaccountAccountNumber']='AccountNumber'; 
$_SESSION['bank_insuranceaccountAgentNo']='AgentNo'; 
//END bank_insuranceaccount


//********** Starting commission_companyinscommission***********************


$_SESSION['commission_companyinscommissionCommId']='CommId'; 
$_SESSION['commission_companyinscommissionEmployeeId']='EmployeeId'; 
$_SESSION['commission_companyinscommissionAgentNo']='AgentNo'; 
$_SESSION['commission_companyinscommissionclientID']='clientID'; 
$_SESSION['commission_companyinscommissionComRate']='ComRate'; 
$_SESSION['commission_companyinscommissionStartDate']='StartDate'; 
$_SESSION['commission_companyinscommissionEndDate']='EndDate'; 
$_SESSION['commission_companyinscommissionrecursive']='recursive'; 
$_SESSION['commission_companyinscommissionoccurance']='occurance'; 
$_SESSION['commission_companyinscommissionstatus']='status'; 
$_SESSION['commission_companyinscommissionEffective_Date']='Effective_Date'; 
//END commission_companyinscommission


//********** Starting commission_insuranceagentcommission***********************


$_SESSION['commission_insuranceagentcommissionCommId']='CommId'; 
$_SESSION['commission_insuranceagentcommissionEmployeeId']='EmployeeId'; 
$_SESSION['commission_insuranceagentcommissionagentcomRate']='agentcomRate'; 
$_SESSION['commission_insuranceagentcommissionclientID']='clientID'; 
$_SESSION['commission_insuranceagentcommissionStartDate']='StartDate'; 
$_SESSION['commission_insuranceagentcommissionEndDate']='EndDate'; 
$_SESSION['commission_insuranceagentcommissionrecursive']='recursive'; 
$_SESSION['commission_insuranceagentcommissionoccurance']='occurance'; 
$_SESSION['commission_insuranceagentcommissionAgentNo']='AgentNo'; 
$_SESSION['commission_insuranceagentcommissionEffective_Date']='Effective_Date'; 
//END commission_insuranceagentcommission


//********** Starting company_agent***********************


$_SESSION['company_agentAgentNo']='AgentNo'; 
$_SESSION['company_agentEmployeeId']='EmployeeId'; 
$_SESSION['company_agentName']='Name'; 
$_SESSION['company_agentDepartmentId']='DepartmentId'; 
$_SESSION['company_agentMobileNo']='MobileNo'; 
$_SESSION['company_agentPostalAddress']='PostalAddress'; 
$_SESSION['company_agentStatus']='Status'; 
$_SESSION['company_agentEffective_Date']='Effective_Date'; 
//END company_agent


//********** Starting company_audit_trail***********************


$_SESSION['company_audit_trailuser_count']='user_count'; 
$_SESSION['company_audit_trailuser_id']='user_id'; 
$_SESSION['company_audit_trailtransaction_date']='transaction_date'; 
$_SESSION['company_audit_trailactivity']='activity'; 
//END company_audit_trail


//********** Starting company_company***********************


$_SESSION['company_companycompany_id']='company_id'; 
$_SESSION['company_companyEmployeeId']='EmployeeId'; 
$_SESSION['company_companyname']='name'; 
$_SESSION['company_companypin_number']='pin_number'; 
$_SESSION['company_companyvat_number']='vat_number'; 
$_SESSION['company_companyincorp_date']='incorp_date'; 
$_SESSION['company_companyeffective_dt']='effective_dt'; 
//END company_company


//********** Starting company_employee***********************


$_SESSION['company_employeeEmployeeId']='EmployeeId'; 
$_SESSION['company_employeesavedby']='savedby'; 
$_SESSION['company_employeeEmpNo']='EmpNo'; 
$_SESSION['company_employeeEmployee_Number']='Employee_Number'; 
$_SESSION['company_employeeSurname']='Surname'; 
$_SESSION['company_employeeOther_Names']='Other_Names'; 
$_SESSION['company_employeeDepartmentId']='DepartmentId'; 
$_SESSION['company_employeePhoneNumber']='PhoneNumber'; 
$_SESSION['company_employeeotherPhoneNumber']='otherPhoneNumber'; 
$_SESSION['company_employeePostalAddress']='PostalAddress'; 
$_SESSION['company_employeepostalCode']='postalCode'; 
$_SESSION['company_employeeTown']='Town'; 
$_SESSION['company_employeeStatus']='Status'; 
$_SESSION['company_employeeEffective_Date']='Effective_Date'; 
//END company_employee


//********** Starting events_event***********************


$_SESSION['events_eventevent_id']='event_id'; 
$_SESSION['events_eventEmployeeId']='EmployeeId'; 
$_SESSION['events_eventevent_description']='event_description'; 
$_SESSION['events_eventevent_start_date']='event_start_date'; 
$_SESSION['events_eventevent_end_date']='event_end_date'; 
$_SESSION['events_eventeffective_date']='effective_date'; 
//END events_event


//********** Starting insurance_client***********************


$_SESSION['insurance_clientclientId']='clientId'; 
$_SESSION['insurance_clientEmployeeId']='EmployeeId'; 
$_SESSION['insurance_clientName']='Name'; 
$_SESSION['insurance_clientProfession']='Profession'; 
$_SESSION['insurance_clientIDOrPassportNo']='IDOrPassportNo'; 
$_SESSION['insurance_clientMobile_Number']='Mobile_Number'; 
$_SESSION['insurance_clientOtherPhoneNumbers']='OtherPhoneNumbers'; 
$_SESSION['insurance_clientPostal_Address']='Postal_Address'; 
$_SESSION['insurance_clientPostal_Code']='Postal_Code'; 
$_SESSION['insurance_clientTown']='Town'; 
$_SESSION['insurance_clientEmail_Address']='Email_Address'; 
$_SESSION['insurance_clientTransactionDate']='TransactionDate'; 
//END insurance_client


//********** Starting insurance_insurer***********************


$_SESSION['insurance_insurerInsurerID']='InsurerID'; 
$_SESSION['insurance_insurerEmployeeId']='EmployeeId'; 
$_SESSION['insurance_insurerInsurer']='Insurer'; 
$_SESSION['insurance_insurerBank_ID']='Bank_ID'; 
$_SESSION['insurance_insurerBank_Branch_ID']='Bank_Branch_ID'; 
$_SESSION['insurance_insurerAccountNumber']='AccountNumber'; 
$_SESSION['insurance_insurerPostalAddress']='PostalAddress'; 
$_SESSION['insurance_insurerPostalCode']='PostalCode'; 
$_SESSION['insurance_insurerPhysicalAddress']='PhysicalAddress'; 
$_SESSION['insurance_insurerTown']='Town'; 
$_SESSION['insurance_insurerContactPerson']='ContactPerson'; 
$_SESSION['insurance_insurerContactPersonPhone']='ContactPersonPhone'; 
$_SESSION['insurance_insurerContactPersonEmail']='ContactPersonEmail'; 
$_SESSION['insurance_insurereffectiveDate']='effectiveDate'; 
//END insurance_insurer


//********** Starting insurance_insurerpayment***********************


$_SESSION['insurance_insurerpaymentPaymentID']='PaymentID'; 
$_SESSION['insurance_insurerpaymentEmployeeID']='EmployeeID'; 
$_SESSION['insurance_insurerpaymentclientId']='clientId'; 
$_SESSION['insurance_insurerpaymentReferenceNumber']='ReferenceNumber'; 
$_SESSION['insurance_insurerpaymentPaymentModeId']='PaymentModeId'; 
$_SESSION['insurance_insurerpaymentCategoryID']='CategoryID'; 
$_SESSION['insurance_insurerpaymentPaymentIDorVoucherNum']='PaymentIDorVoucherNum'; 
$_SESSION['insurance_insurerpaymentStatus']='Status'; 
$_SESSION['insurance_insurerpaymentperiodRef']='periodRef'; 
$_SESSION['insurance_insurerpaymentAmount']='Amount'; 
$_SESSION['insurance_insurerpaymentTransactionDate']='TransactionDate'; 
//END insurance_insurerpayment


//********** Starting insurance_policy***********************


$_SESSION['insurance_policyPolicyId']='PolicyId'; 
$_SESSION['insurance_policyPolicyTypeId']='PolicyTypeId'; 
$_SESSION['insurance_policyEmployeeID']='EmployeeID'; 
$_SESSION['insurance_policyclientId']='clientId'; 
$_SESSION['insurance_policyInsurerID']='InsurerID'; 
$_SESSION['insurance_policyBusiness']='Business'; 
$_SESSION['insurance_policyPolicyNumber']='PolicyNumber'; 
$_SESSION['insurance_policyBasicPremium']='BasicPremium'; 
$_SESSION['insurance_policyTrainingLevy']='TrainingLevy'; 
$_SESSION['insurance_policyPCF']='PCF'; 
$_SESSION['insurance_policyCommissionRate']='CommissionRate'; 
$_SESSION['insurance_policyGeographicalArea']='GeographicalArea'; 
$_SESSION['insurance_policyScope']='Scope'; 
$_SESSION['insurance_policyDateInsured']='DateInsured'; 
$_SESSION['insurance_policyExpiryDate']='ExpiryDate'; 
$_SESSION['insurance_policyeffectiveDate']='effectiveDate'; 
//END insurance_policy


//********** Starting insurance_policy_claims***********************


$_SESSION['insurance_policy_claimsClaimID']='ClaimID'; 
$_SESSION['insurance_policy_claimsClientIDOrPassportNo']='ClientIDOrPassportNo'; 
$_SESSION['insurance_policy_claimsPolicyNo']='PolicyNo'; 
$_SESSION['insurance_policy_claimsStatusOfLoss']='StatusOfLoss'; 
$_SESSION['insurance_policy_claimsNatureOfLoss']='NatureOfLoss'; 
$_SESSION['insurance_policy_claimsProductID']='ProductID'; 
$_SESSION['insurance_policy_claimsPropertyID']='PropertyID'; 
$_SESSION['insurance_policy_claimsUserID']='UserID'; 
$_SESSION['insurance_policy_claimsAgentNo']='AgentNo'; 
$_SESSION['insurance_policy_claimsDateOfLoss']='DateOfLoss'; 
//END insurance_policy_claims


//********** Starting insurance_policy_compensation***********************


$_SESSION['insurance_policy_compensationCompensationID']='CompensationID'; 
$_SESSION['insurance_policy_compensationEmployeeId']='EmployeeId'; 
$_SESSION['insurance_policy_compensationClaimID']='ClaimID'; 
$_SESSION['insurance_policy_compensationAmount']='Amount'; 
$_SESSION['insurance_policy_compensationUserID']='UserID'; 
$_SESSION['insurance_policy_compensationAgentNo']='AgentNo'; 
$_SESSION['insurance_policy_compensationeffectiveDate']='effectiveDate'; 
//END insurance_policy_compensation


//********** Starting insurance_policyrenew***********************


$_SESSION['insurance_policyrenewPolicyId']='PolicyId'; 
$_SESSION['insurance_policyrenewPolicyTypeId']='PolicyTypeId'; 
$_SESSION['insurance_policyrenewEmployeeID']='EmployeeID'; 
$_SESSION['insurance_policyrenewclientId']='clientId'; 
$_SESSION['insurance_policyrenewInsurerID']='InsurerID'; 
$_SESSION['insurance_policyrenewBusiness']='Business'; 
$_SESSION['insurance_policyrenewPolicyNumber']='PolicyNumber'; 
$_SESSION['insurance_policyrenewBasicPremium']='BasicPremium'; 
$_SESSION['insurance_policyrenewTrainingLevy']='TrainingLevy'; 
$_SESSION['insurance_policyrenewPCF']='PCF'; 
$_SESSION['insurance_policyrenewCommissionRate']='CommissionRate'; 
$_SESSION['insurance_policyrenewGeographicalArea']='GeographicalArea'; 
$_SESSION['insurance_policyrenewScope']='Scope'; 
$_SESSION['insurance_policyrenewDateInsured']='DateInsured'; 
$_SESSION['insurance_policyrenewExpiryDate']='ExpiryDate'; 
$_SESSION['insurance_policyrenewpoliycyperiod']='poliycyperiod'; 
$_SESSION['insurance_policyreneweffectiveDate']='effectiveDate'; 
//END insurance_policyrenew


//********** Starting insurance_policytype***********************


$_SESSION['insurance_policytypePolicyTypeId']='PolicyTypeId'; 
$_SESSION['insurance_policytypeEmployeeID']='EmployeeID'; 
$_SESSION['insurance_policytypeDescription']='Description'; 
$_SESSION['insurance_policytypeeffectiveDate']='effectiveDate'; 
//END insurance_policytype


//********** Starting insurance_product***********************


$_SESSION['insurance_productProductID']='ProductID'; 
$_SESSION['insurance_productProductName']='ProductName'; 
$_SESSION['insurance_productProductDescription']='ProductDescription'; 
$_SESSION['insurance_productEmployeeId']='EmployeeId'; 
$_SESSION['insurance_productAgentNo']='AgentNo'; 
//END insurance_product


//********** Starting insurance_property***********************


$_SESSION['insurance_propertyPropertyID']='PropertyID'; 
$_SESSION['insurance_propertyPropertyNumber']='PropertyNumber'; 
$_SESSION['insurance_propertyPropertyName']='PropertyName'; 
$_SESSION['insurance_propertyDescription']='Description'; 
$_SESSION['insurance_propertyLocation']='Location'; 
$_SESSION['insurance_propertyInitialValue']='InitialValue'; 
$_SESSION['insurance_propertyValueRate']='ValueRate'; 
$_SESSION['insurance_propertyClientIDOrPassportNo']='ClientIDOrPassportNo'; 
$_SESSION['insurance_propertyPolicyNo']='PolicyNo'; 
$_SESSION['insurance_propertyUserID']='UserID'; 
$_SESSION['insurance_propertyAgentNo']='AgentNo'; 
//END insurance_property


//********** Starting insurance_risks_mortorvehice***********************


$_SESSION['insurance_risks_mortorvehicemotorcnt']='motorcnt'; 
$_SESSION['insurance_risks_mortorvehicePolicyId']='PolicyId'; 
$_SESSION['insurance_risks_mortorvehiceEmployeeID']='EmployeeID'; 
$_SESSION['insurance_risks_mortorvehiceRegistrationNumber']='RegistrationNumber'; 
$_SESSION['insurance_risks_mortorvehiceMake']='Make'; 
$_SESSION['insurance_risks_mortorvehiceBodyType']='BodyType'; 
$_SESSION['insurance_risks_mortorvehiceYear']='Year'; 
$_SESSION['insurance_risks_mortorvehiceSeatingCapacity']='SeatingCapacity'; 
$_SESSION['insurance_risks_mortorvehiceInsuredEstimateValue']='InsuredEstimateValue'; 
$_SESSION['insurance_risks_mortorvehicepoliycyperiod']='poliycyperiod'; 
$_SESSION['insurance_risks_mortorvehiceeffectiveDate']='effectiveDate'; 
//END insurance_risks_mortorvehice


//********** Starting insurance_risks_policyrisks***********************


$_SESSION['insurance_risks_policyrisksRiskCnt']='RiskCnt'; 
$_SESSION['insurance_risks_policyrisksPolicyId']='PolicyId'; 
$_SESSION['insurance_risks_policyrisksEmployeeID']='EmployeeID'; 
$_SESSION['insurance_risks_policyrisksRiskDescription']='RiskDescription'; 
$_SESSION['insurance_risks_policyrisksInsuredValue']='InsuredValue'; 
$_SESSION['insurance_risks_policyriskspoliycyperiod']='poliycyperiod'; 
$_SESSION['insurance_risks_policyriskseffectiveDate']='effectiveDate'; 
//END insurance_risks_policyrisks


//********** Starting payment_payement***********************


$_SESSION['payment_payementfk_PaymentID']='fk_PaymentID'; 
$_SESSION['payment_payementfk_EmployeeID']='fk_EmployeeID'; 
$_SESSION['payment_payementfk_clientId']='fk_clientId'; 
$_SESSION['payment_payementReferenceNumber']='ReferenceNumber'; 
$_SESSION['payment_payementPaymentModeId']='PaymentModeId'; 
$_SESSION['payment_payementCategoryID']='CategoryID'; 
$_SESSION['payment_payementPaymentIDorVoucherNum']='PaymentIDorVoucherNum'; 
$_SESSION['payment_payementStatus']='Status'; 
$_SESSION['payment_payementfk_periodRef']='fk_periodRef'; 
$_SESSION['payment_payementAmount']='Amount'; 
$_SESSION['payment_payementTransactionDate']='TransactionDate'; 
//END payment_payement


//********** Starting payment_receipts***********************


$_SESSION['payment_receiptsReceiptNo']='ReceiptNo'; 
$_SESSION['payment_receiptsDepartmentId']='DepartmentId'; 
$_SESSION['payment_receiptsDescription']='Description'; 
$_SESSION['payment_receiptsAmountPaid']='AmountPaid'; 
$_SESSION['payment_receiptsAmountDue']='AmountDue'; 
$_SESSION['payment_receiptsPayment_Details']='Payment_Details'; 
$_SESSION['payment_receiptsUserID']='UserID'; 
$_SESSION['payment_receiptsAgentNo']='AgentNo'; 
$_SESSION['payment_receiptsEffective_Date']='Effective_Date'; 
//END payment_receipts


//********** Starting property_housedetails***********************


$_SESSION['property_housedetailsHouseid']='Houseid'; 
$_SESSION['property_housedetailsPropertyID']='PropertyID'; 
$_SESSION['property_housedetailsCategory']='Category'; 
$_SESSION['property_housedetailsNoOfRooms']='NoOfRooms'; 
$_SESSION['property_housedetailsWater']='Water'; 
$_SESSION['property_housedetailsElectricity']='Electricity'; 
$_SESSION['property_housedetailsStatus']='Status'; 
$_SESSION['property_housedetailsEmployeeId']='EmployeeId'; 
$_SESSION['property_housedetailsAgentNo']='AgentNo'; 
//END property_housedetails


//********** Starting property_housepayment***********************


$_SESSION['property_housepaymentPaymentNo']='PaymentNo'; 
$_SESSION['property_housepaymentReceiptNo']='ReceiptNo'; 
$_SESSION['property_housepaymentTenantID']='TenantID'; 
$_SESSION['property_housepaymentHouseCode']='HouseCode'; 
$_SESSION['property_housepaymentRent']='Rent'; 
$_SESSION['property_housepaymentDeposit']='Deposit'; 
$_SESSION['property_housepaymentDate']='Date'; 
$_SESSION['property_housepaymentUserID']='UserID'; 
$_SESSION['property_housepaymentAgentNo']='AgentNo'; 
//END property_housepayment


//********** Starting property_houseproperty***********************


$_SESSION['property_housepropertyPropertyID']='PropertyID'; 
$_SESSION['property_housepropertyOwnerID']='OwnerID'; 
$_SESSION['property_housepropertyLocation']='Location'; 
$_SESSION['property_housepropertyUserID']='UserID'; 
$_SESSION['property_housepropertyAgentNo']='AgentNo'; 
//END property_houseproperty


//********** Starting property_ownercontactdetails***********************


$_SESSION['property_ownercontactdetailsOwnerID']='OwnerID'; 
$_SESSION['property_ownercontactdetailsSurname']='Surname'; 
$_SESSION['property_ownercontactdetailsOther_Names']='Other_Names'; 
$_SESSION['property_ownercontactdetailsMobileNo']='MobileNo'; 
$_SESSION['property_ownercontactdetailsAddress']='Address'; 
$_SESSION['property_ownercontactdetailsKinID']='KinID'; 
$_SESSION['property_ownercontactdetailsKinMobileNo']='KinMobileNo'; 
$_SESSION['property_ownercontactdetailsKinName']='KinName'; 
$_SESSION['property_ownercontactdetailsBank_ID']='Bank_ID'; 
$_SESSION['property_ownercontactdetailsBank_Branch_ID']='Bank_Branch_ID'; 
$_SESSION['property_ownercontactdetailsBank_Account']='Bank_Account'; 
$_SESSION['property_ownercontactdetailsUserID']='UserID'; 
$_SESSION['property_ownercontactdetailsAgentNo']='AgentNo'; 
//END property_ownercontactdetails


//********** Starting property_tenants***********************


$_SESSION['property_tenantsTenantID']='TenantID'; 
$_SESSION['property_tenantsSurname']='Surname'; 
$_SESSION['property_tenantsOther_Names']='Other_Names'; 
$_SESSION['property_tenantsMobileNo']='MobileNo'; 
$_SESSION['property_tenantsEmailAddress']='EmailAddress'; 
$_SESSION['property_tenantsCountry_ID']='Country_ID'; 
$_SESSION['property_tenantsHouseCategory']='HouseCategory'; 
$_SESSION['property_tenantsAddress']='Address'; 
$_SESSION['property_tenantsRentRevisionDate']='RentRevisionDate'; 
$_SESSION['property_tenantsHouseCode']='HouseCode'; 
$_SESSION['property_tenantsUserID']='UserID'; 
$_SESSION['property_tenantsAgentNo']='AgentNo'; 
//END property_tenants


//end of sessions
//********** Starting agent***********************

//complex functions
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

//Generating vital functions
function buildlangfileRSVInsertsPlus($dbinuse){													
    $sql_available_tables="show tables"; 
    $results=mysql_query( $sql_available_tables);
	$cntreg=mysql_num_rows($results);  

if ($cntreg>0){ 
//print "<input type=\"text\" name=\"num_found_contacts\" value=\"$cntreg\">";                        
            while($count=mysql_fetch_array($results)){                                   
			$table_name=$count[0]; 
	echo '//********** Starting  Insert Statements  Table'.$table_name.'***********************<p><br>';  
	
echo'//initialize '."$table_name <p>";
print 'if (isset($_POST["submit_'.$table_name.'"])) {'."<p>";
echo 'Insert_'. $table_name.'_Stmt  ();';
print'}'."<p>";

print 'function Insert_'. $table_name.'_Stmt  (){'."<p>";	
print 'if (isset($_POST["submit_'.$table_name.'"])) {'."<p>";

///////////////////Build post functionalities
	
	$sqltbcols="Show columns from $table_name";   
			$results_tbc=mysql_query($sqltbcols);
	        $cnt_cols=mysql_num_rows($results_tbc); 
			echo "<p>". '// Defining Variables for '.$table_name.' Insert SQL Statement '."<p>";
			while($count_cls=mysql_fetch_array($results_tbc)){
			
			//echo '$'."_POST['".$count_cls['Field']."'];
			echo '$'.$count_cls['Field']."=".'$'."_POST['".$count_cls['Field']."'];"."<br>";
			}
			
	///////////////////	End of post
print'$insertSQL'."$table_name".' = "INSERT INTO '. $table_name  .' VALUES ( '."<p>'";

//end of initialize
			$sqltbcols="Show columns from $table_name";   
			$results_tbc=mysql_query($sqltbcols);
	        $cnt_cols=mysql_num_rows($results_tbc); 
			$numbprocessed='';
			while($count_cls=mysql_fetch_array($results_tbc)){
			
			echo '$'.$count_cls['Field'];
			
			$numbprocessedComp=$numbprocessed+1;
			
			if ($numbprocessedComp==$cnt_cols){
			
			echo"')\";<br>";
			echo '// END of Insert SQL Statement for '.$table_name."<p>";
			}else
			{echo"','";
			}
			$numbprocessed++;
			
			  $table_col_Namef=$count_cls['Field'];
			  $table_col_Type=$count_cls['Type']; 
			  $table_col_Null=$count_cls['Null'];
	

			} 
	
		

echo "<p>";		

echo '$Result1 = mysql_query($insertSQL'.$table_name.') or die(mysql_error());';

//echo 'echo'."'ppppppppppppppp'".'$insertSQL.$table_name';

echo'} //End If'."<br>";

echo'} //End function insert';

echo "<p>".'//END  of the Insert process for '.$table_name ."<p><br>";
 
} //end while
} //end if
} //end func select tables 

//end of all interts

////////////////////////Actuals

///End of actuals
?>
<?php
//All Insert Statements generated

//********** Starting Insert Statements Tableagent***********************

//initialize agent 

if (isset($_POST["submit_agent"])) {

Insert_agent_Stmt ();}

function Insert_agent_Stmt (){

if (isset($_POST["submit_agent"])) {


// Defining Variables for agent Insert SQL Statement 

$AgentNo=$_POST['AgentNo'];
$EmployeeId=$_POST['EmployeeId'];
$Name=$_POST['Name'];
$DepartmentId=$_POST['DepartmentId'];
$MobileNo=$_POST['MobileNo'];
$PostalAddress=$_POST['PostalAddress'];
$Status=$_POST['Status'];
$Effective_Date=$_POST['Effective_Date'];
$insertSQLagent = "INSERT INTO agent VALUES ( 

'$AgentNo','$EmployeeId','$Name','$DepartmentId','$MobileNo','$PostalAddress','$Status','$Effective_Date')";
// END of Insert SQL Statement for agent


$Result1 = mysql_query($insertSQLagent) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for agent


//********** Starting Insert Statements Tableattachments***********************


//initialize attachments 

if (isset($_POST["submit_attachments"])) {

Insert_attachments_Stmt ();}

function Insert_attachments_Stmt (){

if (isset($_POST["submit_attachments"])) {


// Defining Variables for attachments Insert SQL Statement 

$AttachmentID=$_POST['AttachmentID'];
$EmployeeID=$_POST['EmployeeID'];
$AttachmentName=$_POST['AttachmentName'];
$AttachmentPath=$_POST['AttachmentPath'];
$effectiveDate=$_POST['effectiveDate'];
$insertSQLattachments = "INSERT INTO attachments VALUES ( 

'$AttachmentID','$EmployeeID','$AttachmentName','$AttachmentPath','$effectiveDate')";
// END of Insert SQL Statement for attachments


$Result1 = mysql_query($insertSQLattachments) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for attachments


//********** Starting Insert Statements Tableaudit_trail***********************


//initialize audit_trail 

if (isset($_POST["submit_audit_trail"])) {

Insert_audit_trail_Stmt ();}

function Insert_audit_trail_Stmt (){

if (isset($_POST["submit_audit_trail"])) {


// Defining Variables for audit_trail Insert SQL Statement 

$user_count=$_POST['user_count'];
$user_id=$_POST['user_id'];
$transaction_date=$_POST['transaction_date'];
$activity=$_POST['activity'];
$insertSQLaudit_trail = "INSERT INTO audit_trail VALUES ( 

'$user_count','$user_id','$transaction_date','$activity')";
// END of Insert SQL Statement for audit_trail


$Result1 = mysql_query($insertSQLaudit_trail) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for audit_trail


//********** Starting Insert Statements Tablebank_branch***********************


//initialize bank_branch 

if (isset($_POST["submit_bank_branch"])) {

Insert_bank_branch_Stmt ();}

function Insert_bank_branch_Stmt (){

if (isset($_POST["submit_bank_branch"])) {


// Defining Variables for bank_branch Insert SQL Statement 

$branch_id=$_POST['branch_id'];
$EmployeeId=$_POST['EmployeeId'];
$branch_name=$_POST['branch_name'];
$bank_id=$_POST['bank_id'];
$branch_cde=$_POST['branch_cde'];
$deleted=$_POST['deleted'];
$effectiveDate=$_POST['effectiveDate'];
$insertSQLbank_branch = "INSERT INTO bank_branch VALUES ( 

'$branch_id','$EmployeeId','$branch_name','$bank_id','$branch_cde','$deleted','$effectiveDate')";
// END of Insert SQL Statement for bank_branch


$Result1 = mysql_query($insertSQLbank_branch) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for bank_branch


//********** Starting Insert Statements Tablebanks***********************


//initialize banks 

if (isset($_POST["submit_banks"])) {

Insert_banks_Stmt ();}

function Insert_banks_Stmt (){

if (isset($_POST["submit_banks"])) {


// Defining Variables for banks Insert SQL Statement 

$bank_id=$_POST['bank_id'];
$EmployeeId=$_POST['EmployeeId'];
$bank_name=$_POST['bank_name'];
$code=$_POST['code'];
$effectiveDate=$_POST['effectiveDate'];
$insertSQLbanks = "INSERT INTO banks VALUES ( 


'$bank_id','$EmployeeId','$bank_name','$code','$effectiveDate')";
// END of Insert SQL Statement for banks


$Result1 = mysql_query($insertSQLbanks) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for banks


//********** Starting Insert Statements Tablebenefits***********************


//initialize benefits 

if (isset($_POST["submit_benefits"])) {

Insert_benefits_Stmt ();}

function Insert_benefits_Stmt (){

if (isset($_POST["submit_benefits"])) {


// Defining Variables for benefits Insert SQL Statement 

$BenefitID=$_POST['BenefitID'];
$EmployeeId=$_POST['EmployeeId'];
$Description=$_POST['Description'];
$Amount=$_POST['Amount'];
$UserID=$_POST['UserID'];
$AgentNo=$_POST['AgentNo'];
$effective_dt=$_POST['effective_dt'];
$insertSQLbenefits = "INSERT INTO benefits VALUES ( 

'$BenefitID','$EmployeeId','$Description','$Amount','$UserID','$AgentNo','$effective_dt')";
// END of Insert SQL Statement for benefits


$Result1 = mysql_query($insertSQLbenefits) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for benefits


//********** Starting Insert Statements Tableclaims***********************


//initialize claims 

if (isset($_POST["submit_claims"])) {

Insert_claims_Stmt ();}

function Insert_claims_Stmt (){

if (isset($_POST["submit_claims"])) {


// Defining Variables for claims Insert SQL Statement 

$ClaimID=$_POST['ClaimID'];
$ClientIDOrPassportNo=$_POST['ClientIDOrPassportNo'];
$PolicyNo=$_POST['PolicyNo'];
$StatusOfLoss=$_POST['StatusOfLoss'];
$NatureOfLoss=$_POST['NatureOfLoss'];
$ProductID=$_POST['ProductID'];
$PropertyID=$_POST['PropertyID'];
$UserID=$_POST['UserID'];
$AgentNo=$_POST['AgentNo'];
$DateOfLoss=$_POST['DateOfLoss'];
$insertSQLclaims = "INSERT INTO claims VALUES ( 

'$ClaimID','$ClientIDOrPassportNo','$PolicyNo','$StatusOfLoss','$NatureOfLoss','$ProductID','$PropertyID','$UserID','$AgentNo','$DateOfLoss')";
// END of Insert SQL Statement for claims


$Result1 = mysql_query($insertSQLclaims) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for claims


//********** Starting Insert Statements Tablecompany***********************


//initialize company 

if (isset($_POST["submit_company"])) {

Insert_company_Stmt ();}

function Insert_company_Stmt (){

if (isset($_POST["submit_company"])) {


// Defining Variables for company Insert SQL Statement 

$company_id=$_POST['company_id'];
$EmployeeId=$_POST['EmployeeId'];
$name=$_POST['name'];
$pin_number=$_POST['pin_number'];
$vat_number=$_POST['vat_number'];
$incorp_date=$_POST['incorp_date'];
$effective_dt=$_POST['effective_dt'];
$insertSQLcompany = "INSERT INTO company VALUES ( 

'$company_id','$EmployeeId','$name','$pin_number','$vat_number','$incorp_date','$effective_dt')";
// END of Insert SQL Statement for company


$Result1 = mysql_query($insertSQLcompany) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for company


//********** Starting Insert Statements Tablecompanyinscommission***********************


//initialize companyinscommission 

if (isset($_POST["submit_companyinscommission"])) {

Insert_companyinscommission_Stmt ();}

function Insert_companyinscommission_Stmt (){

if (isset($_POST["submit_companyinscommission"])) {


// Defining Variables for companyinscommission Insert SQL Statement 

$CommId=$_POST['CommId'];
$EmployeeId=$_POST['EmployeeId'];
$AgentNo=$_POST['AgentNo'];
$clientID=$_POST['clientID'];
$ComRate=$_POST['ComRate'];
$StartDate=$_POST['StartDate'];
$EndDate=$_POST['EndDate'];
$recursive=$_POST['recursive'];
$occurance=$_POST['occurance'];
$status=$_POST['status'];
$Effective_Date=$_POST['Effective_Date'];
$insertSQLcompanyinscommission = "INSERT INTO companyinscommission VALUES ( 

'$CommId','$EmployeeId','$AgentNo','$clientID','$ComRate','$StartDate','$EndDate','$recursive','$occurance','$status','$Effective_Date')";
// END of Insert SQL Statement for companyinscommission


$Result1 = mysql_query($insertSQLcompanyinscommission) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for companyinscommission


//********** Starting Insert Statements Tablecompensation***********************


//initialize compensation 

if (isset($_POST["submit_compensation"])) {

Insert_compensation_Stmt ();}

function Insert_compensation_Stmt (){

if (isset($_POST["submit_compensation"])) {


// Defining Variables for compensation Insert SQL Statement 

$CompensationID=$_POST['CompensationID'];
$EmployeeId=$_POST['EmployeeId'];
$ClaimID=$_POST['ClaimID'];
$Amount=$_POST['Amount'];
$UserID=$_POST['UserID'];
$AgentNo=$_POST['AgentNo'];
$effectiveDate=$_POST['effectiveDate'];
$insertSQLcompensation = "INSERT INTO compensation VALUES ( 

'$CompensationID','$EmployeeId','$ClaimID','$Amount','$UserID','$AgentNo','$effectiveDate')";
// END of Insert SQL Statement for compensation


$Result1 = mysql_query($insertSQLcompensation) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for compensation


//********** Starting Insert Statements Tableemployee***********************


//initialize employee 

if (isset($_POST["submit_employee"])) {

Insert_employee_Stmt ();}

function Insert_employee_Stmt (){

if (isset($_POST["submit_employee"])) {


// Defining Variables for employee Insert SQL Statement 

$EmployeeId=$_POST['EmployeeId'];
$savedby=$_POST['savedby'];
$EmpNo=$_POST['EmpNo'];
$Employee_Number=$_POST['Employee_Number'];
$Surname=$_POST['Surname'];
$Other_Names=$_POST['Other_Names'];
$DepartmentId=$_POST['DepartmentId'];
$PhoneNumber=$_POST['PhoneNumber'];
$otherPhoneNumber=$_POST['otherPhoneNumber'];
$PostalAddress=$_POST['PostalAddress'];
$postalCode=$_POST['postalCode'];
$Town=$_POST['Town'];
$Status=$_POST['Status'];
$Effective_Date=$_POST['Effective_Date'];
$insertSQLemployee = "INSERT INTO employee VALUES ( 

'$EmployeeId','$savedby','$EmpNo','$Employee_Number','$Surname','$Other_Names','$DepartmentId','$PhoneNumber','$otherPhoneNumber','$PostalAddress','$postalCode','$Town','$Status','$Effective_Date')";
// END of Insert SQL Statement for employee


$Result1 = mysql_query($insertSQLemployee) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for employee


//********** Starting Insert Statements Tablehousedetails***********************


//initialize housedetails 

if (isset($_POST["submit_housedetails"])) {

Insert_housedetails_Stmt ();}

function Insert_housedetails_Stmt (){

if (isset($_POST["submit_housedetails"])) {


// Defining Variables for housedetails Insert SQL Statement 

$Houseid=$_POST['Houseid'];
$PropertyID=$_POST['PropertyID'];
$Category=$_POST['Category'];
$NoOfRooms=$_POST['NoOfRooms'];
$Water=$_POST['Water'];
$Electricity=$_POST['Electricity'];
$Status=$_POST['Status'];
$EmployeeId=$_POST['EmployeeId'];
$AgentNo=$_POST['AgentNo'];
$insertSQLhousedetails = "INSERT INTO housedetails VALUES ( 

'$Houseid','$PropertyID','$Category','$NoOfRooms','$Water','$Electricity','$Status','$EmployeeId','$AgentNo')";
// END of Insert SQL Statement for housedetails


$Result1 = mysql_query($insertSQLhousedetails) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for housedetails


//********** Starting Insert Statements Tablehousepayment***********************


//initialize housepayment 

if (isset($_POST["submit_housepayment"])) {

Insert_housepayment_Stmt ();}

function Insert_housepayment_Stmt (){

if (isset($_POST["submit_housepayment"])) {


// Defining Variables for housepayment Insert SQL Statement 

$PaymentNo=$_POST['PaymentNo'];
$ReceiptNo=$_POST['ReceiptNo'];
$TenantID=$_POST['TenantID'];
$HouseCode=$_POST['HouseCode'];
$Rent=$_POST['Rent'];
$Deposit=$_POST['Deposit'];
$Date=$_POST['Date'];
$UserID=$_POST['UserID'];
$AgentNo=$_POST['AgentNo'];
$insertSQLhousepayment = "INSERT INTO housepayment VALUES ( 

'$PaymentNo','$ReceiptNo','$TenantID','$HouseCode','$Rent','$Deposit','$Date','$UserID','$AgentNo')";
// END of Insert SQL Statement for housepayment


$Result1 = mysql_query($insertSQLhousepayment) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for housepayment


//********** Starting Insert Statements Tablehouseproperty***********************


//initialize houseproperty 

if (isset($_POST["submit_houseproperty"])) {

Insert_houseproperty_Stmt ();}

function Insert_houseproperty_Stmt (){

if (isset($_POST["submit_houseproperty"])) {


// Defining Variables for houseproperty Insert SQL Statement 

$PropertyID=$_POST['PropertyID'];
$OwnerID=$_POST['OwnerID'];
$Location=$_POST['Location'];
$UserID=$_POST['UserID'];
$AgentNo=$_POST['AgentNo'];
$insertSQLhouseproperty = "INSERT INTO houseproperty VALUES ( 

'$PropertyID','$OwnerID','$Location','$UserID','$AgentNo')";
// END of Insert SQL Statement for houseproperty


$Result1 = mysql_query($insertSQLhouseproperty) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for houseproperty


//********** Starting Insert Statements Tableinsuranceaccount***********************


//initialize insuranceaccount 

if (isset($_POST["submit_insuranceaccount"])) {

Insert_insuranceaccount_Stmt ();}

function Insert_insuranceaccount_Stmt (){

if (isset($_POST["submit_insuranceaccount"])) {


// Defining Variables for insuranceaccount Insert SQL Statement 

$accountId=$_POST['accountId'];
$EmployeeId=$_POST['EmployeeId'];
$InsurerID=$_POST['InsurerID'];
$bank_id=$_POST['bank_id'];
$branch_id=$_POST['branch_id'];
$AccountNumber=$_POST['AccountNumber'];
$AgentNo=$_POST['AgentNo'];
$insertSQLinsuranceaccount = "INSERT INTO insuranceaccount VALUES ( 

'$accountId','$EmployeeId','$InsurerID','$bank_id','$branch_id','$AccountNumber','$AgentNo')";
// END of Insert SQL Statement for insuranceaccount


$Result1 = mysql_query($insertSQLinsuranceaccount) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for insuranceaccount


//********** Starting Insert Statements Tableinsuranceagentcommission***********************


//initialize insuranceagentcommission 

if (isset($_POST["submit_insuranceagentcommission"])) {

Insert_insuranceagentcommission_Stmt ();}

function Insert_insuranceagentcommission_Stmt (){

if (isset($_POST["submit_insuranceagentcommission"])) {


// Defining Variables for insuranceagentcommission Insert SQL Statement 

$CommId=$_POST['CommId'];
$EmployeeId=$_POST['EmployeeId'];
$agentcomRate=$_POST['agentcomRate'];
$clientID=$_POST['clientID'];
$StartDate=$_POST['StartDate'];
$EndDate=$_POST['EndDate'];
$recursive=$_POST['recursive'];
$occurance=$_POST['occurance'];
$AgentNo=$_POST['AgentNo'];
$Effective_Date=$_POST['Effective_Date'];
$insertSQLinsuranceagentcommission = "INSERT INTO insuranceagentcommission VALUES ( 

'$CommId','$EmployeeId','$agentcomRate','$clientID','$StartDate','$EndDate','$recursive','$occurance','$AgentNo','$Effective_Date')";
// END of Insert SQL Statement for insuranceagentcommission


$Result1 = mysql_query($insertSQLinsuranceagentcommission) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for insuranceagentcommission


//********** Starting Insert Statements Tableinsuranceclient***********************


//initialize insuranceclient 

if (isset($_POST["submit_insuranceclient"])) {

Insert_insuranceclient_Stmt ();}

function Insert_insuranceclient_Stmt (){

if (isset($_POST["submit_insuranceclient"])) {


// Defining Variables for insuranceclient Insert SQL Statement 

$clientId=$_POST['clientId'];
$EmployeeId=$_POST['EmployeeId'];
$Name=$_POST['Name'];
$Profession=$_POST['Profession'];
$IDOrPassportNo=$_POST['IDOrPassportNo'];
$Mobile_Number=$_POST['Mobile_Number'];
$OtherPhoneNumbers=$_POST['OtherPhoneNumbers'];
$Postal_Address=$_POST['Postal_Address'];
$Postal_Code=$_POST['Postal_Code'];
$Town=$_POST['Town'];
$Email_Address=$_POST['Email_Address'];
$TransactionDate=$_POST['TransactionDate'];
$insertSQLinsuranceclient = "INSERT INTO insuranceclient VALUES ( 

'$clientId','$EmployeeId','$Name','$Profession','$IDOrPassportNo','$Mobile_Number','$OtherPhoneNumbers','$Postal_Address','$Postal_Code','$Town','$Email_Address','$TransactionDate')";
// END of Insert SQL Statement for insuranceclient


$Result1 = mysql_query($insertSQLinsuranceclient) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for insuranceclient


//********** Starting Insert Statements Tableinsurancepayement***********************


//initialize insurancepayement 

if (isset($_POST["submit_insurancepayement"])) {

Insert_insurancepayement_Stmt ();}

function Insert_insurancepayement_Stmt (){

if (isset($_POST["submit_insurancepayement"])) {


// Defining Variables for insurancepayement Insert SQL Statement 

$fk_PaymentID=$_POST['fk_PaymentID'];
$fk_EmployeeID=$_POST['fk_EmployeeID'];
$fk_clientId=$_POST['fk_clientId'];
$ReferenceNumber=$_POST['ReferenceNumber'];
$PaymentModeId=$_POST['PaymentModeId'];
$CategoryID=$_POST['CategoryID'];
$PaymentIDorVoucherNum=$_POST['PaymentIDorVoucherNum'];
$Status=$_POST['Status'];
$fk_periodRef=$_POST['fk_periodRef'];
$Amount=$_POST['Amount'];
$TransactionDate=$_POST['TransactionDate'];
$insertSQLinsurancepayement = "INSERT INTO insurancepayement VALUES ( 

'$fk_PaymentID','$fk_EmployeeID','$fk_clientId','$ReferenceNumber','$PaymentModeId','$CategoryID','$PaymentIDorVoucherNum','$Status','$fk_periodRef','$Amount','$TransactionDate')";
// END of Insert SQL Statement for insurancepayement


$Result1 = mysql_query($insertSQLinsurancepayement) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for insurancepayement


//********** Starting Insert Statements Tableinsurancepolicy***********************


//initialize insurancepolicy 

if (isset($_POST["submit_insurancepolicy"])) {

Insert_insurancepolicy_Stmt ();}

function Insert_insurancepolicy_Stmt (){

if (isset($_POST["submit_insurancepolicy"])) {


// Defining Variables for insurancepolicy Insert SQL Statement 

$PolicyId=$_POST['PolicyId'];
$PolicyTypeId=$_POST['PolicyTypeId'];
$EmployeeID=$_POST['EmployeeID'];
$clientId=$_POST['clientId'];
$InsurerID=$_POST['InsurerID'];
$Business=$_POST['Business'];
$PolicyNumber=$_POST['PolicyNumber'];
$BasicPremium=$_POST['BasicPremium'];
$TrainingLevy=$_POST['TrainingLevy'];
$PCF=$_POST['PCF'];
$CommissionRate=$_POST['CommissionRate'];
$GeographicalArea=$_POST['GeographicalArea'];
$Scope=$_POST['Scope'];
$DateInsured=$_POST['DateInsured'];
$ExpiryDate=$_POST['ExpiryDate'];
$effectiveDate=$_POST['effectiveDate'];
$insertSQLinsurancepolicy = "INSERT INTO insurancepolicy VALUES ( 

'$PolicyId','$PolicyTypeId','$EmployeeID','$clientId','$InsurerID','$Business','$PolicyNumber','$BasicPremium','$TrainingLevy','$PCF','$CommissionRate','$GeographicalArea','$Scope','$DateInsured','$ExpiryDate','$effectiveDate')";
// END of Insert SQL Statement for insurancepolicy


$Result1 = mysql_query($insertSQLinsurancepolicy) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for insurancepolicy


//********** Starting Insert Statements Tableinsurancepolicyrenew***********************


//initialize insurancepolicyrenew 

if (isset($_POST["submit_insurancepolicyrenew"])) {

Insert_insurancepolicyrenew_Stmt ();}

function Insert_insurancepolicyrenew_Stmt (){

if (isset($_POST["submit_insurancepolicyrenew"])) {


// Defining Variables for insurancepolicyrenew Insert SQL Statement 

$PolicyId=$_POST['PolicyId'];
$PolicyTypeId=$_POST['PolicyTypeId'];
$EmployeeID=$_POST['EmployeeID'];
$clientId=$_POST['clientId'];
$InsurerID=$_POST['InsurerID'];
$Business=$_POST['Business'];
$PolicyNumber=$_POST['PolicyNumber'];
$BasicPremium=$_POST['BasicPremium'];
$TrainingLevy=$_POST['TrainingLevy'];
$PCF=$_POST['PCF'];
$CommissionRate=$_POST['CommissionRate'];
$GeographicalArea=$_POST['GeographicalArea'];
$Scope=$_POST['Scope'];
$DateInsured=$_POST['DateInsured'];
$ExpiryDate=$_POST['ExpiryDate'];
$poliycyperiod=$_POST['poliycyperiod'];
$effectiveDate=$_POST['effectiveDate'];
$insertSQLinsurancepolicyrenew = "INSERT INTO insurancepolicyrenew VALUES ( 

'$PolicyId','$PolicyTypeId','$EmployeeID','$clientId','$InsurerID','$Business','$PolicyNumber','$BasicPremium','$TrainingLevy','$PCF','$CommissionRate','$GeographicalArea','$Scope','$DateInsured','$ExpiryDate','$poliycyperiod','$effectiveDate')";
// END of Insert SQL Statement for insurancepolicyrenew


$Result1 = mysql_query($insertSQLinsurancepolicyrenew) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for insurancepolicyrenew


//********** Starting Insert Statements Tableinsurancepolicytype***********************


//initialize insurancepolicytype 

if (isset($_POST["submit_insurancepolicytype"])) {

Insert_insurancepolicytype_Stmt ();}

function Insert_insurancepolicytype_Stmt (){

if (isset($_POST["submit_insurancepolicytype"])) {


// Defining Variables for insurancepolicytype Insert SQL Statement 

$PolicyTypeId=$_POST['PolicyTypeId'];
$EmployeeID=$_POST['EmployeeID'];
$Description=$_POST['Description'];
$effectiveDate=$_POST['effectiveDate'];
$insertSQLinsurancepolicytype = "INSERT INTO insurancepolicytype VALUES ( 

'$PolicyTypeId','$EmployeeID','$Description','$effectiveDate')";
// END of Insert SQL Statement for insurancepolicytype


$Result1 = mysql_query($insertSQLinsurancepolicytype) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for insurancepolicytype


//********** Starting Insert Statements Tableinsuranceproperty***********************


//initialize insuranceproperty 

if (isset($_POST["submit_insuranceproperty"])) {

Insert_insuranceproperty_Stmt ();}

function Insert_insuranceproperty_Stmt (){

if (isset($_POST["submit_insuranceproperty"])) {


// Defining Variables for insuranceproperty Insert SQL Statement 

$PropertyID=$_POST['PropertyID'];
$PropertyNumber=$_POST['PropertyNumber'];
$PropertyName=$_POST['PropertyName'];
$Description=$_POST['Description'];
$Location=$_POST['Location'];
$InitialValue=$_POST['InitialValue'];
$ValueRate=$_POST['ValueRate'];
$ClientIDOrPassportNo=$_POST['ClientIDOrPassportNo'];
$PolicyNo=$_POST['PolicyNo'];
$UserID=$_POST['UserID'];
$AgentNo=$_POST['AgentNo'];
$insertSQLinsuranceproperty = "INSERT INTO insuranceproperty VALUES ( 

'$PropertyID','$PropertyNumber','$PropertyName','$Description','$Location','$InitialValue','$ValueRate','$ClientIDOrPassportNo','$PolicyNo','$UserID','$AgentNo')";
// END of Insert SQL Statement for insuranceproperty


$Result1 = mysql_query($insertSQLinsuranceproperty) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for insuranceproperty


//********** Starting Insert Statements Tableinsurer***********************


//initialize insurer 

if (isset($_POST["submit_insurer"])) {

Insert_insurer_Stmt ();}

function Insert_insurer_Stmt (){

if (isset($_POST["submit_insurer"])) {


// Defining Variables for insurer Insert SQL Statement 

$InsurerID=$_POST['InsurerID'];
$EmployeeId=$_POST['EmployeeId'];
$Insurer=$_POST['Insurer'];
$Bank_ID=$_POST['Bank_ID'];
$Bank_Branch_ID=$_POST['Bank_Branch_ID'];
$AccountNumber=$_POST['AccountNumber'];
$PostalAddress=$_POST['PostalAddress'];
$PostalCode=$_POST['PostalCode'];
$PhysicalAddress=$_POST['PhysicalAddress'];
$Town=$_POST['Town'];
$ContactPerson=$_POST['ContactPerson'];
$ContactPersonPhone=$_POST['ContactPersonPhone'];
$ContactPersonEmail=$_POST['ContactPersonEmail'];
$effectiveDate=$_POST['effectiveDate'];
$insertSQLinsurer = "INSERT INTO insurer VALUES ( 

'$InsurerID','$EmployeeId','$Insurer','$Bank_ID','$Bank_Branch_ID','$AccountNumber','$PostalAddress','$PostalCode','$PhysicalAddress','$Town','$ContactPerson','$ContactPersonPhone','$ContactPersonEmail','$effectiveDate')";
// END of Insert SQL Statement for insurer


$Result1 = mysql_query($insertSQLinsurer) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for insurer


//********** Starting Insert Statements Tableinsurerpayment***********************


//initialize insurerpayment 

if (isset($_POST["submit_insurerpayment"])) {

Insert_insurerpayment_Stmt ();}

function Insert_insurerpayment_Stmt (){

if (isset($_POST["submit_insurerpayment"])) {


// Defining Variables for insurerpayment Insert SQL Statement 

$PaymentID=$_POST['PaymentID'];
$EmployeeID=$_POST['EmployeeID'];
$clientId=$_POST['clientId'];
$ReferenceNumber=$_POST['ReferenceNumber'];
$PaymentModeId=$_POST['PaymentModeId'];
$CategoryID=$_POST['CategoryID'];
$PaymentIDorVoucherNum=$_POST['PaymentIDorVoucherNum'];
$Status=$_POST['Status'];
$periodRef=$_POST['periodRef'];
$Amount=$_POST['Amount'];
$TransactionDate=$_POST['TransactionDate'];
$insertSQLinsurerpayment = "INSERT INTO insurerpayment VALUES ( 

'$PaymentID','$EmployeeID','$clientId','$ReferenceNumber','$PaymentModeId','$CategoryID','$PaymentIDorVoucherNum','$Status','$periodRef','$Amount','$TransactionDate')";
// END of Insert SQL Statement for insurerpayment


$Result1 = mysql_query($insertSQLinsurerpayment) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for insurerpayment


//********** Starting Insert Statements Tablemortorvehice***********************


//initialize mortorvehice 

if (isset($_POST["submit_mortorvehice"])) {

Insert_mortorvehice_Stmt ();}

function Insert_mortorvehice_Stmt (){

if (isset($_POST["submit_mortorvehice"])) {


// Defining Variables for mortorvehice Insert SQL Statement 

$motorcnt=$_POST['motorcnt'];
$PolicyId=$_POST['PolicyId'];
$EmployeeID=$_POST['EmployeeID'];
$RegistrationNumber=$_POST['RegistrationNumber'];
$Make=$_POST['Make'];
$BodyType=$_POST['BodyType'];
$Year=$_POST['Year'];
$SeatingCapacity=$_POST['SeatingCapacity'];
$InsuredEstimateValue=$_POST['InsuredEstimateValue'];
$poliycyperiod=$_POST['poliycyperiod'];
$effectiveDate=$_POST['effectiveDate'];
$insertSQLmortorvehice = "INSERT INTO mortorvehice VALUES ( 

'$motorcnt','$PolicyId','$EmployeeID','$RegistrationNumber','$Make','$BodyType','$Year','$SeatingCapacity','$InsuredEstimateValue','$poliycyperiod','$effectiveDate')";
// END of Insert SQL Statement for mortorvehice


$Result1 = mysql_query($insertSQLmortorvehice) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for mortorvehice


//********** Starting Insert Statements Tableownercontactdetails***********************


//initialize ownercontactdetails 

if (isset($_POST["submit_ownercontactdetails"])) {

Insert_ownercontactdetails_Stmt ();}

function Insert_ownercontactdetails_Stmt (){

if (isset($_POST["submit_ownercontactdetails"])) {


// Defining Variables for ownercontactdetails Insert SQL Statement 

$OwnerID=$_POST['OwnerID'];
$Surname=$_POST['Surname'];
$Other_Names=$_POST['Other_Names'];
$MobileNo=$_POST['MobileNo'];
$Address=$_POST['Address'];
$KinID=$_POST['KinID'];
$KinMobileNo=$_POST['KinMobileNo'];
$KinName=$_POST['KinName'];
$Bank_ID=$_POST['Bank_ID'];
$Bank_Branch_ID=$_POST['Bank_Branch_ID'];
$Bank_Account=$_POST['Bank_Account'];
$UserID=$_POST['UserID'];
$AgentNo=$_POST['AgentNo'];
$insertSQLownercontactdetails = "INSERT INTO ownercontactdetails VALUES ( 

'$OwnerID','$Surname','$Other_Names','$MobileNo','$Address','$KinID','$KinMobileNo','$KinName','$Bank_ID','$Bank_Branch_ID','$Bank_Account','$UserID','$AgentNo')";
// END of Insert SQL Statement for ownercontactdetails


$Result1 = mysql_query($insertSQLownercontactdetails) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for ownercontactdetails


//********** Starting Insert Statements Tablepolicyrisks***********************


//initialize policyrisks 

if (isset($_POST["submit_policyrisks"])) {

Insert_policyrisks_Stmt ();}

function Insert_policyrisks_Stmt (){

if (isset($_POST["submit_policyrisks"])) {


// Defining Variables for policyrisks Insert SQL Statement 

$RiskCnt=$_POST['RiskCnt'];
$PolicyId=$_POST['PolicyId'];
$EmployeeID=$_POST['EmployeeID'];
$RiskDescription=$_POST['RiskDescription'];
$InsuredValue=$_POST['InsuredValue'];
$poliycyperiod=$_POST['poliycyperiod'];
$effectiveDate=$_POST['effectiveDate'];
$insertSQLpolicyrisks = "INSERT INTO policyrisks VALUES ( 

'$RiskCnt','$PolicyId','$EmployeeID','$RiskDescription','$InsuredValue','$poliycyperiod','$effectiveDate')";
// END of Insert SQL Statement for policyrisks


$Result1 = mysql_query($insertSQLpolicyrisks) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for policyrisks


//********** Starting Insert Statements Tableproduct***********************


//initialize product 

if (isset($_POST["submit_product"])) {

Insert_product_Stmt ();}

function Insert_product_Stmt (){

if (isset($_POST["submit_product"])) {


// Defining Variables for product Insert SQL Statement 

$ProductID=$_POST['ProductID'];
$ProductName=$_POST['ProductName'];
$UserID=$_POST['UserID'];
$AgentNo=$_POST['AgentNo'];
$insertSQLproduct = "INSERT INTO product VALUES ( 

'$ProductID','$ProductName','$UserID','$AgentNo')";
// END of Insert SQL Statement for product


$Result1 = mysql_query($insertSQLproduct) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for product


//********** Starting Insert Statements Tablereceipts***********************


//initialize receipts 

if (isset($_POST["submit_receipts"])) {

Insert_receipts_Stmt ();}

function Insert_receipts_Stmt (){

if (isset($_POST["submit_receipts"])) {


// Defining Variables for receipts Insert SQL Statement 

$ReceiptNo=$_POST['ReceiptNo'];
$DepartmentId=$_POST['DepartmentId'];
$Description=$_POST['Description'];
$Effective_Date=$_POST['Effective_Date'];
$AmountPaid=$_POST['AmountPaid'];
$AmountDue=$_POST['AmountDue'];
$Payment_Details=$_POST['Payment_Details'];
$UserID=$_POST['UserID'];
$AgentNo=$_POST['AgentNo'];
$insertSQLreceipts = "INSERT INTO receipts VALUES ( 

'$ReceiptNo','$DepartmentId','$Description','$Effective_Date','$AmountPaid','$AmountDue','$Payment_Details','$UserID','$AgentNo')";
// END of Insert SQL Statement for receipts


$Result1 = mysql_query($insertSQLreceipts) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for receipts


//********** Starting Insert Statements Tablesysattachments***********************


//initialize sysattachments 

if (isset($_POST["submit_sysattachments"])) {

Insert_sysattachments_Stmt ();}

function Insert_sysattachments_Stmt (){

if (isset($_POST["submit_sysattachments"])) {


// Defining Variables for sysattachments Insert SQL Statement 

$Attachmentcnt=$_POST['Attachmentcnt'];
$AttachmentID=$_POST['AttachmentID'];
$EmployeeID=$_POST['EmployeeID'];
$AttachmentRelatedTo=$_POST['AttachmentRelatedTo'];
$effectiveDate=$_POST['effectiveDate'];
$insertSQLsysattachments = "INSERT INTO sysattachments VALUES ( 

'$Attachmentcnt','$AttachmentID','$EmployeeID','$AttachmentRelatedTo','$effectiveDate')";
// END of Insert SQL Statement for sysattachments


$Result1 = mysql_query($insertSQLsysattachments) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for sysattachments


//********** Starting Insert Statements Tabletenants***********************


//initialize tenants 

if (isset($_POST["submit_tenants"])) {

Insert_tenants_Stmt ();}

function Insert_tenants_Stmt (){

if (isset($_POST["submit_tenants"])) {


// Defining Variables for tenants Insert SQL Statement 

$TenantID=$_POST['TenantID'];
$Surname=$_POST['Surname'];
$Other_Names=$_POST['Other_Names'];
$MobileNo=$_POST['MobileNo'];
$EmailAddress=$_POST['EmailAddress'];
$Country_ID=$_POST['Country_ID'];
$HouseCategory=$_POST['HouseCategory'];
$Address=$_POST['Address'];
$RentRevisionDate=$_POST['RentRevisionDate'];
$HouseCode=$_POST['HouseCode'];
$UserID=$_POST['UserID'];
$AgentNo=$_POST['AgentNo'];
$insertSQLtenants = "INSERT INTO tenants VALUES ( 

'$TenantID','$Surname','$Other_Names','$MobileNo','$EmailAddress','$Country_ID','$HouseCategory','$Address','$RentRevisionDate','$HouseCode','$UserID','$AgentNo')";
// END of Insert SQL Statement for tenants


$Result1 = mysql_query($insertSQLtenants) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for tenants


//********** Starting Insert Statements Tableuser***********************


//initialize user 

if (isset($_POST["submit_user"])) {

Insert_user_Stmt ();}

function Insert_user_Stmt (){

if (isset($_POST["submit_user"])) {


// Defining Variables for user Insert SQL Statement 

$id=$_POST['id'];
$user_id=$_POST['user_id'];
$user_password=$_POST['user_password'];
$Name=$_POST['Name'];
$user_priviledge=$_POST['user_priviledge'];
$security_question=$_POST['security_question'];
$security_q_answer=$_POST['security_q_answer'];
$user_active_status=$_POST['user_active_status'];
$effective_dt=$_POST['effective_dt'];
$insertSQLuser = "INSERT INTO user VALUES ( 

'$id','$user_id','$user_password','$Name','$user_priviledge','$security_question','$security_q_answer','$user_active_status','$effective_dt')";
// END of Insert SQL Statement for user


$Result1 = mysql_query($insertSQLuser) or die(mysql_error());} //End If
} //End function insert

//END of the Insert process for user

//END of the Insert statements for user


?>
<?php
//dynamic table
///working list table function
function displayallrecs($datatablelisted,$linkTID,$editpageTo,$viewpageTo,$field2,
$searchfieldDetails){
$currentPage = $_SERVER["PHP_SELF"];
$image1="<img src=\"../template/images/comment.gif\" alt=\"\" />";
$image2="<img src=\"../template/images/timeicon.gif\" alt=\"\" />";
$maxRows_RecordsetSearch = 10;
$pageNum_RecordsetSearch = 0;
if (isset($_GET['pageNum_RecordsetSearch'])) {
  $pageNum_RecordsetSearch = $_GET['pageNum_RecordsetSearch'];
}


if (isset($_POST["seach$datatablelisted"])){

if (isset($_POST["$searchfieldDetails"])){
  $searchfieldDetailsModifier = strtoupper($_POST["$searchfieldDetails"]);
  $searchfieldDetailsModifier='WHERE ucase('.$searchfieldDetails .") Like '%$searchfieldDetailsModifier%'";
}
}


$startRow_RecordsetSearch = $pageNum_RecordsetSearch * $maxRows_RecordsetSearch;
$query_RecordsetSearch = "SELECT * FROM $datatablelisted $searchfieldDetailsModifier";
$query_limit_RecordsetSearch = sprintf("%s LIMIT %d, %d", $query_RecordsetSearch, $startRow_RecordsetSearch, $maxRows_RecordsetSearch);

$RecordsetSearch = mysql_query($query_limit_RecordsetSearch) or die(mysql_error());
$row_RecordsetSearch = mysql_fetch_assoc($RecordsetSearch);

if (isset($_GET['totalRows_RecordsetSearch'])) {
  $totalRows_RecordsetSearch = $_GET['totalRows_RecordsetSearch'];
} else {
  $all_RecordsetSearch = mysql_query($query_RecordsetSearch);
  $totalRows_RecordsetSearch = mysql_num_rows($all_RecordsetSearch);
}
$totalPages_RecordsetSearch = ceil($totalRows_RecordsetSearch/$maxRows_RecordsetSearch)-1;

$queryString_RecordsetSearch = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecordsetSearch") == false && 
        stristr($param, "totalRows_RecordsetSearch") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordsetSearch = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordsetSearch = sprintf("&totalRows_RecordsetSearch=%d%s", $totalRows_RecordsetSearch, $queryString_RecordsetSearch);
?>
<form action="" method="post">
  <div align="left">
<table width="400" border="0">
  <tr>
  
    <td><table border="0" width="400" align="left">
	
      <tr>
        <th colspan="4"><p class="date"> Search <?php echo $_SESSION["$datatablelisted"];?> details</p></th>
		 <tr>
        <td >&nbsp;</td>
      
            <td >
              <?php  echo  $_SESSION["$datatablelisted$searchfieldDetails"];
			  echo " <input size=\"32\"  type=\"text\" name=\"$searchfieldDetails\" />";?>
             <td > 
              
            <?php  echo " <input type=\"submit\" name=\"seach$datatablelisted\" value=\"Find\"/>" ;
			?></td>
          </tr>
		  <tr align="left"> <td colspan="4"> <p align="left" class="date"><?php echo $_SESSION["$datatablelisted"];?></p></td></tr>
		  <tr > <th colspan="2" align="left"> <?php echo $_SESSION["$datatablelisted"];?></th>
		  <th align="left">View</th>
		  <th align="left">Edit</th></tr>
		  </tr>
      <?php do { ?>
          
          <tr>
       
		
        <td colspan="2"><?php 
		
		if(isset($row_RecordsetSearch["$field2"])){
		$field2ext=' - '.$row_RecordsetSearch["$field2"];
		} echo $image1.$row_RecordsetSearch['Name'].$field2ext; ?></td>
        
		
<?php 

//Links
/*print"<td>".$image2;
print"<a href=".$viewpageTo.".php?q=".base64_encode($row_RecordsetSearch["$linkTID"])."\">View</a> ";*/
print " </td>";
print"<td>".$image2."<a href=".$viewpageTo.".php?q=";print base64_encode($row_RecordsetSearch["$linkTID"]).">View</a></td>";

print"<td>".$image2."<a href=".$editpageTo.".php?q=";print base64_encode($row_RecordsetSearch["$linkTID"]).">Edit</a></td>";			
			
echo "</tr>";?>
      </tr>
     
      </tr>
      <?php } while ($row_RecordsetSearch = mysql_fetch_assoc($RecordsetSearch)); ?>
    </table></td></div></td>
  </tr>
  <tr>
    <td height="74">
	
	<p class="date">&nbsp;</p>
	<table border="0" width="20%" align="right">
  <tr>
    <td width="23%" align="center"><?php if ($pageNum_RecordsetSearch > 0) { // Show if not first page
	 ?>
          <a href="<?php printf("%s?pageNum_RecordsetSearch=%d%s", $currentPage, 0, $queryString_RecordsetSearch); ?>"><img src="../template/images/First.gif" border=0></a>
          <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center"><?php if ($pageNum_RecordsetSearch > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_RecordsetSearch=%d%s", $currentPage, max(0, $pageNum_RecordsetSearch - 1), $queryString_RecordsetSearch); ?>"><img src="../template/images/Previous.gif" border=0></a>
          <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_RecordsetSearch < $totalPages_RecordsetSearch) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_RecordsetSearch=%d%s", $currentPage, min($totalPages_RecordsetSearch, $pageNum_RecordsetSearch + 1), $queryString_RecordsetSearch); ?>"><img src="../template/images/Next.gif" border=0></a>
          <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_RecordsetSearch < $totalPages_RecordsetSearch) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_RecordsetSearch=%d%s", $currentPage, $totalPages_RecordsetSearch, $queryString_RecordsetSearch); ?>"><img src="../template/images/Last.gif" border=0></a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table></td>
  </tr>
</table>
<p> Records <?php echo ($startRow_RecordsetSearch + 1) ?> to <?php echo min($startRow_RecordsetSearch + $maxRows_RecordsetSearch, $totalRows_RecordsetSearch) ?> of <?php echo $totalRows_RecordsetSearch ?></p>
</form>

<?php
mysql_free_result($RecordsetSearch);
}
?>
<?php 
//******************************Active Update Statements*********************

//********** Starting Update Statements Tableagent***********************

function Update_agent_Stmt (){

if (isset($_POST["Update_agent"])) {


// Defining Variables for agent Update SQL Statement 

$AgentNo=$_POST['AgentNo'];
$EmployeeId=$_POST['EmployeeId'];
$Name=$_POST['Name'];
$DepartmentId=$_POST['DepartmentId'];
$MobileNo=$_POST['MobileNo'];
$PostalAddress=$_POST['PostalAddress'];
$Status=$_POST['Status'];
$Effective_Date=$_POST['Effective_Date'];
$UpdateSQLagent = " UPDATE agent SET 

AgentNo='$AgentNo',EmployeeId='$EmployeeId',Name='$Name',DepartmentId='$DepartmentId',MobileNo='$MobileNo',PostalAddress='$PostalAddress',Status='$Status',Effective_Date='$Effective_Date' WHERE AgentNo='$AgentNo'";
// END of Update SQL Statement for agent


$Result_update = mysql_query($UpdateSQLagent) or die(mysql_error());} //End If
} //End function insert//initialize agent 

if (isset($_POST["Update_agent"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_agent_Stmt ();}}


//END of the Update process for agent


//********** Starting Update Statements Tableattachments***********************


function Update_attachments_Stmt (){

if (isset($_POST["Update_attachments"])) {


// Defining Variables for attachments Update SQL Statement 

$AttachmentID=$_POST['AttachmentID'];
$EmployeeID=$_POST['EmployeeID'];
$AttachmentName=$_POST['AttachmentName'];
$AttachmentPath=$_POST['AttachmentPath'];
$effectiveDate=$_POST['effectiveDate'];
$UpdateSQLattachments = " UPDATE attachments SET 

AttachmentID='$AttachmentID',EmployeeID='$EmployeeID',AttachmentName='$AttachmentName',AttachmentPath='$AttachmentPath',effectiveDate='$effectiveDate' WHERE AttachmentID='$AttachmentID'";
// END of Update SQL Statement for attachments


$Result_update = mysql_query($UpdateSQLattachments) or die(mysql_error());} //End If
} //End function insert//initialize attachments 

if (isset($_POST["Update_attachments"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_attachments_Stmt ();}}


//END of the Update process for attachments


//********** Starting Update Statements Tableaudit_trail***********************


function Update_audit_trail_Stmt (){

if (isset($_POST["Update_audit_trail"])) {


// Defining Variables for audit_trail Update SQL Statement 

$user_count=$_POST['user_count'];
$user_id=$_POST['user_id'];
$transaction_date=$_POST['transaction_date'];
$activity=$_POST['activity'];
$UpdateSQLaudit_trail = " UPDATE audit_trail SET 

user_count='$user_count',user_id='$user_id',transaction_date='$transaction_date',activity='$activity' WHERE user_count='$user_count'";
// END of Update SQL Statement for audit_trail


$Result_update = mysql_query($UpdateSQLaudit_trail) or die(mysql_error());} //End If
} //End function insert//initialize audit_trail 

if (isset($_POST["Update_audit_trail"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_audit_trail_Stmt ();}}


//END of the Update process for audit_trail


//********** Starting Update Statements Tablebank_branch***********************


function Update_bank_branch_Stmt (){

if (isset($_POST["Update_bank_branch"])) {


// Defining Variables for bank_branch Update SQL Statement 

$branch_id=$_POST['branch_id'];
$EmployeeId=$_POST['EmployeeId'];
$branch_name=$_POST['branch_name'];
$bank_id=$_POST['bank_id'];
$branch_cde=$_POST['branch_cde'];
$deleted=$_POST['deleted'];
$effectiveDate=$_POST['effectiveDate'];
$UpdateSQLbank_branch = " UPDATE bank_branch SET 

branch_id='$branch_id',EmployeeId='$EmployeeId',branch_name='$branch_name',bank_id='$bank_id',branch_cde='$branch_cde',deleted='$deleted',effectiveDate='$effectiveDate' WHERE branch_id='$branch_id'";
// END of Update SQL Statement for bank_branch


$Result_update = mysql_query($UpdateSQLbank_branch) or die(mysql_error());} //End If
} //End function insert//initialize bank_branch 

if (isset($_POST["Update_bank_branch"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_bank_branch_Stmt ();}}


//END of the Update process for bank_branch


//********** Starting Update Statements Tablebanks***********************


function Update_banks_Stmt (){

if (isset($_POST["Update_banks"])) {


// Defining Variables for banks Update SQL Statement 

$bank_id=$_POST['bank_id'];
$EmployeeId=$_POST['EmployeeId'];
$bank_name=$_POST['bank_name'];
$code=$_POST['code'];
$effectiveDate=$_POST['effectiveDate'];
$UpdateSQLbanks = " UPDATE banks SET 

bank_id='$bank_id',EmployeeId='$EmployeeId',bank_name='$bank_name',code='$code',effectiveDate='$effectiveDate' WHERE bank_id='$bank_id'";
// END of Update SQL Statement for banks


$Result_update = mysql_query($UpdateSQLbanks) or die(mysql_error());} //End If
} //End function insert//initialize banks 

if (isset($_POST["Update_banks"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_banks_Stmt ();}}


//END of the Update process for banks


//********** Starting Update Statements Tablebenefits***********************


function Update_benefits_Stmt (){

if (isset($_POST["Update_benefits"])) {


// Defining Variables for benefits Update SQL Statement 

$BenefitID=$_POST['BenefitID'];
$EmployeeId=$_POST['EmployeeId'];
$Description=$_POST['Description'];
$Amount=$_POST['Amount'];
$UserID=$_POST['UserID'];
$AgentNo=$_POST['AgentNo'];
$effective_dt=$_POST['effective_dt'];
$UpdateSQLbenefits = " UPDATE benefits SET 

BenefitID='$BenefitID',EmployeeId='$EmployeeId',Description='$Description',Amount='$Amount',UserID='$UserID',AgentNo='$AgentNo',effective_dt='$effective_dt' WHERE BenefitID='$BenefitID'";
// END of Update SQL Statement for benefits


$Result_update = mysql_query($UpdateSQLbenefits) or die(mysql_error());} //End If
} //End function insert//initialize benefits 

if (isset($_POST["Update_benefits"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_benefits_Stmt ();}}


//END of the Update process for benefits


//********** Starting Update Statements Tableclaims***********************


function Update_claims_Stmt (){

if (isset($_POST["Update_claims"])) {


// Defining Variables for claims Update SQL Statement 

$ClaimID=$_POST['ClaimID'];
$ClientIDOrPassportNo=$_POST['ClientIDOrPassportNo'];
$PolicyNo=$_POST['PolicyNo'];
$StatusOfLoss=$_POST['StatusOfLoss'];
$NatureOfLoss=$_POST['NatureOfLoss'];
$ProductID=$_POST['ProductID'];
$PropertyID=$_POST['PropertyID'];
$UserID=$_POST['UserID'];
$AgentNo=$_POST['AgentNo'];
$DateOfLoss=$_POST['DateOfLoss'];
$UpdateSQLclaims = " UPDATE claims SET 

ClaimID='$ClaimID',ClientIDOrPassportNo='$ClientIDOrPassportNo',PolicyNo='$PolicyNo',StatusOfLoss='$StatusOfLoss',NatureOfLoss='$NatureOfLoss',ProductID='$ProductID',PropertyID='$PropertyID',UserID='$UserID',AgentNo='$AgentNo',DateOfLoss='$DateOfLoss' WHERE ClaimID='$ClaimID'";
// END of Update SQL Statement for claims


$Result_update = mysql_query($UpdateSQLclaims) or die(mysql_error());} //End If
} //End function insert//initialize claims 

if (isset($_POST["Update_claims"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_claims_Stmt ();}}


//END of the Update process for claims


//********** Starting Update Statements Tablecompany***********************


function Update_company_Stmt (){

if (isset($_POST["Update_company"])) {


// Defining Variables for company Update SQL Statement 

$company_id=$_POST['company_id'];
$EmployeeId=$_POST['EmployeeId'];
$name=$_POST['name'];
$pin_number=$_POST['pin_number'];
$vat_number=$_POST['vat_number'];
$incorp_date=$_POST['incorp_date'];
$effective_dt=$_POST['effective_dt'];
$UpdateSQLcompany = " UPDATE company SET 

company_id='$company_id',EmployeeId='$EmployeeId',name='$name',pin_number='$pin_number',vat_number='$vat_number',incorp_date='$incorp_date',effective_dt='$effective_dt' WHERE company_id='$company_id'";
// END of Update SQL Statement for company


$Result_update = mysql_query($UpdateSQLcompany) or die(mysql_error());} //End If
} //End function insert//initialize company 

if (isset($_POST["Update_company"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_company_Stmt ();}}


//END of the Update process for company


//********** Starting Update Statements Tablecompanyinscommission***********************


function Update_companyinscommission_Stmt (){

if (isset($_POST["Update_companyinscommission"])) {


// Defining Variables for companyinscommission Update SQL Statement 

$CommId=$_POST['CommId'];
$EmployeeId=$_POST['EmployeeId'];
$AgentNo=$_POST['AgentNo'];
$clientID=$_POST['clientID'];
$ComRate=$_POST['ComRate'];
$StartDate=$_POST['StartDate'];
$EndDate=$_POST['EndDate'];
$recursive=$_POST['recursive'];
$occurance=$_POST['occurance'];
$status=$_POST['status'];
$Effective_Date=$_POST['Effective_Date'];
$UpdateSQLcompanyinscommission = " UPDATE companyinscommission SET 

CommId='$CommId',EmployeeId='$EmployeeId',AgentNo='$AgentNo',clientID='$clientID',ComRate='$ComRate',StartDate='$StartDate',EndDate='$EndDate',recursive='$recursive',occurance='$occurance',status='$status',Effective_Date='$Effective_Date' WHERE CommId='$CommId'";
// END of Update SQL Statement for companyinscommission


$Result_update = mysql_query($UpdateSQLcompanyinscommission) or die(mysql_error());} //End If
} //End function insert//initialize companyinscommission 

if (isset($_POST["Update_companyinscommission"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_companyinscommission_Stmt ();}}


//END of the Update process for companyinscommission


//********** Starting Update Statements Tablecompensation***********************


function Update_compensation_Stmt (){

if (isset($_POST["Update_compensation"])) {


// Defining Variables for compensation Update SQL Statement 

$CompensationID=$_POST['CompensationID'];
$EmployeeId=$_POST['EmployeeId'];
$ClaimID=$_POST['ClaimID'];
$Amount=$_POST['Amount'];
$UserID=$_POST['UserID'];
$AgentNo=$_POST['AgentNo'];
$effectiveDate=$_POST['effectiveDate'];
$UpdateSQLcompensation = " UPDATE compensation SET 

CompensationID='$CompensationID',EmployeeId='$EmployeeId',ClaimID='$ClaimID',Amount='$Amount',UserID='$UserID',AgentNo='$AgentNo',effectiveDate='$effectiveDate' WHERE CompensationID='$CompensationID'";
// END of Update SQL Statement for compensation


$Result_update = mysql_query($UpdateSQLcompensation) or die(mysql_error());} //End If
} //End function insert//initialize compensation 

if (isset($_POST["Update_compensation"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_compensation_Stmt ();}}


//END of the Update process for compensation


//********** Starting Update Statements Tableemployee***********************


function Update_employee_Stmt (){

if (isset($_POST["Update_employee"])) {


// Defining Variables for employee Update SQL Statement 

$EmployeeId=$_POST['EmployeeId'];
$savedby=$_POST['savedby'];
$EmpNo=$_POST['EmpNo'];
$Employee_Number=$_POST['Employee_Number'];
$Surname=$_POST['Surname'];
$Other_Names=$_POST['Other_Names'];
$DepartmentId=$_POST['DepartmentId'];
$PhoneNumber=$_POST['PhoneNumber'];
$otherPhoneNumber=$_POST['otherPhoneNumber'];
$PostalAddress=$_POST['PostalAddress'];
$postalCode=$_POST['postalCode'];
$Town=$_POST['Town'];
$Status=$_POST['Status'];
$Effective_Date=$_POST['Effective_Date'];
$UpdateSQLemployee = " UPDATE employee SET 

EmployeeId='$EmployeeId',savedby='$savedby',EmpNo='$EmpNo',Employee_Number='$Employee_Number',Surname='$Surname',Other_Names='$Other_Names',DepartmentId='$DepartmentId',PhoneNumber='$PhoneNumber',otherPhoneNumber='$otherPhoneNumber',PostalAddress='$PostalAddress',postalCode='$postalCode',Town='$Town',Status='$Status',Effective_Date='$Effective_Date' WHERE EmployeeId='$EmployeeId'";
// END of Update SQL Statement for employee


$Result_update = mysql_query($UpdateSQLemployee) or die(mysql_error());} //End If
} //End function insert//initialize employee 

if (isset($_POST["Update_employee"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_employee_Stmt ();}}


//END of the Update process for employee


//********** Starting Update Statements Tablehousedetails***********************


function Update_housedetails_Stmt (){

if (isset($_POST["Update_housedetails"])) {


// Defining Variables for housedetails Update SQL Statement 

$Houseid=$_POST['Houseid'];
$PropertyID=$_POST['PropertyID'];
$Category=$_POST['Category'];
$NoOfRooms=$_POST['NoOfRooms'];
$Water=$_POST['Water'];
$Electricity=$_POST['Electricity'];
$Status=$_POST['Status'];
$EmployeeId=$_POST['EmployeeId'];
$AgentNo=$_POST['AgentNo'];
$UpdateSQLhousedetails = " UPDATE housedetails SET 

Houseid='$Houseid',PropertyID='$PropertyID',Category='$Category',NoOfRooms='$NoOfRooms',Water='$Water',Electricity='$Electricity',Status='$Status',EmployeeId='$EmployeeId',AgentNo='$AgentNo' WHERE Houseid='$Houseid'";
// END of Update SQL Statement for housedetails


$Result_update = mysql_query($UpdateSQLhousedetails) or die(mysql_error());} //End If
} //End function insert//initialize housedetails 

if (isset($_POST["Update_housedetails"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_housedetails_Stmt ();}}


//END of the Update process for housedetails


//********** Starting Update Statements Tablehousepayment***********************


function Update_housepayment_Stmt (){

if (isset($_POST["Update_housepayment"])) {


// Defining Variables for housepayment Update SQL Statement 

$PaymentNo=$_POST['PaymentNo'];
$ReceiptNo=$_POST['ReceiptNo'];
$TenantID=$_POST['TenantID'];
$HouseCode=$_POST['HouseCode'];
$Rent=$_POST['Rent'];
$Deposit=$_POST['Deposit'];
$Date=$_POST['Date'];
$UserID=$_POST['UserID'];
$AgentNo=$_POST['AgentNo'];
$UpdateSQLhousepayment = " UPDATE housepayment SET 

PaymentNo='$PaymentNo',ReceiptNo='$ReceiptNo',TenantID='$TenantID',HouseCode='$HouseCode',Rent='$Rent',Deposit='$Deposit',Date='$Date',UserID='$UserID',AgentNo='$AgentNo' WHERE PaymentNo='$PaymentNo'";
// END of Update SQL Statement for housepayment


$Result_update = mysql_query($UpdateSQLhousepayment) or die(mysql_error());} //End If
} //End function insert//initialize housepayment 

if (isset($_POST["Update_housepayment"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_housepayment_Stmt ();}}


//END of the Update process for housepayment


//********** Starting Update Statements Tablehouseproperty***********************


function Update_houseproperty_Stmt (){

if (isset($_POST["Update_houseproperty"])) {


// Defining Variables for houseproperty Update SQL Statement 

$PropertyID=$_POST['PropertyID'];
$OwnerID=$_POST['OwnerID'];
$Location=$_POST['Location'];
$UserID=$_POST['UserID'];
$AgentNo=$_POST['AgentNo'];
$UpdateSQLhouseproperty = " UPDATE houseproperty SET 

PropertyID='$PropertyID',OwnerID='$OwnerID',Location='$Location',UserID='$UserID',AgentNo='$AgentNo' WHERE PropertyID='$PropertyID'";
// END of Update SQL Statement for houseproperty


$Result_update = mysql_query($UpdateSQLhouseproperty) or die(mysql_error());} //End If
} //End function insert//initialize houseproperty 

if (isset($_POST["Update_houseproperty"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_houseproperty_Stmt ();}}


//END of the Update process for houseproperty


//********** Starting Update Statements Tableinsuranceaccount***********************


function Update_insuranceaccount_Stmt (){

if (isset($_POST["Update_insuranceaccount"])) {


// Defining Variables for insuranceaccount Update SQL Statement 

$accountId=$_POST['accountId'];
$EmployeeId=$_POST['EmployeeId'];
$InsurerID=$_POST['InsurerID'];
$bank_id=$_POST['bank_id'];
$branch_id=$_POST['branch_id'];
$AccountNumber=$_POST['AccountNumber'];
$AgentNo=$_POST['AgentNo'];
$UpdateSQLinsuranceaccount = " UPDATE insuranceaccount SET 

accountId='$accountId',EmployeeId='$EmployeeId',InsurerID='$InsurerID',bank_id='$bank_id',branch_id='$branch_id',AccountNumber='$AccountNumber',AgentNo='$AgentNo' WHERE accountId='$accountId'";
// END of Update SQL Statement for insuranceaccount


$Result_update = mysql_query($UpdateSQLinsuranceaccount) or die(mysql_error());} //End If
} //End function insert//initialize insuranceaccount 

if (isset($_POST["Update_insuranceaccount"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_insuranceaccount_Stmt ();}}


//END of the Update process for insuranceaccount


//********** Starting Update Statements Tableinsuranceagentcommission***********************


function Update_insuranceagentcommission_Stmt (){

if (isset($_POST["Update_insuranceagentcommission"])) {


// Defining Variables for insuranceagentcommission Update SQL Statement 

$CommId=$_POST['CommId'];
$EmployeeId=$_POST['EmployeeId'];
$agentcomRate=$_POST['agentcomRate'];
$clientID=$_POST['clientID'];
$StartDate=$_POST['StartDate'];
$EndDate=$_POST['EndDate'];
$recursive=$_POST['recursive'];
$occurance=$_POST['occurance'];
$AgentNo=$_POST['AgentNo'];
$Effective_Date=$_POST['Effective_Date'];
$UpdateSQLinsuranceagentcommission = " UPDATE insuranceagentcommission SET 

CommId='$CommId',EmployeeId='$EmployeeId',agentcomRate='$agentcomRate',clientID='$clientID',StartDate='$StartDate',EndDate='$EndDate',recursive='$recursive',occurance='$occurance',AgentNo='$AgentNo',Effective_Date='$Effective_Date' WHERE CommId='$CommId'";
// END of Update SQL Statement for insuranceagentcommission


$Result_update = mysql_query($UpdateSQLinsuranceagentcommission) or die(mysql_error());} //End If
} //End function insert//initialize insuranceagentcommission 

if (isset($_POST["Update_insuranceagentcommission"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_insuranceagentcommission_Stmt ();}}


//END of the Update process for insuranceagentcommission


//********** Starting Update Statements Tableinsuranceclient***********************


function Update_insuranceclient_Stmt (){

if (isset($_POST["Update_insuranceclient"])) {


// Defining Variables for insuranceclient Update SQL Statement 

$clientId=$_POST['clientId'];
$EmployeeId=$_POST['EmployeeId'];
$Name=$_POST['Name'];
$Profession=$_POST['Profession'];
$IDOrPassportNo=$_POST['IDOrPassportNo'];
$Mobile_Number=$_POST['Mobile_Number'];
$OtherPhoneNumbers=$_POST['OtherPhoneNumbers'];
$Postal_Address=$_POST['Postal_Address'];
$Postal_Code=$_POST['Postal_Code'];
$Town=$_POST['Town'];
$Email_Address=$_POST['Email_Address'];
$TransactionDate=$_POST['TransactionDate'];
$UpdateSQLinsuranceclient = " UPDATE insuranceclient SET 

clientId='$clientId',EmployeeId='$EmployeeId',Name='$Name',Profession='$Profession',IDOrPassportNo='$IDOrPassportNo',Mobile_Number='$Mobile_Number',OtherPhoneNumbers='$OtherPhoneNumbers',Postal_Address='$Postal_Address',Postal_Code='$Postal_Code',Town='$Town',Email_Address='$Email_Address',TransactionDate='$TransactionDate' WHERE clientId='$clientId'";
// END of Update SQL Statement for insuranceclient


$Result_update = mysql_query($UpdateSQLinsuranceclient) or die(mysql_error());} //End If
} //End function insert//initialize insuranceclient 

if (isset($_POST["Update_insuranceclient"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_insuranceclient_Stmt ();}}


//END of the Update process for insuranceclient


//********** Starting Update Statements Tableinsurancepayement***********************


function Update_insurancepayement_Stmt (){

if (isset($_POST["Update_insurancepayement"])) {


// Defining Variables for insurancepayement Update SQL Statement 

$fk_PaymentID=$_POST['fk_PaymentID'];
$fk_EmployeeID=$_POST['fk_EmployeeID'];
$fk_clientId=$_POST['fk_clientId'];
$ReferenceNumber=$_POST['ReferenceNumber'];
$PaymentModeId=$_POST['PaymentModeId'];
$CategoryID=$_POST['CategoryID'];
$PaymentIDorVoucherNum=$_POST['PaymentIDorVoucherNum'];
$Status=$_POST['Status'];
$fk_periodRef=$_POST['fk_periodRef'];
$Amount=$_POST['Amount'];
$TransactionDate=$_POST['TransactionDate'];
$UpdateSQLinsurancepayement = " UPDATE insurancepayement SET 

fk_PaymentID='$fk_PaymentID',fk_EmployeeID='$fk_EmployeeID',fk_clientId='$fk_clientId',ReferenceNumber='$ReferenceNumber',PaymentModeId='$PaymentModeId',CategoryID='$CategoryID',PaymentIDorVoucherNum='$PaymentIDorVoucherNum',Status='$Status',fk_periodRef='$fk_periodRef',Amount='$Amount',TransactionDate='$TransactionDate' WHERE fk_PaymentID='$fk_PaymentID'";
// END of Update SQL Statement for insurancepayement


$Result_update = mysql_query($UpdateSQLinsurancepayement) or die(mysql_error());} //End If
} //End function insert//initialize insurancepayement 

if (isset($_POST["Update_insurancepayement"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_insurancepayement_Stmt ();}}


//END of the Update process for insurancepayement


//********** Starting Update Statements Tableinsurancepolicy***********************


function Update_insurancepolicy_Stmt (){

if (isset($_POST["Update_insurancepolicy"])) {


// Defining Variables for insurancepolicy Update SQL Statement 

$PolicyId=$_POST['PolicyId'];
$PolicyTypeId=$_POST['PolicyTypeId'];
$EmployeeID=$_POST['EmployeeID'];
$clientId=$_POST['clientId'];
$InsurerID=$_POST['InsurerID'];
$Business=$_POST['Business'];
$PolicyNumber=$_POST['PolicyNumber'];
$BasicPremium=$_POST['BasicPremium'];
$TrainingLevy=$_POST['TrainingLevy'];
$PCF=$_POST['PCF'];
$CommissionRate=$_POST['CommissionRate'];
$GeographicalArea=$_POST['GeographicalArea'];
$Scope=$_POST['Scope'];
$DateInsured=$_POST['DateInsured'];
$ExpiryDate=$_POST['ExpiryDate'];
$effectiveDate=$_POST['effectiveDate'];
$UpdateSQLinsurancepolicy = " UPDATE insurancepolicy SET 

PolicyId='$PolicyId',PolicyTypeId='$PolicyTypeId',EmployeeID='$EmployeeID',clientId='$clientId',InsurerID='$InsurerID',Business='$Business',PolicyNumber='$PolicyNumber',BasicPremium='$BasicPremium',TrainingLevy='$TrainingLevy',PCF='$PCF',CommissionRate='$CommissionRate',GeographicalArea='$GeographicalArea',Scope='$Scope',DateInsured='$DateInsured',ExpiryDate='$ExpiryDate',effectiveDate='$effectiveDate' WHERE PolicyId='$PolicyId'";
// END of Update SQL Statement for insurancepolicy


$Result_update = mysql_query($UpdateSQLinsurancepolicy) or die(mysql_error());} //End If
} //End function insert//initialize insurancepolicy 

if (isset($_POST["Update_insurancepolicy"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_insurancepolicy_Stmt ();}}


//END of the Update process for insurancepolicy


//********** Starting Update Statements Tableinsurancepolicyrenew***********************


function Update_insurancepolicyrenew_Stmt (){

if (isset($_POST["Update_insurancepolicyrenew"])) {


// Defining Variables for insurancepolicyrenew Update SQL Statement 

$PolicyId=$_POST['PolicyId'];
$PolicyTypeId=$_POST['PolicyTypeId'];
$EmployeeID=$_POST['EmployeeID'];
$clientId=$_POST['clientId'];
$InsurerID=$_POST['InsurerID'];
$Business=$_POST['Business'];
$PolicyNumber=$_POST['PolicyNumber'];
$BasicPremium=$_POST['BasicPremium'];
$TrainingLevy=$_POST['TrainingLevy'];
$PCF=$_POST['PCF'];
$CommissionRate=$_POST['CommissionRate'];
$GeographicalArea=$_POST['GeographicalArea'];
$Scope=$_POST['Scope'];
$DateInsured=$_POST['DateInsured'];
$ExpiryDate=$_POST['ExpiryDate'];
$poliycyperiod=$_POST['poliycyperiod'];
$effectiveDate=$_POST['effectiveDate'];
$UpdateSQLinsurancepolicyrenew = " UPDATE insurancepolicyrenew SET 

PolicyId='$PolicyId',PolicyTypeId='$PolicyTypeId',EmployeeID='$EmployeeID',clientId='$clientId',InsurerID='$InsurerID',Business='$Business',PolicyNumber='$PolicyNumber',BasicPremium='$BasicPremium',TrainingLevy='$TrainingLevy',PCF='$PCF',CommissionRate='$CommissionRate',GeographicalArea='$GeographicalArea',Scope='$Scope',DateInsured='$DateInsured',ExpiryDate='$ExpiryDate',poliycyperiod='$poliycyperiod',effectiveDate='$effectiveDate' WHERE PolicyId='$PolicyId'";
// END of Update SQL Statement for insurancepolicyrenew


$Result_update = mysql_query($UpdateSQLinsurancepolicyrenew) or die(mysql_error());} //End If
} //End function insert//initialize insurancepolicyrenew 

if (isset($_POST["Update_insurancepolicyrenew"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_insurancepolicyrenew_Stmt ();}}


//END of the Update process for insurancepolicyrenew


//********** Starting Update Statements Tableinsurancepolicytype***********************


function Update_insurancepolicytype_Stmt (){

if (isset($_POST["Update_insurancepolicytype"])) {


// Defining Variables for insurancepolicytype Update SQL Statement 

$PolicyTypeId=$_POST['PolicyTypeId'];
$EmployeeID=$_POST['EmployeeID'];
$Description=$_POST['Description'];
$effectiveDate=$_POST['effectiveDate'];
$UpdateSQLinsurancepolicytype = " UPDATE insurancepolicytype SET 

PolicyTypeId='$PolicyTypeId',EmployeeID='$EmployeeID',Description='$Description',effectiveDate='$effectiveDate' WHERE PolicyTypeId='$PolicyTypeId'";
// END of Update SQL Statement for insurancepolicytype


$Result_update = mysql_query($UpdateSQLinsurancepolicytype) or die(mysql_error());} //End If
} //End function insert//initialize insurancepolicytype 

if (isset($_POST["Update_insurancepolicytype"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_insurancepolicytype_Stmt ();}}


//END of the Update process for insurancepolicytype


//********** Starting Update Statements Tableinsuranceproperty***********************


function Update_insuranceproperty_Stmt (){

if (isset($_POST["Update_insuranceproperty"])) {


// Defining Variables for insuranceproperty Update SQL Statement 

$PropertyID=$_POST['PropertyID'];
$PropertyNumber=$_POST['PropertyNumber'];
$PropertyName=$_POST['PropertyName'];
$Description=$_POST['Description'];
$Location=$_POST['Location'];
$InitialValue=$_POST['InitialValue'];
$ValueRate=$_POST['ValueRate'];
$ClientIDOrPassportNo=$_POST['ClientIDOrPassportNo'];
$PolicyNo=$_POST['PolicyNo'];
$UserID=$_POST['UserID'];
$AgentNo=$_POST['AgentNo'];
$UpdateSQLinsuranceproperty = " UPDATE insuranceproperty SET 

PropertyID='$PropertyID',PropertyNumber='$PropertyNumber',PropertyName='$PropertyName',Description='$Description',Location='$Location',InitialValue='$InitialValue',ValueRate='$ValueRate',ClientIDOrPassportNo='$ClientIDOrPassportNo',PolicyNo='$PolicyNo',UserID='$UserID',AgentNo='$AgentNo' WHERE PropertyID='$PropertyID'";
// END of Update SQL Statement for insuranceproperty


$Result_update = mysql_query($UpdateSQLinsuranceproperty) or die(mysql_error());} //End If
} //End function insert//initialize insuranceproperty 

if (isset($_POST["Update_insuranceproperty"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_insuranceproperty_Stmt ();}}


//END of the Update process for insuranceproperty


//********** Starting Update Statements Tableinsurer***********************


function Update_insurer_Stmt (){

if (isset($_POST["Update_insurer"])) {


// Defining Variables for insurer Update SQL Statement 

$InsurerID=$_POST['InsurerID'];
$EmployeeId=$_POST['EmployeeId'];
$Insurer=$_POST['Insurer'];
$Bank_ID=$_POST['Bank_ID'];
$Bank_Branch_ID=$_POST['Bank_Branch_ID'];
$AccountNumber=$_POST['AccountNumber'];
$PostalAddress=$_POST['PostalAddress'];
$PostalCode=$_POST['PostalCode'];
$PhysicalAddress=$_POST['PhysicalAddress'];
$Town=$_POST['Town'];
$ContactPerson=$_POST['ContactPerson'];
$ContactPersonPhone=$_POST['ContactPersonPhone'];
$ContactPersonEmail=$_POST['ContactPersonEmail'];
$effectiveDate=$_POST['effectiveDate'];
$UpdateSQLinsurer = " UPDATE insurer SET 

InsurerID='$InsurerID',EmployeeId='$EmployeeId',Insurer='$Insurer',Bank_ID='$Bank_ID',Bank_Branch_ID='$Bank_Branch_ID',AccountNumber='$AccountNumber',PostalAddress='$PostalAddress',PostalCode='$PostalCode',PhysicalAddress='$PhysicalAddress',Town='$Town',ContactPerson='$ContactPerson',ContactPersonPhone='$ContactPersonPhone',ContactPersonEmail='$ContactPersonEmail',effectiveDate='$effectiveDate' WHERE InsurerID='$InsurerID'";
// END of Update SQL Statement for insurer


$Result_update = mysql_query($UpdateSQLinsurer) or die(mysql_error());} //End If
} //End function insert//initialize insurer 

if (isset($_POST["Update_insurer"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_insurer_Stmt ();}}


//END of the Update process for insurer


//********** Starting Update Statements Tableinsurerpayment***********************


function Update_insurerpayment_Stmt (){

if (isset($_POST["Update_insurerpayment"])) {


// Defining Variables for insurerpayment Update SQL Statement 

$PaymentID=$_POST['PaymentID'];
$EmployeeID=$_POST['EmployeeID'];
$clientId=$_POST['clientId'];
$ReferenceNumber=$_POST['ReferenceNumber'];
$PaymentModeId=$_POST['PaymentModeId'];
$CategoryID=$_POST['CategoryID'];
$PaymentIDorVoucherNum=$_POST['PaymentIDorVoucherNum'];
$Status=$_POST['Status'];
$periodRef=$_POST['periodRef'];
$Amount=$_POST['Amount'];
$TransactionDate=$_POST['TransactionDate'];
$UpdateSQLinsurerpayment = " UPDATE insurerpayment SET 

PaymentID='$PaymentID',EmployeeID='$EmployeeID',clientId='$clientId',ReferenceNumber='$ReferenceNumber',PaymentModeId='$PaymentModeId',CategoryID='$CategoryID',PaymentIDorVoucherNum='$PaymentIDorVoucherNum',Status='$Status',periodRef='$periodRef',Amount='$Amount',TransactionDate='$TransactionDate' WHERE PaymentID='$PaymentID'";
// END of Update SQL Statement for insurerpayment


$Result_update = mysql_query($UpdateSQLinsurerpayment) or die(mysql_error());} //End If
} //End function insert//initialize insurerpayment 

if (isset($_POST["Update_insurerpayment"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_insurerpayment_Stmt ();}}


//END of the Update process for insurerpayment


//********** Starting Update Statements Tablemortorvehice***********************


function Update_mortorvehice_Stmt (){

if (isset($_POST["Update_mortorvehice"])) {


// Defining Variables for mortorvehice Update SQL Statement 

$motorcnt=$_POST['motorcnt'];
$PolicyId=$_POST['PolicyId'];
$EmployeeID=$_POST['EmployeeID'];
$RegistrationNumber=$_POST['RegistrationNumber'];
$Make=$_POST['Make'];
$BodyType=$_POST['BodyType'];
$Year=$_POST['Year'];
$SeatingCapacity=$_POST['SeatingCapacity'];
$InsuredEstimateValue=$_POST['InsuredEstimateValue'];
$poliycyperiod=$_POST['poliycyperiod'];
$effectiveDate=$_POST['effectiveDate'];
$UpdateSQLmortorvehice = " UPDATE mortorvehice SET 

motorcnt='$motorcnt',PolicyId='$PolicyId',EmployeeID='$EmployeeID',RegistrationNumber='$RegistrationNumber',Make='$Make',BodyType='$BodyType',Year='$Year',SeatingCapacity='$SeatingCapacity',InsuredEstimateValue='$InsuredEstimateValue',poliycyperiod='$poliycyperiod',effectiveDate='$effectiveDate' WHERE motorcnt='$motorcnt'";
// END of Update SQL Statement for mortorvehice


$Result_update = mysql_query($UpdateSQLmortorvehice) or die(mysql_error());} //End If
} //End function insert//initialize mortorvehice 

if (isset($_POST["Update_mortorvehice"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_mortorvehice_Stmt ();}}


//END of the Update process for mortorvehice


//********** Starting Update Statements Tableownercontactdetails***********************


function Update_ownercontactdetails_Stmt (){

if (isset($_POST["Update_ownercontactdetails"])) {


// Defining Variables for ownercontactdetails Update SQL Statement 

$OwnerID=$_POST['OwnerID'];
$Surname=$_POST['Surname'];
$Other_Names=$_POST['Other_Names'];
$MobileNo=$_POST['MobileNo'];
$Address=$_POST['Address'];
$KinID=$_POST['KinID'];
$KinMobileNo=$_POST['KinMobileNo'];
$KinName=$_POST['KinName'];
$Bank_ID=$_POST['Bank_ID'];
$Bank_Branch_ID=$_POST['Bank_Branch_ID'];
$Bank_Account=$_POST['Bank_Account'];
$UserID=$_POST['UserID'];
$AgentNo=$_POST['AgentNo'];
$UpdateSQLownercontactdetails = " UPDATE ownercontactdetails SET 

OwnerID='$OwnerID',Surname='$Surname',Other_Names='$Other_Names',MobileNo='$MobileNo',Address='$Address',KinID='$KinID',KinMobileNo='$KinMobileNo',KinName='$KinName',Bank_ID='$Bank_ID',Bank_Branch_ID='$Bank_Branch_ID',Bank_Account='$Bank_Account',UserID='$UserID',AgentNo='$AgentNo' WHERE OwnerID='$OwnerID'";
// END of Update SQL Statement for ownercontactdetails


$Result_update = mysql_query($UpdateSQLownercontactdetails) or die(mysql_error());} //End If
} //End function insert//initialize ownercontactdetails 

if (isset($_POST["Update_ownercontactdetails"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_ownercontactdetails_Stmt ();}}


//END of the Update process for ownercontactdetails


//********** Starting Update Statements Tablepolicyrisks***********************


function Update_policyrisks_Stmt (){

if (isset($_POST["Update_policyrisks"])) {


// Defining Variables for policyrisks Update SQL Statement 

$RiskCnt=$_POST['RiskCnt'];
$PolicyId=$_POST['PolicyId'];
$EmployeeID=$_POST['EmployeeID'];
$RiskDescription=$_POST['RiskDescription'];
$InsuredValue=$_POST['InsuredValue'];
$poliycyperiod=$_POST['poliycyperiod'];
$effectiveDate=$_POST['effectiveDate'];
$UpdateSQLpolicyrisks = " UPDATE policyrisks SET 

RiskCnt='$RiskCnt',PolicyId='$PolicyId',EmployeeID='$EmployeeID',RiskDescription='$RiskDescription',InsuredValue='$InsuredValue',poliycyperiod='$poliycyperiod',effectiveDate='$effectiveDate' WHERE RiskCnt='$RiskCnt'";
// END of Update SQL Statement for policyrisks


$Result_update = mysql_query($UpdateSQLpolicyrisks) or die(mysql_error());} //End If
} //End function insert//initialize policyrisks 

if (isset($_POST["Update_policyrisks"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_policyrisks_Stmt ();}}


//END of the Update process for policyrisks


//********** Starting Update Statements Tableproduct***********************


function Update_product_Stmt (){

if (isset($_POST["Update_product"])) {


// Defining Variables for product Update SQL Statement 

$ProductID=$_POST['ProductID'];
$ProductName=$_POST['ProductName'];
$UserID=$_POST['UserID'];
$AgentNo=$_POST['AgentNo'];
$UpdateSQLproduct = " UPDATE product SET 

ProductID='$ProductID',ProductName='$ProductName',UserID='$UserID',AgentNo='$AgentNo' WHERE ProductID='$ProductID'";
// END of Update SQL Statement for product


$Result_update = mysql_query($UpdateSQLproduct) or die(mysql_error());} //End If
} //End function insert//initialize product 

if (isset($_POST["Update_product"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_product_Stmt ();}}


//END of the Update process for product


//********** Starting Update Statements Tablereceipts***********************


function Update_receipts_Stmt (){

if (isset($_POST["Update_receipts"])) {


// Defining Variables for receipts Update SQL Statement 

$ReceiptNo=$_POST['ReceiptNo'];
$DepartmentId=$_POST['DepartmentId'];
$Description=$_POST['Description'];
$Effective_Date=$_POST['Effective_Date'];
$AmountPaid=$_POST['AmountPaid'];
$AmountDue=$_POST['AmountDue'];
$Payment_Details=$_POST['Payment_Details'];
$UserID=$_POST['UserID'];
$AgentNo=$_POST['AgentNo'];
$UpdateSQLreceipts = " UPDATE receipts SET 

ReceiptNo='$ReceiptNo',DepartmentId='$DepartmentId',Description='$Description',Effective_Date='$Effective_Date',AmountPaid='$AmountPaid',AmountDue='$AmountDue',Payment_Details='$Payment_Details',UserID='$UserID',AgentNo='$AgentNo' WHERE ReceiptNo='$ReceiptNo'";
// END of Update SQL Statement for receipts


$Result_update = mysql_query($UpdateSQLreceipts) or die(mysql_error());} //End If
} //End function insert//initialize receipts 

if (isset($_POST["Update_receipts"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_receipts_Stmt ();}}


//END of the Update process for receipts


//********** Starting Update Statements Tablesysattachments***********************


function Update_sysattachments_Stmt (){

if (isset($_POST["Update_sysattachments"])) {


// Defining Variables for sysattachments Update SQL Statement 

$Attachmentcnt=$_POST['Attachmentcnt'];
$AttachmentID=$_POST['AttachmentID'];
$EmployeeID=$_POST['EmployeeID'];
$AttachmentRelatedTo=$_POST['AttachmentRelatedTo'];
$effectiveDate=$_POST['effectiveDate'];
$UpdateSQLsysattachments = " UPDATE sysattachments SET 

Attachmentcnt='$Attachmentcnt',AttachmentID='$AttachmentID',EmployeeID='$EmployeeID',AttachmentRelatedTo='$AttachmentRelatedTo',effectiveDate='$effectiveDate' WHERE Attachmentcnt='$Attachmentcnt'";
// END of Update SQL Statement for sysattachments


$Result_update = mysql_query($UpdateSQLsysattachments) or die(mysql_error());} //End If
} //End function insert//initialize sysattachments 

if (isset($_POST["Update_sysattachments"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_sysattachments_Stmt ();}}


//END of the Update process for sysattachments


//********** Starting Update Statements Tabletenants***********************


function Update_tenants_Stmt (){

if (isset($_POST["Update_tenants"])) {


// Defining Variables for tenants Update SQL Statement 

$TenantID=$_POST['TenantID'];
$Surname=$_POST['Surname'];
$Other_Names=$_POST['Other_Names'];
$MobileNo=$_POST['MobileNo'];
$EmailAddress=$_POST['EmailAddress'];
$Country_ID=$_POST['Country_ID'];
$HouseCategory=$_POST['HouseCategory'];
$Address=$_POST['Address'];
$RentRevisionDate=$_POST['RentRevisionDate'];
$HouseCode=$_POST['HouseCode'];
$UserID=$_POST['UserID'];
$AgentNo=$_POST['AgentNo'];
$UpdateSQLtenants = " UPDATE tenants SET 

TenantID='$TenantID',Surname='$Surname',Other_Names='$Other_Names',MobileNo='$MobileNo',EmailAddress='$EmailAddress',Country_ID='$Country_ID',HouseCategory='$HouseCategory',Address='$Address',RentRevisionDate='$RentRevisionDate',HouseCode='$HouseCode',UserID='$UserID',AgentNo='$AgentNo' WHERE TenantID='$TenantID'";
// END of Update SQL Statement for tenants


$Result_update = mysql_query($UpdateSQLtenants) or die(mysql_error());} //End If
} //End function insert//initialize tenants 

if (isset($_POST["Update_tenants"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_tenants_Stmt ();}}


//END of the Update process for tenants


//********** Starting Update Statements Tableuser***********************


function Update_user_Stmt (){

if (isset($_POST["Update_user"])) {


// Defining Variables for user Update SQL Statement 

$id=$_POST['id'];
$user_id=$_POST['user_id'];
$user_password=$_POST['user_password'];
$Name=$_POST['Name'];
$user_priviledge=$_POST['user_priviledge'];
$security_question=$_POST['security_question'];
$security_q_answer=$_POST['security_q_answer'];
$user_active_status=$_POST['user_active_status'];
$effective_dt=$_POST['effective_dt'];
$UpdateSQLuser = " UPDATE user SET 

id='$id',user_id='$user_id',user_password='$user_password',Name='$Name',user_priviledge='$user_priviledge',security_question='$security_question',security_q_answer='$security_q_answer',user_active_status='$user_active_status',effective_dt='$effective_dt' WHERE id='$id'";
// END of Update SQL Statement for user


$Result_update = mysql_query($UpdateSQLuser) or die(mysql_error());} //End If
} //End function insert//initialize user 

if (isset($_POST["Update_user"])) {

if (isset($_GET['q'])) { $colname_to_nameID =base64_decode($_GET['q']);Update_user_Stmt ();}}


//END of the Update process for user




// End of Active Update Statements
//All table tables

$admin_links[1]='admin_user';

$attachments_links[1]='attachments_attachments';

$attachments_links[2]='attachments_sysattachments';

$bank_links[1]='bank_banks';

$bank_links[2]='bank_branch';

$bank_links[3]='bank_insuranceaccount';

$commission_links[1]='commission_companyinscommission';

$commission_links[2]='commission_insuranceagentcommission';

$company_links[1]='company_agent';

$company_links[2]='company_audit_trail';

$company_links[3]='company_company';

$company_links[4]='company_employee';

$events_links[1]='events_event';

$insurance_links[1]='insurance_client';

$insurance_links[2]='insurance_insurer';

$insurance_links[3]='insurance_insurerpayment';

$insurance_links[4]='insurance_policy';

$insurance_links[5]='insurance_policy_claims';

$insurance_links[6]='insurance_policy_compensation';

$insurance_links[7]='insurance_policyrenew';

$insurance_links[8]='insurance_policytype';

$insurance_links[9]='insurance_product';

$insurance_links[10]='insurance_property';

$insurance_links[11]='insurance_risks_mortorvehice';

$insurance_links[12]='insurance_risks_policyrisks';

$payment_links[1]='payment_payement';

$payment_links[2]='payment_receipts';

$property_links[1]='property_housedetails';

$property_links[2]='property_housepayment';

$property_links[3]='property_houseproperty';

$property_links[4]='property_ownercontactdetails';

$property_links[5]='property_tenants';


?>