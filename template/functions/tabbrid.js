
function createTabbedrid(){
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
			 value:'admin_person'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },{
            xtype: 'textfield',
			readOnly:true,value:'N022019',
			
            name: 'person_name',
            fieldLabel: 'Person Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'Emily',
			
            name: 'last_name',
            fieldLabel: 'Last Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'Em',
			
            name: 'middle_name',
            fieldLabel: 'Middle Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'Imani',
			
            name: 'first_name',
            fieldLabel: 'First Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'121212091920',
			
            name: 'idorpassport_number',
            fieldLabel: 'Idorpassport Number ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
			readOnly:true,value:'2012-07-12',
			
            name: 'dob',
            fieldLabel: 'Dob ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			readOnly:true,value:'A930439403493M',
			
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
				 items:[]
				 }
				 ]}
				 );

 
 }
 createTabbedrid();