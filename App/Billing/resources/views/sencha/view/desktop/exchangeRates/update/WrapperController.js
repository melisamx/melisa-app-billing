/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.exchangeRates.update.WrapperController",{extend:"Melisa.billing.view.desktop.exchangeRates.add.WrapperController",alias:"controller.billingExchangeRatesUpdate",requires:["Melisa.controller.AppendFields","Melisa.controller.LoadData","Melisa.controller.Update"],mixins:{appendfields:"Melisa.controller.AppendFields",loaddata:"Melisa.controller.LoadData",update:"Melisa.controller.Update"},onSuccessLoadData:function(a){var b=this,c=b.getViewModel(),d=c.getStore("coins");d.add(a.coin),b.mixins.update.onSuccessLoadData.call(b,a)},onSuccesssubmit:function(a,b,c){Ext.GlobalEvents.fireEvent("app.billing.exchangeRates.update.success",c.result)}});