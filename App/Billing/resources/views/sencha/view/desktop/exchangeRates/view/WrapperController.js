/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.exchangeRates.view.WrapperController",{extend:"Melisa.controller.View",alias:"controller.billingExchangeRatesView",requires:["Melisa.controller.View"],listen:{global:{"app.billing.exchangeRates.update.success":"onUpdatedRecord","app.billing.exchangeRates.create.success":"onUpdatedRecord"}},storeReload:"exchangeRates",windowReportConfig:{title:"Tipo de cambio"}});