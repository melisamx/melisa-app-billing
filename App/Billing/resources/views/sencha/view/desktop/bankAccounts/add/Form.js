Ext.define('Melisa.billing.view.desktop.bankAccounts.add.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.billingBankAccountsAddForm',
    
    requires: [
        'Melisa.billing.view.desktop.banks.Combo'
    ],
    
    defaults: {
        allowBlank: false,
        anchor: '100%'
    },
    items: [
        {
            xtype: 'billingBanksCombo'
        },
        {
            xtype: 'textfield',
            name: 'name',
            fieldLabel: 'Nombre'
        },
        {
            xtype: 'textfield',
            name: 'accountNumber',
            fieldLabel: 'Cuenta'
        },
        {
            xtype: 'numberfield',
            name: 'beginningBalance',
            fieldLabel: 'Saldo inicial'
        },
        {
            xtype: 'checkbox',
            name: 'active',
            fieldLabel: 'Activo',
            checked: true
        }
    ]
});
