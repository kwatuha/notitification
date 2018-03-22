
function createTabbed9(){
var obj=document.getElementById('detailinfo');
obj.innerHTML='';
   loadtype='Save';
   //**************************************************************************************
  

Ext.define('cmbExpenses_expensecategory', {
    extend: 'Ext.data.Model',
	fields:['expensecategory_id','expensecategory_name']
	});

var expenses_expensecategorydata = Ext.create('Ext.data.Store', {
    model: 'cmbExpenses_expensecategory',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=expenses_expensecategory',
        reader: {
            type: 'json'
        }
    }
});

expenses_expensecategorydata.load();


Ext.define('cmbExpenses_expenseitem', {
    extend: 'Ext.data.Model',
	fields:['expenseitem_id','expenseitem_name']
	});

var expenses_expenseitemdata = Ext.create('Ext.data.Store', {
    model: 'cmbExpenses_expenseitem',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=expenses_expenseitem',
        reader: {
            type: 'json'
        }
    }
});

expenses_expenseitemdata.load();

  //*************************************************************************************
   
   admin_contactdata='kwasdasd';
   

Ext.define('cmbExpenses_expensecategory', {
    extend: 'Ext.data.Model',
	fields:['expensecategory_id','expensecategory_name']
	});

var expenses_expensecategorydata = Ext.create('Ext.data.Store', {
    model: 'cmbExpenses_expensecategory',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=expenses_expensecategory',
        reader: {
            type: 'json'
        }
    }
});

expenses_expensecategorydata.load();


Ext.define('cmbExpenses_expenseitem', {
    extend: 'Ext.data.Model',
	fields:['expenseitem_id','expenseitem_name']
	});

var expenses_expenseitemdata = Ext.create('Ext.data.Store', {
    model: 'cmbExpenses_expenseitem',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=expenses_expenseitem',
        reader: {
            type: 'json'
        }
    }
});

expenses_expenseitemdata.load();

   Ext.create('Ext.panel.Panel', {
    renderTo: 'detailinfo',
    width: 700,
	bodyPadding:10,
    title: 'Company Expenses',
    items: [
			     {
	layout:'column',
    items: [{
        title: false,
        columnWidth: .65,
		bodyPadding: 10,
		border:false,
		items:[{
						xtype: 'fieldset',
						title: 'Company Details',
						width:380,
						collapsible:true,
						iconCls:'usergroup',
						items: [{xtype:'hidden',
             name:'t',
			 value:'admin_company'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },{
            xtype: 'textfield',
			readOnly:true,value:'Zulmac Insurance Brokers Limited',
			
            name: 'company_name',
            fieldLabel: 'Company Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'PO0128023M',
			
            name: 'pin_number',
            fieldLabel: 'Pin Number ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'823823928',
			
            name: 'vat_number',
            fieldLabel: 'Vat Number ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
			readOnly:true,value:'0000-00-00',
			
            name: 'incorp_date',
            fieldLabel: 'Incorp Date ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'Shekandu Plaza - Ground Floor',
			
            name: 'building',
            fieldLabel: 'Building ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'Opposite Kholera House',
			
            name: 'location_description',
            fieldLabel: 'Location Description ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'Canon Awori Street/Perus Abura Lane',
			
            name: 'street',
            fieldLabel: 'Street ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'0722248508',
			
            name: 'mobile',
            fieldLabel: 'Mobile ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'056-30352/30373',
			
            name: 'tel',
            fieldLabel: 'Tel ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'056-30793',
			
            name: 'fax',
            fieldLabel: 'Fax ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'208',
			
            name: 'postal_address',
            fieldLabel: 'Postal Address ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'50100',
			
            name: 'postal_code',
            fieldLabel: 'Postal Code ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'Kakamega',
			
            name: 'town',
            fieldLabel: 'Town ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'info@zulmac.com',
			
            name: 'email_address2',
            fieldLabel: 'Email Address2 ',
			allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'zulmacinsurance@yahoo.com',
			
            name: 'email_address',
            fieldLabel: 'Email Address ',
			allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'www.zulmac.com',
			
            name: 'website',
            fieldLabel: 'Website ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			readOnly:true,value:'',
			
            name: 'comment',
            fieldLabel: 'Comment ',
            allowBlank: false,
            minLength: 1
        
		}]
		      }]
    },{
        title:'photo',
		margin: '10 5 5 5',
        columnWidth: 0.25,
		border:false,
		bodyPadding: 10,
		items:[/*{
            html: '<div id="personpicture">'
			+'</div>'
        },{
            xtype: 'button',
            name: 'addphoto',
            text: 'Add Photo',
            allowBlank: false,
            minLength: 1,
			handler:function(){
			
			}
        
		}*/]
    }]
			/////////////////////////////////////////////////
					},
				 //
				 {xtype:'tabpanel',
				 title:false,
				 bodyPadding: 10,
				 items:[
        {
        xtype: 'form',
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
									createFormGrid('Save','NOID','expenses_expensecategory','g')
									}
                }],
		resizable:true,
        frame: true,
		url:'bodysave.php',
        width: 550,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: ' expenses expensecategory',

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
			 value:'expenses_expensecategory'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },{
            xtype: 'textfield',
			
			
            name: 'expensecategory_name',
            fieldLabel: 'Expensecategory Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			
			
            name: 'description',
            fieldLabel: 'Description ',
            allowBlank: false,
            minLength: 1
        
		}],dockedItems: [{
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
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for=><li><span class="field-name">{name}</span>: '
				+ '<span class="error">{error}</span></li></tpl></ul>'),

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
   
						
						}
		
	,
        {
        xtype: 'form',
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
									createFormGrid('Save','NOID','expenses_expensebyitem','g')
									}
                }],
		resizable:true,
        frame: true,
		url:'bodysave.php',
        width: 550,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: ' expenses expensebyitem',

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
			 value:'expenses_expensebyitem'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },
   {
    xtype: 'combobox',
	name:'expensecategory_id',
	forceSelection:true,
	
    fieldLabel: 'Category',
    store: expenses_expensecategorydata,
	
    queryMode: 'remote',
    displayField: 'expensecategory_name',
    valueField: 'expensecategory_id'
	},
   {
    xtype: 'combobox',
	name:'expenseitem_id',
	forceSelection:true,
	
    fieldLabel: 'Item',
    store: expenses_expenseitemdata,
	
    queryMode: 'remote',
    displayField: 'expenseitem_name',
    valueField: 'expenseitem_id'
	},{
            xtype: 'numberfield',
			
			
            name: 'amount',
            fieldLabel: 'Amount ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			
			
            name: 'description',
            fieldLabel: 'Description ',
            allowBlank: false,
            minLength: 1
        
		}],dockedItems: [{
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
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for=><li><span class="field-name">{name}</span>: '
				+ '<span class="error">{error}</span></li></tpl></ul>'),

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
   
						
						}
		
	,
        {
        xtype: 'form',
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
									createFormGrid('Save','NOID','expenses_expenseitem','g')
									}
                }],
		resizable:true,
        frame: true,
		url:'bodysave.php',
        width: 550,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: ' expenses expenseitem',

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
			 value:'expenses_expenseitem'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },{
            xtype: 'textfield',
			
			
            name: 'expenseitem_name',
            fieldLabel: 'Expenseitem Name ',
            allowBlank: false,
            minLength: 1
        
		}],dockedItems: [{
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
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for=><li><span class="field-name">{name}</span>: '
				+ '<span class="error">{error}</span></li></tpl></ul>'),

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
   
						
						}]
				 }
				 ]}
				 );

 
 }
 createTabbed9();