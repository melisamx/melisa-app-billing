/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.customerGroupsCustomers.add.Form",{extend:"Ext.form.Panel",alias:"widget.billingCustomerGroupsCustomersAddForm",defaults:{anchor:"100%",allowBlank:!1},items:[{xtype:"combodefault",fieldLabel:"Cliente a incluir en el grupo",name:"idCustomer",itemId:"cmbCustomers",pageSize:25,listConfig:{emptyText:"No hay clientes",deferEmptyText:!1},bind:{store:"{customers}"}},{xtype:"checkbox",name:"active",fieldLabel:"Activo",checked:!0}]});