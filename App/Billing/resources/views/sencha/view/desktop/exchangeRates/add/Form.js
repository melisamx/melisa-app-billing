Ext.define('Melisa.billing.view.desktop.exchangeRates.add.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.billingExchangeRatesAddForm',
    
    defaults: {
        anchor: '100%'
    },
    items: [
        {
            xtype: 'combodefault',
            fieldLabel: 'Moneda',
            name: 'idCoin',
            itemId: 'cmbCoins',
            bind: {
                store: '{coins}'
            }
        },
        {
            xtype: 'datefield',
            name: 'date',
            fieldLabel: 'Fecha',
            value: new Date(),
            reference: 'dfDate',
            publishes: 'value',
            maxValue: new Date(),
            listeners: {
                change: 'onChangeDate'
            }
        },
        {
            xtype: 'container',
            itemId: 'conLinkDOF',
            tpl: '<a href="' + 
                    'http://www.dof.gob.mx/indicadores_detalle.php?cod_tipo_indicador=158&' + 
                    '{dates}' + 
                    '" target="_blank">Consultar en Diario oficial</a>',
            listeners: {
                afterrender: 'onChangeDate'
            }
        },
        {
            xtype: 'numberfield',
            name: 'rate',
            fieldLabel: 'Valor',
            decimalPrecision: 6
        }
    ]    
});
