Ext.define('Melisa.billing.view.desktop.referralNotes.view.Wrapper', {
    extend: 'Melisa.view.desktop.wrapper.panel.View',
    
    requires: [
        'Melisa.view.desktop.wrapper.panel.View',
        'Melisa.billing.view.desktop.referralNotes.view.Grid',
        'Melisa.billing.view.desktop.referralNotes.view.WrapperController',
        'Melisa.billing.view.universal.referralNotes.view.WrapperModel'
    ],
    
    iconCls: 'x-fa fa-money',
    cls: 'billing-referralNotes-view',
    controller: 'billingReferralNotesView',
    viewModel: {
        type: 'billingReferralNotesView'
    },
    items: [
        {
            xtype: 'billingReferralNotesViewGrid',
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
