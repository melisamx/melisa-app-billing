/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.customers.update.WrapperController",{extend:"Melisa.billing.view.desktop.customers.add.WrapperController",alias:"controller.billingCustomersUpdate",requires:["Melisa.controller.AppendFields","Melisa.controller.LoadData","Melisa.controller.Update"],mixins:{appendfields:"Melisa.controller.AppendFields",loaddata:"Melisa.controller.LoadData",update:"Melisa.controller.Update"},eventSuccess:"event.billing.customers.update.success",onSuccessLoadData:function(a){var b=this,c=b.getViewModel(),d=c.getStore("repositories"),e=c.getStore("waytopay");e.add(a.waytopay),d.add(a.repository),b.getView().down("form").getForm().setValues(a.contributor),b.mixins.update.onSuccessLoadData.call(b,a)}});