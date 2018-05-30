/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.universal.customerGroupsIdentities.add.WrapperModel",{extend:"Ext.app.ViewModel",alias:"viewmodel.billingCustomerGroupsIdentitiesAdd",data:{fieldsHidden:["idCustomerGroup"]},stores:{identities:{proxy:{type:"ajax",url:"{modules.identities}",reader:{type:"json",rootProperty:"data"}}}}});