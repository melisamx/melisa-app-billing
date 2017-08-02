Ext.define('Melisa.billing.view.desktop.invoice.view.Wrapper', {
    extend: 'Melisa.view.desktop.wrapper.panel.View',
    
    requires: [
        'Melisa.view.desktop.wrapper.panel.View',
        'Melisa.billing.view.desktop.invoice.view.Grid',
        'Melisa.billing.view.desktop.invoice.view.WrapperController',
        'Melisa.billing.view.universal.invoice.view.WrapperModel'
    ],
    
    iconCls: 'x-fa fa-money',
    cls: 'billing-invoice-view',
    controller: 'billingInvoiceView',
    viewModel: {
        type: 'billingInvoiceView'
    },
    items: [
        {
            xtype: 'billingInvoiceViewGrid',
            region: 'center',
            listeners: {
                itemdblclick: 'onShowItemReport'
            },
            plugins: [
                {
                    ptype: 'autofilters',
                    filters: {
                        key: {
                            operator: 'like',
                            minChars: 1
                        },
                        shortname: {
                            operator: 'like'
                        },
                        name: {
                            operator: 'like'
                        }
                    }
                }
            ]
        }
    ]
});
