/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.repositories.add.Form",{extend:"Ext.form.Panel",alias:"widget.billingRepositoriesAddForm",defaults:{allowBlank:!1,anchor:"100%"},items:[{xtype:"textfield",name:"name",fieldLabel:"Nombre",itemId:"txtName"},{xtype:"numberfield",name:"expirationDays",fieldLabel:"Días de vencimiento"},{xtype:"container",layout:"hbox",defaults:{flex:1},items:[{xtype:"checkbox",name:"active",fieldLabel:"Activo",maring:"0 10 0 0",checked:!0},{xtype:"checkbox",name:"allowChangeQuota",fieldLabel:"Permitir cambiar cuota",checked:!1}]},{xtype:"numberfield",name:"quota",fieldLabel:"Cuota",allowDecimals:!0}]});