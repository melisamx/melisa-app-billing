/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.documents.view.Wrapper",{extend:"Melisa.view.desktop.wrapper.panel.View",requires:["Melisa.view.desktop.wrapper.panel.View","Melisa.billing.view.desktop.documents.view.Grid","Melisa.billing.view.desktop.documents.view.WrapperController","Melisa.billing.view.universal.documents.view.WrapperModel"],iconCls:"x-fa fa-money",cls:"billing-documents-view",controller:"billingInvoiceView",viewModel:{type:"billingInvoiceView"},items:[{xtype:"billingInvoiceViewGrid",region:"center",reference:"griInvoice",listeners:{itemdblclick:"onShowItemReport"},plugins:[{ptype:"autofilters",filters:{status:{operator:"like",minChars:1},customer:{operator:"like"},total:{operator:"like",minChars:1},folio:{operator:"like",minChars:1},uuid:{operator:"like",minChars:1}}}]}]});