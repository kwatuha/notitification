<?php
echo "/*

This file is part of Ext JS 4
Copyright (c) 2011 Sencha Inc
Contact:  http://www.sencha.com/contact
GNU General Public License Usage
This file may be used under the terms of the GNU General Public License version 3.0 as published by the Free Software Foundation and appearing in the file LICENSE included in the packaging of this file.  Please review the following information to ensure the GNU General Public License version 3.0 requirements will be met: http://www.gnu.org/copyleft/gpl.html.
If you are unsure which license is appropriate for your use, please contact the sales department at http://www.sencha.com/contact.

*/
Ext.Loader.setConfig({
    enabled: true
});
Ext.Loader.setPath('Ext.ux', '../sview/ux');

Ext.require([
    'Ext.grid.*',
    'Ext.data.*',
    'Ext.ux.RowExpander',
    'Ext.selection.CheckboxModel'
]);


function showAccountPaymentInfo(){
var fullname,personcode,iowner,pid,dbnoteid;

var displayhere='detailinfo';
var loadtype='Save';
var rid='NOID';
var obj=document.getElementById(displayhere);

var objchild=document.getElementById('dynamicchild');

objchild.innerHTML='';

obj.innerHTML='';





//var clandlord=Ext.getCmp('clandlord').getValue();
//var tid=Ext.getCmp('chousingtenantid').getValue();
//var tenantfullname=Ext.getCmp('ctenanat').getValue();
var tpid=Ext.getCmp('myaccountpid').getValue();
var personname=Ext.getCmp('personreft').getValue(); 

var start=Ext.getCmp('searchperiod_from').getValue();
var end=Ext.getCmp('searchperiod_to').getValue();
var contractdate=Ext.getCmp('contractdatet').getValue();
 
var ttotalbf=Ext.getCmp('ttotalbf').getValue();
var ttotalrent=Ext.getCmp('ttotalrent').getValue();
var ttotalpaid=Ext.getCmp('ttotalpaid').getValue();
var tbalance=Ext.getCmp('tbalance').getValue(); 

var water_elec=Ext.getCmp('telectricity_water').getValue();
var deposit=Ext.getCmp('tdeposit').getValue(); 
var account=Ext.getCmp('myaccountid').getValue(); 

var tenantid=1;


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
   /////////////////////////GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
   
var viewdiv=document.getElementById('detailinfo'),searchitem;
viewdiv.innerHTML='';
/*var encode = false;
var local = true;
var filters = {
        ftype: 'filters',
        encode: encode, 
        local: local, 
        filters: [
            {
                type: 'boolean',
                dataIndex: 'visible'
            }
        ]
    };*/

Ext.define('cmbhousing_housingtenant', {
    extend: 'Ext.data.Model',
	fields:['fieldname','fieldcaption']
	});

var searchhousing_housingtenantdata = Ext.create('Ext.data.Store', {
    model: 'cmbhousing_housingtenant',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=housing_housingtenant&find=thistable',
        reader: {
            type: 'json'
        } 
    }
});
searchhousing_housingtenantdata.load();

var closebtn= Ext.get('close-btn');
	var  viewgrbtnhousing_housingtenant = Ext.get('gridViewhousing_housingtenant');	
	var icad=Ext.getCmp('myaccountid').getValue();
	Ext.define('Housing_housingtenant', {
    extend: 'Ext.data.Model',
	fields:[
			{name:'refid'},
			{name:'transtbl'},
			{name:'banktrans_name'},
			{name:'voucher_number'},
			{name:'currency_id'},
			{name:'amount'},
			{name:'transaction_type'},
			{name:'naration'},
			{name:'bankaccount_name'},
			{name:'bank'},
			{name:'branch'},
			{name:'check_details'},
			{name:'check_number'},
			{name:'check_date'},
			{name:'currency_name'},
			{name:'date_cleared'},
			{name:'payment_mode'},
			{name:'trans_ref'}
			]
	});
	var paymentgridstore = Ext.create('Ext.data.Store', {
    model: 'Housing_housingtenant',
	
	
    proxy: {
        type: 'ajax',
        url : 'buidgrid.php?acctransindiv=sss&icad='+icad,
        reader: {
            type: 'json'
        }
    }
});
  paymentgridstore.load();
  
  ;
  ////////
      var sellAction = Ext.create('Ext.Action', {
        icon   : '../shared/icons/fam/delete.gif',  // Use a URL in the icon config
        text: 'Delete',
        disabled: true,
        handler: function(widget, event) {
            var rec = grid.getSelectionModel().getSelection()[0];
            if (rec) {
                alert('asdfasdas');
            } else {
                alert('Please select a company from the grid');
            }
        }
    });
	
	
	
    var buyAction = Ext.create('Ext.Action', {
        iconCls: 'user-girl',
        text: 'Edit',
        disabled: true,
        handler: function(widget, event) {
            var rec = grid.getSelectionModel().getSelection()[0];
            if (rec) {
                alert('asdfasdas dfdfdf');
            } else {
                alert('Please select a company from the grid');
            }
        }
    });
	
	var contextMenu = Ext.create('Ext.menu.Menu', {
        items: [
             
        ]
    });

  //////////
  var selModel = Ext.create('Ext.selection.CheckboxModel', {
        listeners: {
            selectionchange: function(sm, selections) {
                //grid.down('#removeButton').setDisabled(selections.length == 0);
            }
        }
    });
    var grid = Ext.create('Ext.grid.Panel', {
		margins    : '0 0 0 3',				  
        store: paymentgridstore,
        stateful: true,
		//selModel: selModel,
		multiSelect: true,
		iconCls: 'icon-grid',
        stateId: 'stateGrid',
		animCollapse:false,
        constrainHeader:true,
        layout: 'fit',
		columnLines: true,
		bbar:{height: 20},
		/*features: [filters],*/
		columns:[
		new Ext.grid.RowNumberer(),
				 
				 
				 {
				header     : 'voucher #' , 
				 width : 80 , 
				 hidden:true,
				 sortable : true ,
				 dataIndex : 'voucher_number'
				 },
				 {
				header     : 'check_number ' , 
				 width : 80 , 
				 hidden:true,
				 sortable : true ,
				 dataIndex : 'check_number'
				 },
				 
				{
				header     : 'branch ' , 
				 width : 80 , 
				 hidden:true,
				 sortable : true ,
				 dataIndex : 'branch'
				 },{
				header     : 'bank ' , 
				 width : 80 , 
				 hidden:true,
				 sortable : true ,
				 dataIndex : 'bank'
				 }, 
				{
				header     : 'currency_name' , 
				 width : 80 ,
				 hidden:true, 
				 sortable : true ,
				 dataIndex : 'currency_name'
				 },
				
				 
				 {
				header     : 'amount' , 
				 width : 80 , 
				 sortable : true ,
				 dataIndex : 'amount'
				 },
				 {
				header     : 'transaction_type' , 
				 width : 80 , 
				 sortable : true ,
				 dataIndex : 'transaction_type'
				 },
				 {
				header     : 'naration' , 
				 width : 80 , 
				 sortable : true ,
				 dataIndex : 'naration'
				 },
				 {
				header     : 'Trans ID' , 
				 width : 80 , 
				 sortable : true ,
				 dataIndex : 'trans_ref'
				 },
				 {
                menuDisabled: true,
                sortable: false,
                xtype: 'actioncolumn',
                width: 80,
                items: [
				  {
                    icon   : '../shared/icons/fam/receipt-invoice.png',
                    tooltip: 'Contract ',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = paymentgridstore.getAt(rowIndex);
                        var amount=rec.get('amount');
						var naration=rec.get('naration');
						var check_number=rec.get('check_number');
						var bank=rec.get('bank');
						var branch=rec.get('branch');
						var check_number=rec.get('check_number');
						var check_details=rec.get('check_details');
						var voucher_number=rec.get('voucher_number');
						var trans_ref=rec.get('trans_ref');
						var bank=rec.get('bank');
						banked=bank+'^'+branch+'^'+check_number+'^'+check_details+'^'+voucher_number;
						
						var payment_mode=rec.get('payment_mode');
						
						////////////////////////////
							
							
							if(amount){
							//alert(secelVallid);
							var tenantfullname=Ext.getCmp('cinsured').getValue(); 
							//var clandlord=Ext.getCmp('cunderwriter').getValue();
							var personname=Ext.getCmp('personreft').getValue();
							var account= Ext.getCmp('myaccountid').getValue();
							var tpid= Ext.getCmp('cinsuredpid').getValue();
							var secelVallid='LLi';
							var paytype='Premium Receipt';	
							
							Ext.Ajax.request({
							url: 'ereceipt.php',
								params:{amount:amount,naration:naration,cname:tenantfullname,
									ref:personname,account:account,pid:tpid,payment_mode:payment_mode,banked:banked,paytype:paytype,trans_ref:trans_ref},
							success: function(resp){
							eval(resp.responseText);
							},
							failure: function(action){
							// you could put an error message here
							}
							});
							
							}
						
						////////////////////////////////
						
                    }
                },{
                    icon   : '../shared/icons/fam/arrow-split.png',
                    tooltip: 'Notify ',
                    handler: function(grid, rowIndex, colIndex) {
                       var rec = paymentgridstore.getAt(rowIndex);
					   var account= Ext.getCmp('myaccountid').getValue();
					   var trans_ref=rec.get('trans_ref');
					   var amount=rec.get('amount');
					   
					   var banked='';
					    var payment_mode=rec.get('payment_mode');
					    var paytype='Premium Payment';
					    var check_number=rec.get('check_number');
						var bank=rec.get('bank');
						var branch=rec.get('branch');
						var check_number=rec.get('check_number');
						var check_details=rec.get('check_details');
						var voucher_number=rec.get('voucher_number');
						banked=bank+'^'+branch+'^'+check_number+'^'+check_details+'^'+voucher_number;
						
						
						createItemizedReceipts(account,trans_ref,amount,payment_mode,paytype,banked);
						
                    }
                },{
                    icon   : '../shared/icons/fam/delete.gif',
                    tooltip: 'Delete ',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = paymentgridstore.getAt(rowIndex);
						var tblnow=\"housing_housingtenant\";
						alert(rec.get('housingtenant_id')+rec.get('amount'));
                        
						var rec = paymentgridstore.getAt(rowIndex);
				        var ridtr=rec.get('refid');
						 var tabl=rec.get('transtbl'); 
						 
				        deleteRecord(tabl,ridtr,paymentgridstore);
						
						 onMouseOver=\"showMenuDesign();\"
                    }
                }, {
                    getClass: function(v, meta, rec) { 
                        if (rec.get('alert_name') < 0) {
                            this.items[1].tooltip = 'Edit';
                            return 'alert-col';
                        } else {
                            this.items[1].tooltip = 'Edit';
                            return 'buy-col';
                        }
                    },
					handler: function(grid, rowIndex, colIndex) {
                        var rec = paymentgridstore.getAt(rowIndex);
//alert(\"wassssssssssssssssssssss\");
var ctv='housing_housingtenant';
var ccrecordid=rec.get('housingtenant_id');
Ext.getCmp('tenantaccountsmgrwin').close();
housing_housingtenantForm('detailinfo','updateload',ccrecordid);

                    }
                }]
            }
        ]
		
		,
		maxHeight: 600,
        width: 750,
		resizable:true,
		collapsible:true,
		autoScroll:true,
        title: 'Accounts manager',
       region:'center',
	 /*  listeners : {
    itemclick: function(dv, record, item, index, e) {
	  var empname=record.get('housingtenant_name');
	  
		Ext.getCmp('statementsumm').expand();
		Ext.getCmp('statemenopers').expand();
		Ext.getCmp('statemenopers').enable();
		Ext.getCmp('cinsured').setValue(empname);
		Ext.getCmp('cunderwriter').setValue(record.get('housinglandlord_name'));
		Ext.getCmp('payablerent').setValue(record.get('rent'));
		
		Ext.getCmp('ttotalrent').setValue(record.get('rentd'));
		Ext.getCmp('ttotalbf').setValue(record.get('rentd'));
		Ext.getCmp('ttotalpenalty').setValue(record.get('rentdd'));
		Ext.getCmp('tbalance').setValue(record.get('rentd'));
		Ext.getCmp('cinsuredid').setValue(record.get('housingtenant_id'));
		Ext.getCmp('cinsuredpid').setValue(record.get('tenantpid'));
		Ext.getCmp('ttotalpaid').setValue(record.get('rentd'));
		Ext.getCmp('personreft').setValue(record.get('person_name'));
		Ext.getCmp('contractdatet').setValue(record.get('period_startdate'));
		var acc=record.get('person_name');
		fillTenantStatement(acc,53);
		}}
	   ,*/
        viewConfig: {
            stripeRows: true,
           // enableTextSelection: true,
			listeners: {
                itemcontextmenu: function(view, rec, node, index, e) {
                    e.stopEvent();
                    contextMenu.showAt(e.getXY());
                    return false;
                }
            }
		}
,
		tbar:[/*{}*/]
	
    });
	
	///grid selection
	
	grid.getSelectionModel().on({
        selectionchange: function(sm, selections) {
            if (selections.length) {
                buyAction.enable();
                sellAction.enable();
				 
            } else {
                buyAction.disable();
                sellAction.disable();
				
            }
        }
    });
	///end of grid selection	
		
	


   ///////////////////////////////////////////////////////////////////////////////////////////////////////////form
   Ext.onReady(function(){ 
   Ext.define('cmbPayment_currency', {
    extend: 'Ext.data.Model',
	fields:['currency_id','currency_name']
	});

var payment_currencydata = Ext.create('Ext.data.Store', {
    model: 'cmbPayment_currency',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=payment_currency',
        reader: {
            type: 'json'
        }
    }
});

payment_currencydata.load();

var bankaccountctrl;

 var form = Ext.create('Ext.form.Panel', {
        title:'Account Options',
		collapsible:true,
		width:505,
		maxHeight: 500,
		region     : 'west',
		margins    : '0 0 0 3',
		maximizable:true,
        fieldDefaults: {
            labelWidth: 100
        },
        tbar:[ {text:'Contacts',
				id:'addcontactsbtn',
                    tooltip:'Contacts',
                    iconCls:'add',
					handler:function(){
					//RevisedContactForm('detailinfo','Save','NOID');
					//Ext.getCmp('addbankactbtn').setText('Add Bank A/C');
					Ext.getCmp('contactsfieldset').show();
					Ext.getCmp('tpaymentmodess').hide();
					Ext.getCmp('bankfieldset').hide();	
					
					//Hide
					
					
							Ext.getCmp('topbaltype').hide();
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
							
							Ext.getCmp('tvoucher_number').hide();
							Ext.getCmp('tcheck_number').hide();
							Ext.getCmp('tcheck_date').hide();
							Ext.getCmp('tbankaccount_id').hide();
							Ext.getCmp('bankbranchid').hide();
							Ext.getCmp('tchecknumberdate').hide();
							Ext.getCmp('tcheck_details').hide();
							Ext.getCmp('tpaymentmodess').hide();
							Ext.getCmp('tamountcurrency').hide();
					////////////////////
					}
                },{text:'Bank A/C',
                    tooltip:'Bank Account',
					id:'addbankactbtn',
                    iconCls:'add',
					handler:function(){
						Ext.getCmp('contactsfieldset').hide();
						Ext.getCmp('edependents').hide();  
						Ext.getCmp('bankfieldset').show();
						Ext.getCmp('tpaymentmodess').hide();
						
						//Hide	
					
							Ext.getCmp('topbaltype').hide();
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
							
							Ext.getCmp('tvoucher_number').hide();
							Ext.getCmp('tcheck_number').hide();
							Ext.getCmp('tcheck_date').hide();
							Ext.getCmp('tbankaccount_id').hide();
							Ext.getCmp('bankbranchid').hide();
							Ext.getCmp('tchecknumberdate').hide();
							Ext.getCmp('tcheck_details').hide();
							Ext.getCmp('tpaymentmodess').hide();
							Ext.getCmp('tamountcurrency').hide();
					////////////////////
						
						
					}
                }
,	{text:'NHIF' ,id:'menbtnnhif' ,iconCls:'add' , handler:function(){}}
,	{text:'NSSF' ,id:'menbtnnssf' ,iconCls:'add' , handler:function(){}}
,	{text:'Paygrade' ,id:'menbtnpaygrade' ,iconCls:'add' , handler:function(){}}
,	{text:'Dependents' ,id:'menbtndependents' ,iconCls:'add' , handler:function(){}}
,	{text:'Next of kin' ,id:'menbtnnextofkin' ,iconCls:'add' , handler:function(){}}
,	{text:'Photo' ,id:'menbtnphoto' ,iconCls:'add' , handler:function(){}}
,	{text:'Apply' ,id:'menbtnleaverequest' ,iconCls:'add' , handler:function(){}}
,	{text:'Approve' ,id:'menbtnleaveapprove' ,iconCls:'add' , handler:function(){}}
,	{text:'Summary' ,id:'menbtnleaveoutstanding' ,iconCls:'add' , handler:function(){}}
,	{text:'Allocate' ,id:'menbtnleaveallocate' ,iconCls:'add' , handler:function(){}}
,	{text:'History' ,id:'menbtnleavehistory' ,iconCls:'add' , handler:function(){}}
,	{text:'Suspend' ,id:'menbtncontractsuspend' ,iconCls:'add' , handler:function(){}}
,	{text:'Renew' ,id:'menbtncontractrenew' ,iconCls:'add' , handler:function(){}}
,	{text:'Terminate' ,id:'menbtncontractterminate' ,iconCls:'add' , handler:function(){}}
,	{text:'Rehire' ,id:'menbtncontractrehire' ,iconCls:'add' , handler:function(){}}
],
/////////////////////////////////Let Menu

///////////////////////////////
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
            fieldLabel: 'Employee Name',
			readOnly:true,
			anchor:'100%',
            name: 'tenantname',
            value:tenantfullname
        },
		//////////////////////////////////////
		//bank details
		{xtype:'fieldset',
		   title:'Bank Information',
		   margin: '10 5 5 105',
		   //maxWidth:'400',
		  id:'bankfieldset',
		   items:[
		{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'bankaccount_name',
			id: 'acbankaccount_name',
			anchor:'100%',
			value:'',
            fieldLabel: 'Account Number',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'bank',
			id: 'acbank',
			anchor:'100%',
			value:'',
            fieldLabel: 'Bank ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'branch',
			id: 'acbranch',
			anchor:'100%',
			value:'',
            fieldLabel: 'Branch ',
            allowBlank: false,
            minLength: 1
        
		},
   {
    xtype: 'combobox',
	name:'currency_id',
	anchor:'100%',
	value:1,
	id: 'accurrency_id',
	forceSelection:true,
    fieldLabel: 'Currency',
    store: payment_currencydata,
    queryMode: 'remote',
    displayField: 'currency_name',
    valueField: 'currency_id'
	},{
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'description',
			id: 'acdescription',
			anchor:'100%',
			value:'',
            fieldLabel: 'Description ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'button',
			text:'Save Bank A/C',
            margin: '10 5 5 0',
           anchor:'25%',
		   handler:function(){
		   
		   savePersonBankDetails(tpid,'admin_person');
		   savedData();
		   }
		    },{
            xtype: 'button',
			text:'Cancel',
            margin: '10 5 5 0',
           anchor:'25%'
		    }]},//contact details
		{xtype:'fieldset',
		   title:'Contact Information',
		   margin: '10 5 5 105',
		   //maxWidth:'400',
		  id:'contactsfieldset',
		   items:[
		{
            xtype: 'textfield',
            name: 'email_address',
			id: 'email_address',
			anchor:'100%',
            fieldLabel: 'Email Address ',
			allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'mobile_number',
			id: 'mobile_number',
			anchor:'100%',
			
			value:'',
            fieldLabel: 'Mobile Number ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'postal_address',
			id: 'postal_address',
			anchor:'100%',
			value:'',
            fieldLabel: 'Postal Address ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'physical_address',
			id: 'physical_address',
			anchor:'100%',
			value:'',
            fieldLabel: 'Physical Address ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'fax',
			id: 'fax',
			anchor:'100%',
			value:'',
            fieldLabel: 'Fax ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'telephone',
			id: 'telephone',
			anchor:'100%',
			value:'',
            fieldLabel: 'Telephone ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'checkbox',
			value:'preferred',
			
			inputValue:'preferred',
            name: 'preferred',
			id: 'preferred',
            fieldLabel: 'Preferred'
            
        
		    },{
            xtype: 'button',
			text:'Save Contacts',
            margin: '10 5 5 0',
           anchor:'25%',
		   handler:function(){
		   
		   savePersonContactDetails(tpid,'admin_person');
		   savedData();
		   }
		    },{
            xtype: 'button',
			text:'Cancel',
            margin: '10 5 5 0',
           anchor:'25%'
		    }]},
		
		//////////////////////////////////
		{
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
		
		{  xtype: 'hiddenfield',
			readOnly:true,
			anchor:'100%',
            fieldLabel: 'A/C',
            name: 'landlordid',
			value:clandlord
        }
		,
		
		{xtype: 'radiogroup',
                fieldLabel:'Balance Type',
				combineErrors: true,
				msgTarget : 'side',
				maxWidth:600,
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
                fieldLabel:'Amount',
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
            fieldLabel: 'Drawer',
			anchor:'100%',
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
           // xtype: 'htmleditor',
			xtype: 'textareafield',
			fieldLabel:'Naration',
			labelAlign:'top',
            name: 'tnaration',
			id:'tnaration',
			anchor:'100%'
            
        }], 
		buttons: [{
            text: 'Save Payment',
			id: 'savetpaymentbtn',
			handler:function(){
			            var	accountscategory_id=53;
						var	accaccount_id=Ext.getCmp('myaccountid').getValue();	
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
						paymentgridstore,
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
						paymentgridstore,
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
							paymentgridstore,
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
			Ext.getCmp('individualaccountmanager').close();
			}
			
        }
		
		//================================================================================
		
		
		//================================================================================
		]
    });
//hide unencessary fields
//SHo default contacts
fillContactInfo(tpid);
fillBankAccInfo(tpid);

//Hide all secondary menu
 
//Ext.getCmp('addcontactsbtn').hide();
//Ext.getCmp('addbankactbtn').hide();
Ext.getCmp('menbtnnssf').hide();
Ext.getCmp('menbtnnhif').hide();
Ext.getCmp('menbtnpaygrade').hide();
Ext.getCmp('menbtndependents').hide();
Ext.getCmp('menbtnnextofkin').hide();
Ext.getCmp('menbtnphoto').hide();
Ext.getCmp('menbtnleaverequest').hide();
Ext.getCmp('menbtnleaveapprove').hide();
Ext.getCmp('menbtnleavehistory').hide();
Ext.getCmp('menbtnleaveoutstanding').hide();
Ext.getCmp('menbtnleaveallocate').hide();
Ext.getCmp('menbtncontractrehire').hide();
Ext.getCmp('menbtncontractterminate').hide();
Ext.getCmp('menbtncontractsuspend').hide();
Ext.getCmp('menbtncontractrenew').hide();

   ///////////////////////////////////////////////////////////////////////////////////////////////////////////End of form
   ////GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
  //Simple 'border layout' panel to house both grids
    var displayPanel = Ext.create('Ext.Panel', {
        width    : 1000,
        height   : 600,
		autoScroll:true,
        layout   : 'border',
        renderTo : 'panel',
        bodyPadding: '5',
        items    : [
            //formPanel
            form,
			grid
			
        ]
        
    });




var win = Ext.create('Ext.window.Window', {
        title: 'Employee Accounts',
		lbar:[
    {text:'NHIF' ,id:'lmenbtnnhif' ,iconCls:'add' , handler:function(){}}
,	{text:'NSSF' ,id:'lmenbtnnssf' ,iconCls:'add' , handler:function(){}}
,	{text:'Paygrade' ,id:'lmenbtnpaygrade' ,iconCls:'add' , handler:function(){}}
,	{text:'Dependents' ,id:'lmenbtndependents' ,iconCls:'add' , handler:function(){}}
,	{text:'Next of kin' ,id:'lmenbtnnextofkin' ,iconCls:'add' , handler:function(){}}
,	{text:'Photo' ,id:'lmenbtnphoto' ,iconCls:'add' , handler:function(){}}
,	{text:'Apply' ,id:'lmenbtnleaverequest' ,iconCls:'add' , handler:function(){}}
,	{text:'Approve' ,id:'lmenbtnleaveapprove' ,iconCls:'add' , handler:function(){}}
,	{text:'Summary' ,id:'lmenbtnleaveoutstanding' ,iconCls:'add' , handler:function(){}}
,	{text:'Allocate' ,id:'lmenbtnleaveallocate' ,iconCls:'add' , handler:function(){}}
,	{text:'History' ,id:'lmenbtnleavehistory' ,iconCls:'add' , handler:function(){}}
,	{text:'Suspend' ,id:'lmenbtncontractsuspend' ,iconCls:'add' , handler:function(){}}
,	{text:'Renew' ,id:'lmenbtncontractrenew' ,iconCls:'add' , handler:function(){}}
,	{text:'Terminate' ,id:'lmenbtncontractterminate' ,iconCls:'add' , handler:function(){}}
,	{text:'Rehire' ,id:'lmenbtncontractrehire' ,iconCls:'add' , handler:function(){}}
],
		tbar:[{text:'Personal Details',
                    tooltip:'Personal Details',
					id:'mmpersonaldetails',
                    iconCls:'add',
					handler:function(){
					
//Modify to show clicked
Ext.getCmp('mmpersonaldetails').addCls('mainMenuSelectedByClick');
Ext.getCmp('mmPayrolldetails').removeCls('mainMenuSelectedByClick');
Ext.getCmp('mmemploymentdetails').removeCls('mainMenuSelectedByClick');
Ext.getCmp('mmleavedetails').removeCls('mainMenuSelectedByClick');
			  	 
Ext.getCmp('addcontactsbtn').show();
Ext.getCmp('addbankactbtn').show();
Ext.getCmp('menbtnnssf').hide();
Ext.getCmp('menbtnnhif').hide();
Ext.getCmp('menbtnpaygrade').hide();
Ext.getCmp('menbtndependents').show();
Ext.getCmp('menbtnnextofkin').show();
Ext.getCmp('menbtnphoto').show();
Ext.getCmp('menbtnleaverequest').hide();
Ext.getCmp('menbtnleaveapprove').hide();
Ext.getCmp('menbtnleavehistory').hide();
Ext.getCmp('menbtnleaveoutstanding').hide();
Ext.getCmp('menbtnleaveallocate').hide();
Ext.getCmp('menbtncontractrehire').hide();
Ext.getCmp('menbtncontractterminate').hide();
Ext.getCmp('menbtncontractsuspend').hide();
Ext.getCmp('menbtncontractrenew').hide();
						
					}
                }, '-',
				{text:'Payroll Details',
                    tooltip:'Payroll Details',
					id:'mmPayrolldetails',
                    iconCls:'add',
					handler:function(){
					

Ext.getCmp('mmPayrolldetails').addCls('mainMenuSelectedByClick');
Ext.getCmp('mmpersonaldetails').removeCls('mainMenuSelectedByClick');
Ext.getCmp('mmemploymentdetails').removeCls('mainMenuSelectedByClick');
Ext.getCmp('mmleavedetails').removeCls('mainMenuSelectedByClick');


Ext.getCmp('addcontactsbtn').hide();
Ext.getCmp('addbankactbtn').hide();
Ext.getCmp('menbtnnssf').show();
Ext.getCmp('menbtnnhif').show();
Ext.getCmp('menbtnpaygrade').hide();
Ext.getCmp('menbtndependents').hide();
Ext.getCmp('menbtnnextofkin').hide();
Ext.getCmp('menbtnphoto').hide();
Ext.getCmp('menbtnleaverequest').hide();
Ext.getCmp('menbtnleaveapprove').hide();
Ext.getCmp('menbtnleavehistory').hide();
Ext.getCmp('menbtnleaveoutstanding').hide();
Ext.getCmp('menbtnleaveallocate').hide();
Ext.getCmp('menbtncontractrehire').hide();
Ext.getCmp('menbtncontractterminate').hide();
Ext.getCmp('menbtncontractsuspend').hide();
Ext.getCmp('menbtncontractrenew').hide();
						
					}
                }, '-',
				{text:'Employment Details', 
                    tooltip:'Employment Details',
					id:'mmemploymentdetails',
                    iconCls:'add',
					handler:function(){

Ext.getCmp('mmemploymentdetails').addCls('mainMenuSelectedByClick');
Ext.getCmp('mmleavedetails').removeCls('mainMenuSelectedByClick');
Ext.getCmp('mmPayrolldetails').removeCls('mainMenuSelectedByClick');
Ext.getCmp('mmpersonaldetails').removeCls('mainMenuSelectedByClick');

Ext.getCmp('addcontactsbtn').hide();
Ext.getCmp('addbankactbtn').hide();
Ext.getCmp('menbtnnssf').hide();
Ext.getCmp('menbtnnhif').hide();
Ext.getCmp('menbtnpaygrade').show();
Ext.getCmp('menbtndependents').hide();
Ext.getCmp('menbtnnextofkin').hide();
Ext.getCmp('menbtnphoto').hide();
Ext.getCmp('menbtnleaverequest').hide();
Ext.getCmp('menbtnleaveapprove').hide();
Ext.getCmp('menbtnleavehistory').hide();
Ext.getCmp('menbtnleaveoutstanding').hide();
Ext.getCmp('menbtnleaveallocate').hide();
Ext.getCmp('menbtncontractrehire').show();
Ext.getCmp('menbtncontractterminate').show();
Ext.getCmp('menbtncontractsuspend').show();
Ext.getCmp('menbtncontractrenew').show();
						
					}
                } 
				, '-',
				{text:'Leave Details', 
                    tooltip:'Leave Details',
					id:'mmleavedetails',
                    iconCls:'add',
					handler:function(){

Ext.getCmp('mmleavedetails').addCls('mainMenuSelectedByClick');
Ext.getCmp('mmPayrolldetails').removeCls('mainMenuSelectedByClick');
Ext.getCmp('mmpersonaldetails').removeCls('mainMenuSelectedByClick');
Ext.getCmp('mmemploymentdetails').removeCls('mainMenuSelectedByClick');

Ext.getCmp('addcontactsbtn').hide();
Ext.getCmp('addbankactbtn').hide();
Ext.getCmp('menbtnnssf').hide();
Ext.getCmp('menbtnnhif').hide();
Ext.getCmp('menbtnpaygrade').hide();
Ext.getCmp('menbtndependents').hide();
Ext.getCmp('menbtnnextofkin').hide();
Ext.getCmp('menbtnphoto').hide();
Ext.getCmp('menbtnleaverequest').show();
Ext.getCmp('menbtnleaveapprove').show();
Ext.getCmp('menbtnleavehistory').show();
Ext.getCmp('menbtnleaveoutstanding').show();
Ext.getCmp('menbtnleaveallocate').show();
Ext.getCmp('menbtncontractrehire').hide();
Ext.getCmp('menbtncontractterminate').hide();
Ext.getCmp('menbtncontractsuspend').hide();
Ext.getCmp('menbtncontractrenew').hide();	
					}
                } 
				
				
				],
        width: 1000,
		bodyPadding:10,
		iconCls: 'icon-grid',
		autoScroll:true,
		maximizable :true,
		collapsible :true,
        maximized:true,
		id:'individualaccountmanager',
        plain: true,
		layout: 'fit',
        items: displayPanel,
		
	/*	dockedItems: [{
            xtype: 'toolbar',
            dock: 'bottom',
            ui: 'header',
            layout: {
                pack: 'center'
            },
            items: [{
                minWidth: 80,
                text: 'Close',
				handler:function(){
				Ext.getCmp('tenantaccountsmgrwin').close();
				}
            }]
        }],*/
        buttonAlign:'center'
    });

    win.show();
});
Ext.getCmp('bankfieldset').hide();
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
//'Kwatuha Alfayo','IN20012','admin_person',51,2
showAccountPaymentInfo();
";
echo "function createItemizedReceipts(account,transid,amount,payment_mode,paytype,banked){
       Ext.Ajax.request({
							url: 'ereceipt.php',
							params:{amount:amount,account:account,trans_ref:transid,banked:banked,mypst:'split'},
							success: function(resp){
							eval(resp.responseText);
							},
							failure: function(action){
							// you could put an error message here
							}
							});
}";
//,'$trans_ref','$paytype'
echo "function createIndivReceiptItems(amount,receipt_id,dyLabel,dyLabelVal,receipt_num,banked){
var receivedfrom=Ext.getCmp('cinsured').getValue(); 
//var clandlord=Ext.getCmp('cunderwriter').getValue();
var personname=Ext.getCmp('personreft').getValue();
var account= Ext.getCmp('myaccountid').getValue();
Ext.onReady(function() {
        var formrcpt = Ext.create('Ext.form.Panel', {
        border: true,
		frame:true,
		autoScroll:true,
        fieldDefaults: {
            labelWidth: 80
        },
        defaultType: 'textfield',
        bodyPadding: 5,

        items: [
		{xtype:'fieldset',
			anchor:'75%',
		   title:'Receipt Details',
		   collapsible:true,
		  
		   items:[
		{
            xtype: 'numberfield',
            fieldLabel: 'Total Amount',
			anchor: '40%',
            name: 'amt',
            value:amount
        },
		{
            xtype: 'textfield',
			readOnly:true,
            fieldLabel: 'Received From',
			anchor: '40%',
			value: receivedfrom
          
        }
		,{
            xtype: 'textfield',
			readOnly:true,
            fieldLabel: 'A/C Number',
			anchor: '40%',
			value: personname
          
        }
		,{
            xtype: 'textfield',
			readOnly:true,
			anchor: '40%',
            fieldLabel: dyLabel,
			value: dyLabelVal
          
        }
		,{
            xtype: 'textfield',
			readOnly:true,
            fieldLabel: 'Receipt Number',
			anchor: '40%',
			id:'treceipt_num',
			value: receipt_num
          
        }]}
		,{xtype: 'hiddenfield',
		  msgTarget : 'side',
		  anchor:'75%',
		  fieldLabel: 'Items',
		  id: 'rctnumberofitems',
			value:''},
			{xtype:'fieldset',
			anchor:'75%',
		   title:'Receipt Items',
		   collapsible:true,
		  
		   items:[
		   {
            xtype: 'button',
			margin: '5 5 5 5',
			text:'Add New',
			handler: function() {
			
								var container = this.up('fieldset');
								var itemnum=0;
								var config = Ext.apply({}, container.initialConfig.items[1]);
								config.fieldName = container.items.length + 1;
								var fieldnamed=container.items.length + 1;
								itemnum=fieldnamed-2;
								 Ext.getCmp('rctnumberofitems').setValue(itemnum);
								
								
								container.add(
									{xtype: 'numberfield',
									msgTarget : 'side',
									anchor:'75%',
									fieldLabel: 'Amount',
									id: 'itAmount'+itemnum,
									value:''},{
									xtype: 'textareafield',
									msgTarget : 'side',
									anchor:'75%',
									id: 'itDescription'+itemnum,
									value:'',
									fieldLabel: 'Description ',
									minLength: 1
								
								});
								
								  var totalAMT=0;
								  /*var initamt=Ext.getCmp('initamount').getValue();
								  var initDesc=Ext.getCmp('initdescr').getValue();*/
								  for(i=0;i<=itemnum;i++){
								   if((i%2)==0){
									var amt= Ext.getCmp('itAmount'+i).getValue();
									if(amt>0){
									totalAMT=totalAMT+amt;
									  }
									 }
								  }
								  if(amount<totalAMT){
								  showcusterror('Total itemized aggrigate exceeds '+amount,'Receipt Amount Error');
								  }
								  
										
								}}
		]}]
    });

    var winrcpt = Ext.create('Ext.window.Window', {
        title: 'Itemize Receipt Details',
        width: 600,
		autoScroll:true,
		maximizable :true,
		collapsible :true,
        maximized:true,
        height:400,
        minWidth: 300,
		bodyPadding:10,
        minHeight: 200,
        layout: 'fit',
		id:'winitemizereceiptitems',
        plain: true,
        items: formrcpt,

        buttons: [{
            text: 'Print Receipt',
			handler:function(){
		              var totalAMT=0;
					  var invaliddescr='';
					  var amountS='';
					  var amountDS='';
								  var itemnum=Ext.getCmp('rctnumberofitems').getValue();
								  
								  for(i=0;i<=itemnum;i++){
								   if((i%2)==0){
									var amt= Ext.getCmp('itAmount'+i).getValue();
									var itDescr= Ext.getCmp('itDescription'+i).getValue();
									if(!itDescr){
									 invaliddescr='Invalid';
									}
									
									if((amt>0)&&(itDescr)){
									totalAMT=totalAMT+amt;
									amountS+=amt+'|';
									amountDS+=itDescr+'|';
									  }
									 }
								  }
								  if(amount<totalAMT){
								  showcusterror('Total itemized aggrigate exceeds '+amount,'Amount Error');
								  }
								  if(amount==totalAMT){
								
							//banked:banked,
							Ext.Ajax.request({
							url: 'ereceipt.php',
								params:{amountDS:amountDS,amountS:amountS,receipt_id:receipt_id,banked:banked,totalamount:amount,rcptitemed:'true',cystype:'INS'},
							success: function(resp){
							eval(resp.responseText);
							},
							failure: function(action){
							// you could put an error message here
							}
							});
								  }
								  if(invaliddescr){
								  showcusterror('Invalid item description for some items','Missing Description');
								  }
			}
        },{
            text: 'Cancel',
			handler:function(){
			Ext.getCmp('winitemizereceiptitems').close();
			}
			
        }]
    });

    winrcpt.show();
});
}";
?>