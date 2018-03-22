
function createTabbed14(){
var obj=document.getElementById('detailinfo');
obj.innerHTML='';
   loadtype='Save';
   //**************************************************************************************
  

Ext.define('cmbHousing_property', {
    extend: 'Ext.data.Model',
	fields:['property_id','property_name']
	});

var housing_propertydata = Ext.create('Ext.data.Store', {
    model: 'cmbHousing_property',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=housing_property',
        reader: {
            type: 'json'
        }
    }
});

housing_propertydata.load();


Ext.define('cmbAdmin_timeperiodtype', {
    extend: 'Ext.data.Model',
	fields:['timeperiodtype_id','timeperiodtype_name']
	});

var admin_timeperiodtypedata = Ext.create('Ext.data.Store', {
    model: 'cmbAdmin_timeperiodtype',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_timeperiodtype',
        reader: {
            type: 'json'
        }
    }
});

admin_timeperiodtypedata.load();


Ext.define('cmbHousing_property', {
    extend: 'Ext.data.Model',
	fields:['property_id','property_name']
	});

var housing_propertydata = Ext.create('Ext.data.Store', {
    model: 'cmbHousing_property',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=housing_property',
        reader: {
            type: 'json'
        }
    }
});

housing_propertydata.load();

  //*************************************************************************************
   
   admin_contactdata='kwasdasd';
   

Ext.define('cmbHousing_property', {
    extend: 'Ext.data.Model',
	fields:['property_id','property_name']
	});

var housing_propertydata = Ext.create('Ext.data.Store', {
    model: 'cmbHousing_property',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=housing_property',
        reader: {
            type: 'json'
        }
    }
});

housing_propertydata.load();


Ext.define('cmbAdmin_timeperiodtype', {
    extend: 'Ext.data.Model',
	fields:['timeperiodtype_id','timeperiodtype_name']
	});

var admin_timeperiodtypedata = Ext.create('Ext.data.Store', {
    model: 'cmbAdmin_timeperiodtype',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_timeperiodtype',
        reader: {
            type: 'json'
        }
    }
});

admin_timeperiodtypedata.load();


Ext.define('cmbHousing_property', {
    extend: 'Ext.data.Model',
	fields:['property_id','property_name']
	});

var housing_propertydata = Ext.create('Ext.data.Store', {
    model: 'cmbHousing_property',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=housing_property',
        reader: {
            type: 'json'
        }
    }
});

housing_propertydata.load();

   Ext.create('Ext.panel.Panel', {
    renderTo: 'detailinfo',
    width: 700,
	bodyPadding:10,
    title: 'Personal Inventory',
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
						title: 'personal details',
						width:380,
						collapsible:true,
						iconCls:'usergroup',
						items: [{xtype:'hidden',
             name:'t',
			 value:'admin_person'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },{
            xtype: 'textfield',
			readOnly:true,value:'ZulM0293',
			
            name: 'person_name',
            fieldLabel: 'Person Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'Selemani',
			
            name: 'last_name',
            fieldLabel: 'Last Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'Suleimani',
			
            name: 'middle_name',
            fieldLabel: 'Middle Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'Jacob',
			
            name: 'first_name',
            fieldLabel: 'First Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'3433433',
			
            name: 'idorpassport_number',
            fieldLabel: 'Idorpassport Number ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
			readOnly:true,value:'0000-00-00',
			
            name: 'dob',
            fieldLabel: 'Dob ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'A9202982M',
			
            name: 'pin',
            fieldLabel: 'Pin ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'Female',
			
            name: 'gender',
            fieldLabel: 'Gender ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'Active',
			
            name: 'status',
            fieldLabel: 'Status ',
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
									createFormGrid('Save','NOID','admin_propertyissue','g')
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
        title: 'Issue',

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
			 value:'admin_propertyissue'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },{
            xtype: 'textfield',
			
			
            name: 'propertyissue_name',
            fieldLabel: 'Propertyissue Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			
			
            name: 'sysowndfn',
            fieldLabel: 'Sysowndfn ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			
			
            name: 'sysowndfnid',
            fieldLabel: 'Sysowndfnid ',
            allowBlank: false,
            minLength: 1
        
		},
   {
    xtype: 'combobox',
	name:'property_id',
	forceSelection:true,
	
    fieldLabel: 'Property Id ',
    store: housing_propertydata,
	
    queryMode: 'remote',
    displayField: 'property_name',
    valueField: 'property_id'
	},{
            xtype: 'datefield',
			
			
            name: 'date_issued',
            fieldLabel: 'Date Issued ',
            allowBlank: false,
            minLength: 1
        
		},
   {
    xtype: 'combobox',
	name:'timeperiodtype_id',
	forceSelection:true,
	
    fieldLabel: 'Timeperiodtype Id ',
    store: admin_timeperiodtypedata,
	
    queryMode: 'remote',
    displayField: 'timeperiodtype_name',
    valueField: 'timeperiodtype_id'
	},{
            xtype: 'numberfield',
			
			
            name: 'allowed_period',
            fieldLabel: 'Allowed Period ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			
			
            name: 'status',
            fieldLabel: 'Status ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			
			
            name: 'comments',
            fieldLabel: 'Comments ',
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
									createFormGrid('Save','NOID','admin_propertyreturn','g')
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
        title: 'Return',

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
			 value:'admin_propertyreturn'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },{
            xtype: 'textfield',
			
			
            name: 'propertyreturn_name',
            fieldLabel: 'Propertyreturn Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			
			
            name: 'sysowndfn',
            fieldLabel: 'Sysowndfn ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			
			
            name: 'sysowndfnid',
            fieldLabel: 'Sysowndfnid ',
            allowBlank: false,
            minLength: 1
        
		},
   {
    xtype: 'combobox',
	name:'property_id',
	forceSelection:true,
	
    fieldLabel: 'Property Id ',
    store: housing_propertydata,
	
    queryMode: 'remote',
    displayField: 'property_name',
    valueField: 'property_id'
	},{
            xtype: 'datefield',
			
			
            name: 'return_date',
            fieldLabel: 'Return Date ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			
			
            name: 'comments',
            fieldLabel: 'Comments ',
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
 createTabbed14();