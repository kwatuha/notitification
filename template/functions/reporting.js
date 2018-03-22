function createReportView(){
var displayhere='detailinfo',loadtype='Save',rid='NOID';
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
									createFormGrid('Save','NOID','admin_table','g')
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
        title: ' admin table',

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
			 value:'admin_table'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },
			 {xtype:'fieldset',
		   title:'Report Filters',
		   collapsible:true,
		   id:'reportfilter',
		   items:[
			 {
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'table_name',
			
			value:'',
            fieldLabel: 'Table Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'table_caption',
			
			value:'',
            fieldLabel: 'Table Caption ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'button',
			margin: '5 5 5 5',
			text:'Show reports',
            handler:gridViewReports
		},{
            xtype: 'numberfield',
			msgTarget : 'side',
            name: 'flexcolumn',
			
			value:'',
            fieldLabel: 'Flexcolumn ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			msgTarget : 'side',
            name: 'gridwidth',
			
			value:'',
            fieldLabel: 'Gridwidth ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			msgTarget : 'side',
            name: 'gridhieght',
			
			value:'',
            fieldLabel: 'Gridhieght ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			msgTarget : 'side',
            name: 'formheight',
			
			value:'',
            fieldLabel: 'Formheight ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			msgTarget : 'side',
            name: 'orderpos',
			
			value:'',
            fieldLabel: 'Orderpos ',
            allowBlank: false,
            minLength: 1
        
		}]},{xtype:'fieldset',
		   title:'View Reports',
		   collapsible:true,
		   id:'mysuser',
		   items:[{html:'<div id="reportview">My Reports</div>'}
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
loadadmin_tableinfo(formPanel,rid);
}

});



}

/****************************************************************************************************************/
function gridViewReports( ){
var searchitem='';
var viewdiv=document.getElementById('reportview');
viewdiv.innerHTML='';
Ext.onReady(function() {
Ext.QuickTips.init();

/*var encode = false;
var local = true;
var filters = {
        ftype: 'filters',
        encode: encode, 
        local: local, 
        filters: [
            {
                type: 'boolean',
                dataIndex: 'visible'
            }
        ]
    };*/

Ext.define('cmbadmin_table', {
    extend: 'Ext.data.Model',
	fields:['fieldname','fieldcaption']
	});

var searchadmin_tabledata = Ext.create('Ext.data.Store', {
    model: 'cmbadmin_table',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_table&find=thistable',
        reader: {
            type: 'json'
        }
    }
});
searchadmin_tabledata.load();

var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_table = Ext.get('gridViewadmin_table');	

	Ext.define('Admin_table', {
    extend: 'Ext.data.Model',
	fields:[{name:'table_id'},{name:'table_name'},{name:'table_caption'},{name:'statement_caption'},{name:'flexcolumn'},{name:'gridwidth'},{name:'gridhieght'},{name:'formheight'},{name:'orderpos'}]
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_table',
	
	
    proxy: {
        type: 'ajax',
        url : 'buidgrid.php?t=admin_table&fdn='+searchitem+'&dyt=',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
  
  ;
  ////////
      var sellAction = Ext.create('Ext.Action', {
        icon   : '../shared/icons/fam/delete.gif',  // Use a URL in the icon config
        text: 'Delete',
        disabled: true,
        handler: function(widget, event) {
            var rec = grid.getSelectionModel().getSelection()[0];
            if (rec) {
                alert('asdfasdas');
            } else {
                alert('Please select a company from the grid');
            }
        }
    });
	
	
	
    var buyAction = Ext.create('Ext.Action', {
        iconCls: 'user-girl',
        text: 'Edit',
        disabled: true,
        handler: function(widget, event) {
            var rec = grid.getSelectionModel().getSelection()[0];
            if (rec) {
                alert('asdfasdas dfdfdf');
            } else {
                alert('Please select a company from the grid');
            }
        }
    });
	
	var contextMenu = Ext.create('Ext.menu.Menu', {
        items: [
             
        ]
    });

  //////////
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
		/*bbar:[items:[{
		xtype:'button',
		text:'Close'
		}],*/
        stateful: true,
		closable:true,
		
        multiSelect: true,
		iconCls: 'icon-grid',
        stateId: 'stateGrid',
		animCollapse:false,
        constrainHeader:true,
        layout: 'fit',
		columnLines: true,
		bbar:{height: 20},
		/*features: [filters],*/
		columns:[
		new Ext.grid.RowNumberer(),{
				header     : ' Table Name ' , 
				 flex : 1 , 
				 
				 sortable : true ,
				 dataIndex : 'table_name'/*,
				 filterable: true*/
				 },
				 {
				header     : ' Table Caption ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'table_caption'/*,
				 filterable: true*/
				 },
				 {
				header     : ' Statement Caption ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'statement_caption'/*,
				 filterable: true*/
				 },
				 {
				header     : ' Flexcolumn ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'flexcolumn'/*,
				 filterable: true*/
				 },
				 {
				header     : ' Gridwidth ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'gridwidth'/*,
				 filterable: true*/
				 },
				 {
				header     : ' Gridhieght ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'gridhieght'/*,
				 filterable: true*/
				 },
				 {
				header     : ' Formheight ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'formheight'/*,
				 filterable: true*/
				 },
				 {
				header     : ' Orderpos ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'orderpos'/*,
				 filterable: true*/
				 },
				 {
                menuDisabled: true,
                sortable: false,
                xtype: 'actioncolumn',
                width: 80,
                items: [
				  {
                    icon   : '../shared/icons/fam/delete.gif',
                    tooltip: 'Delete ',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
						var tblnow="admin_table";
						
                        alert('Sell mumnil tblnow =' + tblnow+ rec.get('alert_name'));
						
						
						 onMouseOver="showMenuDesign();"
                    }
                }, {
                    getClass: function(v, meta, rec) { 
                        if (rec.get('alert_name') < 0) {
                            this.items[1].tooltip = 'Edit';
                            return 'alert-col';
                        } else {
                            this.items[1].tooltip = 'Edit';
                            return 'buy-col';
                        }
                    },
					handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
//alert("wassssssssssssssssssssss");
var ctv='admin_table';
var ccrecordid=rec.get('table_id');


if(ctv=='form_amrsconcepts'){
//alert(ccrecordid);
gridViewform_amrsconceptsFQM('editdiv','updateload',1);
//form_amrsconceptsForm('editdiv','updateload',ccrecordid));
}else{

//alert(rec.get('table_id')+'table_id');
var ccrecordid=rec.get('table_id');
admin_tableForm('editdiv','updateload',ccrecordid);

}

                    }
                }]
            }
        ]
		
		,
		maxHeight: 600,
        width: 800,
		resizable:true,
        title: ' Admin Table',
        renderTo: 'detailinfo',
        viewConfig: {
            stripeRows: true,
           // enableTextSelection: true,
			listeners: {
                itemcontextmenu: function(view, rec, node, index, e) {
                    e.stopEvent();
                    contextMenu.showAt(e.getXY());
                    return false;
                }
            }
		}
,
		tbar:[{
                    text:'Add Record',
                    tooltip:' admin table',
                    iconCls:'add',
					handler:function(){
						createForm("Save","NOID","admin_table","f")
					}
                }, '-', {
                    text:'PDF',
                    tooltip:'Create options',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenReport('YWRtaW5fdGFibGU=');
					}
                },'-', {
                    text:'Invoice',
                    tooltip:'Create options',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenInvoice('YWRtaW5fdGFibGU=');
					}
                },/*
				'-', {
                    text:'Receipt',
                    tooltip:'Print Receipt',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenReceipt('YWRtaW5fdGFibGU=');
					}
                },
				'-', {
                    text:'Statement',
                    tooltip:'Print Statement',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenStatement('YWRtaW5fdGFibGU=');
					}
                },'-',{
                    text:'Delete',
                    tooltip:'Delete record',
                    iconCls:'remove'
                },*/'-',
				{ text:'Search', 
 tooltip:'Find', 
 iconCls:'find',
  handler: function(grid, rowIndex, colIndex) { 
testme();
 }

 }
 ,
 
 {
    xtype: 'combobox',
	name:'grdsearchadmin_table',
	id:'grdsearchadmin_table',
	forceSelection:true,
    fieldLabel: false,
    store: searchadmin_tabledata,
    queryMode: 'local',
    displayField: 'fieldcaption',
    valueField: 'fieldname',
	listeners: {
  select: function(combo,  record,  index ) {
    var selVal = Ext.getCmp('grdsearchadmin_table').getValue();
	var selValtx = Ext.getCmp('searchfield').getValue();
  alert(selValtx+selVal);
}}

	},
 { title:'Search', 
 tooltip:'Find record', 
 xtype:'textfield',
 name:'searchfield',
 id:'searchfield',
 iconCls:'remove',
 listeners: {'render': function(cmp) { 
      cmp.getEl().on('keyup', function( event, el ) {
     	 var ke= event.getKey();
	if((ke==39)||(ke==13)||(ke==112)||(ke==37)||(ke==34)||(ke==38)||(ke==20)){
	var selVal = Ext.getCmp('grdsearchadmin_table').getValue();
   /* var searchitem=el.value;
	store.proxy.extraParams = { searhfield:selVal,searhvalue:searchitem};
	 store.load();
	*/ }
	
      });            
    }}
 }]
	
    });
	
	///grid selection
	
	grid.getSelectionModel().on({
        selectionchange: function(sm, selections) {
            if (selections.length) {
                buyAction.enable();
                sellAction.enable();
				 
            } else {
                buyAction.disable();
                sellAction.disable();
				
            }
        }
    });
	///end of grid selection	
		
	

});//end of testing ext load	
}
/****************************************************************************************************************************/
function createReportGroups(){
var displayhere='detailinfo',loadtype='Save',rid='NOID';
var obj=document.getElementById(displayhere);
var objchild=document.getElementById('dynamicchild');
objchild.innerHTML='';
obj.innerHTML='';



Ext.define('cmbReports_reportgroup', {
    extend: 'Ext.data.Model',
	fields:['reportgroup_id','reportgroup_name']
	});

var reports_reportgroupdata = Ext.create('Ext.data.Store', {
    model: 'cmbReports_reportgroup',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=reports_reportgroup',
        reader: {
            type: 'json'
        }
    }
});

reports_reportgroupdata.load();

/*var checkitems=[{ boxLabel: 'Item 1', name: 'rb', inputValue: '1' },
            { boxLabel: 'Item 2', name: 'rb', inputValue: '2', checked: true },
            { boxLabel: 'Item 3', name: 'rb', inputValue: '3' },
            { boxLabel: 'Item 4', name: 'rb', inputValue: '4' },
            { boxLabel: 'Item 5', name: 'rb', inputValue: '5' },
            { boxLabel: 'Item 6', name: 'rb', inputValue: '6' }];
*/
    
Ext.define('cmbReports_reportview', {
    extend: 'Ext.data.Model',
	fields:['reportview_id','reportview_name']
	});

var reports_reportviewdata = Ext.create('Ext.data.Store', {
    model: 'cmbReports_reportview',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=reports_reportview',
        reader: {
            type: 'json'
        }
    }
});

reports_reportviewdata.load();


Ext.onReady(function() {
Ext.tip.QuickTipManager.init();
new Ext.Component({
    tpl: '{firstName} - {lastName}',
    loader: {
        url: 'myPage.php',
		target:'reportview_id',
        renderer: 'data',
        params: {
            userId: 1
        }
    }
});
var checkitems=[{ boxLabel: 'Item 1', name: 'rb', inputValue: '1' },
            { boxLabel: 'Item 2', name: 'rb', inputValue: '2', checked: true },
            { boxLabel: 'Item 3', name: 'rb', inputValue: '3' },
            { boxLabel: 'Item 4', name: 'rb', inputValue: '4' },
            { boxLabel: 'Item 5', name: 'rb', inputValue: '5' },
            { boxLabel: 'Item 6', name: 'rb', inputValue: '6' }];
 //checkitems.push(mycheck);
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
									createFormGrid('Save','NOID','reports_reportsbygroup','g')
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
        title: ' reports reportsbygroup',

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
			 value:'reports_reportsbygroup'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },
   {
    xtype: 'combobox',
	name:'reportgroup_id',
	id:'reportgroup_id',
	forceSelection:true,
    fieldLabel: 'Reportgroup Id ',
    store: reports_reportgroupdata,
    queryMode: 'remote',
    displayField: 'reportgroup_name',
    valueField: 'reportgroup_id',
	
	listeners: { select: function(combo, record, index ) { 
	var secelVallid = Ext.getCmp('reportgroup_id').getValue();
	createCks(secelVallid);
	}}
	},
   {
    xtype: 'checkboxgroup',
	name:'reportview_id',
	id:'reportview_id',
	fieldLabel: 'Reportview Id '
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
												name: 'reportview_id',
												width:400,
												fieldLabel: 'Reportview Id  '+ fieldnamed/*,
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
loadreports_reportsbygroupinfo(formPanel,rid);
}

});



}/*launchForm()*/
