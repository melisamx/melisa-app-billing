/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.universal.customersBanksAccounts.add.WrapperModel",{extend:"Ext.app.ViewModel",alias:"viewmodel.billingCustomersBanksAccountsAdd",data:{fieldsHidden:["idCustomer"]},stores:{banks:{proxy:{type:"ajax",url:"{modules.banks}",reader:{type:"json",rootProperty:"data"}}},coins:{proxy:{type:"ajax",url:"{modules.coins}",reader:{type:"json",rootProperty:"data"}}}}});