Ext.define('Melisa.billing.view.desktop.repositories.Combo', {
    extend: 'Melisa.view.desktop.ComboDefault',
    alias: 'widget.billingRepositoriesCombo',
    
    requires: [
        'Melisa.view.desktop.ComboDefault'
    ],
    
    fieldLabel: 'Cliente base',
    itemId: 'cmbRepositories',
    name: 'idRepository',
    pageSize: 25,
    allowBlank: false,
    listConfig: {
        emptyText: 'No se encontro el cliente base'
    },
    bind: {
        store: '{repositories}',
        melisa: '{modules.repositoriesAdd}'
    },
    triggers: {
        other: {
            cls: 'x-form-trigger-default x-fa fa-plus',
            handler: 'moduleRun',
            tooltip: 'Agregar cliente base',
            focusOnMousedown: true
        }
    }
});
