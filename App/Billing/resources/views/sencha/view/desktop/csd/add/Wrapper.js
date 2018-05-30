/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.csd.add.Wrapper",{extend:"Melisa.view.desktop.wrapper.window.Add",requires:["Melisa.billing.view.desktop.csd.add.Form","Melisa.billing.view.desktop.csd.add.WrapperController"],iconCls:"x-fa fa-key",defaultFocus:"txtKey",controller:"billingCsdAdd",width:600,height:500,viewModel:{},items:[{xtype:"billingCsdAddForm"}]});