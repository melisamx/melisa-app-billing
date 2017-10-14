Ext.define('Melisa.billing.view.desktop.customers.Combo', {
    extend: 'Melisa.view.desktop.ComboDefault',
    alias: 'widget.billingCustomersCombo',
    
    requires: [
        'Melisa.view.desktop.ComboDefault'
    ],
    
    fieldLabel: 'Facturar a',
    itemId: 'cmbCustomers',
    name: 'idCustomer',
    pageSize: 25,
    allowBlank: false,
    listConfig: {
        emptyText: 'No se encontro a quien se desea facturar'
    },
    bind: {
        store: '{customers}',
        melisa: '{modules.customersAdd}'
    },
    triggers: {
        other: {
            cls: 'x-form-trigger-default x-fa fa-plus',
            handler: 'moduleRun',
            tooltip: 'Agregar cliente',
            focusOnMousedown: true
        }
    }
});
