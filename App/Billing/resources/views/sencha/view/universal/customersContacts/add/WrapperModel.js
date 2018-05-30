/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.universal.customersContacts.add.WrapperModel",{extend:"Ext.app.ViewModel",alias:"viewmodel.billingCustomersContactsAdd",data:{fieldsHidden:["idCustomer"]},stores:{contacts:{proxy:{type:"ajax",url:"{modules.contacts}",reader:{type:"json",rootProperty:"data"}}}}});