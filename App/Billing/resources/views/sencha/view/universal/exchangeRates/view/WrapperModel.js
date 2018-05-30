/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.universal.exchangeRates.view.WrapperModel",{extend:"Ext.app.ViewModel",alias:"viewmodel.billingExchangeRatesView",stores:{exchangeRates:{groupField:"date",groupDir:"desc",autoLoad:!0,remoteFilter:!0,proxy:{type:"ajax",url:"{modules.exchangeRates}",reader:{type:"json",rootProperty:"data"}}}}});