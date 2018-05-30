/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.universal.customersAddresses.add.WrapperModel",{extend:"Ext.app.ViewModel",alias:"viewmodel.billingCustomersAddressesAdd",data:{fieldsHidden:["idContributor","idCustomer"]},stores:{countries:{proxy:{type:"ajax",url:"{modules.countries}",reader:{type:"json",rootProperty:"data"}}},states:{proxy:{type:"ajax",url:"{modules.states}",reader:{type:"json",rootProperty:"data"}}},municipalities:{proxy:{type:"ajax",url:"{modules.municipalities}",reader:{type:"json",rootProperty:"data"}}},settlements:{remoteFilter:!0,proxy:{type:"ajax",url:"{modules.settlements}",reader:{type:"json",rootProperty:"data"}}},accountingAccounts:{remoteFilter:!0,proxy:{type:"ajax",url:"{modules.accountingAccounts}",reader:{type:"json",rootProperty:"data"}}}}});