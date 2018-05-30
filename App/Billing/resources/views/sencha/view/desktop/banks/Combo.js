/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.banks.Combo",{extend:"Melisa.view.desktop.ComboDefault",alias:"widget.billingBanksCombo",requires:["Melisa.view.desktop.ComboDefault"],fieldLabel:"Banco",itemId:"cmbBanks",name:"idBank",pageSize:25,allowBlank:!1,listConfig:{emptyText:"No se encontro el banco"},bind:{store:"{banks}",melisa:"{modules.banksAdd}"},triggers:{other:{cls:"x-form-trigger-default x-fa fa-plus",handler:"moduleRun",tooltip:"Agregar banco",focusOnMousedown:!0}}});