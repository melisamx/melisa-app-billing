/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.my.customers.update.WrapperController",{extend:"Melisa.billing.view.desktop.my.customers.add.WrapperController",alias:"controller.billingMyCustomersUpdate",requires:["Melisa.controller.AppendFields","Melisa.controller.LoadData","Melisa.controller.Update"],mixins:{appendfields:"Melisa.controller.AppendFields",loaddata:"Melisa.controller.LoadData",update:"Melisa.controller.Update"},eventSuccess:"event.billing.my.customers.update.success",onSuccessLoadData:function(a){var b=this,c=b.getViewModel(),d=c.getStore("waytopay"),e=b.getView().down("form").getForm();d.add(a.waytopay),e.setValues(a.contributor),b.mixins.update.onSuccessLoadData.call(b,a)}});