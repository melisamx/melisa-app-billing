/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.csd.view.Grid",{extend:"Ext.grid.Panel",alias:"widget.billingCsdViewGrid",emptyText:"No hay certificados de sello digital registrados",deferEmptyText:!0,bind:{store:"{csd}"},columns:[{dataIndex:"id",text:"Id",hidden:!0},{dataIndex:"name",text:"Nombre",flex:1},{dataIndex:"number",text:"Número de certificado",width:280},{xtype:"datecolumn",dataIndex:"dateExpedition",text:"Fecha de expedición",format:"d/m/Y h:i:s a",width:200},{xtype:"datecolumn",dataIndex:"dateExpiration",text:"Fecha de expiración",format:"d/m/Y h:i:s a",width:200},{xtype:"widgetcolumn",width:30,widget:{xtype:"button",iconCls:"x-fa fa-trash",tooltip:"Eliminar certificado",bind:{melisa:"{modules.delete}",hidden:"{!modules.delete.allowed}"},plugins:{ptype:"buttonconfirmation",messageSuccess:"Certificado eliminado"}}}],selModel:{selType:"checkboxmodel"},bbar:{xtype:"pagingtoolbar",displayInfo:!0}});