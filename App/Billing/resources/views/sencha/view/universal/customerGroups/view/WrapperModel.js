/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.universal.customerGroups.view.WrapperModel",{extend:"Ext.app.ViewModel",alias:"viewmodel.billingCustomerGroupsView",stores:{customerGroups:{autoLoad:!0,remoteFilter:!0,proxy:{type:"ajax",url:"{modules.customerGroups}",reader:{type:"json",rootProperty:"data"}}},customers:{remoteFilter:!0,filters:[{property:"idCustomerGroup",value:"{idCustomerGroup}",operator:"="}],proxy:{type:"ajax",url:"{modules.customers}",reader:{type:"json",rootProperty:"data"}}},identities:{remoteFilter:!0,filters:[{property:"idCustomerGroup",value:"{idCustomerGroup}",operator:"="}],proxy:{type:"ajax",url:"{modules.identities}",reader:{type:"json",rootProperty:"data"}}}}});