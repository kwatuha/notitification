/*function updateOpeningBalTenant(){
Ext.getCmp('topening_balance').hide();
Ext.getCmp('tpreferred').hide();
Ext.getCmp('tcurrency_id').hide();
Ext.getCmp('tcredit_limit').hide();
Ext.getCmp('tcurrency_id').hide();
Ext.getCmp('tamount').hide();
Ext.getCmp('ttransaction_date').hide();
Ext.getCmp('tnaration').hide();
Ext.getCmp('tperiod_startdate').hide();
Ext.getCmp('tperiod_months').hide();
Ext.getCmp('trentperiod_id').hide();

}

//Post accounts


accounts_accaccount
accounts_accountactivity
accounts_accaccount
accounts_accountactivity
opening_balance
credit_limit
opening_balance
credit_limit
accountscategory_id
accountactivity_name
accaccount_id
currency_id
amount
transaction_date
naration
period_startdate
period_months



account
category*/


function inserAccountsRec(ttype,datasource,counterccountscategory,voucher_number,check_number,check_date,bankaccount_id,accountscategory_id,accaccount_id,currency_id,amount,transaction_type,transaction_date,naration){
Ext.Ajax.request({
url: 'bodysave.php',
success: function(resp) {
eval(resp.responseText);
datasource.proxy.extraParams = {acctransindiv:ttype,icad:accaccount_id};
datasource.load();
},
params:{t:'accounts_accountactivity',
tttact:'Save',
countraccountscategory_id:counterccountscategory,
voucher_number:voucher_number,check_number:check_number,check_date:check_date,bankaccount_id:bankaccount_id,
accountscategory_id:accountscategory_id,
accaccount_id:accaccount_id,
currency_id:currency_id,
amount:amount,
transaction_type:transaction_type,
transaction_date:transaction_date,
naration:naration
},
failure: function(action){
// you could put an error message here
}
});	
}

function insertCashDepositRec(ttype,datasource,counterccountscategory,voucher_number,check_number,check_date,bankaccount_id,accountscategory_id,accaccount_id,currency_id,amount,transaction_type,transaction_date,naration){
Ext.Ajax.request({
url: 'bodysave.php',
success: function(resp) {
eval(resp.responseText);
datasource.proxy.extraParams = {acctransindiv:ttype,icad:accaccount_id};
datasource.load();
},
params:{t:'accounts_custcashdeposit',
tttact:'Save',
countraccountscategory_id:counterccountscategory,
voucher_number:voucher_number,check_number:check_number,check_date:check_date,bankaccount_id:bankaccount_id,
accountscategory_id:accountscategory_id,
accaccount_id:accaccount_id,
currency_id:currency_id,
amount:amount,
transaction_type:transaction_type,
transaction_date:transaction_date,
naration:naration
},
failure: function(action){
// you could put an error message here
}
});	
}
function insertCheckRec(ttype,datasource,counterccountscategory,voucher_number,check_number,check_date,bankaccount_id,accountscategory_id,accaccount_id,currency_id,amount,transaction_type,transaction_date,naration){
Ext.Ajax.request({
url: 'bodysave.php',
success: function(resp) {
eval(resp.responseText);
datasource.proxy.extraParams = {acctransindiv:ttype,icad:accaccount_id};
datasource.load();
},
params:{t:'accounts_custcheckregister',
tttact:'Save',
countraccountscategory_id:counterccountscategory,
voucher_number:voucher_number,check_number:check_number,check_date:check_date,bankaccount_id:bankaccount_id,
accountscategory_id:accountscategory_id,
accaccount_id:accaccount_id,
currency_id:currency_id,
amount:amount,
transaction_type:transaction_type,
transaction_date:transaction_date,
naration:naration
},
failure: function(action){
// you could put an error message here
}
});	
}

//Update  

function insertCheckRegisterTrans(
ttype,
datasource,
depositchk,
bankaccount_id,
date_banked,
accaccount_id,
bank,
branch,
check_details,
check_number,
check_date,
currency_id,
amount,
transaction_type,
naration){ 
Ext.Ajax.request({
url: 'bodysave.php',
success: function(resp) {
eval(resp.responseText);
datasource.proxy.extraParams = {acctransindiv:ttype,icad:accaccount_id};
datasource.load();
},
params:{t:'accounts_checkregister',
tttact:'Save',depositchk:depositchk,bankaccount_id:bankaccount_id,date_banked:date_banked,accaccount_id:accaccount_id,
bank:bank,
branch:branch,
check_details:check_details,
check_number:check_number,
check_date:check_date,
currency_id:currency_id,
amount:amount,
transaction_type:transaction_type,
naration:naration
},
failure: function(action){
// you could put an error message here
}
});	
}

//customer check register
function insertCheckRegisterCust(
ttype,								 
datasource,
depositchk,
companyac,
bankaccount_id,
date_banked,
accaccount_id,
bank,
branch,
check_details,
check_number,
check_date,
currency_id,
amount,
transaction_type,
naration){ 
Ext.Ajax.request({
url: 'bodysave.php',
success: function(resp) {
eval(resp.responseText);
datasource.proxy.extraParams = {acctransindiv:ttype,icad:accaccount_id};
datasource.load();
},
params:{t:'accounts_custcheckregister',
tttact:'Save',depositchk:depositchk,custcdeposit:'yes',companyac:companyac,bankaccount_id:bankaccount_id,date_banked:date_banked,accaccount_id:accaccount_id,
bank:bank,
branch:branch,
check_details:check_details,
check_number:check_number,
check_date:check_date,
currency_id:currency_id,
amount:amount,
transaction_type:transaction_type,
naration:naration
},
failure: function(action){
// you could put an error message here
}
});	
}
//cash deposited by client
function insertClietCashDepositRec(ttype,datasource,counterccountscategory,voucher_number,check_number,check_date,bankaccount_id,accountscategory_id,accaccount_id,currency_id,amount,transaction_type,transaction_date,naration){
Ext.Ajax.request({
url: 'bodysave.php',
success: function(resp) {
eval(resp.responseText);
datasource.proxy.extraParams = {acctransindiv:ttype,icad:accaccount_id};
datasource.load();
},
params:{t:'accounts_compcashdeposit',
tttact:'Save',
countraccountscategory_id:counterccountscategory,
voucher_number:voucher_number,check_number:check_number,check_date:check_date,bankaccount_id:bankaccount_id,
accountscategory_id:accountscategory_id,
accaccount_id:accaccount_id,
currency_id:currency_id,
amount:amount,
transaction_type:transaction_type,
transaction_date:transaction_date,
naration:naration
},
failure: function(action){
// you could put an error message here
}
});	
}

//
function insertDirectTransferout(
								 
								 ttype,datasource,counterccountscategory,company_account,client_account,check_date,
								 bankaccount_id,accountscategory_id,accaccount_id,currency_id,amount,transaction_type,transaction_date,naration){
Ext.Ajax.request({
url: 'bodysave.php',
success: function(resp) {
//eval(resp.responseText);
savedAccData();
datasource.proxy.extraParams = {acctransindiv:ttype,icad:accaccount_id};
datasource.load();
},
params:{t:'accounts_directtransferout',
tttact:'Save',
countraccountscategory_id:counterccountscategory,
company_account:company_account,client_account:client_account,check_date:check_date,bankaccount_id:bankaccount_id,
accountscategory_id:accountscategory_id,
accaccount_id:accaccount_id,
currency_id:currency_id,
amount:amount,
transaction_type:transaction_type,
transaction_date:transaction_date,
naration:naration
},
failure: function(action){
// you could put an error message here
}
});	
}
function insertDirectTransferIn(
								 
								 ttype,datasource,counterccountscategory,company_account,client_account,check_date,
								 bankaccount_id,accountscategory_id,accaccount_id,currency_id,amount,transaction_type,transaction_date,naration){
Ext.Ajax.request({
url: 'bodysave.php',
success: function(resp) {
//eval(resp.responseText);
savedAccData();
datasource.proxy.extraParams = {acctransindiv:ttype,icad:accaccount_id};
datasource.load();
},
params:{t:'accounts_directtransferin',
tttact:'Save',
countraccountscategory_id:counterccountscategory,
company_account:company_account,client_account:client_account,check_date:check_date,bankaccount_id:bankaccount_id,
accountscategory_id:accountscategory_id,
accaccount_id:accaccount_id,
currency_id:currency_id,
amount:amount,
transaction_type:transaction_type,
transaction_date:transaction_date,
naration:naration
},
failure: function(action){
// you could put an error message here
}
});	
}
function savedAccData(){
						
							Ext.Msg.show({
							 title:'Success',
							 msg: 'Changes saved!',
							 buttons: Ext.Msg.OK,
							 icon: Ext.Msg.INFO
							   });
			
							}
							