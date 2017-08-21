Ext.define('Melisa.billing.view.desktop.accountsReceivable.view.Wrapper', {
    extend: 'Melisa.view.desktop.wrapper.panel.View',
    
    requires: [
        'Melisa.view.desktop.wrapper.panel.View',
        'Melisa.billing.view.desktop.accountsReceivable.view.Grid',
        'Melisa.billing.view.desktop.accountsReceivable.view.WrapperController',
        'Melisa.billing.view.universal.accountsReceivable.view.WrapperModel'
    ],
    
    iconCls: 'x-fa fa-money',
    cls: 'billing-accountsReceivable-view',
    controller: 'billingAccountsReceivableView',
    viewModel: {
        type: 'billingAccountsReceivableView'
    },
    items: [
        {
            xtype: 'billingAccountsReceivableToPayViewGrid',
            region: 'center',
            listeners: {
                itemdblclick: 'onShowItemReport'
            },
            plugins: [
                {
                    ptype: 'autofilters',
                    filters: {
                        account: {
                            operator: 'like',
                            minChars: 1
                        }
                    }
                }
            ]
        }
    ],
    tbar: [
        '->',
        {
            xtype: 'label',
            text: 'Total vencido:'
        },
        {
            xtype: 'label',
            style: 'font-weight: bold; color: #E53935',
            bind: {
                text: '{totalExpired:usMoney}'
            }
        },
        {
            xtype: 'label',
            text: 'Total por cobrar:'
        },
        {
            xtype: 'label',
            style: 'font-weight: bold;',
            bind: {
                text: '{total:usMoney}'
            }
        }
    ]
});
