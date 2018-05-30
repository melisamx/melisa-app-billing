/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.customerGroups.add.Form",{extend:"Ext.form.Panel",alias:"widget.billingCustomerGroupsAddForm",defaults:{anchor:"100%"},items:[{xtype:"textfield",fieldLabel:"Nombre",name:"name",itemId:"txtName",allowBlank:!1},{xtype:"checkbox",name:"active",fieldLabel:"Activo",checked:!0}]});