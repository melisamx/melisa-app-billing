Ext.define('Melisa.billing.view.desktop.coins.ComboDefault', {
    extend: 'Melisa.view.desktop.ComboDefault',
    alias: 'widget.billingCoinsCombo',
    
    fieldLabel: 'Moneda',
    name: 'idCoin',
    forceSelection: true,
    pageSize: 25,
    listConfig: {
        emptyText: 'Moneda no encontrada'
    },
    bind: {
        store: '{coins}'
    }
});
