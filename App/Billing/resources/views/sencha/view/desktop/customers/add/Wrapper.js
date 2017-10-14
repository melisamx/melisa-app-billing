Ext.define('Melisa.billing.view.desktop.customers.add.Wrapper', {
    extend: 'Melisa.view.desktop.wrapper.window.Add',
    
    requires: [
        'Melisa.view.desktop.wrapper.window.Add',
        'Melisa.billing.view.desktop.customers.add.Form',
        'Melisa.billing.view.desktop.customers.add.WrapperController',
        'Melisa.billing.view.universal.customers.add.WrapperModel'
    ],
    
    iconCls: 'x-fa fa-users',
    defaultFocus: 'cmbRepositories',
    controller: 'billingCustomersAdd',
    plugins: 'responsive',
    responsiveConfig: {
        'width < 1200': {
            width: '100%',
            height: '100%'
        },
        'width >= 1201': {
            width: 1200,
            height: 680
        }
    },
    viewModel: {
        type: 'billingCustomersAdd'
    },
    items: [
        {
            xtype: 'billingCustomersAddForm'
        }
    ],
    bbar: {
        xtype: 'toolbardefault'
    }
});
