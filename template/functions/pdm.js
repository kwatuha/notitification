

Ext.define('cmbModelAccount_account', {
    extend: 'Ext.data.Model',
	fields:['account_id','account_name']
	});

var ModelAccount_accountdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAccount_account',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=account_account',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAccount_accountclosure', {
    extend: 'Ext.data.Model',
	fields:['accountclosure_id','accountclosure_name']
	});

var ModelAccount_accountclosuredata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAccount_accountclosure',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=account_accountclosure',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAccount_accounttermination', {
    extend: 'Ext.data.Model',
	fields:['accounttermination_id','accounttermination_name']
	});

var ModelAccount_accountterminationdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAccount_accounttermination',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=account_accounttermination',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAccount_accreation', {
    extend: 'Ext.data.Model',
	fields:['accreation_id','accreation_name']
	});

var ModelAccount_accreationdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAccount_accreation',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=account_accreation',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAccount_acsetting', {
    extend: 'Ext.data.Model',
	fields:['acsetting_id','acsetting_name']
	});

var ModelAccount_acsettingdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAccount_acsetting',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=account_acsetting',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAccount_consumer', {
    extend: 'Ext.data.Model',
	fields:['consumer_id','consumer_name']
	});

var ModelAccount_consumerdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAccount_consumer',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=account_consumer',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAccount_creditdebitrequest', {
    extend: 'Ext.data.Model',
	fields:['creditdebitrequest_id','creditdebitrequest_name']
	});

var ModelAccount_creditdebitrequestdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAccount_creditdebitrequest',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=account_creditdebitrequest',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAccount_customerdeactivate', {
    extend: 'Ext.data.Model',
	fields:['customerdeactivate_id','customerdeactivate_name']
	});

var ModelAccount_customerdeactivatedata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAccount_customerdeactivate',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=account_customerdeactivate',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAccount_groupmaster', {
    extend: 'Ext.data.Model',
	fields:['groupmaster_id','groupmaster_name']
	});

var ModelAccount_groupmasterdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAccount_groupmaster',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=account_groupmaster',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAccount_transactionlog', {
    extend: 'Ext.data.Model',
	fields:['transactionlog_id','transactionlog_name']
	});

var ModelAccount_transactionlogdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAccount_transactionlog',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=account_transactionlog',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAdmin_aggrigate', {
    extend: 'Ext.data.Model',
	fields:['aggrigate_id','aggrigate_name']
	});

var ModelAdmin_aggrigatedata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAdmin_aggrigate',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_aggrigate',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAdmin_alert', {
    extend: 'Ext.data.Model',
	fields:['alert_id','alert_name']
	});

var ModelAdmin_alertdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAdmin_alert',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_alert',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAdmin_benefitdescr', {
    extend: 'Ext.data.Model',
	fields:['benefitdescr_id','benefitdescr_name']
	});

var ModelAdmin_benefitdescrdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAdmin_benefitdescr',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_benefitdescr',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAdmin_charttype', {
    extend: 'Ext.data.Model',
	fields:['charttype_id','charttype_name']
	});

var ModelAdmin_charttypedata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAdmin_charttype',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_charttype',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAdmin_company', {
    extend: 'Ext.data.Model',
	fields:['company_id','company_name']
	});

var ModelAdmin_companydata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAdmin_company',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_company',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAdmin_compstructtree', {
    extend: 'Ext.data.Model',
	fields:['compstructtree_id','compstructtree_name']
	});

var ModelAdmin_compstructtreedata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAdmin_compstructtree',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_compstructtree',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAdmin_customer', {
    extend: 'Ext.data.Model',
	fields:['customer_id','customer_name']
	});

var ModelAdmin_customerdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAdmin_customer',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_customer',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAdmin_customimport', {
    extend: 'Ext.data.Model',
	fields:['customimport_id','customimport_name']
	});

var ModelAdmin_customimportdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAdmin_customimport',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_customimport',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAdmin_dept', {
    extend: 'Ext.data.Model',
	fields:['dept_id','dept_name']
	});

var ModelAdmin_deptdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAdmin_dept',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_dept',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAdmin_docs', {
    extend: 'Ext.data.Model',
	fields:['attachments_id','attachments_name']
	});

var ModelAdmin_docsdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAdmin_docs',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_docs',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAdmin_empreport', {
    extend: 'Ext.data.Model',
	fields:['empreport_id','empreport_name']
	});

var ModelAdmin_empreportdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAdmin_empreport',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_empreport',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAdmin_passwordreset', {
    extend: 'Ext.data.Model',
	fields:['passwordreset_id','passwordreset_name']
	});

var ModelAdmin_passwordresetdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAdmin_passwordreset',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_passwordreset',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAdmin_role', {
    extend: 'Ext.data.Model',
	fields:['role_id','role_name']
	});

var ModelAdmin_roledata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAdmin_role',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_role',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAdmin_schart', {
    extend: 'Ext.data.Model',
	fields:['schart_id','schart_name']
	});

var ModelAdmin_schartdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAdmin_schart',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_schart',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAdmin_status', {
    extend: 'Ext.data.Model',
	fields:['status_id','status_name']
	});

var ModelAdmin_statusdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAdmin_status',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_status',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAdmin_statustype', {
    extend: 'Ext.data.Model',
	fields:['statustype_id','statustype_name']
	});

var ModelAdmin_statustypedata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAdmin_statustype',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_statustype',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAdmin_sview', {
    extend: 'Ext.data.Model',
	fields:['sview_id','sview_name']
	});

var ModelAdmin_sviewdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAdmin_sview',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_sview',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAdmin_table', {
    extend: 'Ext.data.Model',
	fields:['table_id','table_name']
	});

var ModelAdmin_tabledata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAdmin_table',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_table',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAdmin_usergroup', {
    extend: 'Ext.data.Model',
	fields:['usergroup_id','usergroup_name']
	});

var ModelAdmin_usergroupdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAdmin_usergroup',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_usergroup',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAdmin_viewicon', {
    extend: 'Ext.data.Model',
	fields:['viewicon_id','viewicon_name']
	});

var ModelAdmin_viewicondata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAdmin_viewicon',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_viewicon',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelAdmin_viewmode', {
    extend: 'Ext.data.Model',
	fields:['viewmode_id','viewmode_name']
	});

var ModelAdmin_viewmodedata = Ext.create('Ext.data.Store', {
    model: 'cmbModelAdmin_viewmode',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_viewmode',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelBank_bank', {
    extend: 'Ext.data.Model',
	fields:['bank_id','bank_name']
	});

var ModelBank_bankdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelBank_bank',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=bank_bank',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelBank_branch', {
    extend: 'Ext.data.Model',
	fields:['branch_id','branch_name']
	});

var ModelBank_branchdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelBank_branch',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=bank_branch',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelBank_insuranceaccount', {
    extend: 'Ext.data.Model',
	fields:['insuranceaccount_id','insuranceaccount_name']
	});

var ModelBank_insuranceaccountdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelBank_insuranceaccount',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=bank_insuranceaccount',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelCompany_agent', {
    extend: 'Ext.data.Model',
	fields:['agent_id','agent_name']
	});

var ModelCompany_agentdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelCompany_agent',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=company_agent',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelCompany_company', {
    extend: 'Ext.data.Model',
	fields:['company_id','company_name']
	});

var ModelCompany_companydata = Ext.create('Ext.data.Store', {
    model: 'cmbModelCompany_company',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=company_company',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelCompany_employee', {
    extend: 'Ext.data.Model',
	fields:['employee_id','employee_name']
	});

var ModelCompany_employeedata = Ext.create('Ext.data.Store', {
    model: 'cmbModelCompany_employee',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=company_employee',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelEvents_event', {
    extend: 'Ext.data.Model',
	fields:['event_id','event_name']
	});

var ModelEvents_eventdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelEvents_event',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=events_event',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelEvents_reminder', {
    extend: 'Ext.data.Model',
	fields:['reminder_id','reminder_name']
	});

var ModelEvents_reminderdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelEvents_reminder',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=events_reminder',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelHousing_landlord', {
    extend: 'Ext.data.Model',
	fields:['landlord_id','landlord_name']
	});

var ModelHousing_landlorddata = Ext.create('Ext.data.Store', {
    model: 'cmbModelHousing_landlord',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=housing_landlord',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelHousing_nextofkin', {
    extend: 'Ext.data.Model',
	fields:['nextofkin_id','nextofkin_name']
	});

var ModelHousing_nextofkindata = Ext.create('Ext.data.Store', {
    model: 'cmbModelHousing_nextofkin',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=housing_nextofkin',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelHousing_property', {
    extend: 'Ext.data.Model',
	fields:['property_id','property_name']
	});

var ModelHousing_propertydata = Ext.create('Ext.data.Store', {
    model: 'cmbModelHousing_property',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=housing_property',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelHousing_tenant', {
    extend: 'Ext.data.Model',
	fields:['tenant_id','tenant_name']
	});

var ModelHousing_tenantdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelHousing_tenant',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=housing_tenant',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelHousing_unit', {
    extend: 'Ext.data.Model',
	fields:['unit_id','unit_name']
	});

var ModelHousing_unitdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelHousing_unit',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=housing_unit',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelInsurance_client', {
    extend: 'Ext.data.Model',
	fields:['client_id','client_name']
	});

var ModelInsurance_clientdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelInsurance_client',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=insurance_client',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelInsurance_insurer', {
    extend: 'Ext.data.Model',
	fields:['insurer_id','insurer_name']
	});

var ModelInsurance_insurerdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelInsurance_insurer',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=insurance_insurer',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelInsurance_policy', {
    extend: 'Ext.data.Model',
	fields:['policy_id','policy_name']
	});

var ModelInsurance_policydata = Ext.create('Ext.data.Store', {
    model: 'cmbModelInsurance_policy',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=insurance_policy',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelInsurance_policytype', {
    extend: 'Ext.data.Model',
	fields:['policytype_id','policytype_name']
	});

var ModelInsurance_policytypedata = Ext.create('Ext.data.Store', {
    model: 'cmbModelInsurance_policytype',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=insurance_policytype',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelInsurance_product', {
    extend: 'Ext.data.Model',
	fields:['product_id','product_name']
	});

var ModelInsurance_productdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelInsurance_product',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=insurance_product',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelInsurance_risk', {
    extend: 'Ext.data.Model',
	fields:['risk_id','risk_name']
	});

var ModelInsurance_riskdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelInsurance_risk',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=insurance_risk',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelPayment_bank', {
    extend: 'Ext.data.Model',
	fields:['bank_id','bank_name']
	});

var ModelPayment_bankdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelPayment_bank',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=payment_bank',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelPayment_branch', {
    extend: 'Ext.data.Model',
	fields:['branch_id','branch_name']
	});

var ModelPayment_branchdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelPayment_branch',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=payment_branch',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelPayment_costcenter', {
    extend: 'Ext.data.Model',
	fields:['costcenter_id','costcenter_name']
	});

var ModelPayment_costcenterdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelPayment_costcenter',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=payment_costcenter',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelPayment_currency', {
    extend: 'Ext.data.Model',
	fields:['currency_id','currency_name']
	});

var ModelPayment_currencydata = Ext.create('Ext.data.Store', {
    model: 'cmbModelPayment_currency',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=payment_currency',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelSms_messagereived', {
    extend: 'Ext.data.Model',
	fields:['message_id','message_name']
	});

var ModelSms_messagereiveddata = Ext.create('Ext.data.Store', {
    model: 'cmbModelSms_messagereived',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=sms_messagereived',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelSms_messagesend', {
    extend: 'Ext.data.Model',
	fields:['messagesend_id','messagesend_name']
	});

var ModelSms_messagesenddata = Ext.create('Ext.data.Store', {
    model: 'cmbModelSms_messagesend',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=sms_messagesend',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelSms_processedsms', {
    extend: 'Ext.data.Model',
	fields:['customer_id','customer_name']
	});

var ModelSms_processedsmsdata = Ext.create('Ext.data.Store', {
    model: 'cmbModelSms_processedsms',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=sms_processedsms',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelSms_smshandle', {
    extend: 'Ext.data.Model',
	fields:['customer_id','customer_name']
	});

var ModelSms_smshandledata = Ext.create('Ext.data.Store', {
    model: 'cmbModelSms_smshandle',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=sms_smshandle',
        reader: {
            type: 'json'
        }
    }
});



Ext.define('cmbModelSms_smsinvalid', {
    extend: 'Ext.data.Model',
	fields:['customer_id','customer_name']
	});

var ModelSms_smsinvaliddata = Ext.create('Ext.data.Store', {
    model: 'cmbModelSms_smsinvalid',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=sms_smsinvalid',
        reader: {
            type: 'json'
        }
    }
});

