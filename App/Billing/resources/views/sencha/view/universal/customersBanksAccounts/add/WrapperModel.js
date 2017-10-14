Ext.define('Melisa.billing.view.universal.customersBanksAccounts.add.WrapperModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.billingCustomersBanksAccountsAdd',
        
    data: {
        fieldsHidden: [
            'idCustomer'
        ]
    },
    stores: {
        banks: {
            proxy: {
                type: 'ajax',
                url: '{modules.banks}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        },
        coins: {
            proxy: {
                type: 'ajax',
                url: '{modules.coins}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        }
    }    
});
