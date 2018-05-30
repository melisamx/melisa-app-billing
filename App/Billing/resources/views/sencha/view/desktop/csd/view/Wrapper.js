/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.csd.view.Wrapper",{extend:"Melisa.view.desktop.wrapper.panel.View",requires:["Melisa.view.desktop.wrapper.panel.View","Melisa.billing.view.desktop.csd.view.Grid","Melisa.billing.view.desktop.csd.view.WrapperController","Melisa.billing.view.universal.csd.view.WrapperModel"],iconCls:"x-fa fa-key",cls:"billing-csd-view",controller:"billingCsdView",viewModel:{type:"billingCsdView"},items:[{xtype:"billingCsdViewGrid",region:"center",listeners:{itemdblclick:"onShowItemReport"},plugins:[{ptype:"autofilters",filters:{name:{operator:"like",minChars:1},number:{operator:"like",minChars:1}},filtersIgnore:["dateExpiration","dateExpedition"]},{ptype:"floatingbutton",configButton:{handler:"moduleRun",iconCls:"x-fa fa-plus",scale:"large",tooltip:"Agregar certificado de sello digital",bind:{melisa:"{modules.add}",hidden:"{!modules.add.allowed}"}}}]}]});