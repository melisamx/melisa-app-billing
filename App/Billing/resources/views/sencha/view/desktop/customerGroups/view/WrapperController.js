/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.customerGroups.view.WrapperController",{extend:"Melisa.controller.View",alias:"controller.billingCustomerGroupsView",requires:["Melisa.controller.View"],listen:{global:{"app.billing.customerGroups.update.success":"onUpdatedRecord","app.billing.customerGroups.create.success":"onUpdatedRecord","app.billing.customerGroupsCustomers.create.success":"onReloadCustomers","app.billing.customerGroupsIdentities.create.success":"onReloadIdentities"}},storeReload:"customerGroups",windowReportConfig:{title:"Grupo de clientes"},onReloadCustomers:function(){this.getViewModel().getStore("customers").load()},onReloadIdentities:function(){this.getViewModel().getStore("identities").load()},onSelectionChangeCustomers:function(a,b){var c=this,d=c.getViewModel(),e=c.getView();return Ext.isEmpty(b)?(d.set("hiddenColumns",!1),d.getStore("customers").removeAll(),d.getStore("identities").removeAll(),void e.down("#panDetails").collapse()):(e.down("#panDetails").expand(),d.set("hiddenColumns",!0),d.set("idCustomerGroup",b[0].get("id")),d.notify(),void Ext.defer(function(){d.getStore("customers").load(),d.getStore("identities").load()},500))},onLoadedModuleAsociate:function(a,b){var c=this,d=c.lookup("griCustomerGroups");console.log(d),a.fireEvent("loaddata",{id:d.getSelection()[0].get("id")},b.launcher)},onAfterRenderDetails:function(a){a.collapse()}});