function changePayment(account){
	var displayhere,loadtype,rid;
var obj=document.getElementById(displayhere);

var objchild=document.getElementById('dynamicchild');

objchild.innerHTML='';

obj.innerHTML='';



Ext.define('cmbAccounts_accaccount', {
    extend: 'Ext.data.Model',
	fields:['accaccount_id','accaccount_name']
	});

var accounts_accaccountdata = Ext.create('Ext.data.Store', {
    model: 'cmbAccounts_accaccount',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=accounts_accaccount',
        reader: {
            type: 'json'
        }
    }
});

accounts_accaccountdata.load();


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
									createFormGrid('Save','NOID','housing_reviserent','g')
									}
                }],
		resizable:true,
		closable:true,
		  frame: true,
		url:'bodysave.php',
        width: 550,
		
	
		autoScroll:true,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: ' housing reviserent',

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
			 value:'housing_reviserent'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },
   {
    xtype: 'combobox',
	name:'accaccount_id',
	forceSelection:true,
    fieldLabel: 'Accaccount Id ',
    store: accounts_accaccountdata,
    queryMode: 'remote',
    displayField: 'accaccount_name',
    valueField: 'accaccount_id'
	},
   {
    xtype: 'combobox',
	name:'rentperiod_id',
	forceSelection:true,
    fieldLabel: 'Rentperiod Id ',
    store: housing_rentperioddata,
    queryMode: 'remote',
    displayField: 'rentperiod_name',
    valueField: 'rentperiod_id'
	},{
            xtype: 'numberfield',
			msgTarget : 'side',
            name: 'amount',
			
			value:'',
            fieldLabel: 'Amount ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			msgTarget : 'side',
            name: 'rent_due',
			
			value:'',
            fieldLabel: 'Rent Due ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
			msgTarget : 'side',
            name: 'start_date',
			
			value:'',
            fieldLabel: 'Start Date ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			msgTarget : 'side',
            name: 'preferred',
			
			value:'',
            fieldLabel: 'Preferred ',
            allowBlank: false,
            minLength: 1
        
		},{xtype:'fieldset',
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
												name: 'preferred',
												width:400,
												fieldLabel: 'Preferred  '+ fieldnamed/*,
												allowBlank: false,
												minLength: 1*/
											
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
                    waitMsg: 'saving changes...',
                    success: function(fp, o) {
                       // Ext.Msg.alert('Success', '' + o.result.savemsg + '"');
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
loadhousing_reviserentinfo(formPanel,rid);
}




    var win = Ext.create('Ext.window.Window', {
        title: 'Select Tenant Landlord',
        width: 600,
        height:400,
        minWidth: 300,
		bodyPadding:10,
        minHeight: 200,
        layout: 'fit',
		id:'frmselectlandlord',
        plain: true,
        items: formPanel,

        buttons: [{
            text: 'Create Contract',
			handler:function(){
			
			}
        },{
            text: 'Cancel'
			
        }]
    });

    win.show();
});
}