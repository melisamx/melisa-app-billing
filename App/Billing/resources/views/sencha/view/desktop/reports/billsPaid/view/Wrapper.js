Ext.define('Melisa.billing.view.desktop.reports.billsPaid.view.Wrapper', {
    extend: 'Melisa.view.desktop.wrapper.panel.View',
    
    requires: [
        'Melisa.view.desktop.wrapper.panel.View',
        'Melisa.billing.view.desktop.reports.billsPaid.view.Grid',
        'Melisa.billing.view.desktop.reports.billsPaid.view.WrapperController',
        'Melisa.billing.view.universal.reports.billsPaid.view.WrapperModel'
    ],
    
    iconCls: 'x-fa fa-money',
    cls: 'billing-documents-view',
    controller: 'billingReportsBillsPaid',
    viewModel: {
        type: 'billingReportsBillsPaid'
    },
    items: [
        {
            xtype: 'billingReportsBillsPaidGrid',
            region: 'center',
            plugins: [
                {
                    ptype: 'autofilters',
                    filters: {
                        name: {
                            operator: 'like',
                            minChars: 1
                        },
                        rfc: {
                            operator: 'like',
                            minChars: 1
                        }
                    },
                    filtersIgnore: [
                        'total',
                        'amount',
                        'totalInvoices'
                    ]
                }
            ]
        }
    ]
});
