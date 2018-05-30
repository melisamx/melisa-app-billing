/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.banks.update.Wrapper",{extend:"Melisa.billing.view.desktop.banks.add.Wrapper",requires:["Melisa.billing.view.desktop.banks.add.Wrapper","Melisa.billing.view.desktop.banks.update.WrapperController"],controller:"reserveEventsUpdate",listeners:{loaddata:"onLoadData",successloadremotedata:"onSuccessLoadData",beforeloaddata:"onBeforeLoadData"}});