Ext.define('Melisa.billing.view.desktop.series.add.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.billingSeriesAddForm',
    
    scrollable: true,
    defaults: {
        anchor: '100%'
    },
    items: [
        {
            xtype: 'textfield',
            fieldLabel: 'Número de serie',
            name: 'serie',
            itemId: 'txtSerie'
        },
        {
            xtype: 'numberfield',
            fieldLabel: 'Folio inicial',
            name: 'folioInitial'
        },
        {
            xtype: 'checkbox',
            name: 'isDefault',
            fieldLabel: 'Es default'
        },
        {
            xtype: 'checkbox',
            name: 'active',
            fieldLabel: 'Activo',
            checked: true
        }
    ]    
});
