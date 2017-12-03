Ext.define('Melisa.billing.view.desktop.accountingAccounts.add.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.billingAccountingAccountsAddForm',
    
    defaults: {
        allowBlank: false,
        anchor: '100%'
    },
    items: [
        {
            xtype: 'textfield',
            name: 'name',
            fieldLabel: 'Nombre (se usara para mostrarse en los listados)'
        },
        {
            xtype: 'textfield',
            name: 'accountNumber',
            fieldLabel: 'Cuenta contable',
            allowBlank: true
        },
        {
            xtype: 'numberfield',
            name: 'expirationDays',
            fieldLabel: 'Días de vencimiento'
        },
        {
            xtype: 'checkbox',
            name: 'active',
            fieldLabel: 'Activo',
            checked: true
        }
    ]
});
