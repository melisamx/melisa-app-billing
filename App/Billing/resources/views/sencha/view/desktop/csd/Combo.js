/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.csd.Combo",{extend:"Melisa.view.desktop.ComboDefault",alias:"widget.billingCsdCombo",requires:["Melisa.view.desktop.ComboDefault"],fieldLabel:"Certificado de sello digital",name:"idCsd",pageSize:25,allowBlank:!1,listConfig:{emptyText:"No se encontro certificado de sello digital"},bind:{store:"{csd}",melisa:"{modules.csdAdd}"},triggers:{other:{cls:"x-form-trigger-default x-fa fa-plus",handler:"moduleRun",tooltip:"Agregar certificado de sello digital",focusOnMousedown:!0}}});