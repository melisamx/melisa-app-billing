/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.bankAccounts.update.Wrapper",{extend:"Melisa.billing.view.desktop.bankAccounts.add.Wrapper",requires:["Melisa.billing.view.desktop.bankAccounts.add.Wrapper","Melisa.billing.view.desktop.bankAccounts.update.WrapperController"],controller:"billingBankAccountsUpdate",listeners:{loaddata:"onLoadData",successloadremotedata:"onSuccessLoadData",beforeloaddata:"onBeforeLoadData"}});