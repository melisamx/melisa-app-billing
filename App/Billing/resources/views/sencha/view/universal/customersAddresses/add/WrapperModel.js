Ext.define('Melisa.billing.view.universal.customersAddresses.add.WrapperModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.billingCustomersAddressesAdd',
        
    data: {
        fieldsHidden: [
            'idContributor',
            'idCustomer'
        ]
    },
    stores: {
        countries: {
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
