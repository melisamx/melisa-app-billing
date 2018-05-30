/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.customerGroupsIdentities.add.Form",{extend:"Ext.form.Panel",alias:"widget.billingCustomerGroupsIdentitiesAddForm",requires:["Melisa.security.view.desktop.identities.ComboDefault"],defaults:{anchor:"100%",allowBlank:!1},items:[{xtype:"securityIdentitiesComboDefault",fieldLabel:"Perfil a incluir en el grupo",name:"idIdentity",itemId:"cmbIdentities",pageSize:25,listConfig:{emptyText:"No hay perfiles",deferEmptyText:!1},bind:{store:"{identities}"}},{xtype:"checkbox",name:"active",fieldLabel:"Activo",checked:!0}]});