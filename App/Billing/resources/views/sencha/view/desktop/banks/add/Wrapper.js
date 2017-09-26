Ext.define('Melisa.billing.view.desktop.banks.add.Wrapper', {
    extend: 'Melisa.view.desktop.wrapper.window.Add',
    
    requires: [
        'Melisa.billing.view.desktop.banks.add.Form',
        'Melisa.billing.view.desktop.banks.add.WrapperController'
    ],
    
    iconCls: 'x-fa fa-users',
    defaultFocus: 'txtKey',
    controller: 'billingBanksAdd',
    width: 400,
    height: 400,
    viewModel: {},
    items: [
        {
            xtype: 'billingBanksAddForm'
        }
    ]
});
