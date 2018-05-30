/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.customerGroups.view.Identities",{extend:"Ext.grid.Panel",alias:"widget.billingCustomerGroupsViewIdentities",emptyText:"No hay perfiles en este grupo",deferEmptyText:!0,bind:{store:"{identities}"},columns:[{dataIndex:"id",text:"Id",hidden:!0},{dataIndex:"displayEspecific",text:"Nombre",flex:1},{xtype:"booleancolumn",dataIndex:"active",text:"Activo",aling:"center",width:90,bind:{hidden:"{hiddenColumns}"}},{xtype:"datecolumn",dataIndex:"createdAt",text:"Fecha creación",flex:1,hidden:!0,format:"d/m/Y h:i:s a"},{xtype:"datecolumn",dataIndex:"updatedAt",text:"Fecha modificación",flex:1,format:"d/m/Y h:i:s a",hidden:!0,bind:{hidden:"{hiddenColumns}"}},{xtype:"widgetcolumn",width:30,widget:{xtype:"button",iconCls:"x-fa fa-trash",tooltip:"Eliminar perfil del grupo",bind:{melisa:"{modules.identitiesDelete}",hidden:"{!modules.identitiesDelete.allowed}"},plugins:{ptype:"buttonconfirmation",messageSuccess:"Perfil eliminado del grupo"}}}],selModel:{selType:"checkboxmodel"},bbar:{xtype:"pagingtoolbar",displayInfo:!0},plugins:[{ptype:"floatingbutton",configButton:{iconCls:"x-fa fa-user",scale:"large",tooltip:"Agregar perfil al grupo",bind:{melisa:"{modules.identitiesAdd}",hidden:"{!modules.identitiesAdd.allowed}"},listeners:{click:"moduleRun",loaded:"onLoadedModuleAsociate"}}}]});