Ext.define('Melisa.billing.view.desktop.exchangeRates.view.Wrapper', {
    extend: 'Ext.panel.Panel',
    
    requires: [
        'Melisa.core.Module',
        'Melisa.ux.grid.Filters',
        'Melisa.ux.FloatingButton',
        'Melisa.ux.confirmation.Button',
        'Melisa.billing.view.desktop.exchangeRates.view.Grid',
        'Melisa.billing.view.desktop.exchangeRates.view.WrapperController',
        'Melisa.billing.view.universal.exchangeRates.view.WrapperModel'
    ],
    
    mixins: [
        'Melisa.core.Module'
    ],
    
    iconCls: 'x-fa fa-exchange',
    layout: 'border',
    controller: 'billingExchangeRatesView',
    reference: 'wrapper',
    viewModel: {
        type: 'billingExchangeRatesView'
    },
    items: [
        {
            xtype: 'billingExchangeRatesViewGrid',
            region: 'center',
            listeners: {
                itemdblclick: 'onShowItemReport'
            },
            plugins: [
                {
                    ptype: 'autofilters',
                    filters: {
                        coin: {
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
