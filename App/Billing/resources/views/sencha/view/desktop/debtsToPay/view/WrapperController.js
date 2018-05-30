/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.debtsToPay.view.WrapperController",{extend:"Melisa.controller.View",alias:"controller.billingDebtsToPayView",requires:["Melisa.controller.View"],listen:{global:{"event.billing.debtsToPay.cancel.success":"onUpdatedRecord","event.billing.debtsToPay.create.success":"onUpdatedRecord","event.billing.debtsToPay.payoff.success":"onUpdatedRecord"}},storeReload:"debtsToPay",windowReportConfig:{title:"Cuenta por pagar"},onDataChangedDebtsToPay:function(a){var b=this,c=b.getViewModel(),d=a.first(),e=d?d.get("totalPayable"):0,f=d?d.get("totalPayableExpired"):0;c.set({total:e,totalExpired:f})}});