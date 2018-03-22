
function lookup_mylinkedaccountclosure_id(account_accountclosureaccountclosure_id) {
    if(account_accountclosureaccountclosure_id.length == 0) {
        
		
		$('#account_accountclosureaccountclosure_idsuggestions').hide();
    } else {
        $.post("../account/rpcaccount_accountclosure.php", {queryString: ""+account_accountclosureaccountclosure_id+""}, function(data){
            if(data.length >0) {
                $('#account_accountclosureaccountclosure_idsuggestions').show();
                $('#account_accountclosureaccountclosure_idautoSuggestionsList').html(data);
            }
        });
    }
} // account_accountclosure   lookup




function fill_account_accountclosureaccountclosure_id(thisValue) {
	
    $('#account_accountclosureaccountclosure_id').val(thisValue);
	
	
   $('#account_accountclosureaccountclosure_idsuggestions').hide();
}

function fill_hiddenaccount_accountclosureaccountclosure_id(thisValue) {
	
    $('#account_accountclosureaccountclosure_idhidden').val(thisValue);
	
	
   $('#account_accountclosureaccountclosure_idsuggestions').hide();
}


function lookup_mylinkedaccounttermination_id(account_accountterminationaccounttermination_id) {
    if(account_accountterminationaccounttermination_id.length == 0) {
        
		
		$('#account_accountterminationaccounttermination_idsuggestions').hide();
    } else {
        $.post("../account/rpcaccount_accounttermination.php", {queryString: ""+account_accountterminationaccounttermination_id+""}, function(data){
            if(data.length >0) {
                $('#account_accountterminationaccounttermination_idsuggestions').show();
                $('#account_accountterminationaccounttermination_idautoSuggestionsList').html(data);
            }
        });
    }
} // account_accounttermination   lookup




function fill_account_accountterminationaccounttermination_id(thisValue) {
	
    $('#account_accountterminationaccounttermination_id').val(thisValue);
	
	
   $('#account_accountterminationaccounttermination_idsuggestions').hide();
}

function fill_hiddenaccount_accountterminationaccounttermination_id(thisValue) {
	
    $('#account_accountterminationaccounttermination_idhidden').val(thisValue);
	
	
   $('#account_accountterminationaccounttermination_idsuggestions').hide();
}


function lookup_mylinkedaccreation_id(account_accreationaccreation_id) {
    if(account_accreationaccreation_id.length == 0) {
        
		
		$('#account_accreationaccreation_idsuggestions').hide();
    } else {
        $.post("../account/rpcaccount_accreation.php", {queryString: ""+account_accreationaccreation_id+""}, function(data){
            if(data.length >0) {
                $('#account_accreationaccreation_idsuggestions').show();
                $('#account_accreationaccreation_idautoSuggestionsList').html(data);
            }
        });
    }
} // account_accreation   lookup




function fill_account_accreationaccreation_id(thisValue) {
	
    $('#account_accreationaccreation_id').val(thisValue);
	
	
   $('#account_accreationaccreation_idsuggestions').hide();
}

function fill_hiddenaccount_accreationaccreation_id(thisValue) {
	
    $('#account_accreationaccreation_idhidden').val(thisValue);
	
	
   $('#account_accreationaccreation_idsuggestions').hide();
}


function lookup_mylinkedacsetting_id(account_acsettingacsetting_id) {
    if(account_acsettingacsetting_id.length == 0) {
        
		
		$('#account_acsettingacsetting_idsuggestions').hide();
    } else {
        $.post("../account/rpcaccount_acsetting.php", {queryString: ""+account_acsettingacsetting_id+""}, function(data){
            if(data.length >0) {
                $('#account_acsettingacsetting_idsuggestions').show();
                $('#account_acsettingacsetting_idautoSuggestionsList').html(data);
            }
        });
    }
} // account_acsetting   lookup




function fill_account_acsettingacsetting_id(thisValue) {
	
    $('#account_acsettingacsetting_id').val(thisValue);
	
	
   $('#account_acsettingacsetting_idsuggestions').hide();
}

function fill_hiddenaccount_acsettingacsetting_id(thisValue) {
	
    $('#account_acsettingacsetting_idhidden').val(thisValue);
	
	
   $('#account_acsettingacsetting_idsuggestions').hide();
}


function lookup_mylinkedconsumer_id(account_consumerconsumer_id) {
    if(account_consumerconsumer_id.length == 0) {
        
		
		$('#account_consumerconsumer_idsuggestions').hide();
    } else {
        $.post("../account/rpcaccount_consumer.php", {queryString: ""+account_consumerconsumer_id+""}, function(data){
            if(data.length >0) {
                $('#account_consumerconsumer_idsuggestions').show();
                $('#account_consumerconsumer_idautoSuggestionsList').html(data);
            }
        });
    }
} // account_consumer   lookup




function fill_account_consumerconsumer_id(thisValue) {
	
    $('#account_consumerconsumer_id').val(thisValue);
	
	
   $('#account_consumerconsumer_idsuggestions').hide();
}

function fill_hiddenaccount_consumerconsumer_id(thisValue) {
	
    $('#account_consumerconsumer_idhidden').val(thisValue);
	
	
   $('#account_consumerconsumer_idsuggestions').hide();
}


function lookup_mylinkedcreditdebitrequest_id(account_creditdebitrequestcreditdebitrequest_id) {
    if(account_creditdebitrequestcreditdebitrequest_id.length == 0) {
        
		
		$('#account_creditdebitrequestcreditdebitrequest_idsuggestions').hide();
    } else {
        $.post("../account/rpcaccount_creditdebitrequest.php", {queryString: ""+account_creditdebitrequestcreditdebitrequest_id+""}, function(data){
            if(data.length >0) {
                $('#account_creditdebitrequestcreditdebitrequest_idsuggestions').show();
                $('#account_creditdebitrequestcreditdebitrequest_idautoSuggestionsList').html(data);
            }
        });
    }
} // account_creditdebitrequest   lookup




function fill_account_creditdebitrequestcreditdebitrequest_id(thisValue) {
	
    $('#account_creditdebitrequestcreditdebitrequest_id').val(thisValue);
	
	
   $('#account_creditdebitrequestcreditdebitrequest_idsuggestions').hide();
}

function fill_hiddenaccount_creditdebitrequestcreditdebitrequest_id(thisValue) {
	
    $('#account_creditdebitrequestcreditdebitrequest_idhidden').val(thisValue);
	
	
   $('#account_creditdebitrequestcreditdebitrequest_idsuggestions').hide();
}


function lookup_mylinkedcustomerdeactivate_id(account_customerdeactivatecustomerdeactivate_id) {
    if(account_customerdeactivatecustomerdeactivate_id.length == 0) {
        
		
		$('#account_customerdeactivatecustomerdeactivate_idsuggestions').hide();
    } else {
        $.post("../account/rpcaccount_customerdeactivate.php", {queryString: ""+account_customerdeactivatecustomerdeactivate_id+""}, function(data){
            if(data.length >0) {
                $('#account_customerdeactivatecustomerdeactivate_idsuggestions').show();
                $('#account_customerdeactivatecustomerdeactivate_idautoSuggestionsList').html(data);
            }
        });
    }
} // account_customerdeactivate   lookup




function fill_account_customerdeactivatecustomerdeactivate_id(thisValue) {
	
    $('#account_customerdeactivatecustomerdeactivate_id').val(thisValue);
	
	
   $('#account_customerdeactivatecustomerdeactivate_idsuggestions').hide();
}

function fill_hiddenaccount_customerdeactivatecustomerdeactivate_id(thisValue) {
	
    $('#account_customerdeactivatecustomerdeactivate_idhidden').val(thisValue);
	
	
   $('#account_customerdeactivatecustomerdeactivate_idsuggestions').hide();
}


function lookup_mylinkedgroupmaster_id(account_groupmastergroupmaster_id) {
    if(account_groupmastergroupmaster_id.length == 0) {
        
		
		$('#account_groupmastergroupmaster_idsuggestions').hide();
    } else {
        $.post("../account/rpcaccount_groupmaster.php", {queryString: ""+account_groupmastergroupmaster_id+""}, function(data){
            if(data.length >0) {
                $('#account_groupmastergroupmaster_idsuggestions').show();
                $('#account_groupmastergroupmaster_idautoSuggestionsList').html(data);
            }
        });
    }
} // account_groupmaster   lookup




function fill_account_groupmastergroupmaster_id(thisValue) {
	
    $('#account_groupmastergroupmaster_id').val(thisValue);
	
	
   $('#account_groupmastergroupmaster_idsuggestions').hide();
}

function fill_hiddenaccount_groupmastergroupmaster_id(thisValue) {
	
    $('#account_groupmastergroupmaster_idhidden').val(thisValue);
	
	
   $('#account_groupmastergroupmaster_idsuggestions').hide();
}


function lookup_mylinkedinvoice_id(account_invoiceinvoice_id) {
    if(account_invoiceinvoice_id.length == 0) {
        
		
		$('#account_invoiceinvoice_idsuggestions').hide();
    } else {
        $.post("../account/rpcaccount_invoice.php", {queryString: ""+account_invoiceinvoice_id+""}, function(data){
            if(data.length >0) {
                $('#account_invoiceinvoice_idsuggestions').show();
                $('#account_invoiceinvoice_idautoSuggestionsList').html(data);
            }
        });
    }
} // account_invoice   lookup




function fill_account_invoiceinvoice_id(thisValue) {
	
    $('#account_invoiceinvoice_id').val(thisValue);
	
	
   $('#account_invoiceinvoice_idsuggestions').hide();
}

function fill_hiddenaccount_invoiceinvoice_id(thisValue) {
	
    $('#account_invoiceinvoice_idhidden').val(thisValue);
	
	
   $('#account_invoiceinvoice_idsuggestions').hide();
}


function lookup_mylinkedtransactionlog_id(account_transactionlogtransactionlog_id) {
    if(account_transactionlogtransactionlog_id.length == 0) {
        
		
		$('#account_transactionlogtransactionlog_idsuggestions').hide();
    } else {
        $.post("../account/rpcaccount_transactionlog.php", {queryString: ""+account_transactionlogtransactionlog_id+""}, function(data){
            if(data.length >0) {
                $('#account_transactionlogtransactionlog_idsuggestions').show();
                $('#account_transactionlogtransactionlog_idautoSuggestionsList').html(data);
            }
        });
    }
} // account_transactionlog   lookup




function fill_account_transactionlogtransactionlog_id(thisValue) {
	
    $('#account_transactionlogtransactionlog_id').val(thisValue);
	
	
   $('#account_transactionlogtransactionlog_idsuggestions').hide();
}

function fill_hiddenaccount_transactionlogtransactionlog_id(thisValue) {
	
    $('#account_transactionlogtransactionlog_idhidden').val(thisValue);
	
	
   $('#account_transactionlogtransactionlog_idsuggestions').hide();
}


function lookup_mylinkedaggrigate_id(admin_aggrigateaggrigate_id) {
    if(admin_aggrigateaggrigate_id.length == 0) {
        
		
		$('#admin_aggrigateaggrigate_idsuggestions').hide();
    } else {
        $.post("../admin/rpcadmin_aggrigate.php", {queryString: ""+admin_aggrigateaggrigate_id+""}, function(data){
            if(data.length >0) {
                $('#admin_aggrigateaggrigate_idsuggestions').show();
                $('#admin_aggrigateaggrigate_idautoSuggestionsList').html(data);
            }
        });
    }
} // admin_aggrigate   lookup




function fill_admin_aggrigateaggrigate_id(thisValue) {
	
    $('#admin_aggrigateaggrigate_id').val(thisValue);
	
	
   $('#admin_aggrigateaggrigate_idsuggestions').hide();
}

function fill_hiddenadmin_aggrigateaggrigate_id(thisValue) {
	
    $('#admin_aggrigateaggrigate_idhidden').val(thisValue);
	
	
   $('#admin_aggrigateaggrigate_idsuggestions').hide();
}


function lookup_mylinkedalert_id(admin_alertalert_id) {
    if(admin_alertalert_id.length == 0) {
        
		
		$('#admin_alertalert_idsuggestions').hide();
    } else {
        $.post("../admin/rpcadmin_alert.php", {queryString: ""+admin_alertalert_id+""}, function(data){
            if(data.length >0) {
                $('#admin_alertalert_idsuggestions').show();
                $('#admin_alertalert_idautoSuggestionsList').html(data);
            }
        });
    }
} // admin_alert   lookup




function fill_admin_alertalert_id(thisValue) {
	
    $('#admin_alertalert_id').val(thisValue);
	
	
   $('#admin_alertalert_idsuggestions').hide();
}

function fill_hiddenadmin_alertalert_id(thisValue) {
	
    $('#admin_alertalert_idhidden').val(thisValue);
	
	
   $('#admin_alertalert_idsuggestions').hide();
}


function lookup_mylinkedbenefitdescr_id(admin_benefitdescrbenefitdescr_id) {
    if(admin_benefitdescrbenefitdescr_id.length == 0) {
        
		
		$('#admin_benefitdescrbenefitdescr_idsuggestions').hide();
    } else {
        $.post("../admin/rpcadmin_benefitdescr.php", {queryString: ""+admin_benefitdescrbenefitdescr_id+""}, function(data){
            if(data.length >0) {
                $('#admin_benefitdescrbenefitdescr_idsuggestions').show();
                $('#admin_benefitdescrbenefitdescr_idautoSuggestionsList').html(data);
            }
        });
    }
} // admin_benefitdescr   lookup




function fill_admin_benefitdescrbenefitdescr_id(thisValue) {
	
    $('#admin_benefitdescrbenefitdescr_id').val(thisValue);
	
	
   $('#admin_benefitdescrbenefitdescr_idsuggestions').hide();
}

function fill_hiddenadmin_benefitdescrbenefitdescr_id(thisValue) {
	
    $('#admin_benefitdescrbenefitdescr_idhidden').val(thisValue);
	
	
   $('#admin_benefitdescrbenefitdescr_idsuggestions').hide();
}


function lookup_mylinkedcompany_id(admin_companycompany_id) {
    if(admin_companycompany_id.length == 0) {
        
		
		$('#admin_companycompany_idsuggestions').hide();
    } else {
        $.post("../admin/rpcadmin_company.php", {queryString: ""+admin_companycompany_id+""}, function(data){
            if(data.length >0) {
                $('#admin_companycompany_idsuggestions').show();
                $('#admin_companycompany_idautoSuggestionsList').html(data);
            }
        });
    }
} // admin_company   lookup




function fill_admin_companycompany_id(thisValue) {
	
    $('#admin_companycompany_id').val(thisValue);
	
	
   $('#admin_companycompany_idsuggestions').hide();
}

function fill_hiddenadmin_companycompany_id(thisValue) {
	
    $('#admin_companycompany_idhidden').val(thisValue);
	
	
   $('#admin_companycompany_idsuggestions').hide();
}


function lookup_mylinkedcompstructtree_id(admin_compstructtreecompstructtree_id) {
    if(admin_compstructtreecompstructtree_id.length == 0) {
        
		
		$('#admin_compstructtreecompstructtree_idsuggestions').hide();
    } else {
        $.post("../admin/rpcadmin_compstructtree.php", {queryString: ""+admin_compstructtreecompstructtree_id+""}, function(data){
            if(data.length >0) {
                $('#admin_compstructtreecompstructtree_idsuggestions').show();
                $('#admin_compstructtreecompstructtree_idautoSuggestionsList').html(data);
            }
        });
    }
} // admin_compstructtree   lookup




function fill_admin_compstructtreecompstructtree_id(thisValue) {
	
    $('#admin_compstructtreecompstructtree_id').val(thisValue);
	
	
   $('#admin_compstructtreecompstructtree_idsuggestions').hide();
}

function fill_hiddenadmin_compstructtreecompstructtree_id(thisValue) {
	
    $('#admin_compstructtreecompstructtree_idhidden').val(thisValue);
	
	
   $('#admin_compstructtreecompstructtree_idsuggestions').hide();
}


function lookup_mylinkedcustom_id(admin_customcustom_id) {
    if(admin_customcustom_id.length == 0) {
        
		
		$('#admin_customcustom_idsuggestions').hide();
    } else {
        $.post("../admin/rpcadmin_custom.php", {queryString: ""+admin_customcustom_id+""}, function(data){
            if(data.length >0) {
                $('#admin_customcustom_idsuggestions').show();
                $('#admin_customcustom_idautoSuggestionsList').html(data);
            }
        });
    }
} // admin_custom   lookup




function fill_admin_customcustom_id(thisValue) {
	
    $('#admin_customcustom_id').val(thisValue);
	
	
   $('#admin_customcustom_idsuggestions').hide();
}

function fill_hiddenadmin_customcustom_id(thisValue) {
	
    $('#admin_customcustom_idhidden').val(thisValue);
	
	
   $('#admin_customcustom_idsuggestions').hide();
}


function lookup_mylinkedcustomer_id(admin_customercustomer_id) {
    if(admin_customercustomer_id.length == 0) {
        
		
		$('#admin_customercustomer_idsuggestions').hide();
    } else {
        $.post("../admin/rpcadmin_customer.php", {queryString: ""+admin_customercustomer_id+""}, function(data){
            if(data.length >0) {
                $('#admin_customercustomer_idsuggestions').show();
                $('#admin_customercustomer_idautoSuggestionsList').html(data);
            }
        });
    }
} // admin_customer   lookup




function fill_admin_customercustomer_id(thisValue) {
	
    $('#admin_customercustomer_id').val(thisValue);
	
	
   $('#admin_customercustomer_idsuggestions').hide();
}

function fill_hiddenadmin_customercustomer_id(thisValue) {
	
    $('#admin_customercustomer_idhidden').val(thisValue);
	
	
   $('#admin_customercustomer_idsuggestions').hide();
}


function lookup_mylinkedcustomimport_id(admin_customimportcustomimport_id) {
    if(admin_customimportcustomimport_id.length == 0) {
        
		
		$('#admin_customimportcustomimport_idsuggestions').hide();
    } else {
        $.post("../admin/rpcadmin_customimport.php", {queryString: ""+admin_customimportcustomimport_id+""}, function(data){
            if(data.length >0) {
                $('#admin_customimportcustomimport_idsuggestions').show();
                $('#admin_customimportcustomimport_idautoSuggestionsList').html(data);
            }
        });
    }
} // admin_customimport   lookup




function fill_admin_customimportcustomimport_id(thisValue) {
	
    $('#admin_customimportcustomimport_id').val(thisValue);
	
	
   $('#admin_customimportcustomimport_idsuggestions').hide();
}

function fill_hiddenadmin_customimportcustomimport_id(thisValue) {
	
    $('#admin_customimportcustomimport_idhidden').val(thisValue);
	
	
   $('#admin_customimportcustomimport_idsuggestions').hide();
}


function lookup_mylinkeddept_id(admin_deptdept_id) {
    if(admin_deptdept_id.length == 0) {
        
		
		$('#admin_deptdept_idsuggestions').hide();
    } else {
        $.post("../admin/rpcadmin_dept.php", {queryString: ""+admin_deptdept_id+""}, function(data){
            if(data.length >0) {
                $('#admin_deptdept_idsuggestions').show();
                $('#admin_deptdept_idautoSuggestionsList').html(data);
            }
        });
    }
} // admin_dept   lookup




function fill_admin_deptdept_id(thisValue) {
	
    $('#admin_deptdept_id').val(thisValue);
	
	
   $('#admin_deptdept_idsuggestions').hide();
}

function fill_hiddenadmin_deptdept_id(thisValue) {
	
    $('#admin_deptdept_idhidden').val(thisValue);
	
	
   $('#admin_deptdept_idsuggestions').hide();
}


function lookup_mylinkeddocs_id(admin_docsdocs_id) {
    if(admin_docsdocs_id.length == 0) {
        
		
		$('#admin_docsdocs_idsuggestions').hide();
    } else {
        $.post("../admin/rpcadmin_docs.php", {queryString: ""+admin_docsdocs_id+""}, function(data){
            if(data.length >0) {
                $('#admin_docsdocs_idsuggestions').show();
                $('#admin_docsdocs_idautoSuggestionsList').html(data);
            }
        });
    }
} // admin_docs   lookup




function fill_admin_docsdocs_id(thisValue) {
	
    $('#admin_docsdocs_id').val(thisValue);
	
	
   $('#admin_docsdocs_idsuggestions').hide();
}

function fill_hiddenadmin_docsdocs_id(thisValue) {
	
    $('#admin_docsdocs_idhidden').val(thisValue);
	
	
   $('#admin_docsdocs_idsuggestions').hide();
}


function lookup_mylinkedempreport_id(admin_empreportempreport_id) {
    if(admin_empreportempreport_id.length == 0) {
        
		
		$('#admin_empreportempreport_idsuggestions').hide();
    } else {
        $.post("../admin/rpcadmin_empreport.php", {queryString: ""+admin_empreportempreport_id+""}, function(data){
            if(data.length >0) {
                $('#admin_empreportempreport_idsuggestions').show();
                $('#admin_empreportempreport_idautoSuggestionsList').html(data);
            }
        });
    }
} // admin_empreport   lookup




function fill_admin_empreportempreport_id(thisValue) {
	
    $('#admin_empreportempreport_id').val(thisValue);
	
	
   $('#admin_empreportempreport_idsuggestions').hide();
}

function fill_hiddenadmin_empreportempreport_id(thisValue) {
	
    $('#admin_empreportempreport_idhidden').val(thisValue);
	
	
   $('#admin_empreportempreport_idsuggestions').hide();
}


function lookup_mylinkedpasswordreset_id(admin_passwordresetpasswordreset_id) {
    if(admin_passwordresetpasswordreset_id.length == 0) {
        
		
		$('#admin_passwordresetpasswordreset_idsuggestions').hide();
    } else {
        $.post("../admin/rpcadmin_passwordreset.php", {queryString: ""+admin_passwordresetpasswordreset_id+""}, function(data){
            if(data.length >0) {
                $('#admin_passwordresetpasswordreset_idsuggestions').show();
                $('#admin_passwordresetpasswordreset_idautoSuggestionsList').html(data);
            }
        });
    }
} // admin_passwordreset   lookup




function fill_admin_passwordresetpasswordreset_id(thisValue) {
	
    $('#admin_passwordresetpasswordreset_id').val(thisValue);
	
	
   $('#admin_passwordresetpasswordreset_idsuggestions').hide();
}

function fill_hiddenadmin_passwordresetpasswordreset_id(thisValue) {
	
    $('#admin_passwordresetpasswordreset_idhidden').val(thisValue);
	
	
   $('#admin_passwordresetpasswordreset_idsuggestions').hide();
}


function lookup_mylinkedperson_id(admin_personperson_id) {
    if(admin_personperson_id.length == 0) {
        
		
		$('#admin_personperson_idsuggestions').hide();
    } else {
        $.post("../admin/rpcadmin_person.php", {queryString: ""+admin_personperson_id+""}, function(data){
            if(data.length >0) {
                $('#admin_personperson_idsuggestions').show();
                $('#admin_personperson_idautoSuggestionsList').html(data);
            }
        });
    }
} // admin_person   lookup




function fill_admin_personperson_id(thisValue) {
	
    $('#admin_personperson_id').val(thisValue);
	
	
   $('#admin_personperson_idsuggestions').hide();
}

function fill_hiddenadmin_personperson_id(thisValue) {
	
    $('#admin_personperson_idhidden').val(thisValue);
	
	
   $('#admin_personperson_idsuggestions').hide();
}


function lookup_mylinkedrole_id(admin_rolerole_id) {
    if(admin_rolerole_id.length == 0) {
        
		
		$('#admin_rolerole_idsuggestions').hide();
    } else {
        $.post("../admin/rpcadmin_role.php", {queryString: ""+admin_rolerole_id+""}, function(data){
            if(data.length >0) {
                $('#admin_rolerole_idsuggestions').show();
                $('#admin_rolerole_idautoSuggestionsList').html(data);
            }
        });
    }
} // admin_role   lookup




function fill_admin_rolerole_id(thisValue) {
	
    $('#admin_rolerole_id').val(thisValue);
	
	
   $('#admin_rolerole_idsuggestions').hide();
}

function fill_hiddenadmin_rolerole_id(thisValue) {
	
    $('#admin_rolerole_idhidden').val(thisValue);
	
	
   $('#admin_rolerole_idsuggestions').hide();
}


function lookup_mylinkedschart_id(admin_schartschart_id) {
    if(admin_schartschart_id.length == 0) {
        
		
		$('#admin_schartschart_idsuggestions').hide();
    } else {
        $.post("../admin/rpcadmin_schart.php", {queryString: ""+admin_schartschart_id+""}, function(data){
            if(data.length >0) {
                $('#admin_schartschart_idsuggestions').show();
                $('#admin_schartschart_idautoSuggestionsList').html(data);
            }
        });
    }
} // admin_schart   lookup




function fill_admin_schartschart_id(thisValue) {
	
    $('#admin_schartschart_id').val(thisValue);
	
	
   $('#admin_schartschart_idsuggestions').hide();
}

function fill_hiddenadmin_schartschart_id(thisValue) {
	
    $('#admin_schartschart_idhidden').val(thisValue);
	
	
   $('#admin_schartschart_idsuggestions').hide();
}


function lookup_mylinkedstatustypestatus_id(admin_statusstatustypestatus_id) {
    if(admin_statusstatustypestatus_id.length == 0) {
        
		
		$('#admin_statusstatustypestatus_idsuggestions').hide();
    } else {
        $.post("../admin/rpcadmin_status.php", {queryString: ""+admin_statusstatustypestatus_id+""}, function(data){
            if(data.length >0) {
                $('#admin_statusstatustypestatus_idsuggestions').show();
                $('#admin_statusstatustypestatus_idautoSuggestionsList').html(data);
            }
        });
    }
} // admin_status   lookup




function fill_admin_statusstatustypestatus_id(thisValue) {
	
    $('#admin_statusstatustypestatus_id').val(thisValue);
	
	
   $('#admin_statusstatustypestatus_idsuggestions').hide();
}

function fill_hiddenadmin_statusstatustypestatus_id(thisValue) {
	
    $('#admin_statusstatustypestatus_idhidden').val(thisValue);
	
	
   $('#admin_statusstatustypestatus_idsuggestions').hide();
}


function lookup_mylinkedstatustype_id(admin_statustypestatustype_id) {
    if(admin_statustypestatustype_id.length == 0) {
        
		
		$('#admin_statustypestatustype_idsuggestions').hide();
    } else {
        $.post("../admin/rpcadmin_statustype.php", {queryString: ""+admin_statustypestatustype_id+""}, function(data){
            if(data.length >0) {
                $('#admin_statustypestatustype_idsuggestions').show();
                $('#admin_statustypestatustype_idautoSuggestionsList').html(data);
            }
        });
    }
} // admin_statustype   lookup




function fill_admin_statustypestatustype_id(thisValue) {
	
    $('#admin_statustypestatustype_id').val(thisValue);
	
	
   $('#admin_statustypestatustype_idsuggestions').hide();
}

function fill_hiddenadmin_statustypestatustype_id(thisValue) {
	
    $('#admin_statustypestatustype_idhidden').val(thisValue);
	
	
   $('#admin_statustypestatustype_idsuggestions').hide();
}


function lookup_mylinkedtable_id(admin_tabletable_id) {
    if(admin_tabletable_id.length == 0) {
        
		
		$('#admin_tabletable_idsuggestions').hide();
    } else {
        $.post("../admin/rpcadmin_table.php", {queryString: ""+admin_tabletable_id+""}, function(data){
            if(data.length >0) {
                $('#admin_tabletable_idsuggestions').show();
                $('#admin_tabletable_idautoSuggestionsList').html(data);
            }
        });
    }
} // admin_table   lookup




function fill_admin_tabletable_id(thisValue) {
	
    $('#admin_tabletable_id').val(thisValue);
	
	
   $('#admin_tabletable_idsuggestions').hide();
}

function fill_hiddenadmin_tabletable_id(thisValue) {
	
    $('#admin_tabletable_idhidden').val(thisValue);
	
	
   $('#admin_tabletable_idsuggestions').hide();
}


function lookup_mylinkedid_id(admin_userid_id) {
    if(admin_userid_id.length == 0) {
        
		
		$('#admin_userid_idsuggestions').hide();
    } else {
        $.post("../admin/rpcadmin_user.php", {queryString: ""+admin_userid_id+""}, function(data){
            if(data.length >0) {
                $('#admin_userid_idsuggestions').show();
                $('#admin_userid_idautoSuggestionsList').html(data);
            }
        });
    }
} // admin_user   lookup




function fill_admin_userid(thisValue) {
	
    $('#admin_userid').val(thisValue);
	
	
   $('#admin_userid_idsuggestions').hide();
}

function fill_hiddenadmin_userid(thisValue) {
	
    $('#admin_useridhidden').val(thisValue);
	
	
   $('#admin_userid_idsuggestions').hide();
}


function lookup_mylinkedusergroup_id(admin_usergroupusergroup_id) {
    if(admin_usergroupusergroup_id.length == 0) {
        
		
		$('#admin_usergroupusergroup_idsuggestions').hide();
    } else {
        $.post("../admin/rpcadmin_usergroup.php", {queryString: ""+admin_usergroupusergroup_id+""}, function(data){
            if(data.length >0) {
                $('#admin_usergroupusergroup_idsuggestions').show();
                $('#admin_usergroupusergroup_idautoSuggestionsList').html(data);
            }
        });
    }
} // admin_usergroup   lookup




function fill_admin_usergroupusergroup_id(thisValue) {
	
    $('#admin_usergroupusergroup_id').val(thisValue);
	
	
   $('#admin_usergroupusergroup_idsuggestions').hide();
}

function fill_hiddenadmin_usergroupusergroup_id(thisValue) {
	
    $('#admin_usergroupusergroup_idhidden').val(thisValue);
	
	
   $('#admin_usergroupusergroup_idsuggestions').hide();
}


function lookup_mylinkedinsuranceaccount_id(bank_insuranceaccountinsuranceaccount_id) {
    if(bank_insuranceaccountinsuranceaccount_id.length == 0) {
        
		
		$('#bank_insuranceaccountinsuranceaccount_idsuggestions').hide();
    } else {
        $.post("../bank/rpcbank_insuranceaccount.php", {queryString: ""+bank_insuranceaccountinsuranceaccount_id+""}, function(data){
            if(data.length >0) {
                $('#bank_insuranceaccountinsuranceaccount_idsuggestions').show();
                $('#bank_insuranceaccountinsuranceaccount_idautoSuggestionsList').html(data);
            }
        });
    }
} // bank_insuranceaccount   lookup




function fill_bank_insuranceaccountinsuranceaccount_id(thisValue) {
	
    $('#bank_insuranceaccountinsuranceaccount_id').val(thisValue);
	
	
   $('#bank_insuranceaccountinsuranceaccount_idsuggestions').hide();
}

function fill_hiddenbank_insuranceaccountinsuranceaccount_id(thisValue) {
	
    $('#bank_insuranceaccountinsuranceaccount_idhidden').val(thisValue);
	
	
   $('#bank_insuranceaccountinsuranceaccount_idsuggestions').hide();
}


function lookup_mylinkedagent_id(company_agentagent_id) {
    if(company_agentagent_id.length == 0) {
        
		
		$('#company_agentagent_idsuggestions').hide();
    } else {
        $.post("../company/rpccompany_agent.php", {queryString: ""+company_agentagent_id+""}, function(data){
            if(data.length >0) {
                $('#company_agentagent_idsuggestions').show();
                $('#company_agentagent_idautoSuggestionsList').html(data);
            }
        });
    }
} // company_agent   lookup




function fill_company_agentagent_id(thisValue) {
	
    $('#company_agentagent_id').val(thisValue);
	
	
   $('#company_agentagent_idsuggestions').hide();
}

function fill_hiddencompany_agentagent_id(thisValue) {
	
    $('#company_agentagent_idhidden').val(thisValue);
	
	
   $('#company_agentagent_idsuggestions').hide();
}


function lookup_mylinkedemployee_id(company_employeeemployee_id) {
    if(company_employeeemployee_id.length == 0) {
        
		
		$('#company_employeeemployee_idsuggestions').hide();
    } else {
        $.post("../company/rpccompany_employee.php", {queryString: ""+company_employeeemployee_id+""}, function(data){
            if(data.length >0) {
                $('#company_employeeemployee_idsuggestions').show();
                $('#company_employeeemployee_idautoSuggestionsList').html(data);
            }
        });
    }
} // company_employee   lookup




function fill_company_employeeemployee_id(thisValue) {
	
    $('#company_employeeemployee_id').val(thisValue);
	
	
   $('#company_employeeemployee_idsuggestions').hide();
}

function fill_hiddencompany_employeeemployee_id(thisValue) {
	
    $('#company_employeeemployee_idhidden').val(thisValue);
	
	
   $('#company_employeeemployee_idsuggestions').hide();
}


function lookup_mylinkedcharttype_id(designer_charttypecharttype_id) {
    if(designer_charttypecharttype_id.length == 0) {
        
		
		$('#designer_charttypecharttype_idsuggestions').hide();
    } else {
        $.post("../designer/rpcdesigner_charttype.php", {queryString: ""+designer_charttypecharttype_id+""}, function(data){
            if(data.length >0) {
                $('#designer_charttypecharttype_idsuggestions').show();
                $('#designer_charttypecharttype_idautoSuggestionsList').html(data);
            }
        });
    }
} // designer_charttype   lookup




function fill_designer_charttypecharttype_id(thisValue) {
	
    $('#designer_charttypecharttype_id').val(thisValue);
	
	
   $('#designer_charttypecharttype_idsuggestions').hide();
}

function fill_hiddendesigner_charttypecharttype_id(thisValue) {
	
    $('#designer_charttypecharttype_idhidden').val(thisValue);
	
	
   $('#designer_charttypecharttype_idsuggestions').hide();
}


function lookup_mylinkedsform_id(designer_sformsform_id) {
    if(designer_sformsform_id.length == 0) {
        
		
		$('#designer_sformsform_idsuggestions').hide();
    } else {
        $.post("../designer/rpcdesigner_sform.php", {queryString: ""+designer_sformsform_id+""}, function(data){
            if(data.length >0) {
                $('#designer_sformsform_idsuggestions').show();
                $('#designer_sformsform_idautoSuggestionsList').html(data);
            }
        });
    }
} // designer_sform   lookup




function fill_designer_sformsform_id(thisValue) {
	
    $('#designer_sformsform_id').val(thisValue);
	
	
   $('#designer_sformsform_idsuggestions').hide();
}

function fill_hiddendesigner_sformsform_id(thisValue) {
	
    $('#designer_sformsform_idhidden').val(thisValue);
	
	
   $('#designer_sformsform_idsuggestions').hide();
}


function lookup_mylinkedsview_id(designer_sviewsview_id) {
    if(designer_sviewsview_id.length == 0) {
        
		
		$('#designer_sviewsview_idsuggestions').hide();
    } else {
        $.post("../designer/rpcdesigner_sview.php", {queryString: ""+designer_sviewsview_id+""}, function(data){
            if(data.length >0) {
                $('#designer_sviewsview_idsuggestions').show();
                $('#designer_sviewsview_idautoSuggestionsList').html(data);
            }
        });
    }
} // designer_sview   lookup




function fill_designer_sviewsview_id(thisValue) {
	
    $('#designer_sviewsview_id').val(thisValue);
	
	
   $('#designer_sviewsview_idsuggestions').hide();
}

function fill_hiddendesigner_sviewsview_id(thisValue) {
	
    $('#designer_sviewsview_idhidden').val(thisValue);
	
	
   $('#designer_sviewsview_idsuggestions').hide();
}


function lookup_mylinkedviewicon_id(designer_viewiconviewicon_id) {
    if(designer_viewiconviewicon_id.length == 0) {
        
		
		$('#designer_viewiconviewicon_idsuggestions').hide();
    } else {
        $.post("../designer/rpcdesigner_viewicon.php", {queryString: ""+designer_viewiconviewicon_id+""}, function(data){
            if(data.length >0) {
                $('#designer_viewiconviewicon_idsuggestions').show();
                $('#designer_viewiconviewicon_idautoSuggestionsList').html(data);
            }
        });
    }
} // designer_viewicon   lookup




function fill_designer_viewiconviewicon_id(thisValue) {
	
    $('#designer_viewiconviewicon_id').val(thisValue);
	
	
   $('#designer_viewiconviewicon_idsuggestions').hide();
}

function fill_hiddendesigner_viewiconviewicon_id(thisValue) {
	
    $('#designer_viewiconviewicon_idhidden').val(thisValue);
	
	
   $('#designer_viewiconviewicon_idsuggestions').hide();
}


function lookup_mylinkedviewmode_id(designer_viewmodeviewmode_id) {
    if(designer_viewmodeviewmode_id.length == 0) {
        
		
		$('#designer_viewmodeviewmode_idsuggestions').hide();
    } else {
        $.post("../designer/rpcdesigner_viewmode.php", {queryString: ""+designer_viewmodeviewmode_id+""}, function(data){
            if(data.length >0) {
                $('#designer_viewmodeviewmode_idsuggestions').show();
                $('#designer_viewmodeviewmode_idautoSuggestionsList').html(data);
            }
        });
    }
} // designer_viewmode   lookup




function fill_designer_viewmodeviewmode_id(thisValue) {
	
    $('#designer_viewmodeviewmode_id').val(thisValue);
	
	
   $('#designer_viewmodeviewmode_idsuggestions').hide();
}

function fill_hiddendesigner_viewmodeviewmode_id(thisValue) {
	
    $('#designer_viewmodeviewmode_idhidden').val(thisValue);
	
	
   $('#designer_viewmodeviewmode_idsuggestions').hide();
}


function lookup_mylinkedevent_id(events_eventevent_id) {
    if(events_eventevent_id.length == 0) {
        
		
		$('#events_eventevent_idsuggestions').hide();
    } else {
        $.post("../events/rpcevents_event.php", {queryString: ""+events_eventevent_id+""}, function(data){
            if(data.length >0) {
                $('#events_eventevent_idsuggestions').show();
                $('#events_eventevent_idautoSuggestionsList').html(data);
            }
        });
    }
} // events_event   lookup




function fill_events_eventevent_id(thisValue) {
	
    $('#events_eventevent_id').val(thisValue);
	
	
   $('#events_eventevent_idsuggestions').hide();
}

function fill_hiddenevents_eventevent_id(thisValue) {
	
    $('#events_eventevent_idhidden').val(thisValue);
	
	
   $('#events_eventevent_idsuggestions').hide();
}


function lookup_mylinkedreminder_id(events_reminderreminder_id) {
    if(events_reminderreminder_id.length == 0) {
        
		
		$('#events_reminderreminder_idsuggestions').hide();
    } else {
        $.post("../events/rpcevents_reminder.php", {queryString: ""+events_reminderreminder_id+""}, function(data){
            if(data.length >0) {
                $('#events_reminderreminder_idsuggestions').show();
                $('#events_reminderreminder_idautoSuggestionsList').html(data);
            }
        });
    }
} // events_reminder   lookup




function fill_events_reminderreminder_id(thisValue) {
	
    $('#events_reminderreminder_id').val(thisValue);
	
	
   $('#events_reminderreminder_idsuggestions').hide();
}

function fill_hiddenevents_reminderreminder_id(thisValue) {
	
    $('#events_reminderreminder_idhidden').val(thisValue);
	
	
   $('#events_reminderreminder_idsuggestions').hide();
}


function lookup_mylinkedlandlord_id(housing_landlordlandlord_id) {
    if(housing_landlordlandlord_id.length == 0) {
        
		
		$('#housing_landlordlandlord_idsuggestions').hide();
    } else {
        $.post("../housing/rpchousing_landlord.php", {queryString: ""+housing_landlordlandlord_id+""}, function(data){
            if(data.length >0) {
                $('#housing_landlordlandlord_idsuggestions').show();
                $('#housing_landlordlandlord_idautoSuggestionsList').html(data);
            }
        });
    }
} // housing_landlord   lookup




function fill_housing_landlordlandlord_id(thisValue) {
	
    $('#housing_landlordlandlord_id').val(thisValue);
	
	
   $('#housing_landlordlandlord_idsuggestions').hide();
}

function fill_hiddenhousing_landlordlandlord_id(thisValue) {
	
    $('#housing_landlordlandlord_idhidden').val(thisValue);
	
	
   $('#housing_landlordlandlord_idsuggestions').hide();
}


function lookup_mylinkednextofkin_id(housing_nextofkinnextofkin_id) {
    if(housing_nextofkinnextofkin_id.length == 0) {
        
		
		$('#housing_nextofkinnextofkin_idsuggestions').hide();
    } else {
        $.post("../housing/rpchousing_nextofkin.php", {queryString: ""+housing_nextofkinnextofkin_id+""}, function(data){
            if(data.length >0) {
                $('#housing_nextofkinnextofkin_idsuggestions').show();
                $('#housing_nextofkinnextofkin_idautoSuggestionsList').html(data);
            }
        });
    }
} // housing_nextofkin   lookup




function fill_housing_nextofkinnextofkin_id(thisValue) {
	
    $('#housing_nextofkinnextofkin_id').val(thisValue);
	
	
   $('#housing_nextofkinnextofkin_idsuggestions').hide();
}

function fill_hiddenhousing_nextofkinnextofkin_id(thisValue) {
	
    $('#housing_nextofkinnextofkin_idhidden').val(thisValue);
	
	
   $('#housing_nextofkinnextofkin_idsuggestions').hide();
}


function lookup_mylinkedproperty_id(housing_propertyproperty_id) {
    if(housing_propertyproperty_id.length == 0) {
        
		
		$('#housing_propertyproperty_idsuggestions').hide();
    } else {
        $.post("../housing/rpchousing_property.php", {queryString: ""+housing_propertyproperty_id+""}, function(data){
            if(data.length >0) {
                $('#housing_propertyproperty_idsuggestions').show();
                $('#housing_propertyproperty_idautoSuggestionsList').html(data);
            }
        });
    }
} // housing_property   lookup




function fill_housing_propertyproperty_id(thisValue) {
	
    $('#housing_propertyproperty_id').val(thisValue);
	
	
   $('#housing_propertyproperty_idsuggestions').hide();
}

function fill_hiddenhousing_propertyproperty_id(thisValue) {
	
    $('#housing_propertyproperty_idhidden').val(thisValue);
	
	
   $('#housing_propertyproperty_idsuggestions').hide();
}


function lookup_mylinkedtenant_id(housing_tenanttenant_id) {
    if(housing_tenanttenant_id.length == 0) {
        
		
		$('#housing_tenanttenant_idsuggestions').hide();
    } else {
        $.post("../housing/rpchousing_tenant.php", {queryString: ""+housing_tenanttenant_id+""}, function(data){
            if(data.length >0) {
                $('#housing_tenanttenant_idsuggestions').show();
                $('#housing_tenanttenant_idautoSuggestionsList').html(data);
            }
        });
    }
} // housing_tenant   lookup




function fill_housing_tenanttenant_id(thisValue) {
	
    $('#housing_tenanttenant_id').val(thisValue);
	
	
   $('#housing_tenanttenant_idsuggestions').hide();
}

function fill_hiddenhousing_tenanttenant_id(thisValue) {
	
    $('#housing_tenanttenant_idhidden').val(thisValue);
	
	
   $('#housing_tenanttenant_idsuggestions').hide();
}


function lookup_mylinkedunit_id(housing_unitunit_id) {
    if(housing_unitunit_id.length == 0) {
        
		
		$('#housing_unitunit_idsuggestions').hide();
    } else {
        $.post("../housing/rpchousing_unit.php", {queryString: ""+housing_unitunit_id+""}, function(data){
            if(data.length >0) {
                $('#housing_unitunit_idsuggestions').show();
                $('#housing_unitunit_idautoSuggestionsList').html(data);
            }
        });
    }
} // housing_unit   lookup




function fill_housing_unitunit_id(thisValue) {
	
    $('#housing_unitunit_id').val(thisValue);
	
	
   $('#housing_unitunit_idsuggestions').hide();
}

function fill_hiddenhousing_unitunit_id(thisValue) {
	
    $('#housing_unitunit_idhidden').val(thisValue);
	
	
   $('#housing_unitunit_idsuggestions').hide();
}


function lookup_mylinkedclient_id(insurance_clientclient_id) {
    if(insurance_clientclient_id.length == 0) {
        
		
		$('#insurance_clientclient_idsuggestions').hide();
    } else {
        $.post("../insurance/rpcinsurance_client.php", {queryString: ""+insurance_clientclient_id+""}, function(data){
            if(data.length >0) {
                $('#insurance_clientclient_idsuggestions').show();
                $('#insurance_clientclient_idautoSuggestionsList').html(data);
            }
        });
    }
} // insurance_client   lookup




function fill_insurance_clientclient_id(thisValue) {
	
    $('#insurance_clientclient_id').val(thisValue);
	
	
   $('#insurance_clientclient_idsuggestions').hide();
}

function fill_hiddeninsurance_clientclient_id(thisValue) {
	
    $('#insurance_clientclient_idhidden').val(thisValue);
	
	
   $('#insurance_clientclient_idsuggestions').hide();
}


function lookup_mylinkedinsurer_id(insurance_insurerinsurer_id) {
    if(insurance_insurerinsurer_id.length == 0) {
        
		
		$('#insurance_insurerinsurer_idsuggestions').hide();
    } else {
        $.post("../insurance/rpcinsurance_insurer.php", {queryString: ""+insurance_insurerinsurer_id+""}, function(data){
            if(data.length >0) {
                $('#insurance_insurerinsurer_idsuggestions').show();
                $('#insurance_insurerinsurer_idautoSuggestionsList').html(data);
            }
        });
    }
} // insurance_insurer   lookup




function fill_insurance_insurerinsurer_id(thisValue) {
	
    $('#insurance_insurerinsurer_id').val(thisValue);
	
	
   $('#insurance_insurerinsurer_idsuggestions').hide();
}

function fill_hiddeninsurance_insurerinsurer_id(thisValue) {
	
    $('#insurance_insurerinsurer_idhidden').val(thisValue);
	
	
   $('#insurance_insurerinsurer_idsuggestions').hide();
}


function lookup_mylinkedpolicy_id(insurance_policypolicy_id) {
    if(insurance_policypolicy_id.length == 0) {
        
		
		$('#insurance_policypolicy_idsuggestions').hide();
    } else {
        $.post("../insurance/rpcinsurance_policy.php", {queryString: ""+insurance_policypolicy_id+""}, function(data){
            if(data.length >0) {
                $('#insurance_policypolicy_idsuggestions').show();
                $('#insurance_policypolicy_idautoSuggestionsList').html(data);
            }
        });
    }
} // insurance_policy   lookup




function fill_insurance_policypolicy_id(thisValue) {
	
    $('#insurance_policypolicy_id').val(thisValue);
	
	
   $('#insurance_policypolicy_idsuggestions').hide();
}

function fill_hiddeninsurance_policypolicy_id(thisValue) {
	
    $('#insurance_policypolicy_idhidden').val(thisValue);
	
	
   $('#insurance_policypolicy_idsuggestions').hide();
}


function lookup_mylinkedpolicytype_id(insurance_policytypepolicytype_id) {
    if(insurance_policytypepolicytype_id.length == 0) {
        
		
		$('#insurance_policytypepolicytype_idsuggestions').hide();
    } else {
        $.post("../insurance/rpcinsurance_policytype.php", {queryString: ""+insurance_policytypepolicytype_id+""}, function(data){
            if(data.length >0) {
                $('#insurance_policytypepolicytype_idsuggestions').show();
                $('#insurance_policytypepolicytype_idautoSuggestionsList').html(data);
            }
        });
    }
} // insurance_policytype   lookup




function fill_insurance_policytypepolicytype_id(thisValue) {
	
    $('#insurance_policytypepolicytype_id').val(thisValue);
	
	
   $('#insurance_policytypepolicytype_idsuggestions').hide();
}

function fill_hiddeninsurance_policytypepolicytype_id(thisValue) {
	
    $('#insurance_policytypepolicytype_idhidden').val(thisValue);
	
	
   $('#insurance_policytypepolicytype_idsuggestions').hide();
}


function lookup_mylinkedproduct_id(insurance_productproduct_id) {
    if(insurance_productproduct_id.length == 0) {
        
		
		$('#insurance_productproduct_idsuggestions').hide();
    } else {
        $.post("../insurance/rpcinsurance_product.php", {queryString: ""+insurance_productproduct_id+""}, function(data){
            if(data.length >0) {
                $('#insurance_productproduct_idsuggestions').show();
                $('#insurance_productproduct_idautoSuggestionsList').html(data);
            }
        });
    }
} // insurance_product   lookup




function fill_insurance_productproduct_id(thisValue) {
	
    $('#insurance_productproduct_id').val(thisValue);
	
	
   $('#insurance_productproduct_idsuggestions').hide();
}

function fill_hiddeninsurance_productproduct_id(thisValue) {
	
    $('#insurance_productproduct_idhidden').val(thisValue);
	
	
   $('#insurance_productproduct_idsuggestions').hide();
}


function lookup_mylinkedrisk_id(insurance_riskrisk_id) {
    if(insurance_riskrisk_id.length == 0) {
        
		
		$('#insurance_riskrisk_idsuggestions').hide();
    } else {
        $.post("../insurance/rpcinsurance_risk.php", {queryString: ""+insurance_riskrisk_id+""}, function(data){
            if(data.length >0) {
                $('#insurance_riskrisk_idsuggestions').show();
                $('#insurance_riskrisk_idautoSuggestionsList').html(data);
            }
        });
    }
} // insurance_risk   lookup




function fill_insurance_riskrisk_id(thisValue) {
	
    $('#insurance_riskrisk_id').val(thisValue);
	
	
   $('#insurance_riskrisk_idsuggestions').hide();
}

function fill_hiddeninsurance_riskrisk_id(thisValue) {
	
    $('#insurance_riskrisk_idhidden').val(thisValue);
	
	
   $('#insurance_riskrisk_idsuggestions').hide();
}


function lookup_mylinkedbank_id(payment_bankbank_id) {
    if(payment_bankbank_id.length == 0) {
        
		
		$('#payment_bankbank_idsuggestions').hide();
    } else {
        $.post("../payment/rpcpayment_bank.php", {queryString: ""+payment_bankbank_id+""}, function(data){
            if(data.length >0) {
                $('#payment_bankbank_idsuggestions').show();
                $('#payment_bankbank_idautoSuggestionsList').html(data);
            }
        });
    }
} // payment_bank   lookup




function fill_payment_bankbank_id(thisValue) {
	
    $('#payment_bankbank_id').val(thisValue);
	
	
   $('#payment_bankbank_idsuggestions').hide();
}

function fill_hiddenpayment_bankbank_id(thisValue) {
	
    $('#payment_bankbank_idhidden').val(thisValue);
	
	
   $('#payment_bankbank_idsuggestions').hide();
}


function lookup_mylinkedbranch_id(payment_branchbranch_id) {
    if(payment_branchbranch_id.length == 0) {
        
		
		$('#payment_branchbranch_idsuggestions').hide();
    } else {
        $.post("../payment/rpcpayment_branch.php", {queryString: ""+payment_branchbranch_id+""}, function(data){
            if(data.length >0) {
                $('#payment_branchbranch_idsuggestions').show();
                $('#payment_branchbranch_idautoSuggestionsList').html(data);
            }
        });
    }
} // payment_branch   lookup




function fill_payment_branchbranch_id(thisValue) {
	
    $('#payment_branchbranch_id').val(thisValue);
	
	
   $('#payment_branchbranch_idsuggestions').hide();
}

function fill_hiddenpayment_branchbranch_id(thisValue) {
	
    $('#payment_branchbranch_idhidden').val(thisValue);
	
	
   $('#payment_branchbranch_idsuggestions').hide();
}


function lookup_mylinkedcostcenter_id(payment_costcentercostcenter_id) {
    if(payment_costcentercostcenter_id.length == 0) {
        
		
		$('#payment_costcentercostcenter_idsuggestions').hide();
    } else {
        $.post("../payment/rpcpayment_costcenter.php", {queryString: ""+payment_costcentercostcenter_id+""}, function(data){
            if(data.length >0) {
                $('#payment_costcentercostcenter_idsuggestions').show();
                $('#payment_costcentercostcenter_idautoSuggestionsList').html(data);
            }
        });
    }
} // payment_costcenter   lookup




function fill_payment_costcentercostcenter_id(thisValue) {
	
    $('#payment_costcentercostcenter_id').val(thisValue);
	
	
   $('#payment_costcentercostcenter_idsuggestions').hide();
}

function fill_hiddenpayment_costcentercostcenter_id(thisValue) {
	
    $('#payment_costcentercostcenter_idhidden').val(thisValue);
	
	
   $('#payment_costcentercostcenter_idsuggestions').hide();
}


function lookup_mylinkedcurrency_id(payment_currencycurrency_id) {
    if(payment_currencycurrency_id.length == 0) {
        
		
		$('#payment_currencycurrency_idsuggestions').hide();
    } else {
        $.post("../payment/rpcpayment_currency.php", {queryString: ""+payment_currencycurrency_id+""}, function(data){
            if(data.length >0) {
                $('#payment_currencycurrency_idsuggestions').show();
                $('#payment_currencycurrency_idautoSuggestionsList').html(data);
            }
        });
    }
} // payment_currency   lookup




function fill_payment_currencycurrency_id(thisValue) {
	
    $('#payment_currencycurrency_id').val(thisValue);
	
	
   $('#payment_currencycurrency_idsuggestions').hide();
}

function fill_hiddenpayment_currencycurrency_id(thisValue) {
	
    $('#payment_currencycurrency_idhidden').val(thisValue);
	
	
   $('#payment_currencycurrency_idsuggestions').hide();
}


function lookup_mylinkedmessagereceived_id(sms_messagereivedmessagereceived_id) {
    if(sms_messagereivedmessagereceived_id.length == 0) {
        
		
		$('#sms_messagereivedmessagereceived_idsuggestions').hide();
    } else {
        $.post("../sms/rpcsms_messagereived.php", {queryString: ""+sms_messagereivedmessagereceived_id+""}, function(data){
            if(data.length >0) {
                $('#sms_messagereivedmessagereceived_idsuggestions').show();
                $('#sms_messagereivedmessagereceived_idautoSuggestionsList').html(data);
            }
        });
    }
} // sms_messagereived   lookup




function fill_sms_messagereivedmessagereceived_id(thisValue) {
	
    $('#sms_messagereivedmessagereceived_id').val(thisValue);
	
	
   $('#sms_messagereivedmessagereceived_idsuggestions').hide();
}

function fill_hiddensms_messagereivedmessagereceived_id(thisValue) {
	
    $('#sms_messagereivedmessagereceived_idhidden').val(thisValue);
	
	
   $('#sms_messagereivedmessagereceived_idsuggestions').hide();
}


function lookup_mylinkedmessagesend_id(sms_messagesendmessagesend_id) {
    if(sms_messagesendmessagesend_id.length == 0) {
        
		
		$('#sms_messagesendmessagesend_idsuggestions').hide();
    } else {
        $.post("../sms/rpcsms_messagesend.php", {queryString: ""+sms_messagesendmessagesend_id+""}, function(data){
            if(data.length >0) {
                $('#sms_messagesendmessagesend_idsuggestions').show();
                $('#sms_messagesendmessagesend_idautoSuggestionsList').html(data);
            }
        });
    }
} // sms_messagesend   lookup




function fill_sms_messagesendmessagesend_id(thisValue) {
	
    $('#sms_messagesendmessagesend_id').val(thisValue);
	
	
   $('#sms_messagesendmessagesend_idsuggestions').hide();
}

function fill_hiddensms_messagesendmessagesend_id(thisValue) {
	
    $('#sms_messagesendmessagesend_idhidden').val(thisValue);
	
	
   $('#sms_messagesendmessagesend_idsuggestions').hide();
}


function lookup_mylinkedprocessedSMS_id(sms_processedsmsprocessedSMS_id) {
    if(sms_processedsmsprocessedSMS_id.length == 0) {
        
		
		$('#sms_processedsmsprocessedSMS_idsuggestions').hide();
    } else {
        $.post("../sms/rpcsms_processedsms.php", {queryString: ""+sms_processedsmsprocessedSMS_id+""}, function(data){
            if(data.length >0) {
                $('#sms_processedsmsprocessedSMS_idsuggestions').show();
                $('#sms_processedsmsprocessedSMS_idautoSuggestionsList').html(data);
            }
        });
    }
} // sms_processedsms   lookup




function fill_sms_processedsmsprocessedSMS_id(thisValue) {
	
    $('#sms_processedsmsprocessedSMS_id').val(thisValue);
	
	
   $('#sms_processedsmsprocessedSMS_idsuggestions').hide();
}

function fill_hiddensms_processedsmsprocessedSMS_id(thisValue) {
	
    $('#sms_processedsmsprocessedSMS_idhidden').val(thisValue);
	
	
   $('#sms_processedsmsprocessedSMS_idsuggestions').hide();
}


function lookup_mylinkedsmshandle_id(sms_smshandlesmshandle_id) {
    if(sms_smshandlesmshandle_id.length == 0) {
        
		
		$('#sms_smshandlesmshandle_idsuggestions').hide();
    } else {
        $.post("../sms/rpcsms_smshandle.php", {queryString: ""+sms_smshandlesmshandle_id+""}, function(data){
            if(data.length >0) {
                $('#sms_smshandlesmshandle_idsuggestions').show();
                $('#sms_smshandlesmshandle_idautoSuggestionsList').html(data);
            }
        });
    }
} // sms_smshandle   lookup




function fill_sms_smshandlesmshandle_id(thisValue) {
	
    $('#sms_smshandlesmshandle_id').val(thisValue);
	
	
   $('#sms_smshandlesmshandle_idsuggestions').hide();
}

function fill_hiddensms_smshandlesmshandle_id(thisValue) {
	
    $('#sms_smshandlesmshandle_idhidden').val(thisValue);
	
	
   $('#sms_smshandlesmshandle_idsuggestions').hide();
}


function lookup_mylinkedsmshandle_id(sms_smsinvalidsmshandle_id) {
    if(sms_smsinvalidsmshandle_id.length == 0) {
        
		
		$('#sms_smsinvalidsmshandle_idsuggestions').hide();
    } else {
        $.post("../sms/rpcsms_smsinvalid.php", {queryString: ""+sms_smsinvalidsmshandle_id+""}, function(data){
            if(data.length >0) {
                $('#sms_smsinvalidsmshandle_idsuggestions').show();
                $('#sms_smsinvalidsmshandle_idautoSuggestionsList').html(data);
            }
        });
    }
} // sms_smsinvalid   lookup




function fill_sms_smsinvalidsmshandle_id(thisValue) {
	
    $('#sms_smsinvalidsmshandle_id').val(thisValue);
	
	
   $('#sms_smsinvalidsmshandle_idsuggestions').hide();
}

function fill_hiddensms_smsinvalidsmshandle_id(thisValue) {
	
    $('#sms_smsinvalidsmshandle_idhidden').val(thisValue);
	
	
   $('#sms_smsinvalidsmshandle_idsuggestions').hide();
}

