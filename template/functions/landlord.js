function housing_housinglandlordFormRevised(displayhere,loadtype,rid,pid,lndlname,lfullname,sendby){
	
/*alert('housing_housinglandlord');*/
var obj=document.getElementById(displayhere);

var objchild=document.getElementById('dynamicchild');

objchild.innerHTML='';

obj.innerHTML='';





Ext.define('cmbAdmin_month', {
    extend: 'Ext.data.Model',
	fields:['month_id','month_name']
	});

var admin_monthdata = Ext.create('Ext.data.Store', {
    model: 'cmbAdmin_month',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_month',
        reader: {
            type: 'json'
        }
    }
});

admin_monthdata.load();


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


Ext.onReady(function() {
Ext.tip.QuickTipManager.init();
        var formPanel = Ext.widget('form', {
        renderTo: displayhere,
		tbar:[{
                    text:'Add new',
                    tooltip:'Add a new row',
                    iconCls:'add',
					handler:function(){
					registerperson();	
					}
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
						      housingrpls();
									//createFormGrid('Save','NOID','housing_housinglandlord','g')
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
        title: ' housing housinglandlord',

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
			 value:sendby
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },{
            xtype: 'hidden',
			
            name: 'housinglandlord_name',
			value:lndlname,
            
        
		},
		{
            xtype: 'hidden',
			
            name: 'housinglandlordgrp_name',
			value:lndlname,
            
        
		},
		{
    xtype: 'hidden',
	name:'syowner',
	value:sendby
	},
   {
    xtype: 'hidden',
	name:'person_id',
	value:pid
	},{
    xtype: 'hidden',
	name:'persongroup_id',
	value:pid
	},{
    xtype: 'textfield',
	readOnly:true,
	name:'person_fullname',
	fieldLabel: 'Landlord Name',
	value:lfullname
	},{xtype: 'fieldcontainer',
                fieldLabel:false,
				combineErrors: true,
				msgTarget : 'side',
                layout: 'hbox',
				items:[{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'contract_day',
			margin: '0 5 0 0',
			value:'',
            fieldLabel: 'Contract Day ',
            allowBlank: false,
            minLength: 1
        
		},
   {
    xtype: 'combobox',
	margin: '0 5 0 0',
	name:'month_id',
	forceSelection:true,
    fieldLabel: 'Month Id ',
    store: admin_monthdata,
    queryMode: 'remote',
    displayField: 'month_name',
    valueField: 'month_id'
	}]},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'contract_year',
			
			value:'',
            fieldLabel: 'Contract Year ',
            allowBlank: false,
            minLength: 1
        
		},{xtype: 'fieldcontainer',
                fieldLabel:false,
				combineErrors: true,
				msgTarget : 'side',
                layout: 'hbox',
				items:[{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'term_period',
			
			value:'',
            fieldLabel: 'Term Period ',
			margin: '0 5 0 0',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			msgTarget : 'side',
            name: 'term_months',
			margin: '0 5 0 0',
			value:'',
            fieldLabel: 'Term Months ',
			allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			msgTarget : 'side',
			margin: '0 5 0 0',
            name: 'commission',
			value:'10',
            fieldLabel: 'Commission ',
            allowBlank: false,
            minLength: 1
        
		}]},{xtype: 'fieldcontainer',
                fieldLabel:false,
				combineErrors: true,
				msgTarget : 'side',
                layout: 'hbox',
				items:[{
            xtype: 'numberfield',
			msgTarget : 'side',
            name: 'commission_alternative',
			margin: '0 5 0 0',
	        value:'',
            fieldLabel: 'Commission Alternative ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			margin: '0 5 0 0',
			msgTarget : 'side',
            name: 'excess_amount',
			
			value:'',
            fieldLabel: 'Excess Amount ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			margin: '0 5 0 0',
			msgTarget : 'side',
            name: 'payment_day',
			
			value:'15',
            fieldLabel: 'Payment Day ',
            allowBlank: false,
            minLength: 1
        
		}]},{
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'property',
			
			value:'',
            fieldLabel: 'Property ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'contract_dated',
			
			value:'',
            fieldLabel: 'Contract Dated ',
            allowBlank: false,
            minLength: 1
        
		},
   {
    xtype: 'combobox',
	name:'rentperiod_id',
	forceSelection:true,
    fieldLabel: 'Rentperiod Id ',
	value:1,
    store: housing_rentperioddata,
    queryMode: 'remote',
    displayField: 'rentperiod_name',
    valueField: 'rentperiod_id'
	}/*,{xtype:'fieldset',
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
												name: 'rentperiod_id',
												width:400,
												fieldLabel: 'Rentperiod Id  '+ fieldnamed,
												allowBlank: false,
												minLength: 1
											
											});
										
								}}
		]}*/], dockedItems: [{
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
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for=><li><span class="field-name">{name}</span>: <span class="error">{error}</span></li></tpl></ul>'),

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
                    success: function(resp) {eval(resp.responseText);
					form.reset();
					}
                    /*success: function(fp, o) {
                       // Ext.Msg.alert('Success', '' + o.result.savemsg + '"');
					   eval(o.result.savemsg);
                    }*/
                });
            }
        }
    }
	
		]
        }]
    });
	
	
if(loadtype=='updateload'){
loadhousing_housinglandlordinfo(formPanel,rid);
}

});



}/*launchForm()*/
