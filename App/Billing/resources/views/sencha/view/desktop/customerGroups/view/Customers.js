/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.customerGroups.view.Customers",{extend:"Ext.grid.Panel",alias:"widget.billingCustomerGroupsViewCustomers",emptyText:"No hay clientes en este grupo",deferEmptyText:!0,bind:{store:"{customers}"},columns:[{dataIndex:"id",text:"Id",hidden:!0},{dataIndex:"name",text:"Nombre",flex:1},{dataIndex:"rfc",text:"RFC",width:150,bind:{hidden:"{hiddenColumns}"}},{dataIndex:"paymentMethod",text:"Método de pago",width:160,bind:{hidden:"{hiddenColumns}"}},{xtype:"booleancolumn",dataIndex:"active",text:"Activo",aling:"center",width:90,bind:{hidden:"{hiddenColumns}"}},{xtype:"datecolumn",dataIndex:"createdAt",text:"Fecha creación",flex:1,hidden:!0,format:"d/m/Y h:i:s a"},{xtype:"datecolumn",dataIndex:"updatedAt",text:"Fecha modificación",flex:1,format:"d/m/Y h:i:s a",hidden:!0,bind:{hidden:"{hiddenColumns}"}},{xtype:"widgetcolumn",width:30,widget:{xtype:"button",iconCls:"x-fa fa-trash",tooltip:"Eliminar cliente del grupo",bind:{melisa:"{modules.customersDelete}",hidden:"{!modules.customersDelete.allowed}"},plugins:{ptype:"buttonconfirmation",messageSuccess:"Cliente eliminado del grupo"}}}],selModel:{selType:"checkboxmodel"},bbar:{xtype:"pagingtoolbar",displayInfo:!0},plugins:[{ptype:"floatingbutton",configButton:{iconCls:"x-fa fa-plus",scale:"large",tooltip:"Agregar cliente al grupo",bind:{melisa:"{modules.customersAdd}",hidden:"{!modules.customersAdd.allowed}"},listeners:{click:"moduleRun",loaded:"onLoadedModuleAsociate"}}}]});