/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.repositories.add.Wrapper",{extend:"Melisa.view.desktop.wrapper.window.Add",requires:["Melisa.billing.view.desktop.repositories.add.Form","Melisa.billing.view.desktop.repositories.add.WrapperController"],iconCls:"x-fa fa-database",defaultFocus:"txtName",controller:"billingRepositoriesAdd",width:400,height:480,viewModel:{},items:[{xtype:"billingRepositoriesAddForm"}]});