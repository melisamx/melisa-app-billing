/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.customersBanksAccounts.add.Form",{extend:"Ext.form.Panel",alias:"widget.billingCustomersBanksAccountsAddForm",defaults:{anchor:"100%"},items:[{xtype:"combodefault",fieldLabel:"Banco",name:"idBank",itemId:"txtBank",bind:{store:"{banks}"}},{xtype:"combodefault",fieldLabel:"Moneda",name:"idCoin",bind:{store:"{coins}"}},{xtype:"textfield",name:"account",fieldLabel:"Cuenta"},{xtype:"checkbox",name:"active",fieldLabel:"Activo",checked:!0}]});