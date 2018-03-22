var Menu_Modules = new Ext.Panel({
title: 'Modules'
,id:'Menu_Modules'
,layout:'accordion'
,collapsible: true
,split:true
,layoutConfig: {
animate: true
}
});

function Build_Menu_Modules(){
Ext.Ajax.request({
url: 'iRequestToServeur.aspx'
,waitMsg:'Chargement...'
,params: {TYPE_REQUEST:'31' }
,success: function(response, success){
var ListesModules = Ext.decode(response.responseText).ListesModules;
for (i=0; i<ListesModules.length; i++) {
Menu_Modules.add({
title: ListesModules[i].DOSSIER
,html: 'content'
,closable:true
,autoScroll:true
}).show();

}
}
});

Menu_Modules.add({
title: 'TITLE FIX '
,html: 'TITLE FIX'
}).show();
}
Build_Menu_Modules();