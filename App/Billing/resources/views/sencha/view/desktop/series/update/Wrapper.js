/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.series.update.Wrapper",{extend:"Melisa.billing.view.desktop.series.add.Wrapper",requires:["Melisa.billing.view.desktop.series.add.Wrapper","Melisa.billing.view.desktop.series.update.WrapperController"],controller:"billingSeriesUpdate",viewModel:{data:{mode:"update"}},listeners:{loaddata:"onLoadData",successloadremotedata:"onSuccessLoadData",beforeloaddata:"onBeforeLoadData"}});