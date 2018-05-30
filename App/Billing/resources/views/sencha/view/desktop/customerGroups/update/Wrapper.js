/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.customerGroups.update.Wrapper",{extend:"Melisa.billing.view.desktop.customerGroups.add.Wrapper",requires:["Melisa.billing.view.desktop.customerGroups.add.Wrapper","Melisa.billing.view.desktop.customerGroups.update.WrapperController"],iconCls:"x-fa fa-pencil",controller:"billingCustomerGroupsUpdate",viewModel:{data:{mode:"update"}},listeners:{loaddata:"onLoadData",successloadremotedata:"onSuccessLoadData",beforeloaddata:"onBeforeLoadData"}});