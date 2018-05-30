/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.banks.add.Wrapper",{extend:"Melisa.view.desktop.wrapper.window.Add",requires:["Melisa.billing.view.desktop.banks.add.Form","Melisa.billing.view.desktop.banks.add.WrapperController"],iconCls:"x-fa fa-users",defaultFocus:"txtKey",controller:"billingBanksAdd",width:400,height:400,viewModel:{},items:[{xtype:"billingBanksAddForm"}]});