<?php
echo "function changePaymentRSv(){
var tenantfullname=Ext.getCmp('ctenanat').getValue(); 
var clandlord=Ext.getCmp('clandlord').getValue();
var personname=Ext.getCmp('personreft').getValue();
var account= Ext.getCmp('taccountid').getValue();
var tpid= Ext.getCmp('chousingtenantpid').getValue();
var tenantid=1


//Hide unnecessary controls


Ext.onReady(function() {


Ext.define('cmbHousing_rentperiod', {
    extend: 'Ext.data.Model',
	fields:['rentperiod_id','rentperiod_name']
	});

var housing_rentperioddata = Ext.create('Ext.data.Store', {
    model: 'cmbHousing_rentperiod',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=housing_rentperiod',
        reader: {
            type: 'json'
        }
    }
});

housing_rentperioddata.load();


Ext.define('tcmbBank_bankaccount', {
    extend: 'Ext.data.Model',
	fields:['bankaccount_id','bankaccount_name']
	});

var bank_bankaccountdata = Ext.create('Ext.data.Store', {
    model: 'tcmbBank_bankaccount',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=bank_bankaccount',
        reader: {
            type: 'json'
        }
    }
});

bank_bankaccountdata.load();

Ext.define('tcmbPayment_currency', {
    extend: 'Ext.data.Model',
	fields:['currency_id','currency_name']
	});

var payment_currencydata = Ext.create('Ext.data.Store', {
    model: 'tcmbPayment_currency',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=payment_currency',
        reader: {
            type: 'json'
        }
    }
});

payment_currencydata.load();

    var form = Ext.create('Ext.form.Panel', {
        border: true,
		frame:true,
		maximizable:true,
        fieldDefaults: {
            labelWidth: 100
        },
        url: 'save-form.php',
        defaultType: 'textfield',
        bodyPadding: 5,
		items: [
		{
            xtype: 'textfield',
			readOnly:true,
            fieldLabel: 'Account',
            name: 'tenantid',
            value:personname
        },{
            xtype: 'hiddenfield',
			readOnly:true,
            fieldLabel: 'Account ID',
            name: 'account_name',
            value:account
        },{
            xtype: 'textfield',
            fieldLabel: 'Tenant Name',
			readOnly:true,
			anchor:'50%',
            name: 'tenantname',
            value:tenantfullname
        },{
            xtype: 'hidden',
            fieldLabel: 'syowner',
            name: 'syowner',
            value:tenantid
        },{
            xtype: 'hiddenfield',
            fieldLabel: 'personid',
            name: 'personid',
            value:tpid 
        },
		
		{  xtype: 'textfield',
			readOnly:true,
			anchor:'50%',
            fieldLabel: 'LandLord',
            name: 'landlordid',
			value:clandlord
        }
		,
		
		{xtype: 'radiogroup',
                fieldLabel:'Balance Type',
				combineErrors: true,
				msgTarget : 'side',
				maxWidth:370,
				id:'topbaltype',
				columns: 1,
				horizontal: true,
				 listeners: {'change': function() {
			var pmop=Ext.getCmp('toppositive').getValue();
			var nmop=Ext.getCmp('topnegative').getValue();
			if(pmop==true){
			Ext.getCmp('topnbaltype').setValue('P');
			}
			if(nmop==true){
			Ext.getCmp('topnbaltype').setValue('N');
			}
			}},
   items:[{
    xtype: 'radiofield',
	name:'tpmode',
	id:'toppositive',
	inputValue:'P',
	boxLabel:'Advance payment',
	labelWidth:80,
	margin: '0 5 0 0',
	handler:function(){
	}},
	{xtype: 'radiofield',
	name:'tpmode',
	id:'topnegative', 
	inputValue:'N',
	boxLabel:'Arrears',
	labelWidth:80,
	margin: '0 5 0 0',
	handler:function(){
	}}]},
		{xtype: 'radiogroup',
                fieldLabel:'Payment Mode',
				combineErrors: true,
				msgTarget : 'side',
				maxWidth:370,
				id:'tpaymentmodess',
				name:'tpaymentmodess',
				columns: 2,
				vertical: true,
				 listeners: {'change': function() {
			var tpbankmode=Ext.getCmp('tpbankmode').getValue();
			var cashtpmode=Ext.getCmp('tbcashtpmode').getValue();
			var tpbankcheckmode=Ext.getCmp('tpbankcheckmode').getValue();
			var tpbankcheckdepositedmode=Ext.getCmp('tpbankcheckdepositedmode').getValue();
			
			if(cashtpmode==true){
			Ext.getCmp('ttpaymentmode').setValue(17);
			Ext.getCmp('topening_balance').hide();
			Ext.getCmp('tpreferred').hide();
			Ext.getCmp('tcurrency_id').hide();
			Ext.getCmp('tcredit_limit').hide();
			Ext.getCmp('tcurrency_id').hide();
			Ext.getCmp('tamount').hide();
			Ext.getCmp('tamountcurrency').hide();
			Ext.getCmp('ttransaction_date').hide();
			Ext.getCmp('tnaration').hide();
			Ext.getCmp('tperiod_startdate').hide();
			Ext.getCmp('tperiod_months').hide();
			Ext.getCmp('trentperiod_id').hide();
			Ext.getCmp('tvoucher_number').hide();
			Ext.getCmp('tcheck_number').hide();
			Ext.getCmp('tcheck_date').hide();
			Ext.getCmp('tbankaccount_id').hide();
			Ext.getCmp('bankbranchid').hide();
			Ext.getCmp('tchecknumberdate').hide();
			Ext.getCmp('tcheck_details').hide();

	        Ext.getCmp('tcurrency_id').show();
			Ext.getCmp('tamount').show();
			Ext.getCmp('tamountcurrency').show();
			Ext.getCmp('tvoucher_number').show();
			Ext.getCmp('ttransaction_date').show();
	        Ext.getCmp('tnaration').show();
			}
			if(tpbankmode==true){
			Ext.getCmp('ttpaymentmode').setValue(18);
			Ext.getCmp('topening_balance').hide();
			Ext.getCmp('tpreferred').hide();
			Ext.getCmp('tcurrency_id').hide();
			Ext.getCmp('tcredit_limit').hide();
			Ext.getCmp('tcurrency_id').hide();
			Ext.getCmp('tamount').hide();
			Ext.getCmp('tamountcurrency').hide();
			Ext.getCmp('ttransaction_date').hide();
			Ext.getCmp('tnaration').hide();
			Ext.getCmp('tperiod_startdate').hide();
			Ext.getCmp('tperiod_months').hide();
			Ext.getCmp('trentperiod_id').hide();
			Ext.getCmp('tvoucher_number').hide();
			Ext.getCmp('tcheck_number').hide();
			Ext.getCmp('tcheck_date').hide();
			Ext.getCmp('tbankaccount_id').hide();
			Ext.getCmp('bankbranchid').hide();
			Ext.getCmp('tchecknumberdate').hide();
			Ext.getCmp('tcheck_details').hide();

			
	        Ext.getCmp('tcurrency_id').show();
			Ext.getCmp('tamount').show();
			Ext.getCmp('tamountcurrency').show();
			Ext.getCmp('tvoucher_number').show();
			Ext.getCmp('tbankaccount_id').show();
			Ext.getCmp('ttransaction_date').show();
	        Ext.getCmp('tnaration').show();
			}
			if(tpbankcheckdepositedmode==true){
			Ext.getCmp('ttpaymentmode').setValue(180);
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
			Ext.getCmp('tvoucher_number').hide();
			Ext.getCmp('tcheck_number').hide();
			Ext.getCmp('tcheck_date').hide();
			Ext.getCmp('tbankaccount_id').hide();
		    Ext.getCmp('bankbranchid').hide();
			Ext.getCmp('tchecknumberdate').hide();
			Ext.getCmp('tcheck_details').hide();

			
			
			 Ext.getCmp('tcurrency_id').show();
			 Ext.getCmp('tamountcurrency').show();
			Ext.getCmp('tamount').show();
			Ext.getCmp('ttransaction_date').show();
	        Ext.getCmp('tnaration').show();
			Ext.getCmp('tcurrency_id').show();
			Ext.getCmp('bankbranchid').show();
			Ext.getCmp('tchecknumberdate').show();
			
			Ext.getCmp('tcheck_details').show();
            Ext.getCmp('tcheck_number').show();
			Ext.getCmp('tcheck_date').show();
			}
			if(tpbankcheckmode==true){
			Ext.getCmp('ttpaymentmode').setValue(181);
			Ext.getCmp('topening_balance').hide();
			Ext.getCmp('tpreferred').hide();
			Ext.getCmp('tcurrency_id').hide();
			Ext.getCmp('tcredit_limit').hide();
			Ext.getCmp('tamountcurrency').hide();
			Ext.getCmp('tcurrency_id').hide();
			Ext.getCmp('tamount').hide();
			Ext.getCmp('tamountcurrency').hide();
			Ext.getCmp('ttransaction_date').hide();
			Ext.getCmp('tnaration').hide();
			Ext.getCmp('tperiod_startdate').hide();
			Ext.getCmp('tperiod_months').hide();
			Ext.getCmp('trentperiod_id').hide();
			Ext.getCmp('tvoucher_number').hide();
			Ext.getCmp('tcheck_number').hide();
			Ext.getCmp('tcheck_date').hide();
			Ext.getCmp('tbankaccount_id').hide();
			Ext.getCmp('bankbranchid').hide();
			Ext.getCmp('tchecknumberdate').hide();
			Ext.getCmp('tcheck_details').hide();

			
			Ext.getCmp('tcurrency_id').show();
			Ext.getCmp('tamount').show();
			Ext.getCmp('tamountcurrency').show();
			Ext.getCmp('ttransaction_date').show();
	        Ext.getCmp('tnaration').show();
			Ext.getCmp('tcurrency_id').show();
			Ext.getCmp('bankbranchid').show();
			Ext.getCmp('tchecknumberdate').show();
			
			Ext.getCmp('tcheck_details').show();
            Ext.getCmp('tcheck_number').show();
			Ext.getCmp('tcheck_date').show();
			Ext.getCmp('tbankaccount_id').show();
			
			}	    
			
				 }},
				items:[
   {
    xtype: 'radiofield',
	name:'tpmode',
	id:'tbcashtpmode',
	inputValue:'17',
	boxLabel:'Cash',
	labelWidth:80,
	margin: '0 5 0 0',
	handler:function(){
	}},
	{xtype: 'radiofield',
	name:'tpmode',
	id:'tpbankmode', 
	inputValue:'18',
	boxLabel:'Cash Deposit',
	labelWidth:80,
	margin: '0 5 0 0',
	handler:function(){
	}},
	{xtype: 'radiofield',
	name:'tpmode',
	id:'tpbankcheckdepositedmode',
	inputValue:'181',
	boxLabel:'Check',
	labelWidth:80,
	margin: '0 5 0 0',
	handler:function(){
	
			
	}},
	{xtype: 'radiofield',
	name:'tpmode',
	id:'tpbankcheckmode',
	inputValue:'180', 
	boxLabel:'Check Deposit',
	labelWidth:80,
	margin: '0 5 0 0',
	handler:function(){
	}}]},{
            xtype: 'hiddenfield',
			id : 'ttpaymentmode',
			fieldLabel:'Mode'
			},
			
		{xtype: 'fieldcontainer',
                fieldLabel:'Rent Amount',
				combineErrors: true,
				id:'tamountcurrency',
				msgTarget : 'side',
                layout: 'hbox',
				items:[{
            xtype: 'numberfield',
			margin: '0 5 0 0',
			msgTarget : 'side',
            name: 'amount',
			id: 'tamount',
			value:'',
            fieldLabel:false,
            allowBlank: false,
            minLength: 1
        
		},{
	xtype: 'combobox',
	name:'currency_id',
	id:'tcurrency_id',
	value:1,
	forceSelection:true,
    fieldLabel: 'Currency ',
	labelWidth:70,
    store: payment_currencydata,
    queryMode: 'remote',
    displayField: 'currency_name',
    valueField: 'currency_id'
	}]},
		{
            xtype: 'datefield',
			msgTarget : 'side',
            name: 'transaction_date',
			id: 'ttransaction_date',
			value:'',
            fieldLabel: 'Date',
            allowBlank: false,
            minLength: 1
        
		},
		
		{
            xtype: 'numberfield',
			msgTarget : 'side',
            name: 'period_months',
			 id: 'tperiod_months',
			value:'',
            fieldLabel: 'Period(months) ',
            allowBlank: false,
            minLength: 1
        
		},

{
            xtype: 'datefield',
			msgTarget : 'side',
            name: 'period_startdate',
			id: 'tperiod_startdate',
			value:'',
            fieldLabel: 'Start Date ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			msgTarget : 'side',
            name: 'preferred',
			id: 'tpreferred',
			value:'',
            fieldLabel: 'Preferred ',
            allowBlank: false,
            minLength: 1
        
		},
		{
            xtype: 'numberfield',
			msgTarget : 'side',
            name: 'opening_balance',
			id: 'topening_balance',
			value:'',
            fieldLabel: 'Opening Balance ',
            allowBlank: false,
            minLength: 1
        },
		{
            xtype: 'hiddenfield',
			msgTarget : 'side',
            id: 'tprocessflowcontrol',
			value:'',
            fieldLabel: 'Process Flow',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'hiddenfield',
			msgTarget : 'side',
            id: 'topnbaltype',
			value:'',
            fieldLabel: 'Bal Type',
            allowBlank: false,
            minLength: 1
        
		},
		{
            xtype: 'numberfield',
			msgTarget : 'side',
            name: 'credit_limit',
			id: 'tcredit_limit',
			value:'',
            fieldLabel: 'Credit Limit ',
            allowBlank: false,
            minLength: 1
        
		},
		
	{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'voucher_number',
			id: 'tvoucher_number',
			value:'',
            fieldLabel: 'Voucher Number ',
            allowBlank: false,
            minLength: 1,
			listeners: {'change': function() {
			Ext.getCmp('tsavecheck').setValue('Ready');
			}}
        
		},
		{
            xtype: 'hiddenfield',
			msgTarget : 'side',
            
			id: 'tsavecheck',
			value:'',
            fieldLabel: 'Check Here ',
            allowBlank: false,
            minLength: 1
        
		},
		{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'check_details',
			id: 'tcheck_details',
			value:tenantfullname,
            fieldLabel: 'Drawee',
            allowBlank: false,
            minLength: 1
        
		},
		{xtype: 'fieldcontainer',
                fieldLabel:'Bank',
				combineErrors: true,
				id:'bankbranchid',
				msgTarget : 'side',
                layout: 'hbox',
				items:[
	  {  
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'bank',
			id: 'tbank',
			value:'',
            fieldLabel:false,
			margin: '0 5 0 0',
            allowBlank: false,
            minLength: 1
        
		},  
			
			{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'tbranch',
			id: 'tbranch',
			labelWidth:70,
			
			value:'',
            fieldLabel: 'Branch ',
            allowBlank: false,
            minLength: 1
        
		}]},{xtype: 'fieldcontainer',
                fieldLabel:'Check Number',
				combineErrors: true,
				id:'tchecknumberdate',
				msgTarget : 'side',
                layout: 'hbox',
				items:[{
            xtype: 'textfield',
			margin: '0 5 0 0',
			msgTarget : 'side',
            name: 'check_number',
			id: 'tcheck_number',
			listeners: {'change': function() {
			Ext.getCmp('tsavecheck').setValue('Ready');
			}},
			value:'',
            fieldLabel:false,
            allowBlank: false,
            minLength: 1
        
		},
		{
            xtype: 'datefield',
			labelWidth:70,
			
			msgTarget : 'side',
            name: 'check_date',
			id: 'tcheck_date',
			value:'',
            fieldLabel: 'Check Date',
            allowBlank: false,
            minLength: 1
        
		}]},

	{
	xtype: 'combobox',
	name:'bankaccount_id',
	id:'tbankaccount_id',
	forceSelection:true,
    fieldLabel: 'Bank',
    store: bank_bankaccountdata,
    queryMode: 'remote',
    displayField: 'bankaccount_name',
    valueField: 'bankaccount_id'
	},
		
    {
	xtype: 'combobox',
	name:'rentperiod_id',
	id:'trentperiod_id',
	forceSelection:true,
    fieldLabel: 'Period ',
    store: housing_rentperioddata,
    queryMode: 'remote',
    displayField: 'rentperiod_name',
    valueField: 'rentperiod_id'
	}, {
           // xtype: 'htmleditor',
			xtype: 'textareafield',
			fieldLabel:'Naration',
			labelAlign:'top',
            name: 'tnaration',
			id:'tnaration',
            anchor: '100% -47'
        }],
		buttons: [{
            text: 'Save',
			handler:function(){
			
			}
        },{
            text: 'Cancel',
			handler:function(){
			Ext.getCmp('fraccountsmmanagement').close();
			}
			
        }]
    });

    var win = Ext.create('Ext.window.Window', {
        title: 'Manage Account',
        width: 800,
		maximized:true,
        height:500,
		minWidth: 300,
		bodyPadding:10,
        minHeight: 200,
        layout: 'fit',
		tbar:[{text:'Openning Balance',
                    tooltip:'Openning Balance',
                    iconCls:'add',
					handler:function(){
					    Ext.getCmp('topbaltype').show();
						Ext.getCmp('topening_balance').show();
						Ext.getCmp('tprocessflowcontrol').setValue('OPBAL');
						Ext.getCmp('tsavecheck').setValue('Ready');
						
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
							Ext.getCmp('tvoucher_number').hide();
							Ext.getCmp('tcheck_number').hide();
							Ext.getCmp('tcheck_date').hide();
							Ext.getCmp('tbankaccount_id').hide();
							Ext.getCmp('bankbranchid').hide();
							Ext.getCmp('tchecknumberdate').hide();
							Ext.getCmp('tcheck_details').hide();
							Ext.getCmp('tpaymentmodess').hide();
							Ext.getCmp('tamountcurrency').hide();

					}
                },'-',{text:'Expenses',
                    tooltip:'Add Expenses',
                    iconCls:'add',
					handler:function(){
						/*Ext.getCmp('idestatemgtwin').close();
						registerperson();*/
					}
                }, '-',{text:'Payment',
                    tooltip:'Tenant Payment',
                    iconCls:'add',
					handler:function(){
						/////////////////////////
						/*Ext.getCmp('tcurrency_id').show();
						Ext.getCmp('tamount').show();
						Ext.getCmp('ttransaction_date').show();
						Ext.getCmp('tnaration').show();
						Ext.getCmp('tvoucher_number').show();
						Ext.getCmp('tcheck_number').show();
						Ext.getCmp('tcheck_date').show();
						Ext.getCmp('tbankaccount_id').show();*/
						Ext.getCmp('tpaymentmodess').show();
						Ext.getCmp('topbaltype').hide();
						
						
                        
						Ext.getCmp('topening_balance').hide();
						Ext.getCmp('tpreferred').hide();
						Ext.getCmp('tcredit_limit').hide();
						Ext.getCmp('tperiod_startdate').hide();
						Ext.getCmp('tperiod_months').hide();
						Ext.getCmp('trentperiod_id').hide();
						/////////////////////////
					}
                }, '-',{text:'Notices',
                    tooltip:'Openning Balance',
                    iconCls:'add',
					handler:function(){
						/*Ext.getCmp('idestatemgtwin').close();
						registerperson();*/
					}
                }, '-',{text:'Terminate',
                    tooltip:'Openning Balance',
                    iconCls:'add',
					handler:function(){
						/*Ext.getCmp('idestatemgtwin').close();
						registerperson();*/
					}
                },  '-',{text:'Credit Limit',
                    tooltip:'Openning Balance',
                    iconCls:'add',
					handler:function(){
						/*Ext.getCmp('idestatemgtwin').close();
						registerperson();*/
					}
                }, '-',{text:'New Contract',
                    tooltip:'Openning Balance',
                    iconCls:'add',
					handler:function(){
						/*Ext.getCmp('idestatemgtwin').close();
						registerperson();*/
					}
                }, '-',{text:'Receipts',
                    tooltip:'Openning Balance',
                    iconCls:'add',
					handler:function(){
						/*Ext.getCmp('idestatemgtwin').close();
						registerperson();*/
					}
                }, '-',{text:'Invoices',
                    tooltip:'Openning Balance',
                    iconCls:'add',
					handler:function(){
						/*Ext.getCmp('idestatemgtwin').close();
						registerperson();*/
					}
                }, '-'
				],
		id:'fraccountsmmanagement',
		maximizable :true,
		autoScroll:true,
        plain: true,
        items: form,

        buttons: [{
            text: 'Save Payment',
			id: 'savetpaymentbtn',
			handler:function(){
			            var	accountscategory_id=54;
						var	accaccount_id=Ext.getCmp('taccountid').getValue();	
						var	currency_id	=Ext.getCmp('tcurrency_id').getValue();	
						var	amount=Ext.getCmp('tamount').getValue();	
						var	transaction_type='Debit'
						var	transaction_date=Ext.getCmp('ttransaction_date').getValue();
						var data_banked=transaction_date;	
						var	naration=Ext.getCmp('tnaration').getValue();
						var voucher_number=Ext.getCmp('tvoucher_number').getValue();
						var check_number=Ext.getCmp('tcheck_number').getValue();
						var check_date=Ext.getCmp('tcheck_date').getValue();
						var bankaccount_id=Ext.getCmp('tbankaccount_id').getValue(); 
						var counterccountscategory=Ext.getCmp('ttpaymentmode').getValue();
						var	bank	=Ext.getCmp('tbank').getValue();	
						var	branch	=Ext.getCmp('tbranch').getValue();	
						var	check_details	=Ext.getCmp('tcheck_details').getValue();	
						var baltype=Ext.getCmp('topnbaltype').getValue();
						
						var processflowcontrol=Ext.getCmp('tprocessflowcontrol').getValue();
						var opening_balance=Ext.getCmp('topening_balance').getValue();
                         var mycheck=Ext.getCmp('tsavecheck').getValue();
						 
						var pmodetosave= Ext.getCmp('ttpaymentmode').getValue();
						
						
                        if(mycheck=='Ready'){
						
						if(pmodetosave==17||pmodetosave==18){
		                inserAccountsRec(
						counterccountscategory,
						voucher_number,
						check_number,
						check_date,
						bankaccount_id,
						accountscategory_id,
						accaccount_id,
						currency_id,
						amount,
						transaction_type,
						transaction_date,
						naration);
						
						}
						
						if(pmodetosave==181||pmodetosave==180){
						//save check register
							/*inputValue:'180', 
							boxLabel:'Check Deposit',*/
						var depositchk='No';
						//insert account
						inserAccountsRec(
						pmodetosave,
						voucher_number,
						check_number,
						check_date,
						bankaccount_id,
						accountscategory_id,
						accaccount_id,
						currency_id,
						amount,
						transaction_type,
						transaction_date,
						naration);
						//insert account
					
						if(pmodetosave==181){
						depositchk='Yes';
						}
							insertCheckRegisterTrans(
							depositchk,
							bankaccount_id,
							data_banked,
							accaccount_id,
							bank,
							branch,
							check_details,
							check_number,
							check_date,
							currency_id,
							amount,
							transaction_type,
							naration);
						
						////////////////
						}
						
						if(processflowcontrol=='OPBAL'){
						saveOpenBal(accaccount_id,opening_balance,baltype);
						}
						Ext.getCmp('tsavecheck').setValue('Not Ready');
						}else{
						showcusterror('Record could not be saved again!','Record Already Saved!');
						}
						
						
						
						
						
			}
        },{
            text: 'Cancel',
			handler:function(){
			Ext.getCmp('fraccountsmmanagement').close();
			}
			
        }]
    });
win.show();
});
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
Ext.getCmp('tvoucher_number').hide();
Ext.getCmp('tcheck_number').hide();
Ext.getCmp('tcheck_date').hide();
Ext.getCmp('tbankaccount_id').hide();
Ext.getCmp('bankbranchid').hide();
Ext.getCmp('tchecknumberdate').hide();

Ext.getCmp('tcheck_details').hide();
Ext.getCmp('tpaymentmodess').hide();
Ext.getCmp('tamountcurrency').hide();
Ext.getCmp('topbaltype').hide();


}

changePaymentRSv();

";
?>