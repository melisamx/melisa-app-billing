/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.universal.documents.view.WrapperModel",{extend:"Ext.app.ViewModel",alias:"viewmodel.billingInvoiceView",stores:{documents:{autoLoad:!0,remoteFilter:!0,proxy:{type:"ajax",url:"{modules.documents}",reader:{type:"json",rootProperty:"data"}}}}});