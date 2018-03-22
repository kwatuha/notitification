<?php

echo "function insurance_insurancedebitnoteFormRevised(fullname,personcode,iowner,pid,fillcode){
/*alert('insurance_insurancedebitnote');*/
//('.\"'$lfullname','$persontyname','admin_person',$personid\".')
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


Ext.onReady(function() {

///////////////
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
        renderTo: displayhere,
		tbar:[{
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
									createFormGrid('Save','NOID','insurance_insurancedebitnote','g')
									}
                }],
		resizable:true,
		closable:true,
		  frame: true,
		url:'bodysave.php',
        width: 800,
		
	
		autoScroll:true,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: ' insurance insurancedebitnote',

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
			 {xtype:'fieldset',
		   title:'Insured',
		   collapsible:true,
		   id:'insureddetails',
		   items:[
			 {
			 bodyPadding: '5 5 5 5',
			 anchor:'50%',
			html:'<h2>Ref : '+personcode+'</br>  Insured : '+fullname+'</h2>'
           }]},
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
			name: 'syowner',
			value:iowner
        
		},{
            xtype: 'hidden',
            name: 'person_id',
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
	anchor:'75%',
	margin: '0 5 0 0',
    store: insurance_underwriterdata,
    queryMode: 'remote',
    displayField: 'underwriter_name',
    valueField: 'underwriter_id',
	listeners: { select: function(combo, record, index ) { 
	//var secelVallid = Ext.getCmp('liperson_id').getValue();
	//createFillLandlordDetails(secelVallid,tenantid);
	}}
	},{
    xtype: 'combobox',
	name:'policyscope_id',
	id:'policyscope_id',
	forceSelection:true,
    fieldLabel: 'Scope',
	labelWidth:50,
	anchor:'75%',
    store: insurance_policyscopedata,
	margin: '0 5 0 0',
    queryMode: 'remote',
    displayField: 'policyscope_name',
    valueField: 'policyscope_id',
	listeners: { select: function(combo, record, index ) { 
	//var secelVallid = Ext.getCmp('liperson_id').getValue();
	//createFillLandlordDetails(secelVallid,tenantid);
	}}
	},{
            xtype: 'numberfield',
			msgTarget : 'side',
			margin: '0 5 0 0',
            name: 'policy_value',
			
			value:'',
            fieldLabel: 'Value',
			labelWidth:50,
            allowBlank: false,
            minLength: 1
        
		}]},{xtype:'fieldset',
		   title:'Insurance Class',
		   collapsible:true,
		   id:'policyitem',
		   items:[
				  {
    xtype: 'combobox',
	name:'insuranceclass_id',
	forceSelection:true,
    fieldLabel: 'Class ',
	anchor:'75%',
    store: insurance_insuranceclassdata,
    queryMode: 'remote',
    displayField: 'insuranceclass_name',
    valueField: 'insuranceclass_id',
	allowBlank: false
	},{
            xtype: 'textareafield',
			msgTarget : 'side',
			anchor:'75%',
            name: 'description',
			
			value:'',
            fieldLabel: 'Description ',
            allowBlank: false,
        
            minLength: 1
        
		},{
            xtype: 'button',
			margin: '5 5 5 5',
			text:'Add New',
			handler: function() {
			
								var container = this.up('fieldset');
								var itemnum=0;
								var config = Ext.apply({}, container.initialConfig.items[1]);
								config.fieldName = container.items.length + 1;
								var fieldnamed=container.items.length + 1;
								itemnum=fieldnamed-3;
								 Ext.getCmp('numberofitems').setValue(itemnum);
								
								
										container.add(
   {
    xtype: 'combobox',
	name:'insuranceclass_id'+itemnum,
	forceSelection:true,
    fieldLabel: 'Class ',
	anchor:'75%',
    store: insurance_insuranceclassdata,
    queryMode: 'remote',
    displayField: 'insuranceclass_name',
    valueField: 'insuranceclass_id'
	},{
            xtype: 'textareafield',
			msgTarget : 'side',
			anchor:'75%',
            name: 'description'+itemnum,
			
			value:'',
            fieldLabel: 'Description ',
            
            minLength: 1
        
		});
										
								}}
		]},{xtype:'fieldset',
		   title:'Policy Details',
		   collapsible:true,
		   id:'policydetails',
		   items:[{xtype: 'fieldcontainer',
                fieldLabel:'Period From',
				combineErrors: true,
				msgTarget : 'side',
                layout: 'hbox',
				items:[{
            xtype: 'datefield',
			msgTarget : 'side',
			margin: '0 5 0 0',
            name: 'period_from',
			
			value:'',
            fieldLabel:false,
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
			msgTarget : 'side',
			margin: '0 5 0 0',
            name: 'period_to',
			
			value:'',
            fieldLabel: 'Period To ',
            allowBlank: false,
            minLength: 1
        
		}]},{
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'risk_covered_naration',
			anchor:'100%',
			value:'',
            fieldLabel: 'Risk Covered Naration ',
            allowBlank: false,
            minLength: 1
        
		},
   {xtype: 'fieldcontainer',
                fieldLabel:'Currency',
				combineErrors: true,
				msgTarget : 'side',
                layout: 'hbox',
				items:[{
    xtype: 'combobox',
	name:'currency_id',
	margin: '0 5 0 0',
	forceSelection:true,
    fieldLabel: false,
    store: payment_currencydata,
    queryMode: 'remote',
    displayField: 'currency_name',
    valueField: 'currency_id'
	},{
            xtype: 'numberfield',
			msgTarget : 'side',
			margin: '0 5 0 0',
            name: 'amount_insured',
			
			value:'',
            fieldLabel: 'Premium',
			labelWidth:50,
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			margin: '0 5 0 0',
			msgTarget : 'side',
            name: 'pcf',
			labelWidth:30,
			width:110,
			value:'0.2',
            fieldLabel: 'P.C.F',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			margin: '0 5 0 0',
			msgTarget : 'side',
			width:150,
			labelWidth:80,
            name: 'sdtl',
			
			value:'0.25',
            fieldLabel: 'S.D & T.L',
            allowBlank: false,
            minLength: 1
        
		}]}]},{xtype:'fieldset',
		   title:'Add Attachments',
		   collapsible:true,
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
												width:400,
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
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for=><li><span class=\"field-name\">{name}</span>: <span class=\"error\">{error}</span></li></tpl></ul>'),

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
    });
	
	
if(loadtype=='updateload'){
loadinsurance_insurancedebitnoteinfo(formPanel,rid);
}

});



}/*launchForm()*/
insurance_insurancedebitnoteFormRevised('Kwatuha Alfayo','IN20012','admin_person',51,'fillcode');
";?>