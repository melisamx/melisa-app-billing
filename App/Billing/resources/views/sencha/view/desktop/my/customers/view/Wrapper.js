Ext.define('Melisa.billing.view.desktop.my.customers.view.Wrapper', {
    extend: 'Ext.panel.Panel',
    
    requires: [
        'Melisa.core.Module',
        'Melisa.ux.grid.Filters',
        'Melisa.ux.FloatingButton',
        'Melisa.ux.confirmation.Button',
        'Melisa.billing.view.desktop.my.customers.view.Grid',
        'Melisa.billing.view.desktop.my.customers.view.WrapperController',
        'Melisa.billing.view.desktop.my.customers.addresses.Grid',
        'Melisa.billing.view.universal.my.customers.view.WrapperModel'
    ],
    
    mixins: [
        'Melisa.core.Module'
    ],
    
    iconCls: 'x-fa fa-users',
    cls: 'billing-customers-view',
    layout: 'border',
    controller: 'billingMyCustomersView',
    reference: 'wrapper',
    viewModel: {
        type: 'billingMyCustomerView'
    },
    items: [
        {
            xtype: 'billingMyCustomerViewGrid',
            region: 'center',
            reference: 'griCustomers',
            listeners: {
                itemdblclick: 'onShowItemReport'
            },
            plugins: [
                {
                    ptype: 'autofilters',
                    filters: {
                        name: {
                            operator: 'like'
                        },
                        rfc: {
                            operator: 'like'
                        },
                        email: {
                            operator: 'like'
                        }
                    }
                },
                {
                    ptype: 'floatingbutton',
                    configButton: {
                        handler: 'moduleRun',
                        iconCls: 'x-fa fa-plus',
                        scale: 'large',
                        tooltip: 'Agregar cliente',
                        bind: {
                            melisa: '{modules.add}',
                            hidden: '{!modules.add.allowed}'
                        }
                    }
                }
            ]
        }
    ]
});
