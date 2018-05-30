/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.my.customers.add.WrapperController",{extend:"Melisa.controller.Create",alias:"controller.billingMyCustomersAdd",requires:["Melisa.people.view.desktop.settlements.AutoSelectMixin","Melisa.people.view.desktop.countries.AutoSelectMixin"],mixins:{settlements:"Melisa.people.view.desktop.settlements.AutoSelectMixin",countries:"Melisa.people.view.desktop.countries.AutoSelectMixin"},eventSuccess:"event.billing.my.customers.create.success",control:{"#":{ready:"onLoadedModule"}},autoSelectSettlement:function(){var a=this,b=a.getView(),c=b.down("#txtAddress");c.focus(),a.mixins.settlements.autoSelectSettlement.apply(a,arguments)},onLoadedModule:function(){var a=this;a.mixins.countries.autoSelectCountry.apply(a)}});