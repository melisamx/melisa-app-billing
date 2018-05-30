/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.reports.billsPaid.view.Grid",{extend:"Ext.grid.Panel",alias:"widget.billingReportsBillsPaidGrid",emptyText:"No hay facturas registradas",deferEmptyText:!0,bind:{store:"{billsPaid}"},columns:[{dataIndex:"name",text:"Razon social",flex:1},{dataIndex:"rfc",text:"RFC",align:"center",width:180},{dataIndex:"totalInvoices",text:"Número de facturas",align:"center",width:180},{dataIndex:"amount",text:"Total",align:"center",width:120,renderer:Ext.util.Format.usMoney}],bbar:{xtype:"pagingtoolbar",displayInfo:!0}});