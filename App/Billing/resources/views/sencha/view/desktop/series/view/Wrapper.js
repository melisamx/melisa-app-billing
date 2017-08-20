Ext.define('Melisa.billing.view.desktop.series.view.Wrapper', {
    extend: 'Melisa.view.desktop.wrapper.panel.View',
    
    requires: [
        'Melisa.view.desktop.wrapper.panel.View',
        'Melisa.billing.view.desktop.series.view.Grid',
        'Melisa.billing.view.desktop.series.view.WrapperController',
        'Melisa.billing.view.universal.series.view.WrapperModel'
    ],
    
    iconCls: 'x-fa fa-money',
    cls: 'billing-series-view',
    controller: 'billingSeriesView',
    viewModel: {
        type: 'billingSeriesView'
    },
    items: [
        {
            xtype: 'billingSeriesViewGrid',
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
