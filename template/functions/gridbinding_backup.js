function form_amrsconceptsFormQuestionBinding(displayhere,loadtype,rid){
var obj=document.getElementById(displayhere);
obj.innerHTML='';
Ext.onReady(function() {

Ext.define('cmbMobile_form', {
    extend: 'Ext.data.Model',
	fields:['form_id','form_name']
	});

var mobile_formdata = Ext.create('Ext.data.Store', {
    model: 'cmbMobile_form',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=mobile_form',
        reader: {
            type: 'json'
        }
    }
});
mobile_formdata.load();


Ext.define('cmbStructure_amrsgroup', {
    extend: 'Ext.data.Model',
	fields:['amrsgroup_id','amrsgroup_name']
	});

var structure_amrsgroupdata = Ext.create('Ext.data.Store', {
    model: 'cmbStructure_amrsgroup',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=structure_amrsgroup',
        reader: {
            type: 'json'
        }
    }
});
structure_amrsgroupdata.load();


Ext.tip.QuickTipManager.init();
        var formPanel = Ext.widget('form', {
        renderTo: 'editdiv',
		tbar:[{
                    text:'Add Something',
                    tooltip:'Add a new row',
                    iconCls:'add'
                }, '-', {
                    text:'Options',
                    tooltip:'Blah blah blah blaht',
                    iconCls:'option'
                },'-',{
                    text:'Remove Something',
                    tooltip:'Remove the selected item',
                    iconCls:'remove'
                },'-',{
                    text:'View',
                    tooltip:'View Information Grid',
                    iconCls:'grid',
					handler:function(buttonObj, eventObj) { 
									///eventObj.click(eval(tablevalgrpArr[2]));
									gridViewform_amrsconcepts();
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
        title: ' form amrsconcepts',

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

            if (me.hasBeenDirty || me.getForm().isDirty()) { //prevents showing global error when form first loads
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
			 value:'form_amrsformquestion'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:'Save'
			 },
		 {
            xtype: 'hidden',
            name: 'amrsformquestion_id',
            fieldLabel: 'Form question Id ',
            allowBlank: false,
            minLength: 1
        },
		





		{
    xtype: 'combobox',
	name:'form_id',
	forceSelection:true,
    fieldLabel: 'Mobile Form',
    store: mobile_formdata,
    queryMode: 'local',
    displayField: 'form_name',
    valueField: 'form_id'
	},
	{
    xtype: 'combobox',
	name:'amrsgroup_id',
	forceSelection:true,
    fieldLabel: 'main group',
    store: structure_amrsgroupdata,
    queryMode: 'local',
    displayField: 'amrsgroup_name',
    valueField: 'amrsgroup_id'
	},
	{
    xtype: 'checkbox',
	name:'stype',
    fieldLabel: 'is Answer',
	value:'Question Answer'
	},{
            xtype: 'textfield',
            name: 'scnname',
            fieldLabel: 'Question #',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'scncaption',
            fieldLabel: 'Question Caption ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'amrsconceptid',
			readOnly:true,
            fieldLabel: 'Concept ID',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'amrsconceptname',
            fieldLabel: 'Concept Name ',
			readOnly:true,
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
            name: 'Description',
			readOnly:true,
            fieldLabel: 'Description '
        
		},{
            xtype: 'textfield',
            name: 'Synonyms',
            fieldLabel: 'Synonyms '
        
		},{
            xtype: 'textfield',
            name: 'Answers',
			readOnly:true,
            fieldLabel: 'Answers '
        
		},{
            xtype: 'textfield',
            name: 'Set_Members',
			readOnly:true,
            fieldLabel: 'Set Members '
        
		},{
            xtype: 'textfield',
            name: 'Class',
            fieldLabel: 'Class ',
			readOnly:true
        
		},{
            xtype: 'textfield',
			readOnly:true,
            name: 'Datatype',
            fieldLabel: 'Data Type '
        
		}], dockedItems: [{
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

                    // Update CSS class and tooltip content
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
			
			
	//now submit
	{
		xtype: 'button',
        text: 'Submit Data',
        handler: function() {
            var form = this.up('form').getForm();
            if(form.isValid()){
                form.submit({
                    url: 'bodysave.php?rtb=rvdconcepts',
                    waitMsg: 'saving changes...',
                    success: function(fp, o) {
                        Ext.Msg.alert('Success', '' + o.result.savemsg + '"');
                    }
                });
            }
        }
    }
	///end of cols
		]
        }]
    });
	
	/*var win = Ext.create('Ext.Window', {
					 
        title: 'User Registration',
       // height: 700,
       //width: 800,
        layout: 'fit',
		autoScroll :true,
		items: formPanel,
		 tbar:[{
                    text:'Add Something muse',
                    tooltip:'Add a new row',
                    iconCls:'add'
                }, '-', {
                    text:'Options',
                    tooltip:'Blah blah blah blaht',
                    iconCls:'option'
                },'-',{
                    text:'Remove Something',
                    tooltip:'Remove the selected item',
                    iconCls:'remove'
                },'-',{
                    text:'View',
                    tooltip:'View Information Grid',
                    iconCls:'grid',
					handler:function(buttonObj, eventObj) { 
									///eventObj.click(eval(tablevalgrpArr[2]));
									gridViewform_amrsconcepts();
											}
                }
				]
    }).show();
	*/
	
if(loadtype=='updateload'){
loadform_amrsconceptsinfo(formPanel,rid);
}

});



}//launchForm()

/////////////////////////////////////////////////form

function gridViewform_amrsconceptsFQM(){
var viewdiv=document.getElementById('detailinfo');

viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnform_amrsconcepts = Ext.get('gridViewform_amrsconcepts');	

	Ext.define('Form_amrsconcepts', {
    extend: 'Ext.data.Model',
	fields:['amrsconcepts_id','amrsconceptid','amrsconceptname','Description','Synonyms','Answers','Set_Members','Class','Datatype','Changed_By','Creator']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Form_amrsconcepts',
    proxy: {
        type: 'ajax',
        url : 'buidgrid.php?t=form_amrsconcepts',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        //collapsible: true,
        multiSelect: true,
		iconCls: 'icon-grid',
        stateId: 'stateGrid',
		animCollapse:false,
        constrainHeader:true,
        layout: 'fit',
		columnLines: true,
		//headerPosition :'left',
		bbar:{height: 20},
		columns:[
		new Ext.grid.RowNumberer(),{
		text     : ' Amrsconcepts Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'amrsconcepts_id'
		 },
		 {
		text     : ' Formgenconcepts Name ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'amrsconceptid'
		 },
		 {
		text     : ' Amrsconceptname ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'amrsconceptname'
		 },
		 {
		text     : ' Description ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'Description'
		 },
		 {
		text     : ' Synonyms ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'Synonyms'
		 },
		 {
		text     : ' Answers ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'Answers'
		 },
		 {
		text     : ' Set Members ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'Set_Members'
		 },
		 {
		text     : ' Class ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'Class'
		 },
		 {
		text     : ' Datatype ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'Datatype'
		 },
		 {
		text     : ' Changed By ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'Changed_By'
		 },
		 {
		text     : ' Creator ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'Creator'
		 },
		 {
                menuDisabled: true,
                sortable: false,
                xtype: 'actioncolumn',
                width: 50,
                items: [{
                    icon   : '../shared/icons/fam/delete.gif',
                    tooltip: 'Sell stock',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
                        alert('Sell ' + rec.get('alert_name'));
                    }
                }, {
                    getClass: function(v, meta, rec) { 
                        if (rec.get('alert_name') < 0) {
                            this.items[1].tooltip = 'Hold stock';
                            return 'alert-col';
                        } else {
                            this.items[1].tooltip = 'Buy stock';
                            return 'buy-col';
                        }
                    },
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);

form_amrsconceptsFormQuestionBinding('editdiv','updateload',rec.get('amrsconcepts_id'));
                    }
                }]
            }
        ]
		
		,
		maxHeight: 600,
        width: 600,
		resizable:true,
        title: ' Form Amrsconcepts',
        renderTo: 'detailinfo',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
		},
		tbar:[{
                    text:'Add Record',
                    tooltip:'Add a new row',
                    iconCls:'add',
					handler:function(){
						alert('something');
					}
                }, '-', {
                    text:'Options',
                    tooltip:'Blah blah blah blaht',
                    iconCls:'option'
                },'-',{
                    text:'Remove Something',
                    tooltip:'Remove the selected item',
                    iconCls:'remove'
                }]
		
    });
	
	/*var win = Ext.create('Ext.Window', {
		extend: 'Ext.ux.desktop.Module',				  
        title: 'Grid Filters Example',
		collapsable:true,
		autoScroll :true,
        layout: 'fit',
		items: grid
    }).show();*/
	
}//end of gridViewform_amrsconcepts function
//////////////////////////////////////////////////////////////////////////////////////////