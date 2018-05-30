/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.debtsToPay.payoff.WrapperController",{extend:"Melisa.controller.Create",alias:"controller.billingDebtsToPayPayoff",requires:["Melisa.controller.AppendFields","Melisa.controller.LoadData","Melisa.controller.Update"],mixins:{appendfields:"Melisa.controller.AppendFields",loaddata:"Melisa.controller.LoadData",update:"Melisa.controller.Update"},eventSuccess:"event.billing.debtsToPay.payoff.success",listeners:{selectedfile:"onSelectedFile"},onSuccessLoadData:function(a){var b=this,c=b.getView();c.setTitle([c.getTitle()," de ",a.provider.name].join("")),a.paymentDate=new Date,b.mixins.update.onSuccessLoadData.call(b,a)},onSelectedFile:function(a){var b=this,c=b.getView().down("#txtFilePayment");c.setValue(a[0].get("id"))},onLoadedModuleSelectFile:function(a,b){a.fireEvent("loaddata",this,"selectedfile",{},b.launcher)}});