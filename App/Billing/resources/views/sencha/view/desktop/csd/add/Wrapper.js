Ext.define('Melisa.billing.view.desktop.csd.add.Wrapper', {
    extend: 'Melisa.view.desktop.wrapper.window.Add',
    
    requires: [
        'Melisa.billing.view.desktop.csd.add.Form',
        'Melisa.billing.view.desktop.csd.add.WrapperController'
    ],
    
    iconCls: 'x-fa fa-key',
    defaultFocus: 'txtKey',
    controller: 'billingCsdAdd',
    width: 600,
    height: 500,
    viewModel: {},
    items: [
        {
            xtype: 'billingCsdAddForm'
        }
    ]
});
