/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.my.customers.update.Form",{extend:"Ext.form.Panel",alias:"widget.billingMyCustomersUpdateForm",defaults:{xtype:"container",layout:"hbox",defaults:{allowBlank:!1,flex:1}},items:[{items:[{xtype:"textfield",fieldLabel:"Nombre",name:"name",itemId:"txtBusinessName",margin:"0 10 0 0"},{xtype:"textfield",fieldLabel:"R. F. C.",name:"rfc",flex:null,maxLength:13,width:140}]},{items:[{xtype:"combodefault",fieldLabel:"Forma de pago",name:"idWaytopay",margin:"0 10 0 0",pageSize:25,bind:{store:"{waytopay}"}},{xtype:"textfield",fieldLabel:"Correo electrónico",name:"email",vtype:"email",allowBlank:!0}]},{xtype:"checkbox",name:"active",fieldLabel:"Activo",checked:!0}]});