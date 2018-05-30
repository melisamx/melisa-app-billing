/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.banks.view.WrapperController",{extend:"Melisa.controller.View",alias:"controller.billingBanksView",requires:["Melisa.controller.View"],listen:{global:{"event.billing.banks.update.success":"onUpdatedRecord","event.billing.banks.create.success":"onUpdatedRecord"}},storeReload:"banks",windowReportConfig:{title:"Banco"}});