/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.customersAddresses.update.Wrapper",{extend:"Melisa.billing.view.desktop.customersAddresses.add.Wrapper",requires:["Melisa.billing.view.desktop.customersAddresses.add.Wrapper","Melisa.billing.view.desktop.customersAddresses.update.WrapperController"],controller:"billingCustomersAddressesUpdate",iconCls:"x-fa fa-pencil",viewModel:{data:{mode:"update",fieldsHidden:["id","idContributor"]}},listeners:{loaddata:"onLoadData",successloadremotedata:"onSuccessLoadData",beforeloaddata:"onBeforeLoadData"}});