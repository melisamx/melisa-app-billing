Ext.define('Melisa.billing.view.desktop.debtsToPay.add.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.billingDebtsToPayAddForm',
    
    defaults: {
        allowBlank: false,
        anchor: '100%'
    },
    items: [
        {
            xtype: 'combodefault',
            name: 'idProvider',
            itemId: 'cmbProviders',
            fieldLabel: 'Provedor',
            bind: {
                store: '{providers}'
            }
        },
        {
            xtype: 'numberfield',
            name: 'amountPayable',
            fieldLabel: 'Monto a pagar'
        },
        {
            xtype: 'datefield',
            name: 'dateVoucher',
            fieldLabel: 'Fecha del comprobante',
            value: new Date()
        },
        {
            xtype: 'datefield',
            name: 'dueDate',
            fieldLabel: 'Fecha de vencimiento',
            itemId: 'txtDueDate'
        },
        {
            xtype: 'textfield',
            fieldLabel: 'Comprobante',
            name: 'idFileVoucher',
            itemId: 'txtFileVoucher',
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
        }
    ]
});
