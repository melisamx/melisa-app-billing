/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.series.add.Form",{extend:"Ext.form.Panel",alias:"widget.billingSeriesAddForm",scrollable:!0,defaults:{anchor:"100%"},items:[{xtype:"textfield",fieldLabel:"Número de serie",name:"serie",itemId:"txtSerie"},{xtype:"numberfield",fieldLabel:"Folio inicial",name:"folioInitial"},{xtype:"checkbox",name:"isDefault",fieldLabel:"Es default"},{xtype:"checkbox",name:"active",fieldLabel:"Activo",checked:!0}]});