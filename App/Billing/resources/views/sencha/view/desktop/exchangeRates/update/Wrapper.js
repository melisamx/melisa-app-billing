/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.exchangeRates.update.Wrapper",{extend:"Melisa.billing.view.desktop.exchangeRates.add.Wrapper",requires:["Melisa.billing.view.desktop.exchangeRates.add.Wrapper","Melisa.billing.view.desktop.exchangeRates.update.WrapperController"],controller:"billingExchangeRatesUpdate",iconCls:"x-fa fa-exchange",viewModel:{data:{mode:"update"}},listeners:{loaddata:"onLoadData",successloadremotedata:"onSuccessLoadData",successsubmit:"onSuccesssubmit",beforeloaddata:"onBeforeLoadData"}});