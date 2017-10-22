Ext.define('Melisa.billing.view.desktop.debtsToPay.payoff.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.billingDebtsToPayPayoffForm',
    
    defaults: {
        anchor: '100%'
    },
    items: [
        {
            xtype: 'textfield',
            fieldLabel: 'Comprobante',
            name: 'idFilePayment',
            itemId: 'txtFilePayment',            
            bind: {
                melisa: '{modules.filesSelect}',
                hidden: '{!modules.filesSelect.allowed}',
            },
            triggers: {
                foo: {
                    handler: 'moduleRun'
                }
            },
            listeners: {
                loaded: 'onLoadedModuleSelectFile'
            }
        },
        {
            xtype: 'datefield',
            name: 'paymentDate',
            fieldLabel: 'Fecha de pago'
        }
    ]
});
