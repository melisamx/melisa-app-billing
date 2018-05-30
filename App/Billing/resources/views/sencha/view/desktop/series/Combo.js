/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.series.Combo",{extend:"Melisa.view.desktop.ComboDefault",alias:"widget.billingSeriesCombo",requires:["Melisa.view.desktop.ComboDefault"],fieldLabel:"Número de serie",name:"idSerie",displayField:"serie",pageSize:25,allowBlank:!1,listConfig:{emptyText:"No se encontro el número de serie"},bind:{store:"{series}",melisa:"{modules.seriesAdd}"},triggers:{other:{cls:"x-form-trigger-default x-fa fa-plus",handler:"moduleRun",tooltip:"Agregar número de serie",focusOnMousedown:!0}}});