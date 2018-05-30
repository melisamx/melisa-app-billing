/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.banks.view.Wrapper",{extend:"Melisa.view.desktop.wrapper.panel.View",requires:["Melisa.view.desktop.wrapper.panel.View","Melisa.billing.view.desktop.banks.view.Grid","Melisa.billing.view.desktop.banks.view.WrapperController","Melisa.billing.view.universal.banks.view.WrapperModel"],iconCls:"x-fa fa-university",cls:"billing-banks-view",controller:"billingBanksView",viewModel:{type:"billingBanksView"},items:[{xtype:"billingBanksViewGrid",region:"center",listeners:{itemdblclick:"onShowItemReport"},plugins:[{ptype:"autofilters",filters:{key:{operator:"like",minChars:1},shortname:{operator:"like"},name:{operator:"like"}}},{ptype:"floatingbutton",configButton:{handler:"moduleRun",iconCls:"x-fa fa-plus",scale:"large",tooltip:"Agregar banco",bind:{melisa:"{modules.add}",hidden:"{!modules.add.allowed}"}}}]}]});