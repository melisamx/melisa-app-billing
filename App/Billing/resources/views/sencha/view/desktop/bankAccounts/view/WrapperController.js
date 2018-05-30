/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.bankAccounts.view.WrapperController",{extend:"Melisa.controller.View",alias:"controller.billingBankAccountsView",requires:["Melisa.controller.View"],listen:{global:{"event.billing.bankAccounts.update.success":"onUpdatedRecord","event.billing.bankAccounts.create.success":"onUpdatedRecord"}},storeReload:"bankAccounts",windowReportConfig:{title:"Cuenta bancaria"}});