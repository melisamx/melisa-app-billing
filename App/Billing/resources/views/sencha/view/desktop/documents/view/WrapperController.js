/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.documents.view.WrapperController",{extend:"Melisa.controller.View",alias:"controller.billingInvoiceView",requires:["Melisa.controller.View"],listen:{global:{"event.billing.documents.cancel.success":"onUpdatedRecord"}},storeReload:"billing",windowReportConfig:{title:"Factura"},onClickBtnDownloadInvoicePdf:function(a){this.downloadFile(a,"pdf")},onClickBtnDownloadInvoiceXml:function(a){this.downloadFile(a,"xml")},downloadFile:function(a,b){var c=this,d=c.getViewModel().get("modules.filesView."+b),e=a.getViewModel().get("record"),f=[new Ext.Template(d).apply({id:e.get("id")}),"?nc=",(new Date).toTimeString()].join("");window.open(f,"__blank")}});