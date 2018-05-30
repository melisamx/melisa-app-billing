/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.exchangeRates.add.Wrapper",{extend:"Ext.window.Window",requires:["Melisa.core.Module","Melisa.billing.view.desktop.exchangeRates.add.Form","Melisa.billing.view.desktop.exchangeRates.add.WrapperController","Melisa.billing.view.universal.exchangeRates.add.WrapperModel"],mixins:["Melisa.core.Module"],width:"50%",iconCls:"x-fa fa-exchange",defaultFocus:"cmbCoins",controller:"billingExchangeRatesAdd",layout:"fit",minWidth:500,modal:!0,viewModel:{type:"billingExchangeRatesAdd"},items:[{xtype:"billingExchangeRatesAddForm"}],bbar:{xtype:"toolbardefault"}});