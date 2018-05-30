/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.coins.AutoSelectMixin",{autoSelectCoin:function(a){var b,c=this,d=c.getViewModel();d.notify(),b=d.getStore("coins"),b.load({scope:c,callback:c.onLoadCoin,params:{query:a||"Peso Mexicano"}})},onLoadCoin:function(a,b,c){var d=this,e=d.getView();console.log(e),c&&!Ext.isEmpty(a)&&e.down("billingCoinsCombo").select(a[0])}});