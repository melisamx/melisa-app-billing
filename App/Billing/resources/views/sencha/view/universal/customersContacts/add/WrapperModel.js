Ext.define('Melisa.billing.view.universal.customersContacts.add.WrapperModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.billingCustomersContactsAdd',
        
    data: {
        fieldsHidden: [
            'idCustomer'
        ]
    },
    stores: {
        contacts: {
            proxy: {
                type: 'ajax',
                url: '{modules.contacts}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        }
    }    
});
