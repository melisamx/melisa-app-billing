/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.csd.add.Form",{extend:"Ext.form.Panel",alias:"widget.billingCsdAddForm",defaults:{allowBlank:!1,anchor:"100%"},items:[{xtype:"textfield",fieldLabel:"Archivo cer",name:"idFileCer",itemId:"txtFileCer",bind:{melisa:"{modules.filesSelect}",hidden:"{!modules.filesSelect.allowed}"},triggers:{foo:{handler:"moduleRun"}},listeners:{loaded:"onLoadedModuleSelectFileCer"}},{xtype:"textfield",fieldLabel:"Archivo key",name:"idFileKey",itemId:"txtFileKey",bind:{melisa:"{modules.filesSelect}",hidden:"{!modules.filesSelect.allowed}"},triggers:{foo:{handler:"moduleRun"}},listeners:{loaded:"onLoadedModuleSelectFileKey"}},{xtype:"textfield",name:"password",fieldLabel:"Contraseña",inputType:"password",autoComplete:!1}]});