Ext.define('Melisa.billing.view.universal.my.customers.add.WrapperModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.billingMyCustomersAdd',
        
    stores: {
        repositories: {
            proxy: {
                type: 'ajax',
                url: '{modules.repositories}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        },
        waytopay: {
            proxy: {
                type: 'ajax',
                url: '{modules.waytopay}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        },
        countries: {
            remoteFilter: true,
            proxy: {
                type: 'ajax',
                url: '{modules.countries}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        },
        states: {
            remoteFilter: true,
            proxy: {
                type: 'ajax',
                url: '{modules.states}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        },
        municipalities: {
            proxy: {
                type: 'ajax',
                url: '{modules.municipalities}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        },
        settlements: {
            remoteFilter: true,
            proxy: {
                type: 'ajax',
                url: '{modules.settlements}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        }
    }    
});
