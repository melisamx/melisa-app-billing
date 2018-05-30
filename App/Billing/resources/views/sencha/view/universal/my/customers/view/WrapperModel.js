/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.universal.my.customers.view.WrapperModel",{extend:"Ext.app.ViewModel",alias:"viewmodel.billingMyCustomerView",stores:{customers:{autoLoad:!0,remoteFilter:!0,proxy:{type:"ajax",url:"{modules.customers}",reader:{type:"json",rootProperty:"data"}}},customersAddresses:{remoteFilter:!0,groupField:"bank",filters:[{property:"idContributor",value:"{customer.idContributor}",operator:"="}],proxy:{type:"ajax",url:"{modules.addresses}",reader:{type:"json",rootProperty:"data"}}}}});