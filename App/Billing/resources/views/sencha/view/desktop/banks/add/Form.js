/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.banks.add.Form",{extend:"Ext.form.Panel",alias:"widget.billingBanksAddForm",defaults:{allowBlank:!1,anchor:"100%"},items:[{xtype:"numberfield",name:"key",fieldLabel:"Clave",itemId:"txtKey"},{xtype:"textfield",name:"shortname",fieldLabel:"Nombre corto"},{xtype:"textfield",name:"name",fieldLabel:"Nombre"},{xtype:"checkbox",name:"active",fieldLabel:"Activo",checked:!0}]});