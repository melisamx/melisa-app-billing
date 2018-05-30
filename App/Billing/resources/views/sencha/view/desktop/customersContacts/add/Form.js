/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.customersContacts.add.Form",{extend:"Ext.form.Panel",alias:"widget.billingCustomersContactsAddForm",defaults:{anchor:"100%"},items:[{xtype:"combodefault",fieldLabel:"Contacto a asociar",name:"idPeople",bind:{store:"{contacts}"}},{xtype:"checkbox",name:"active",fieldLabel:"Activo",checked:!0}]});