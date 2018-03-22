/*

This file is part of Ext JS 4

Copyright (c) 2011 Sencha Inc

Contact:  http://www.sencha.com/contact

GNU General Public License Usage
This file may be used under the terms of the GNU General Public License version 3.0 as published by the Free Software Foundation and appearing in the file LICENSE included in the packaging of this file.  Please review the following information to ensure the GNU General Public License version 3.0 requirements will be met: http://www.gnu.org/copyleft/gpl.html.

If you are unsure which license is appropriate for your use, please contact the sales department at http://www.sencha.com/contact.

*/
Ext.Loader.setConfig({enabled: true});

Ext.Loader.setPath('Ext.ux.DataView', '../sview/ux/DataView/');

Ext.require([
    'Ext.data.*',
    'Ext.util.*',
    'Ext.view.View',
    'Ext.ux.DataView.DragSelector',
    'Ext.ux.DataView.LabelEditor'
]);
function createDataView(currenttable){
var tbl=currenttable;
Ext.onReady(function(){
	var obj=document.getElementById('detailinfo');
	obj.innerHTML='';
    ImageModel = Ext.define('ImageModel', {
        extend: 'Ext.data.Model',
        fields: [
           {name: 'name'},
           {name: 'url'},
           {name: 'size', type: 'float'},
           {name:'lastmod', type:'date', dateFormat:'timestamp'}
        ]
    });

    var store = Ext.create('Ext.data.Store', {
        model: 'ImageModel',
        proxy: {
            type: 'ajax',
            url: '../sysdocs/photoman.php?ftbl='+tbl,
            reader: {
                type: 'json',
                root: 'images'
            }
        }
    });
    store.load();

    Ext.create('Ext.Panel', {
        id: 'images-view',
        frame: true,
        collapsible: true,
		closable: true,
        width: 600,
		autoScroll:true,
		
        renderTo: 'detailinfo',
        title: 'Photo View (0 items selected)',
        items: Ext.create('Ext.view.View', {
            store: store,
            tpl: [
                '<tpl for=".">',
                    '<div class="thumb-wrap" id="{name}">',
                    '<div class="thumb"><img src="{url}" title="{name}"></div>',
                    '<span class="x-editable">{shortName}</span></div>',
                '</tpl>',
                '<div class="x-clear"></div>'
            ],
            multiSelect: true,
            height: 500,
			autoScroll:true,
			resizable:true,
			
            trackOver: true,
            overItemCls: 'x-item-over',
            itemSelector: 'div.thumb-wrap',
            emptyText: 'No images to display',
            plugins: [
                Ext.create('Ext.ux.DataView.DragSelector', {}),
                Ext.create('Ext.ux.DataView.LabelEditor', {dataIndex: 'name'})
            ],
            prepareData: function(data) {
                Ext.apply(data, {
                    shortName: Ext.util.Format.ellipsis(data.name, 15),
                    sizeString: Ext.util.Format.fileSize(data.size),
                    dateString: Ext.util.Format.date(data.lastmod, "m/d/Y g:i a")
                });
                return data;
            },
            listeners: {
                selectionchange: function(dv, nodes ){
                    var l = nodes.length,
                        s = l !== 1 ? 's' : '';
                    this.up('panel').setTitle('Photo View (' + l + ' photo' + s + ' selected)');

//var nodeData = view.getSelectedRecords();
var itemssl='';

for(var i = 0, len = nodes.length; i < len; i++){
var data = nodes[i].data;
//alert(data.url)
itemssl=itemssl+':'+data.name;
}
var xv=document.getElementById('dataviewselected');
xv.innerHTML=itemssl;

                }
            }
        })
    });
});

}