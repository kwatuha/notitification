function TestMy(displayhere){


Ext.define('cmbPayment_branch', {
    extend: 'Ext.data.Model',
	fields:['branch_id','branch_name']
	});

var payment_branchdata = Ext.create('Ext.data.Store', {
    model: 'cmbPayment_branch',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=payment_branch',
        reader: {
            type: 'json'
        }
    }
});

payment_branchdata.load();


Ext.define('cmbPayment_bank', {
    extend: 'Ext.data.Model',
	fields:['bank_id','bank_name']
	});

var payment_bankdata = Ext.create('Ext.data.Store', {
    model: 'cmbPayment_bank',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=payment_bank',
        reader: {
            type: 'json'
        }
    }
});

payment_bankdata.load();

var obj=document.getElementById(displayhere);
obj.innerHTML='';



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
									createFormGrid('Save','NOID','housing_lease','g')
									}
                }],
		resizable:true,
        frame: true,
		url:'bodysave.php',
        width: 600,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: 'House Allowance Form',

        defaults: {
            anchor: '100%'
        },
        fieldDefaults: {
            labelAlign: 'left',
            msgTarget: 'none'
			/*,
            invalidCls: '' 
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
		
		{
						xtype: 'fieldset',
						title: 'Introductions',
						width:600,
						iconCls:'usergroup',
						items: [{
            xtype: 'textfield',
            name: 'insurer_name',
            fieldLabel: 'Insurer Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'AccountNumber',
            fieldLabel: 'AccountNumber ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'PostalAddress',
            fieldLabel: 'PostalAddress ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'PostalCode',
            fieldLabel: 'PostalCode ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'PhysicalAddress',
            fieldLabel: 'PhysicalAddress ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'Town',
            fieldLabel: 'Town ',
            allowBlank: false,
            minLength: 1
        
		},
   {
    xtype: 'combobox',
	name:'branch_id',
	forceSelection:true,
    fieldLabel: 'Branch Id ',
    store: payment_branchdata,
    queryMode: 'local',
    displayField: 'branch_name',
    valueField: 'branch_id'
	},
   {
    xtype: 'combobox',
	name:'bank_id',
	forceSelection:true,
    fieldLabel: 'Bank Id ',
    store: payment_bankdata,
    queryMode: 'local',
    displayField: 'bank_name',
    valueField: 'bank_id'
	}]},
	
	//new
	
					{xtype: 'tabpanel',
						title:false,
						width:600,
						iconCls:'usergroup',
						activeTab: 0,
						defaults:{
							bodyStyle:'padding:10px'
						},
						items:[
							   {
						title:'Tenanat',
						items: [{
									xtype: 'combobox',
									name:'bank_id',
									forceSelection:true,
									fieldLabel: 'Bank Id ',
									store: payment_bankdata,
									queryMode: 'local',
									displayField: 'bank_name',
									valueField: 'bank_id'
								}]},
						{
						title:'Lease',
						items: [{
								xtype: 'combobox',
								name:'bank_id',
								forceSelection:true,
								fieldLabel: 'Bank Id ',
								store: payment_bankdata,
								queryMode: 'local',
								displayField: 'bank_name',
								valueField: 'bank_id'
						}]} ]}
	
	
	///end of new
	
	],//last
	
	
	
	
	
	 dockedItems: [{
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
                        Ext.Msg.alert('Success', '' + o.result.savemsg + '"');
                    }
                });
            }
        }
    }
	
		]
        }]
    });
	
	
if(loadtype=='updateload'){
loadhousing_leaseinfo(formPanel,rid);
}

});



}/*launchForm()*/
