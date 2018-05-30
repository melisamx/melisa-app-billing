/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.accountsReceivable.view.WrapperController",{extend:"Melisa.controller.View",alias:"controller.billingAccountsReceivableView",requires:["Melisa.controller.View"],listen:{global:{"event.billing.accountsReceivable.cancel.success":"onUpdatedRecord","event.billing.accountsReceivable.create.success":"onUpdatedRecord"}},storeReload:"accountsReceivable",windowReportConfig:{title:"Cuenta por cobrar"},onDataChangedAccountsReceivable:function(a){var b=this,c=b.getViewModel(),d=a.first(),e=d?d.get("totalCharged"):0,f=d?d.get("totalChargedExpired"):0;c.set({total:e,totalExpired:f})}});