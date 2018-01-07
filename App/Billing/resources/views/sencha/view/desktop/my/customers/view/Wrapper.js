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
        'Melisa.billing.view.universal.my.customers.view.WrapperModel',
    ],
    
    mixins: [
        'Melisa.core.Module'
    ],
    
    iconCls: 'x-fa fa-users',
    cls: 'billing-customers-view',
    layout: 'card',
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
                itemdblclick: 'onShowItemReport',
                selectionchange: 'onSelectionChangeCustomers'
            },
            actions: {
                viewAddresses: {
                    text: 'Ver direcciones',
                    iconCls: 'x-fa fa-map-marker',
                    handler: 'onClicBtnViewAddresses',
                    disabled: true
                }
            },
            tbar: [
                '@viewAddresses'
            ],
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
        },
        {
            xtype: 'billingMyCustomersAddressesGrid',
            tbar: [
                {
                    xtype: 'toolbar',
                    layout: {
                        type: 'hbox',
                        align: 'middle'
                    },
                    items: [
                        {
                            scale: 'large',
                            iconCls: 'x-fa fa-chevron-left',
                            handler: 'onClicBtnReturn'
                        },
                        {
                            xtype: 'label',
                            bind: {
                                html: [
                                    '<b>Cliente</b>: {customer.name}',
                                    '<b>RFC</b>: {customer.rfc}'
                                ].join('<br>')
                            }
                        }
                    ]
                }
            ],
            plugins: [
                {
                    ptype: 'autofilters',
                    filters: {
                        country: {
                            operator: 'like'
                        },
                        state: {
                            operator: 'like'
                        },
                        municipality: {
                            operator: 'like'
                        }
                    },
                    filtersIgnore: [
                        'id',
                        'cratedAt',
                        'updatedAt'
                    ]
                },
                {
                    ptype: 'floatingbutton',
                    configButton: {
                        iconCls: 'x-fa fa-map-marker',
                        scale: 'large',
                        tooltip: 'Agregar dirección',
                        bind: {
                            melisa: '{modules.addressesAdd}',
                            hidden: '{!modules.addressesAdd.allowed}'
                        },
                        listeners: {
                            click: 'moduleRun',
                            loaded: 'onLoadedModuleAsociate'
                        }
                    }
                }
            ]
        }
    ]
});