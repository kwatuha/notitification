function accounts_accountactivityFormRevised(){
var displayhere='detailinfo';
var loadtype='Save';
var rid='NOID';
/*alert('accounts_accountactivity');*/
var obj=document.getElementById(displayhere);

var objchild=document.getElementById('dynamicchild');

objchild.innerHTML='';

obj.innerHTML='';


Ext.onReady(function() {
					 
Ext.define('cmbAccounts_accountscategory', {
    extend: 'Ext.data.Model',
	fields:['accountscategory_id','accountscategory_name']
	});
var accounts_accountscategorydata = Ext.create('Ext.data.Store', {
    model: 'cmbAccounts_accountscategory',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=accounts_accountscategory',
        reader: {
            type: 'json'
        }
    }
});

accounts_accountscategorydata.load();
Ext.define('cmbDesigner_systemclass', {
    extend: 'Ext.data.Model',
	fields:['systemclass_id','systemclass_name']
	});
var designer_systemclassdata = Ext.create('Ext.data.Store', {
    model: 'cmbDesigner_systemclass',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=designer_systemclass',
        reader: {
            type: 'json'
        }
    }
});
designer_systemclassdata.load();

Ext.define('cmbcnaccounts_accountscategorydata', {
    extend: 'Ext.data.Model',
	fields:['accountscategory_id','accountscategory_name']
	});
var cnaccounts_accountscategorydata = Ext.create('Ext.data.Store', {
    model: 'cmbcnaccounts_accountscategorydata',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=accounts_accountscategory&cnactivity=12',
        reader: {
            type: 'json'
        }
    }
});

cnaccounts_accountscategorydata.load();
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


Ext.define('cmbBank_bankaccount', {
    extend: 'Ext.data.Model',
	fields:['bankaccount_id','bankaccount_name']
	});
var bank_bankaccountdata = Ext.create('Ext.data.Store', {
    model: 'cmbBank_bankaccount',
    proxy: {
        type: 'ajax',
		loadMask:false,
        url : 'cmb.php?tbp=bank_bankaccount',
        reader: {
            type: 'json'
        }
    }
});
bank_bankaccountdata.load();
//
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
									createFormGrid('Save','NOID','accounts_accountactivity','g')
									}
                },
				/////////////////////
				'-',
				
				{
    xtype: 'combobox',
	margin:'0 5 0 0',
	name:'systemclass_id',
	forceSelection:true,
    fieldLabel: 'Account Type',
	labelWidth:80,
	anchor:'60%',
    store: designer_systemclassdata,
    queryMode: 'remote',
    displayField: 'systemclass_name',
    valueField: 'systemclass_id'
	}
	],
		resizable:true,
		closable:true,
		  frame: true,
		url:'bodysave.php',
        width: 700,
		
	
		autoScroll:true,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: ' accounts accountactivity',

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
				
				///////////////////////////////////////////////////
				Ext.override(Ext.form.ComboBox, {
    validateValue: function(value){
        if(!Ext.form.ComboBox.superclass.validateValue.call(this, value)){
            return false;
        }
        if(this.forceSelection){
            var i = (this.store.findBy(function(record){
                return this.displayField 
                    ? record.get(this.displayField) === value
                                    : record.get(this.valueField) === value;
            }, this));
            return i > -1;
        }
        return true;
    }
});  
				////////////////////////////////////////////////////////
                errorCmp.setErrors(errors);
                me.hasBeenDirty = true;
            }
        },

        items: [
		
		{xtype:'hidden',
             name:'t',
			 value:'accounts_accountactivity'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },
	{xtype:'fieldset',
		   title:'Main Ledger',
		   collapsible:true,
		   items:[
   {xtype: 'fieldcontainer',
                fieldLabel:'Ledger',
				
                combineErrors: true,
				
                msgTarget : 'side',
                layout: 'hbox',
				items:[{
    xtype: 'combobox',
	margin:'0 5 0 0',
	name:'accountscategory_id',
	forceSelection:true,
    fieldLabel: false,
	anchor:'60%',
    store: accounts_accountscategorydata,
    queryMode: 'remote',
    displayField: 'accountscategory_name',
    valueField: 'accountscategory_id'
	},
	
   {
    xtype: 'combobox',
	
	name:'accaccount_id',
	forceSelection:true,
    fieldLabel: 'Account',
	labelWidth:50,
    store: accounts_accaccountdata,
    queryMode: 'remote',
    displayField: 'accaccount_name',
    valueField: 'accaccount_id'
	}]},
   {xtype: 'fieldcontainer',
                fieldLabel:'Posting',
				
               //combineErrors: true,
				allowBlank: false,
                msgTarget : 'side',
                layout: 'hbox',
				items:[{
            xtype: 'radiofield',
			margin:'0 5 0 0',
			msgTarget : 'side',
            name: 'transaction_type',
			
			boxLabel: 'Credit',
			inputValue:'Credit',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'radiofield',
			msgTarget : 'side',
            name: 'transaction_type',
			inputValue:'Debit',
			boxLabel: 'Debit',
            allowBlank: false,
            minLength: 1
        
		}]},{xtype: 'fieldcontainer',
                fieldLabel:'Currency',
				
                //combineErrors: true,
				
                msgTarget : 'side',
                layout: 'hbox',
				items:[{
     
    xtype: 'combobox',
	name:'currency_id',
	margin:'0 5 0 0',
	forceSelection:true,
    fieldLabel:false,
    store: payment_currencydata,
    queryMode: 'remote',
	labelWidth:50,
    displayField: 'currency_name',
    valueField: 'currency_id'
	},{
            xtype: 'numberfield',
			msgTarget : 'side',
            name: 'amount',
			fieldLabel: 'Amount',
			labelWidth:50,
            allowBlank: false,
            minLength: 1
        
		}]},{xtype: 'fieldcontainer',
                //fieldLabel:'Currency',
				fieldLabel: 'Transaction ID ',
                //combineErrors: true,
				
                msgTarget : 'side',
                layout: 'hbox',
				items:[{
            xtype: 'textfield',
			msgTarget : 'side',
			margin:'0 5 0 0',
            name: 'accountactivity_name',
			fieldLabel:false,
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
			msgTarget : 'side',
            name: 'transaction_date',
			labelWidth:50,
            fieldLabel: 'Date ',
            allowBlank: false,
            minLength: 1
        
		}]},{
            xtype: 'textareafield',
			msgTarget : 'side',
			anchor:'100%',
            name: 'naration',
			id: 'naration',
			
			value:'',
            fieldLabel: 'Naration ',
            allowBlank: false,
            minLength: 1
        
		}]},{xtype:'fieldset',
		   title:'Counter Ledger',
		   collapsible:true,
		   id:'mysuser',
		   items:[{
    xtype: 'combobox',
	//margin:'5 5 5 5',
	width:400,
	name:'countraccountscategory_id',
	id:'accountscategory_id',
	forceSelection:true,
    fieldLabel: 'Counter Ledger',
    store: cnaccounts_accountscategorydata,
    queryMode: 'remote',
    displayField: 'accountscategory_name',
    valueField: 'accountscategory_id',
	listeners: { select: function(combo, record, index ) { 
	//var secelVals = Ext.getCmp('naration').hide();
	var secelVal = Ext.getCmp('accountscategory_id').getValue();
	
	//show  bank details
	if((secelVal==18)||(secelVal==17)){
		Ext.getCmp('voucher_number').show();
	}else{
		Ext.getCmp('voucher_number').hide();
	}
	
	if(secelVal==18){
	Ext.getCmp('check_number').show();
	Ext.getCmp('bankaccount_id').show();
	Ext.getCmp('check_date').show();
	
	}else{
	 Ext.getCmp('bankaccount_id').hide();
	 Ext.getCmp('check_number').hide();
	 Ext.getCmp('check_date').hide();
	}
	
	//show  cash details
	/*if(secelVal==17){
	Ext.getCmp('check_date').hide();
	Ext.getCmp('check_number').hide();
		
	}else{
	Ext.getCmp('voucher_number').hide();
	//Ext.getCmp('voucchertype').hide();
		
	}*/
	
	
	
	/*fieldlist_visibledata.proxy.extraParams = { fieldsearchtbl:secelVal}; 
	fieldlist_visibledata.load();*/
	 }}
	},{
            xtype: 'textfield',
			margin:'5 5 5 5',
			msgTarget : 'side',
			anchor:'100%',
            name: 'voucher_number',
			id: 'voucher_number',
			
			value:'',
            fieldLabel: 'Voucher #',
			hidden:true,
            
            minLength: 1
        
		},{
            xtype: 'textfield',
			margin:'5 5 5 5',
			msgTarget : 'side',
			anchor:'100%',
            name: 'check_number',
			id: 'check_number',
			
			value:'',
            fieldLabel: 'Check #',
			hidden:true,
            
            minLength: 1
        
		},{
            xtype: 'datefield',
			margin:'5 5 5 5',
			msgTarget : 'side',
			anchor:'100%',
            name: 'check_date',
			id: 'check_date',
            fieldLabel: 'Check Date',
			hidden:true,
            
            minLength: 1
        
		}, {xtype: 'fieldcontainer',
                //fieldLabel:'Currency',
				id:'bankfields',
                msgTarget : 'side',
                layout: 'hbox',
				items:[{
			xtype: 'combobox',
			name:'bankaccount_id',
			id:'bankaccount_id',
			forceSelection:true,
			hidden:true,
			fieldLabel: 'Bank Account',
			store: bank_bankaccountdata,
			queryMode: 'remote',
			width:400,
			displayField: 'bankaccount_name',
			valueField: 'bankaccount_id'
	}]}]}], dockedItems: [{
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
loadaccounts_accountactivityinfo(formPanel,rid);
}

});



}/*launchForm()*/
