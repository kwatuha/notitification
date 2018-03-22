
function createTabbed2(){
var obj=document.getElementById('detailinfo');
obj.innerHTML='';
   loadtype='Save';
   //**************************************************************************************
  
  //*************************************************************************************
   
   admin_contactdata='kwasdasd';
   
   Ext.create('Ext.panel.Panel', {
    renderTo: 'detailinfo',
    width: 700,
	bodyPadding:10,
    title: 'User registration',
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
						title: 'Personal Details',
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
			 },{
            xtype: 'textfield',
			readOnly:true,value:'3243432',
			
            name: 'role_name',
            fieldLabel: 'Role Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			readOnly:true,value:'sdfsdfsd',
			
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
				 items:[]
				 }
				 ]}
				 );

 
 }
 createTabbed2();