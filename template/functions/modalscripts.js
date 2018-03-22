$(function() {
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		$( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 300,
			width: 350,
			modal: true,
			buttons: {
				
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				//llFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

$( "#account_account" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#account_accountclosure" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#account_accounttermination" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#account_accreation" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#account_acsetting" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#account_consumer" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#account_creditdebitrequest" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#account_customerdeactivate" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#account_groupmaster" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#account_invoice" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#account_invoiceitems" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#account_transactionlog" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_adminuser" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_aggrigate" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_alert" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_autofill" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_benefitdescr" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_cmpbenefits" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_company" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_compstructtree" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_controller" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_custom" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_customer" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_customimport" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_dept" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_docs" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_empdepartment" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_emppayment" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_emppropertyissued" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_empreport" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_groupnotification" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_groupnotificationhist" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_ntg" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_orgdepartment" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_orgpaygradedecr" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_passwordreset" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_passwordresethist" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_person" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_rights" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_role" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_schart" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_scnotification" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_statement" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_status" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_statustype" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_supervisor" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_table" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_tablerole" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_user" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_useremp" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_usergroup" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#admin_usergrouprole" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#commission_companyinscommission" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#commission_insuranceagentcommission" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#company_agent" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#company_employee" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#designer_charttype" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#designer_sform" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#designer_sview" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#designer_tabmngr" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#designer_viewicon" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#designer_viewmode" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#events_event" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#events_reminder" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#housing_arrearspayment" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#housing_housepayment" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#housing_landlord" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#housing_lease" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#housing_login" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#housing_nextofkin" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#housing_property" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#housing_tenant" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#housing_unit" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#insurance_client" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#insurance_insurer" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#insurance_insurerpayment" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#insurance_payment" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#insurance_policy" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#insurance_policyclaims" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#insurance_policycompensation" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#insurance_policytype" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#insurance_product" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#insurance_receipts" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#insurance_renewal" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#insurance_risk" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#insurance_riskmortorvehice" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#payment_bnkbranch" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#payment_branch" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#payment_costcenter" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#payment_currency" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#sms_indsms" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#sms_messagereived" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#sms_messagesend" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#sms_processedsms" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#sms_smshandle" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});
$( "#sms_smsinvalid" )
            .button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				fillthisdiv()
				viewDetails()
			});});