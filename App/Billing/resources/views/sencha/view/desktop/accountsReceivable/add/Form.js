Ext.define('Melisa.billing.view.desktop.accountsReceivable.add.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.billingAccountsReceivableAddForm',
    
    defaults: {
        allowBlank: false,
        anchor: '100%'
    },
    items: [
        {
            xtype: 'combodefault',
            name: 'idContributorAddress',
            itemId: 'cmbCustomers',
            fieldLabel: 'Cliente',
            bind: {
                store: '{customers}'
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
