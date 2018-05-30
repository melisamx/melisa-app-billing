/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.universal.exchangeRates.add.WrapperModel",{extend:"Ext.app.ViewModel",alias:"viewmodel.billingExchangeRatesAdd",stores:{coins:{proxy:{type:"ajax",url:"{modules.coins}",reader:{type:"json",rootProperty:"data"}}}}});