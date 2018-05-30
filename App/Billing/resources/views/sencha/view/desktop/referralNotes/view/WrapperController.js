/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.referralNotes.view.WrapperController",{extend:"Melisa.controller.View",alias:"controller.billingReferralNotesView",requires:["Melisa.controller.View"],listen:{global:{"event.billing.referralNotes.cancel.success":"onUpdatedRecord"}},storeReload:"billing",windowReportConfig:{title:"Factura"},onClickBtnDownloadInvoicePdf:function(a){this.downloadFile(a,"idFilePdf")},onClickBtnDownloadInvoiceXml:function(a){this.downloadFile(a,"idFileXml")},downloadFile:function(a,b){var c=this,d=c.getViewModel().get("modules.filesView"),e=a.getViewModel().get("record");window.open([d,e.get(b),"/?nc=",(new Date).toTimeString()].join(""),"__blank")}});