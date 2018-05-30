/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.accountsReceivable.add.WrapperController",{extend:"Melisa.controller.Create",alias:"controller.billingAccountsReceivableAddForm",eventSuccess:"event.billing.accountsReceivable.create.success",listeners:{selectedfile:"onSelectedFile"},control:{"#cmbAccounts":{select:"onSelectAccount"}},onSelectAccount:function(a,b){var c=this,d=c.getView(),e=d.down("#txtDueDate"),f=new Date;f.setDate(f.getDate()+b.get("expirationDays")),e.setValue(f)},onSelectedFile:function(a){var b=this,c=b.getView().down("#txtFileVoucher");c.setValue(a[0].get("id"))},onLoadedModuleSelectFile:function(a,b){a.fireEvent("loaddata",this,"selectedfile",{},b.launcher)}});