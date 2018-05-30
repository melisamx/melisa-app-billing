/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.bankAccounts.add.Form",{extend:"Ext.form.Panel",alias:"widget.billingBankAccountsAddForm",requires:["Melisa.billing.view.desktop.banks.Combo"],defaults:{allowBlank:!1,anchor:"100%"},items:[{xtype:"billingBanksCombo"},{xtype:"textfield",name:"name",fieldLabel:"Nombre"},{xtype:"textfield",name:"accountNumber",fieldLabel:"Cuenta"},{xtype:"numberfield",name:"beginningBalance",fieldLabel:"Saldo inicial"},{xtype:"checkbox",name:"active",fieldLabel:"Activo",checked:!0}]});