Ext.define('Melisa.billing.view.desktop.customersAddresses.add.Wrapper', {
    extend: 'Melisa.view.desktop.wrapper.window.Add',
    
    requires: [
        'Melisa.view.desktop.wrapper.window.Add',
        'Melisa.billing.view.desktop.customersAddresses.add.Form',
        'Melisa.billing.view.desktop.customersAddresses.add.WrapperController',
        'Melisa.billing.view.universal.customersAddresses.add.WrapperModel'
    ],
    
    iconCls: 'x-fa fa-map-marker',
    defaultFocus: 'peopleSettlementsPostalCode',
    controller: 'billingCustomersAddressesAdd',
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
        type: 'billingCustomersAddressesAdd'
    },
    items: [
        {
            xtype: 'billingCustomersAddressesAddForm'
        }
    ],
    bbar: {
        xtype: 'toolbardefault'
    }
});
