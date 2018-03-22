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


function insurance_insurancedebitnoteFormRevised(fullname,personcode,iowner,pid,dbnoteid){

var displayhere='detailinfo';
var loadtype='Save';
var rid='NOID';
var obj=document.getElementById(displayhere);

var objchild=document.getElementById('dynamicchild');

objchild.innerHTML='';

obj.innerHTML='';



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

var admin_grpdata = Ext.create('Ext.data.Store', {
    model: 'cmbsysgroups',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tgr=ggrp',
        reader: {
            type: 'json'
        }
    }
});

admin_grpdata.load();
Ext.onReady(function(){

//////////////////////////////
Ext.define('cmbInsurance_insurancedebitnote', {
    extend: 'Ext.data.Model',
	fields:['insurancedebitnote_id','insurancedebitnote_name']
	});

var insurance_insurancedebitnotedata = Ext.create('Ext.data.Store', {
    model: 'cmbInsurance_insurancedebitnote',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=insurance_insurancedebitnote',
        reader: {
            type: 'json'
        }
    }
});

insurance_insurancedebitnotedata.load();


Ext.define('cmbInsurance_insuranceclass', {
    extend: 'Ext.data.Model',
	fields:['insuranceclass_id','insuranceclass_name']
	});

var insurance_insuranceclassdata = Ext.create('Ext.data.Store', {
    model: 'cmbInsurance_insuranceclass',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=insurance_insuranceclass',
        reader: {
            type: 'json'
        }
    }
});

insurance_insuranceclassdata.load();


Ext.define('cmbInsurance_underwriter', {
    extend: 'Ext.data.Model',
	fields:['underwriter_id','underwriter_name']
	});

var insurance_underwriterdata = Ext.create('Ext.data.Store', {
    model: 'cmbInsurance_underwriter',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=insurance_underwriter',
        reader: {
            type: 'json'
        }
    }
});

insurance_underwriterdata.load();

Ext.define('cmbInsurance_policyscope', {
    extend: 'Ext.data.Model',
	fields:['policyscope_id','policyscope_name']
	});

var insurance_policyscopedata = Ext.create('Ext.data.Store', {
    model: 'cmbInsurance_policyscope',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=insurance_policyscope',
        reader: {
            type: 'json'
        }
    }
});

insurance_policyscopedata.load();
/////// 
Ext.tip.QuickTipManager.init();
        var formPanel = Ext.widget('form', {
		id:'insurancedebitnoteform',
		 region           : 'west',
		 bodyStyle  : 'padding: 10px; background-color: #DFE8F6',
        tbar:[{
                    text:'Add new',
                    tooltip:'Add a new row',
                    iconCls:'add'
                }, '-', {
                    text:'Options',
                    tooltip:'Configure options',
                    iconCls:'option'
                },'-',{
                    text:'View',
                    tooltip:'View table Grid',
                    iconCls:'grid',
					handler:function(buttonObj, eventObj) { 
									createFormGrid('Save','NOID','insurance_insurancedebitnote','g')
									}
                },'-',{
                    text:'Close',
                    tooltip:'Delete selected item',
                    iconCls:'delete',
					handler:function(){
				Ext.getCmp('dbnotecustomization').close();
				}
                }],
		//resizable:true,
		//closable:true,
		//  frame: true,
		url:'bodysave.php',
        width     : 340,
		
	    collapsible:true,
		autoScroll:true,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: 'Insured Information',

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

            if (me.hasBeenDirty || me.getForm().isDirty()) { 
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
		
		{xtype:'hidden',
             name:'t',
			 value:iowner
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },
			 /*{xtype:'fieldset',
		   title:'Insured',
		   bodyBorder:false,
		   bodyPadding:5,
		   collapsible:true,
		   id:'insureddetails',
		   items:[*/
			 {
			 margin:'5 5 5 5',
			html:'<div  class=\"summaryinfo\"><table border=\"0\"><tr><td>File No.:</td><td>' +personcode+'</td></tr>'+'<tr><td>Insured : </td><td>'+fullname+'</td></tr></table></div>'
			
           }/*]}*/,
		   {
            xtype: 'hidden',
            name: 'insurancedebitnote_name',
			value:personcode
			},
			{
            xtype: 'hidden',
			value:fullname,
            name:'clientfullname'
        
		},{
            xtype: 'hidden',
			id: 'syowner',
			value:iowner
        
		},{
            xtype: 'hidden',
            name: 'person_id',
			id: 'person_id',
			value:pid
        
		},{
            xtype: 'hidden',
            name: 'persongroup_id',
			value:pid
        
		},{
            xtype: 'hidden',
            name: 'numberofitems',
			id: 'numberofitems',
			value:''
        
		},{xtype: 'fieldcontainer',
                fieldLabel:'Underwriter',
				combineErrors: true,
				msgTarget : 'side',
                layout: 'hbox',
				items:[{
    xtype: 'combobox',
	name:'underwriter_id',
	id:'underwriter_id',
	forceSelection:true,
    fieldLabel: false,
	labelWidth:80,
	anchor:'100%',
	margin: '0 5 0 0',
    store: insurance_underwriterdata,
    queryMode: 'remote',
    displayField: 'underwriter_name',
    valueField: 'underwriter_id',
	listeners: { select: function(combo, record, index ) { 
	//var secelVallid = Ext.getCmp('liperson_id').getValue();
	//createFillLandlordDetails(secelVallid,tenantid);
	}}
	}]},{
 xtype: 'radiogroup',
 autoScroll:true,
 fieldLabel: 'Policy Type',
 columns: 2,
 vertical: true,
 items: [{ boxLabel: 'Renewable',id: 'policyrenewable', inputValue: '1'},
 { boxLabel: 'Non-Renewable',id: 'policynonrenewable', inputValue: '0'}]},
 {
            xtype: 'textfield',
			msgTarget : 'side',
			anchor:'100%',
            name: 'policy_number',
			 id: 'policy_number',
			fieldLabel: 'Policy #'
         
		},
 {
    xtype: 'combobox',
	anchor:'100%',
	name:'currency_id',
	id:'currency_id',
	margin: '0 5 5 0',
	forceSelection:true,
     fieldLabel:'Currency',
    store: payment_currencydata,
    queryMode: 'remote',
    displayField: 'currency_name',
    valueField: 'currency_id' 
	},
 {xtype:'fieldset',
		   title:'Policy Details',
		   collapsible:true,
		   id:'policydetails',
		   items:[
		   
  {
            xtype: 'numberfield',
			margin: '0 5 5 0',
			msgTarget : 'side',
            name: 'pcf',
			id: 'pcf',
			value:'0.2',
            fieldLabel: 'P.C.F',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			margin: '0 5 5 0',
			msgTarget : 'side',
			name: 'stamp_duty',
			id: 'stamp_duty',
			value:'40',
             fieldLabel:'Stamp Duty',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			margin: '0 5 5 0',
			msgTarget : 'side',
			name: 'training_levy',
			id: 'training_levy',
			value:'0.25',
            fieldLabel: 'Training Levy',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			margin: '0 5 5 0',
			msgTarget : 'side',
            name: 'wtax',
			id: 'wtax',
			value:'0',
            fieldLabel:'Withholding Tax',
            allowBlank: false,
            minLength: 1
        
		}
		]},{xtype:'fieldset',
		   title:'Policy Summary',
		   collapsible:true,
		   collapsed:true,
		   id:'policysummaryd',
		   items:[
		{html:'PCF:',margin: '0 5 0 0'},
		{html:'Comm.:',margin: '0 5 0 0'},
		{html:'W.T:',margin: '0 5 0 0'},
		{html:'Net premium:',margin: '0 5 5 0'}]},
		{xtype:'fieldset',
		   title:'Additional details',
		   collapsible:true,
		   collapsed:true,
		   id:'fsother_details',
		   items:[{
            xtype: 'textarea',
			fieldLabel:'Other Details',
			labelAlign:'top',
            name: 'other_details',
			id: 'other_details',
            anchor: '100%'
        }]},
		   {xtype:'fieldset',
		   title:'Add Attachments',
		   collapsible:true,
		   collapsed:true,
		   id:'policyattachments',
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
												name: 'policyattachments',
												id: 'policyattachments',
												width:200,
												fieldLabel: 'Sdtl  '+ fieldnamed,
												minLength: 1
											
											});
										
								}}
		]}], dockedItems: [{
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
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for=><li><span class=\"field-name\">{name}</span>:'
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
            }/*, 
			*/
			
	/*now submit*/
	/*{
		xtype: 'button',
        text: 'Submit Data',
        handler: function() {
            var form = this.up('form').getForm();
            if(form.isValid()){
                form.submit({
                    url: 'bodysave.php',
                    waitMsg: 'saving changes...',
                    success: function(fp, o) {
                       
					   eval(o.result.savemsg);
                    }
                });
            }
        }
    }*/
	
		]
        }]
    });
	
	
if(loadtype=='updateload'){
loadinsurance_insurancedebitnoteinfo(formPanel,rid);
}

///////////////////////////////////////////////////////////////////////////////////////////////////
    
Ext.define('cmbInsurance_policypaymentmode', {
    extend: 'Ext.data.Model',
	fields:['policypaymentmode_id','policypaymentmode_name']
	});
var insurance_policypaymentmodedata = Ext.create('Ext.data.Store', {
    model: 'cmbInsurance_policypaymentmode',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=insurance_policypaymentmode',
        reader: {
            type: 'json'
        }
    }
});
insurance_policypaymentmodedata.load();

Ext.define('cmbInsurance_policyfinance', {
    extend: 'Ext.data.Model',
	fields:['policyfinance_id','policyfinance_name']
	});
var insurance_policyfinancedata = Ext.create('Ext.data.Store', {
    model: 'cmbInsurance_policyfinance',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=insurance_policyfinance',
        reader: {
            type: 'json'
        }
    }
});
insurance_policyfinancedata.load();

      
    // Setup the form panel
    var formPanel2 = Ext.create('Ext.form.Panel', {
        region     : 'east',
        title      : 'Policy Payment',
		collapsible:true,
		autoScroll:true,
        bodyStyle  : 'padding: 10px; background-color: #DFE8F6',
        labelWidth : 100,
        width     : 340,
        margins    : '0 0 0 3',
        items      : [{
    xtype: 'combobox',
	name:'policypaymentmode_id',
	id:'policypaymentmode_id',
	forceSelection:true,
	labelAlign:'top',
    fieldLabel: 'Payment mode',
    store: insurance_policypaymentmodedata,
    queryMode: 'remote',
    displayField: 'policypaymentmode_name',
    valueField: 'policypaymentmode_id',
	listeners: { select: function(combo, record, index ) { 
	var pmode = Ext.getCmp('policypaymentmode_id').getValue();
if(pmode==1){	
Ext.getCmp('policyfinance_id').show();
Ext.getCmp('dnbank').show();
Ext.getCmp('policyipf').expand();
Ext.getCmp('check_number').show();
Ext.getCmp('dnamount').show();
Ext.getCmp('check_date').show();
Ext.getCmp('policyfinance_id').show();
}
else if(pmode==2){
Ext.getCmp('policyipf').expand();
Ext.getCmp('policyfinance_id').hide();
Ext.getCmp('chnaration').show();
Ext.getCmp('check_details').show();	   
Ext.getCmp('check_number').show();
Ext.getCmp('dnamount').show();
Ext.getCmp('dnbank').show();
Ext.getCmp('check_date').show();
}else{
Ext.getCmp('chnaration').hide();
Ext.getCmp('check_details').hide();	
Ext.getCmp('policyfinance_id').hide();
Ext.getCmp('policyipf').collapse();
Ext.getCmp('dnbank').hide();
Ext.getCmp('check_number').hide();
Ext.getCmp('dnamount').hide();
Ext.getCmp('check_date').hide();
}
	}}
	},{xtype:'fieldset',
		   title:'Policy Payment',
		   collapsed:true,
		   collapsible:true,
		   id:'policyipf',
		   items:[
				  {
    xtype: 'combobox',
	name:'policyfinance_id',
	id:'policyfinance_id',
	forceSelection:true,
    fieldLabel: 'Financier ',
	anchor:'100%',
    store: insurance_policyfinancedata,
    queryMode: 'remote',
    displayField: 'policyfinance_name',
    valueField: 'policyfinance_id',
	allowBlank: false
	},{
            xtype: 'textfield',
			msgTarget : 'side',
			anchor:'100%',
            name: 'bank',
			 id: 'dnbank',
			fieldLabel: 'Bank'
           
        
		},
		{
            xtype: 'textfield',
			msgTarget : 'side',
			anchor:'100%',
            name: 'branch',
			 id: 'dbranch',
			fieldLabel: 'Branch'
           
        
		},
        {
            xtype: 'textfield',
			msgTarget : 'side',
			anchor:'100%',
            name: 'check_number',
			id: 'check_number',
			fieldLabel: 'Check Number'
        },
		{
            xtype: 'textfield',
			msgTarget : 'side',
			anchor:'100%',
            name: 'amount',
			id: 'dnamount',
			fieldLabel: 'Amount'
        },
		{
            xtype: 'textfield',
			msgTarget : 'side',
			anchor:'100%',
            name: 'check_details',
			id: 'check_details',
			fieldLabel: 'Check Name'
        }, 
		{
            xtype: 'datefield',
			msgTarget : 'side',
			anchor:'100%',
            name: 'check_date',
			id: 'check_date',
			fieldLabel: 'Check Date'
           
        
		},
		{
            xtype: 'textarea',
			name: 'naration',
			id: 'chnaration',
			fieldLabel: 'Narration',
			labelAlign:'top',
            anchor: '100%'
        },
        {
            xtype: 'button',
			margin: '5 5 5 5',
			text:'Add IPF Cheque(s)',
			handler: function() {
			
			var	paymentmodeid=Ext.getCmp('policypaymentmode_id').getValue();
			if(paymentmodeid==2){
			var	bank=Ext.getCmp('dnbank').getValue();	
			var	check_details=Ext.getCmp('check_details').getValue();	
			var	check_number=Ext.getCmp('check_number').getValue();	
			var	check_date=Ext.getCmp('check_date').getValue();	
			var	currency_id=Ext.getCmp('currency_id').getValue();	
			var	amount=Ext.getCmp('dnamount').getValue();	
			//var	transaction_type=Ext.getCmp('transaction_type').getValue();	
			var	naration=Ext.getCmp('chnaration').getValue();
			var	dbranch=Ext.getCmp('dbranch').getValue();		

			Ext.Ajax.request({
								   url: 'bodysave.php',
								   success: function(resp) {eval(resp.responseText);},
                                   params:{t:'accounts_checkregister',
								   tttact:'Save',
								   branch:dbranch,
								   insurancedebitnote_id:dbnoteid,
								   ckdins:'Y',
								   person_id:pid,
									syowner:iowner,
									bank:bank,
									check_details:check_details,
									check_number:check_number,
									check_date:check_date,
									currency_id:currency_id,
									amount:amount,
									transaction_type:'Deposit',
									naration:naration
									},
									failure: function(action){
									// you could put an error message here
									}
								   });
			}
			if(paymentmodeid==1){
			var	policyfinance_id=Ext.getCmp('policyfinance_id').getValue();
			var	bank=Ext.getCmp('dnbank').getValue();
			var	check_number=Ext.getCmp('check_number').getValue();
			var	amount=Ext.getCmp('dnamount').getValue();
			var	check_date=Ext.getCmp('check_date').getValue();
			
			Ext.Ajax.request({
								   url: 'bodysave.php',
								   success: function(resp) {eval(resp.responseText);},
                                   params:{t:'insurance_dnpolicyfinance',
								   tttact:'Save',
								   insurancedebitnote_id:dbnoteid,
								   policyfinance_id:policyfinance_id,
							        bank:bank,
									check_number:check_number,
									amount:	amount,
									check_date:	check_date
									},
									failure: function(action){
									// you could put an error message here
									}
								   });
				}	   

			}}]},
			{xtype:'fieldset',
		   title:'Underwriter Receipts',
		   collapsed:true,
		   collapsible:true,
		   id:'policyrecepts',
		   items:[
		   {
            xtype: 'textfield',
			msgTarget : 'side',
			anchor:'75%',
            name: 'receipt_number',
			id: 'receipt_number',
			fieldLabel: 'Receipt Number'
        },
				 {
            xtype: 'datefield',
			msgTarget : 'side',
			anchor:'75%',
            name: 'receipt_date',
			 id: 'receipt_date',
			fieldLabel: 'Receipt Date'
         
		},
        {
            xtype: 'textfield',
			msgTarget : 'side',
			anchor:'75%',
            name: 'receipt_amount',
			id: 'receipt_amount',
			fieldLabel: 'Amount'
        },{
            xtype: 'button',
            name: 'addpayment',
			id: 'yaddpayment',
			margin:'0 5 0 0',
           
            text:'Add Receipts #',
			handler:function(){
			
			
var	receipt_number=Ext.getCmp('receipt_number').getValue();
var	receipt_amount=Ext.getCmp('receipt_amount').getValue();
var	receipt_date=Ext.getCmp('receipt_date').getValue();


			Ext.Ajax.request({
								   url: 'bodysave.php',
								   success: function(resp) {eval(resp.responseText);},
                                   params:{t:'insurance_dbnotetransact',
								   tttact:'Save',
								   insurancedebitnote_id:dbnoteid,
								   receipt_number:receipt_number,
								   receipt_amount:receipt_amount,
								    receipt_date:receipt_date
									},
									failure: function(action){
									// you could put an error message here
									}
								   });	   
		    
			
			}}]}
        ]
    });
	
	var formPanel3 = Ext.create('Ext.form.Panel', {
        region     : 'center',
        title      : 'Insurance Class',
		collapsible:true,
		autoScroll:true,
        bodyStyle  : 'padding: 10px; background-color: #DFE8F6',
        margin:'0 0 0 3',
        width     : 200,
        items      : [{xtype:'fieldset',
		   title:'Risk Naration',
		   collapsible:true,
		   id:'policyitemdescri',
		   items:[{
    xtype: 'combobox',
	name:'insuranceclass_id',
	id:'insuranceclass_id',
	forceSelection:true,
    fieldLabel: 'Class ',
	anchor:'75%',
    store: insurance_insuranceclassdata,
    queryMode: 'remote',
    displayField: 'insuranceclass_name',
    valueField: 'insuranceclass_id',
	allowBlank: false,
	listeners: { select: function(combo, record, index ) { 
	var insuranceclassid = Ext.getCmp('insuranceclass_id').getValue();
	
	//general policy infor
var	policy_number=Ext.getCmp('policy_number').getValue();
var	underwriter_id=Ext.getCmp('underwriter_id').getValue();
var	person_id=Ext.getCmp('person_id').getValue();
var	other_details=Ext.getCmp('other_details').getValue();
var	currency_id=Ext.getCmp('currency_id').getValue();
var	pcf=Ext.getCmp('pcf').getValue();
var	training_levy=Ext.getCmp('training_levy').getValue();
var	stamp_duty=Ext.getCmp('stamp_duty').getValue();
var	wtax=Ext.getCmp('wtax').getValue();


	if(insuranceclassid==1){
	Ext.getCmp('year_manufactured').show();
	Ext.getCmp('chasis_number').show();
	Ext.getCmp('engine_number').show();
	Ext.getCmp('make').show();
	Ext.getCmp('registration_number').show();
	
	}else{
	Ext.getCmp('year_manufactured').hide();
	Ext.getCmp('chasis_number').hide(); 
	Ext.getCmp('engine_number').hide();
	Ext.getCmp('make').hide();
	Ext.getCmp('registration_number').hide();
	}
	}}
	},{
            xtype: 'textfield',
			msgTarget : 'side',
			margin: '0 5 5 0',
			anchor:'100%',
            name: 'registration_number',
			id: 'registration_number',
			value:'',
                fieldLabel:'Registration #',
            allowBlank: false,
            minLength: 1
			
			
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
			margin: '0 5 5 0',
			anchor:'75%',
            name: 'make',
			 id: 'make',
			value:'',
            fieldLabel:'make'
			
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
			margin: '0 5 5 0',
			anchor:'100%',
            name: 'chasis_number',
			id: 'chasis_number',
			value:'',
            fieldLabel:'Chasis Number'
			
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
			margin: '0 5 5 0',
			anchor:'100%',
            name: 'engine_number',
			id: 'engine_number',
			value:'',
            fieldLabel:'Engine Number'
			
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
			margin: '0 5 5 0',
			anchor:'75%',
            name: 'year_manufactured',
			id: 'year_manufactured',
			value:'',
            fieldLabel:'Year'
        
		},{
            xtype: 'textarea',
			
            fieldLabel:'Description',
			labelAlign:'top',
            name: 'description',
			id: 'description',
            anchor: '100%'
        }
		]},///////////////
		{xtype:'fieldset',
		   title:'Insurance Class',
		   collapsible:true,
		   id:'policyitem',
		   items:[{
    xtype: 'combobox',
	name:'policyscope_id',
	id:'policyscope_id',
	forceSelection:true,
    fieldLabel: 'Scope',
	anchor:'75%',
    store: insurance_policyscopedata,
	margin: '0 5 5 0',
    queryMode: 'remote',
    displayField: 'policyscope_name',
    valueField: 'policyscope_id',
	listeners: { select: function(combo, record, index ) { 
	//var secelVallid = Ext.getCmp('liperson_id').getValue();
	//createFillLandlordDetails(secelVallid,tenantid);
	}}
	},{
            xtype: 'datefield',
			msgTarget : 'side',
			margin: '0 5 5 0',
			anchor:'75%',
            name: 'period_from',
			 id: 'period_from',
			value:'',
            fieldLabel:'Period From',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
			anchor:'75%',
			msgTarget : 'side',
			margin: '0 5 5 0',
            name: 'period_to',
			id: 'period_to',
			
			value:'',
            fieldLabel: 'Period To ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			msgTarget : 'side',
			margin: '0 5 5 0',
            name: 'amount_insured',
			id: 'amount_insured',
			value:'',
			anchor:'75%',
            fieldLabel: 'Value',
			allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			msgTarget : 'side',
			margin: '0 5 5 0',
			anchor:'75%',
            name: 'basic_premium',
			id: 'basic_premium',
			
			value:'',
            fieldLabel: 'Premium',
		
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			msgTarget : 'side',
			margin: '0 5 5 0',
            name: 'commission',
			id: 'commission',
			value:'',
            fieldLabel:'Commission',
			allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'button',
			alignButton:'center',
			margin: '5 5 5 5',
			text:'Save Class',
			handler:function(){
			var insuranceclass=Ext.getCmp('insuranceclass_id').getValue();
			var descriptionval=Ext.getCmp('description').getValue();
			
			var	policyscope_id=Ext.getCmp('policyscope_id').getValue();			
			var	period_from=Ext.getCmp('period_from').getValue();			
			var	period_to=Ext.getCmp('period_to').getValue();						
			var	basic_premium=Ext.getCmp('basic_premium').getValue();			
			var	commission=Ext.getCmp('commission').getValue();			
			var	amount_insured=Ext.getCmp('amount_insured').getValue();	
			
			//debit variables
			var	policy_number=Ext.getCmp('policy_number').getValue();
			var	underwriter_id=Ext.getCmp('underwriter_id').getValue();
			var	person_id=Ext.getCmp('person_id').getValue();
			var	other_details=Ext.getCmp('other_details').getValue();
			var	currency_id=Ext.getCmp('currency_id').getValue();
			var	pcf=Ext.getCmp('pcf').getValue();
			var	training_levy=Ext.getCmp('training_levy').getValue();
			var	stamp_duty=Ext.getCmp('stamp_duty').getValue();
			var	wtax=Ext.getCmp('wtax').getValue();

			if(insuranceclass==1){
			var registrationnumber=Ext.getCmp('registration_number').getValue();
			var year_manufactured=Ext.getCmp('year_manufactured').getValue();
			var chasis_number=Ext.getCmp('chasis_number').getValue();
			var make=Ext.getCmp('make').getValue();
			var engine_number=Ext.getCmp('engine_number').getValue();
			
			Ext.Ajax.request({
								   url: 'bodysave.php',
								   waitMsg: 'saving changes...',
								   //success: function(resp) {eval(resp.responseText);},
								   params:{t:'insurance_motorisk',
								   tttact:'Save',
								   insurancedebitnote_id:dbnoteid,
								   registration_number:registrationnumber,
								   year_manufactured:year_manufactured,
								   chasis_number:chasis_number,
								   make:make,
								   engine_number:engine_number,
								   description:descriptionval},
								   failure: function(action){
									// you could put an error message here
									}
								   });
								   
						
			}
			
			
			//now update insurance debit note
			Ext.Ajax.request({
								   url: 'bodysave.php',
								   
                                   params:{t:'insurance_insurancedebitnote',
								   insurancedebitnote_id:dbnoteid,
								   insurancedebitnote_name:personcode,
								    policy_number:policy_number,
									underwriter_id:underwriter_id,
									person_id:person_id,
									other_details:other_details,
									currency_id:currency_id,
									pcf:pcf,
									training_levy:training_levy,
									stamp_duty:stamp_duty,
									wtax:wtax
									},
									failure: function(action){
									// you could put an error message here
									}
								   });
			
							Ext.Ajax.request({
								   url: 'bodysave.php',
								   success: function(resp) {eval(resp.responseText);},
                                   params:{t:'insurance_insurancedebitnoteitems',
								   tttact:'Save',
								   insurancedebitnote_id:dbnoteid,
								   insuranceclass_id:insuranceclass,
								   description:descriptionval,
								    policyscope_id:policyscope_id,
									period_from:period_from,
									period_to:period_to,
							        basic_premium:basic_premium,
									commission:commission,
									amount_insured:amount_insured
									},
									failure: function(action){
									// you could put an error message here
									}
								   });	   
		    
			
								   
			
			}
			},]}
        ]
    });
//hide unencessary fields
    Ext.getCmp('year_manufactured').hide();
	Ext.getCmp('chasis_number').hide();
	Ext.getCmp('make').hide();
	Ext.getCmp('engine_number').hide();
	Ext.getCmp('registration_number').hide();

	Ext.getCmp('policyfinance_id').hide();
	Ext.getCmp('dnbank').hide();
	Ext.getCmp('check_number').hide();
	Ext.getCmp('dnamount').hide();
	Ext.getCmp('check_date').hide();
    Ext.getCmp('chnaration').hide();
    Ext.getCmp('check_details').hide();
  //Simple 'border layout' panel to house both grids
    var displayPanel = Ext.create('Ext.Panel', {
        width    : 1100,
        height   : 550,
		autoScroll:true,
        layout   : 'border',
        renderTo : 'panel',
        bodyPadding: '5',
        items    : [
            formPanel,
            formPanel2,
			formPanel3
        ],
        bbar    : [
			
            '->', // Fill
            {
                text    : 'Reset Example',
                handler : function() {
                    //refresh source grid
                    gridStore.loadData(myData);
                    formPanel.getForm().reset();
                }
            }
        ]
    });

var win = Ext.create('Ext.window.Window', {
        title: 'Insurance Policy Information',
        width: 1100,
		bodyPadding:10,
		iconCls: 'icon-grid',
		autoScroll:true,
		maximizable :true,
		collapsible :true,
        maximized:true,
		id:'dbnotecustomization',
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
				Ext.getCmp('dbnotecustomization').close();
				}
            }]
        }],*/
        buttonAlign:'center',
        buttons: [{
            text: 'Close',
			handler:function(){
				Ext.getCmp('dbnotecustomization').close();
				}
			
        }]
    });

    win.show();

});
}
insurance_insurancedebitnoteFormRevised('Kwatuha Alfayo','IN20012','admin_person',51,2);
";

?>