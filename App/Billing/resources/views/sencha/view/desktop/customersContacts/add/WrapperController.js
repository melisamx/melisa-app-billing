/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.customersContacts.add.WrapperController",{extend:"Melisa.controller.Create",alias:"controller.billingCustomersContactsAdd",requires:["Melisa.controller.AppendFields","Melisa.controller.LoadData","Melisa.controller.Update"],mixins:{appendfields:"Melisa.controller.AppendFields",loaddata:"Melisa.controller.LoadData",update:"Melisa.controller.Update"},control:{"#":{loaddata:"onLoadData",successloadremotedata:"onSuccessLoadData",beforeloaddata:"onBeforeLoadData"}},eventSuccess:"event.billing.customersContacts.create.success",onBeforeLoadData:function(a){var b=this;return console.log(a),b.getViewModel().set("idCustomer",a.id),b.mixins.update.onSuccessLoadData.call(b,{idCustomer:a.id}),!1}});