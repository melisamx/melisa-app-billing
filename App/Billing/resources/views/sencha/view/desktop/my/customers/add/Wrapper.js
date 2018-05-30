/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.my.customers.add.Wrapper",{extend:"Melisa.billing.view.desktop.customers.add.Wrapper",requires:["Melisa.billing.view.desktop.customers.add.Wrapper","Melisa.billing.view.desktop.my.customers.add.WrapperController","Melisa.billing.view.desktop.my.customers.add.Form","Melisa.billing.view.universal.my.customers.add.WrapperModel"],defaultFocus:"txtBusinessName",controller:"billingMyCustomersAdd",viewModel:{type:"billingMyCustomersAdd"},items:[{xtype:"billingMyCustomersAddForm"}]});