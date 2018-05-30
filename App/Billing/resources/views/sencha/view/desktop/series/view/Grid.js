/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.series.view.Grid",{extend:"Ext.grid.Panel",alias:"widget.billingSeriesViewGrid",emptyText:"No hay series registradas",deferEmptyText:!0,bind:{store:"{series}"},columns:[{dataIndex:"id",text:"Id",hidden:!0},{dataIndex:"serie",text:"Serie",flex:1},{dataIndex:"folioInitial",text:"Folio inicial",width:280},{dataIndex:"folioCurrent",text:"Folio actual",width:280},{xtype:"datecolumn",dataIndex:"createdAt",text:"Fecha creación",flex:1,hidden:!0,format:"d/m/Y h:i:s a"},{xtype:"datecolumn",dataIndex:"updatedAt",text:"Fecha modificación",flex:1,format:"d/m/Y h:i:s a",hidden:!0,bind:{hidden:"{hiddenColumns}"}},{xtype:"widgetcolumn",width:30,widget:{xtype:"button",iconCls:"x-fa fa-pencil",tooltip:"Modificar serie",bind:{melisa:"{modules.update}",hidden:"{!modules.update.allowed}"},listeners:{click:"moduleRun",loaded:"onLoadedModuleUpdate"}}},{xtype:"widgetcolumn",width:30,widget:{xtype:"button",iconCls:"x-fa fa-trash",tooltip:"Eliminar serie",bind:{melisa:"{modules.delete}",hidden:"{!modules.delete.allowed}"},plugins:{ptype:"buttonconfirmation",messageSuccess:"Serie eliminada"}}}],selModel:{selType:"checkboxmodel"},bbar:{xtype:"pagingtoolbar",displayInfo:!0}});