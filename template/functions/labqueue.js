function medicallab_queueFormRevised(personid,personname,displayhere){
var loadtype='Save',rid='NOID';
/*alert('medicallab_queue');*/
var obj=document.getElementById(displayhere);

var objchild=document.getElementById('dynamicchild');

objchild.innerHTML='';

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
									createFormGrid('Save','NOID','medicallab_queue','g')
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
        title: ' medicallab queue',

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
			 value:'medicallab_queue'
			 },{xtype: 'fieldcontainer',
							fieldLabel:'Category',
							msgTarget : 'side',
							allowBlank: false,
							id:'visittypesel',
							layout: 'hbox',
							items:[
									{
								xtype: 'radiofield',
								margin: '0 5 0 0',
								name: 'diagnosis_type',
								id: 'diagnosis_typeCytology',
								inputValue:'Cytology',
								boxLabel: 'Cytology'
							
							},
							{
								xtype: 'radiofield',
								margin: '0 5 0 0',
								id: 'diagnosis_typeHistology',
								name: 'diagnosis_type',
								inputValue:'Histology',
								boxLabel: 'Histology'
							
							},
							{
								xtype: 'radiofield',
								margin: '0 5 0 0',
								name: 'diagnosis_type',
								id: 'diagnosis_typePapSmear',
								inputValue:'Pap Smear',
								boxLabel: 'Pap Smear'
							
							}]},
			 	{
    xtype: 'textfield',
	name:'personname',
	 fieldLabel: 'Patient Name ',
	readOnly:true,
    value:personname
	},	
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'hospital_number',
			
			value:'',
            fieldLabel: 'Hospital Number ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'queue_name',
			
			value:'',
            fieldLabel: 'Lab Number ',
            allowBlank: false,
            minLength: 1
        
		},
		{
            xtype: 'numberfield',
			msgTarget : 'side',
            name: 'patient_age',
			value:'',
            fieldLabel: 'Patient Age ',
            allowBlank: false,
            minLength: 1
        
		},
   {
    xtype: 'hidden',
	name:'person_id',
    value:personid
	},	{xtype: 'fieldcontainer',
                fieldLabel:'Visit Type',
				msgTarget : 'side',
                layout: 'hbox',
				items:[
						{
								xtype: 'radiofield',
								margin: '0 5 0 0',
								name: 'visit_type',
								inputValue:'Review Case',
								boxLabel: 'Review Case'
							
							},
							{
								xtype: 'radiofield',
								margin: '0 5 0 0',
								name: 'visit_type',
								inputValue:'Recap',
								boxLabel: 'Recap Case'
							
							},
							{
								xtype: 'radiofield',
								margin: '0 5 0 0',
								name: 'visit_type',
								inputValue:'Initial',
								selected:true,
								boxLabel: 'Initial'
							
							}]}
							,{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'referring_facility',
			value:'',
            fieldLabel: 'Referring Facility '
          },{
            xtype: 'datefield',
			msgTarget : 'side',
            name: 'reporting_date',
			
			value:'',
            fieldLabel: 'Reporting Date ',
            allowBlank: false,
            minLength: 1
        
		},
		
      {
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'other_details',
			
			value:'',
            fieldLabel: 'Other Details ',
            allowBlank: false,
            minLength: 1
        
		},{xtype:'fieldset',
		   title:'Attachments',
		   hidden:true,
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
												name: 'other_attachments',
												width:400,
												fieldLabel: 'Other Details  '+ fieldnamed/*,
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
        text: 'Save',
        handler: function() {
            var form = this.up('form').getForm();
			var dPapSmear=Ext.getCmp('diagnosis_typePapSmear').getValue();
			var dHistology=Ext.getCmp('diagnosis_typeHistology').getValue();
			var dCytology=Ext.getCmp('diagnosis_typeCytology').getValue();
			
			if(dPapSmear==true||dHistology==true||dCytology==true){
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
			}else{
				showerror("Please Select Category!");
			}
        }
    }
	
		]
        }]
    });
	
	
if(loadtype=='updateload'){
loadmedicallab_queueinfo(formPanel,rid);
}

});



}/*launchForm()*/