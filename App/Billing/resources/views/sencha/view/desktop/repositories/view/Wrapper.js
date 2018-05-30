/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.repositories.view.Wrapper",{extend:"Melisa.view.desktop.wrapper.panel.View",requires:["Melisa.view.desktop.wrapper.panel.View","Melisa.billing.view.desktop.repositories.view.Grid","Melisa.billing.view.desktop.repositories.view.WrapperController","Melisa.billing.view.universal.repositories.view.WrapperModel"],iconCls:"x-fa fa-database",cls:"billing-repositories-view",controller:"billingRepositoriesView",viewModel:{type:"billingRepositoriesView"},items:[{xtype:"billingRepositoriesViewGrid",region:"center",plugins:[{ptype:"autofilters",filters:{key:{operator:"like",minChars:1},shortname:{operator:"like"},name:{operator:"like"}}},{ptype:"floatingbutton",configButton:{handler:"moduleRun",iconCls:"x-fa fa-plus",scale:"large",tooltip:"Agregar cliente base",bind:{melisa:"{modules.add}",hidden:"{!modules.add.allowed}"}}}]}]});