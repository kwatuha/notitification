function createRoleTabbed(){
var ccgroup='Admin';
var obj=document.getElementById('detailinfo');
obj.innerHTML='';
   loadtype='Save';
   //************************Role info
    Ext.define('cmbGroupGeneralDatadata', {
    extend: 'Ext.data.Model',
	fields:['displaygroup']
	});

var secondarytableListdata = Ext.create('Ext.data.Store', {
    model: 'cmbGroupGeneralDatadata',
    proxy: {
        type: 'ajax',
        url : 'cmbdesgn.php?tbgp=1',
        reader: {
            type: 'json'
        }
    }
});
secondarytableListdata.load();

 Ext.define('cmbRoledataDatadata', {
    extend: 'Ext.data.Model',
	fields:['role_id','role_name']
	});

var roledata = Ext.create('Ext.data.Store', {
    model: 'cmbRoledataDatadata',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_role',
        reader: {
            type: 'json'
        }
    }
});
roledata.load();
accrgts=[{ boxLabel: ' admin adminuser', name: 'admin_adminuser', inputValue: 'admin_adminuser' },{ boxLabel: ' admin company', name: 'admin_company', inputValue: 'admin_company' },{ boxLabel: ' admin companycontact', name: 'admin_companycontact', inputValue: 'admin_companycontact' },{ boxLabel: ' admin companydept', name: 'admin_companydept', inputValue: 'admin_companydept' },{ boxLabel: ' admin companydeptrlnphp', name: 'admin_companydeptrlnphp', inputValue: 'admin_companydeptrlnphp' },{ boxLabel: ' admin dept', name: 'admin_dept', inputValue: 'admin_dept' },{ boxLabel: ' admin person', name: 'admin_person', inputValue: 'admin_person' },{ boxLabel: ' admin persondept', name: 'admin_persondept', inputValue: 'admin_persondept' },{ boxLabel: ' admin personpersontype', name: 'admin_personpersontype', inputValue: 'admin_personpersontype' },{ boxLabel: ' admin personttypecategory', name: 'admin_personttypecategory', inputValue: 'admin_personttypecategory' },{ boxLabel: ' admin propertyissue', name: 'admin_propertyissue', inputValue: 'admin_propertyissue' },{ boxLabel: ' admin propertyreturn', name: 'admin_propertyreturn', inputValue: 'admin_propertyreturn' },{ boxLabel: ' admin role', name: 'admin_role', inputValue: 'admin_role' },{ boxLabel: ' admin roleperson', name: 'admin_roleperson', inputValue: 'admin_roleperson' },{ boxLabel: ' admin roleprivilege', name: 'admin_roleprivilege', inputValue: 'admin_roleprivilege' },{ boxLabel: ' admin rolerole', name: 'admin_rolerole', inputValue: 'admin_rolerole' },{ boxLabel: ' admin supervisor', name: 'admin_supervisor', inputValue: 'admin_supervisor' },{ boxLabel: ' admin timeperiodtype', name: 'admin_timeperiodtype', inputValue: 'admin_timeperiodtype' },{ boxLabel: ' admin contact', name: 'admin_contact', inputValue: 'admin_contact' },{ boxLabel: ' admin contactdetails', name: 'admin_contactdetails', inputValue: 'admin_contactdetails' },{ boxLabel: ' admin persongroup', name: 'admin_persongroup', inputValue: 'admin_persongroup' }];
   //*************************End of role info
   //**************************************************************************************
  

Ext.define('cmbAdmin_person', {
    extend: 'Ext.data.Model',
	fields:['person_id','person_name']
	});

var admin_persondata = Ext.create('Ext.data.Store', {
    model: 'cmbAdmin_person',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_person',
        reader: {
            type: 'json'
        }
    }
});

admin_persondata.load();

  //*************************************************************************************
   
   admin_contactdata='kwasdasd';
   

Ext.define('cmbAdmin_person', {
    extend: 'Ext.data.Model',
	fields:['person_id','person_name']
	});

var admin_persondata = Ext.create('Ext.data.Store', {
    model: 'cmbAdmin_person',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_person',
        reader: {
            type: 'json'
        }
    }
});

admin_persondata.load();

   Ext.create('Ext.panel.Panel', {
    renderTo: 'detailinfo',
    width: 700,
	bodyPadding:10,
    title: 'Role Definition',
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
						title: 'Role Details',
						width:380,
						collapsible:true,
						iconCls:'usergroup',
						items: [{xtype:'hidden',
             name:'t',
			 value:'admin_role'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },{html:'<div id="tabsdv">Inof here</div>'
			 },{
            xtype: 'textfield',
			readOnly:true,value:'Hr Manager',
			
            name: 'role_name',
            fieldLabel: 'Role Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			readOnly:true,value:'Human resource manager',
			
            name: 'description',
            fieldLabel: 'Description ',
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
									createFormGrid('Save','NOID','admin_roleperson','g')
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
        title: 'Assign role',

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
			 value:'admin_roleperson'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },
   {
    xtype: 'combobox',
	name:'person_id',
	forceSelection:true,
	
    fieldLabel: 'Person Id ',
    store: admin_persondata,
	
    queryMode: 'remote',
    displayField: 'person_name',
    valueField: 'person_id'
	},{
            xtype: 'hidden',
			
			 value:'2',
            name: 'role_id',
            fieldLabel: 'Role Id ',
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
									createFormGrid('Save','NOID','admin_roleprivilege','g')
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
        title: 'Privileges',

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
			 value:'admin_roleprivilege'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },{
            xtype: 'hidden',
			
			 value:'2',
            name: 'role_id',
            fieldLabel: 'Role Id ',
            allowBlank: false,
            minLength: 1
        
		},{
    xtype: 'combobox',
	name:'tablelist_secondary',
	id:'tablelist_secondary',
	forceSelection:true,
    fieldLabel: 'Section Filter',
    store: secondarytableListdata,
      queryMode: 'remote',
	  value:ccgroup,
    displayField: 'displaygroup',
    valueField: 'displaygroup',
	listeners: { select: function(combo, record, index ) { 
	var secelVal = Ext.getCmp('tablelist_secondary').getValue();
	createCheckitesm(secelVal);
	 }}
	}, {
    xtype: 'combobox',
	name:'role_id',
	id:'role_id',
	forceSelection:true,
    fieldLabel: 'Role',
    store: roledata,
      queryMode: 'remote',
	 // value:'role_id,
    displayField: 'role_name',
    valueField: 'role_id',
	listeners: { select: function(combo, record, index ) { 
	//var secelVal = Ext.getCmp('tablelist_secondary').getValue();
	//createCheckitesm(secelVal);
	 }}
	},{
 xtype: 'checkboxgroup',
 fieldLabel: 'Privileges',
 columns: 2,
 vertical: true,
 items: [accrgts]
 },{
            xtype: 'toolbar',
            dock: 'bottom',
            ui: 'footer',
            defaults: {
                minWidth: 75
            },
            items: ['->',  {
                text: 'Clear',
                handler: function(){
                    var field = Ext.getCmp(fieldId);
                    if (!field.readOnly && !field.disabled) {
                        field.clearValue();
                    }
                }
            }, {
                text: 'Reset',
                handler: function() {
                    Ext.this.up('form').getForm().reset();
                }
            }, {
		xtype: 'button',
        text: 'Save',
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
    }]}],dockedItems: [{
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
									createFormGrid('Save','NOID','admin_rolerole','g')
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
        title: 'Child roles',

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
			 value:'admin_rolerole'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },{
            xtype: 'hidden',
			
			 value:'2',
            name: 'role_id',
            fieldLabel: 'Role Id ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			
			
            name: 'parent_role',
            fieldLabel: 'Parent Role ',
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