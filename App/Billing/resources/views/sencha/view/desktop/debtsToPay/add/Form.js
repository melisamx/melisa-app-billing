/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.debtsToPay.add.Form",{extend:"Ext.form.Panel",alias:"widget.billingDebtsToPayAddForm",defaults:{allowBlank:!1,anchor:"100%"},items:[{xtype:"combodefault",name:"idProvider",itemId:"cmbProviders",fieldLabel:"Provedor",bind:{store:"{providers}"}},{xtype:"numberfield",name:"amountPayable",fieldLabel:"Monto a pagar"},{xtype:"datefield",name:"dateVoucher",fieldLabel:"Fecha del comprobante",value:new Date},{xtype:"datefield",name:"dueDate",fieldLabel:"Fecha de vencimiento",itemId:"txtDueDate"},{xtype:"textfield",fieldLabel:"Comprobante",name:"idFileVoucher",itemId:"txtFileVoucher",bind:{melisa:"{modules.filesSelect}",hidden:"{!modules.filesSelect.allowed}"},triggers:{foo:{handler:"moduleRun"}},listeners:{loaded:"onLoadedModuleSelectFile"}}]});