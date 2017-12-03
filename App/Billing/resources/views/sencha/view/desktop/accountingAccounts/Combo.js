Ext.define('Melisa.billing.view.desktop.accountingAccounts.Combo', {
    extend: 'Melisa.view.desktop.ComboDefault',
    alias: 'widget.billingAccountingAccountsCombo',
    
    requires: [
        'Melisa.view.desktop.ComboDefault'
    ],
    
    fieldLabel: 'Cuentas contables',
    itemId: 'cmbAccountingAccounts',
    name: 'idAccountingAccount',
    pageSize: 25,
    allowBlank: false,
    listConfig: {
        emptyText: 'No se encontro la cuenta contable'
    },
    bind: {
        store: '{accountingAccounts}',
        melisa: '{modules.accountingAccountsAdd}'
    },
    triggers: {
        other: {
            cls: 'x-form-trigger-default x-fa fa-plus',
            handler: 'moduleRun',
            tooltip: 'Agregar cuenta contable',
            focusOnMousedown: true
        }
    }
});
