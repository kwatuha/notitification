function housing_housingtenantFormRevised(displayhere,loadtype,rid,tname,tpid,tcode,lnameid, lname, llcode, owner){
//housing_housingtenantFormRevised('detailinfo','Save','NOID',tenantfullname,tpid,personname,lnameid,lname,lunilid,tenantid);
/*alert('housing_housingtenant');*/
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
					        housingrpts();
									//createFormGrid('Save','NOID','housing_housingtenant','g')
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
        title: ' housing housingtenant',

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
			 value:owner
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },{
            xtype: 'hidden',
			msgTarget : 'side',
            name: 'housinglandlordgrp_name',
            fieldLabel: 'Housingtenant Name ',
			value:tcode,
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'hidden',
			msgTarget : 'side',
            name: 'housingtenant_name',
            fieldLabel: 'Housingtenant Name ',
			value:tcode,
            allowBlank: false,
            minLength: 1
        
		},
		
		//tname,tpid,tcode
   {
    xtype: 'textfield',
	name:'tenanatnid',
    fieldLabel: 'Tenant ',
    value:tname
	},
	
   
	{
    xtype: 'hidden',
	fieldLabel:'owener',
	name:'syowner',
	value:owner
	},
	{
    xtype: 'hidden',
	fieldLabel:'TPID',
	name:'person_id',
	value:tpid
	},
	{
    xtype: 'hidden',
	fieldLabel:'TPID',
	name:'persongroup_id',
	value:tpid 
	},
	 {
    xtype: 'hidden',
	name:'housinglandlord_id',
	fieldLabel: 'LLID',
	value:llcode
	},{
    xtype: 'textfield',
	fieldLabel: 'LandLord',
	name:'housinglandlord_name',
	value:lname
	},
		{xtype: 'fieldcontainer',
                //fieldLabel:'Currency',
				fieldLabel: 'Contract Day',
                //combineErrors: true,
				
                msgTarget : 'side',
                layout: 'hbox',
				items:[{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'contract_day',
			margin:'0 5 0 0',
			
			value:'',
            fieldLabel: false,
            allowBlank: false,
            minLength: 1
        
		},
   {
    xtype: 'combobox',
	name:'month_id',
	id:'tmonth_id',
	margin:'0 5 0 0',
	forceSelection:true,
    fieldLabel: 'Month ',
	labelWidth:50,
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
        
		},{
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'property_description',
			
			value:'',
            fieldLabel: 'Property Description ',
            allowBlank: false,
            minLength: 1
        
		},{xtype: 'fieldcontainer',
                //fieldLabel:'Currency',
				fieldLabel: 'Rent ',
                
                msgTarget : 'side',
                layout: 'hbox',
				items:[{
            xtype: 'numberfield',
			margin:'0 5 0 0',
			msgTarget : 'side',
            name: 'rent',
			
			value:'',
            fieldLabel: false,
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			msgTarget : 'side',
            name: 'electricity_water',
			labelWidth:120,
			value:'',
            fieldLabel: 'Electricity & Water ',
            allowBlank: false,
			margin:'0 5 0 0',
            minLength: 1
        
		},
		
   {
    xtype: 'combobox',
	name:'rentperiod_id',
	id:'trentperiod_id',
	forceSelection:true,
    fieldLabel: 'Frequency',
    store: housing_rentperioddata,
	margin:'0 5 0 0',
	labelWidth:60,
    queryMode: 'remote',
    displayField: 'rentperiod_name',
    valueField: 'rentperiod_id'
	}]},{
            xtype: 'numberfield',
			msgTarget : 'side',
            name: 'deposit',
			value:'',
            fieldLabel: 'Deposit',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'deposit_description',
			
			value:'',
            fieldLabel: 'Deposit Description ',
            allowBlank: false,
            minLength: 1
        
		},{xtype: 'fieldcontainer',
                //fieldLabel:'Currency',
				fieldLabel: 'Tenancy Period',
                
                msgTarget : 'side',
                layout: 'hbox',
				items:[{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'tenancy_period',
			margin:'0 5 0 0',
			value:'',
            fieldLabel:false,
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			msgTarget : 'side',
            name: 'period_months',
			margin:'0 5 0 0',
			value:'',
			//labelWidth:50,
            fieldLabel: 'Period in Months',
            allowBlank: false,
            minLength: 1
        
		}]},{xtype: 'fieldcontainer',
                //fieldLabel:'Currency',
				fieldLabel: 'Period Start',
                
                msgTarget : 'side',
                layout: 'hbox',
				items:[{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'period_starts',
			margin:'0 5 0 0',
			value:'',
			labelWidth:50,
            fieldLabel:false,
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
			msgTarget : 'side',
            name: 'period_startdate',
			margin:'0 5 0 0',
			value:'',
            fieldLabel: 'Start Date ',
            allowBlank: false,
            minLength: 1
        
		}]},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'contract_dated',
			
			value:'',
            fieldLabel: 'Contract Dated ',
            allowBlank: false,
            minLength: 1
        
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
												name: 'contract_dated',
												width:400,
												fieldLabel: 'Contract Dated  '+ fieldnamed,
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
			var formerror='';
			var errorid;  
			var selMonth = Ext.getCmp('tmonth_id').getValue();
			var selPeriod = Ext.getCmp('trentperiod_id').getValue();
			formerror='has errors';
			if((selMonth>=1)&&(selPeriod>=1)){
			formerror='';	
			}
			if(!selMonth>=1){
			errorid="Please Select Month";
			}
			if(!selPeriod>=1){
			errorid="Please Select Frequency";
			}
			if(formerror==''){
					if(form.isValid()){
						form.submit({
							url: 'bodysave.php',
							success: function(resp) {eval(resp.responseText);}
							/*waitMsg: 'saving changes...',
							success: function(fp, o) {
							   // Ext.Msg.alert('Success', '' + o.result.savemsg + '"');
							   eval(o.result.savemsg);
							}*/
						});
					}
			}
			else{
				showerror(errorid);
			}
        }
    }
	
		]
        }]
    });
	
	
if(loadtype=='updateload'){
loadhousing_housingtenantinfo(formPanel,rid);
}

});



}/*launchForm()*/
