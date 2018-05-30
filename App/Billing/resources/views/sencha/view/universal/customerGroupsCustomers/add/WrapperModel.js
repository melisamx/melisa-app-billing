/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.universal.customerGroupsCustomers.add.WrapperModel",{extend:"Ext.app.ViewModel",alias:"viewmodel.billingCustomerGroupsCustomersAdd",data:{fieldsHidden:["idCustomerGroup"]},stores:{customers:{proxy:{type:"ajax",url:"{modules.customers}",reader:{type:"json",rootProperty:"data"}}}}});