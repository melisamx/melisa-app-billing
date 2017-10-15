Ext.define('Melisa.billing.view.desktop.customersAddresses.Combo', {
    extend: 'Melisa.view.desktop.ComboDefault',
    alias: 'widget.billingCustomersAddressesCombo',
    
    requires: [
        'Melisa.view.desktop.ComboDefault'
    ],
    
    fieldLabel: 'Dirección de facturación',
    itemId: 'cmbCustomersAddresses',
    name: 'idContributorAddress',
    pageSize: 25,
    allowBlank: false,
    listConfig: {
        emptyText: 'No se encontro la dirección facturar'
    },
    bind: {
        store: '{customersAddresses}',
        melisa: '{modules.customersAddressesAdd}'
    },
    tpl: Ext.create('Ext.XTemplate',
        '<ul class="x-list-plain"><tpl for=".">',
            '<li role="option" class="x-boundlist-item">',
                '<b>{address}</b>, {exteriorNumber}, {colony}, C.P. {postalCode}, {state.name}, {municipality.name}, {country.name}',
            '</li>',
        '</tpl></ul>'
    ),
    displayTpl: Ext.create('Ext.XTemplate',
        '<tpl for=".">',
            '{address}, {exteriorNumber}, {colony}, C.P.  {postalCode}, {state.name}, {municipality.name}, {country.name}',
        '</tpl>'
    ),
    triggers: {
        other: {
            cls: 'x-form-trigger-default x-fa fa-plus',
            handler: 'moduleRun',
            tooltip: 'Agregar dirección de facturación',
            focusOnMousedown: true
        }
    }
});
