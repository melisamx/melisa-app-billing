Ext.define('Melisa.billing.view.desktop.csd.Combo', {
    extend: 'Melisa.view.desktop.ComboDefault',
    alias: 'widget.billingCsdCombo',
    
    requires: [
        'Melisa.view.desktop.ComboDefault'
    ],
    
    fieldLabel: 'Certificado de sello digital',
    name: 'idCsd',
    pageSize: 25,
    allowBlank: false,
    listConfig: {
        emptyText: 'No se encontro certificado de sello digital'
    },
    bind: {
        store: '{csd}',
        melisa: '{modules.csdAdd}'
    },
    triggers: {
        other: {
            cls: 'x-form-trigger-default x-fa fa-plus',
            handler: 'moduleRun',
            tooltip: 'Agregar certificado de sello digital',
            focusOnMousedown: true
        }
    }
});
