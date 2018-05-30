/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.universal.debtsToPay.view.WrapperModel",{extend:"Ext.app.ViewModel",alias:"viewmodel.billingDebtsToPayView",stores:{debtsToPay:{autoLoad:!0,remoteFilter:!0,proxy:{type:"ajax",url:"{modules.debtsToPay}",reader:{type:"json",rootProperty:"data"}},listeners:{datachanged:"onDataChangedDebtsToPay"}}}});