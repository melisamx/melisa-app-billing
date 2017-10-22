Ext.define('Melisa.billing.view.desktop.customers.view.Wrapper', {
    extend: 'Ext.panel.Panel',
    
    requires: [
        'Melisa.core.Module',
        'Melisa.ux.grid.Filters',
        'Melisa.ux.FloatingButton',
        'Melisa.ux.confirmation.Button',
        'Melisa.billing.view.desktop.customers.view.Grid',
        'Melisa.billing.view.desktop.customers.view.WrapperController',
        'Melisa.billing.view.universal.customers.view.WrapperModel',
        'Melisa.people.view.desktop.contacts.view.Grid',
        'Melisa.billing.view.desktop.customersContacts.Grid',
        'Melisa.billing.view.desktop.customersBanksAccounts.Grid',
        'Melisa.billing.view.desktop.customersAddresses.Grid'
    ],
    
    mixins: [
        'Melisa.core.Module'
    ],
    
    iconCls: 'x-fa fa-users',
    cls: 'billing-customers-view',
    layout: 'border',
    controller: 'billingCustomersView',
    reference: 'wrapper',
    viewModel: {
        type: 'billingCustomerView'
    },
    items: [
        {
            xtype: 'billingCustomerViewGrid',
            region: 'center',
            reference: 'griCustomers',
            listeners: {
                itemdblclick: 'onShowItemReport',
                selectionchange: 'onSelectionChangeCustomers'
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
        },
        {
            xtype: 'tabpanel',
            plugins: 'responsive',
            itemId: 'panDetails',
            split: true,
            responsiveConfig: {
                'width < 1200': {
                    region: 'south',
                    height: '50%'
                },
                'width >= 1200': {
                    region: 'east',
                    width: '80%'
                }
            },
            listeners: {
                afterrender: 'onAfterRenderDetails'
            },
            items: [
                {
                    iconCls: 'x-fa fa-address-card-o',
                    title: 'Contactos',
                    xtype: 'billingCustomersContactsGrid',
                    plugins: [
                        {
                            ptype: 'floatingbutton',
                            configButton: {
                                iconCls: 'x-fa fa-address-card-o',
                                scale: 'large',
                                tooltip: 'Asociar contacto',
                                bind: {
                                    melisa: '{modules.contactsAdd}',
                                    hidden: '{!modules.contactsAdd.allowed}'
                                },
                                listeners: {
                                    click: 'moduleRun',
                                    loaded: 'onLoadedModuleAsociate'
                                }
                            }
                        }
                    ]
                },
                {
                    iconCls: 'x-fa fa-university',
                    title: 'Cuentas bancarias',
                    xtype: 'billingCustomersBanksAccountsGrid',
                    plugins: [
                        {
                            ptype: 'floatingbutton',
                            configButton: {
                                iconCls: 'x-fa fa-university',
                                scale: 'large',
                                tooltip: 'Agregar cuenta bancaría',
                                bind: {
                                    melisa: '{modules.banksAccountsAdd}',
                                    hidden: '{!modules.banksAccountsAdd.allowed}'
                                },
                                listeners: {
                                    click: 'moduleRun',
                                    loaded: 'onLoadedModuleAsociate'
                                }
                            }
                        }
                    ]
                },
                {
                    xtype: 'billingCustomersAddressesGrid',
                    title: 'Direcciónes',
                    iconCls: 'x-fa fa-map-marker'
                }
            ]
        }
    ]
});
