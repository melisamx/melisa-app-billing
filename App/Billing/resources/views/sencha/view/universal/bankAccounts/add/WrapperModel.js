/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.universal.bankAccounts.add.WrapperModel",{extend:"Ext.app.ViewModel",alias:"viewmodel.billingBankAccountsAdd",stores:{banks:{autoLoad:!1,remoteFilter:!0,proxy:{type:"ajax",url:"{modules.banks}",reader:{type:"json",rootProperty:"data"}}}}});