/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.csd.add.WrapperController",{extend:"Melisa.controller.Create",alias:"controller.billingCsdAdd",eventSuccess:"event.billing.csd.create.success",listeners:{selectedfilecer:"onSelectedFileCer",selectedfilekey:"onSelectedFileKey"},onSelectedFileKey:function(a){var b=this,c=b.getView().down("#txtFileKey");c.setValue(a[0].get("id"))},onSelectedFileCer:function(a){var b=this,c=b.getView().down("#txtFileCer");c.setValue(a[0].get("id"))},onLoadedModuleSelectFileCer:function(a,b){a.fireEvent("loaddata",this,"selectedfilecer",{},b.launcher)},onLoadedModuleSelectFileKey:function(a,b){a.fireEvent("loaddata",this,"selectedfilekey",{},b.launcher)}});