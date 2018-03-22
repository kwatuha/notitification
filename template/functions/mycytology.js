function medicallab_cytologyrefFormRevised(hospitalnum,queuid,labnum,personname,displayhere){
var loadtype='Save',rid='NOID';
var obj=document.getElementById(displayhere);
var objchild=document.getElementById('dynamicchild');

objchild.innerHTML='';

obj.innerHTML='';





Ext.onReady(function() {
					 

Ext.tip.QuickTipManager.init();
Ext.define('cmbAdmin_person', {
    extend: 'Ext.data.Model',
	fields:['person_id','person_name']
	});

var admin_persondata = Ext.create('Ext.data.Store', {
    model: 'cmbAdmin_person',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?sydocprsn=1',
        reader: {
            type: 'json'
        }
    }
});

admin_persondata.load();
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
									createFormGrid('Save','NOID','medicallab_histology','g')
									}
                }],
		resizable:true,
		closable:true,
		  frame: true,
		url:'bodysave.php',
         width: 600,
		
	
		autoScroll:true,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: 'Cytology',

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
			 value:'medicallab_labresult'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },
  {
    xtype: 'hidden',
	name:'queue_id',
	id:'queue_id',
	value:queuid
	},{xtype:'fieldset',
		   title:'Part A',
		   collapsible:true,
		   items:[{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'patiename',
			id: 'patientname',
			fieldLabel: 'Patient Name ',
            value:personname
        
		},{xtype: 'fieldcontainer',
							fieldLabel:'Hospital Number ',
							msgTarget : 'side',
							layout: 'hbox',
							items:[{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'patiennumb',
			value:hospitalnum,
			id: 'patientnumber',
			margin: '0 5 0 0',
            fieldLabel:false
        
		},{
            xtype: 'textfield',
			margin: '0 5 0 0',
			msgTarget : 'side',
            name: 'labnum',
			id: 'labnumber',
            value:labnum,
            fieldLabel: 'Lab Number '
        
		}]}, {
    xtype: 'multiselect',
	name:'physician',
	height:50,
	id:'physician',
	forceSelection:true,
    fieldLabel: 'Physician ',
    store: admin_persondata,
    queryMode: 'remote',
    displayField: 'person_name',
    valueField: 'person_id'
	},{xtype: 'fieldcontainer',
							fieldLabel:'Reporting Date',
							msgTarget : 'side',
							layout: 'hbox',
							items:[{
            xtype: 'datefield',
			msgTarget : 'side',
            name: 'reporting_date',
			value:'',
			margin: '0 5 0 0',
            fieldLabel:false,
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
			msgTarget : 'side',
            name: 'sample_collection_date',
			margin: '0 5 0 0',
			value:'',
            fieldLabel: 'Sample Collection Date ',
            allowBlank: false,
            minLength: 1
        
		}]},{xtype: 'textfield',
			msgTarget : 'side',
            name: 'biopsy',
			value:'',
            fieldLabel: 'Biopsy site '
			}]}//end of fieldset personal details
			,
		{xtype:'fieldset',
		   title:'Part B',
		   collapsible:true,
		   items:[
				  {
							xtype: 'textareafield',
							msgTarget : 'side',
							name: 'clinical_history',
							fieldLabel:'Clinical History',
							anchor: '100%',
							value:'',
							
							allowBlank: false,
							minLength: 1
						
						},{
							xtype: 'textareafield',
							msgTarget : 'side',
							name: 'gross_description',
							fieldLabel:'Gross Description',

							anchor: '100%',
							value:'',
							allowBlank: false,
							minLength: 1
						
						},{
							xtype: 'textareafield',
							msgTarget : 'side',
							name: 'microscopy',
							fieldLabel:'Microscopy',
							anchor: '100%',
							value:'',
							allowBlank: false,
							minLength: 1
						
						},{
							xtype: 'textareafield',
							msgTarget : 'side',
							name: 'diagnosis',
							fieldLabel:'Diagnosis',
							anchor: '100%',
							value:'',
							allowBlank: false,
							minLength: 1
						
						},{
								xtype: 'textareafield',
								msgTarget : 'side',
								name: 'comments',
								value:'',
								anchor: '100%',
								fieldLabel:'Comments',
								allowBlank: false,
								minLength: 1
							}]}
		             
                ], dockedItems: [{
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
loadmedicallab_histologyinfo(formPanel,rid);
}

});



}

/*launchForm()*/
