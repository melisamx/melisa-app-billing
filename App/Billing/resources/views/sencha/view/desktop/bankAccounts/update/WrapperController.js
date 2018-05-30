/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.bankAccounts.update.WrapperController",{extend:"Melisa.billing.view.desktop.bankAccounts.add.WrapperController",alias:"controller.billingBankAccountsUpdate",requires:["Melisa.billing.view.desktop.bankAccounts.add.WrapperController","Melisa.controller.AppendFields","Melisa.controller.LoadData","Melisa.controller.Update"],mixins:{appendfields:"Melisa.controller.AppendFields",loaddata:"Melisa.controller.LoadData",update:"Melisa.controller.Update"},eventSuccess:"event.billing.bankAccounts.update.success",onSuccessLoadData:function(a){var b=this,c=b.getViewModel(),d=c.getStore("banks");d.add(a.bank),b.mixins.update.onSuccessLoadData.call(b,a)}});