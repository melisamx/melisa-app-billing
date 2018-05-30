/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.series.add.Wrapper",{extend:"Melisa.view.desktop.wrapper.window.Add",requires:["Melisa.view.desktop.wrapper.window.Add","Melisa.billing.view.desktop.series.add.Form","Melisa.billing.view.desktop.series.add.WrapperController"],iconCls:"x-fa fa-money",defaultFocus:"txtSerie",controller:"billingSeriesAdd",plugins:"responsive",width:600,height:500,viewModel:{},items:[{xtype:"billingSeriesAddForm"}],bbar:{xtype:"toolbardefault"}});