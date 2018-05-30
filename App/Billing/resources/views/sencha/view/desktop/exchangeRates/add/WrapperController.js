/*!
 * Melisa Tasks 1.0.0
 * Copyright (c) 2014-2017 Melisa
 * 2018-04-04 04:04:41
 */
Ext.define("Melisa.billing.view.desktop.exchangeRates.add.WrapperController",{extend:"Melisa.controller.Create",alias:"controller.billingExchangeRatesAdd",requires:["Melisa.billing.view.universal.exchangeRates.add.WrapperController"],mixins:{universal:"Melisa.billing.view.universal.exchangeRates.add.WrapperController"},control:{"#":{successsubmit:"onSuccesssubmit"}},save:function(){var a=this;a.mixins.universal.beforeSave.call(a),a.callParent()},onSuccesssubmit:function(a,b,c){Ext.GlobalEvents.fireEvent("app.billing.exchangeRates.create.success",c.result)},onChangeDate:function(){var a=this,b=a.getView(),c=a.lookup("dfDate").getValue(),d=Ext.util.Format.date(c,"d/m/Y");b.down("#conLinkDOF").setData({dates:Ext.Object.toQueryString({dfecha:d,hfecha:d})})}});