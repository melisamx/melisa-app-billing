/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.customersAddresses.update.WrapperController",{extend:"Melisa.billing.view.desktop.customersAddresses.add.WrapperController",alias:"controller.billingCustomersAddressesUpdate",requires:["Melisa.billing.view.desktop.customersAddresses.add.WrapperController"],eventSuccess:"event.billing.customersAddresses.update.success",onBeforeLoadData:function(){},onSuccessLoadData:function(a){var b=this,c=b.getViewModel(),d=c.getStore("states"),e=c.getStore("countries"),f=c.getStore("municipalities"),g=c.getStore("accountingAccounts");e.add(a.country),d.add(a.state),f.add(a.municipality),Ext.isEmpty(a.accounting_account)||g.add(a.accounting_account),b.mixins.update.onSuccessLoadData.call(b,a)},onReadyModule:function(){}});