/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.coins.ComboDefault",{extend:"Melisa.view.desktop.ComboDefault",alias:"widget.billingCoinsCombo",fieldLabel:"Moneda",name:"idCoin",forceSelection:!0,pageSize:25,listConfig:{emptyText:"Moneda no encontrada"},bind:{store:"{coins}"}});