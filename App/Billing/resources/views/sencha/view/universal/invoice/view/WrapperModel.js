Ext.define('Melisa.billing.view.universal.documents.view.WrapperModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.billingInvoiceView',
    
    stores: {
        documents: {
            autoLoad: true,
            remoteFilter: true,
            proxy: {
                type: 'ajax',
                url: '{modules.documents}',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        }
    }
    
});
