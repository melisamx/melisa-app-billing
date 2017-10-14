Ext.define('Melisa.billing.view.desktop.customerGroupsIdentities.add.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.billingCustomerGroupsIdentitiesAddForm',
    
    requires: [
        'Melisa.security.view.desktop.identities.ComboDefault'
    ],
    
    defaults: {
        anchor: '100%',
        allowBlank: false
    },
    items: [
        {
            xtype: 'securityIdentitiesComboDefault',
            fieldLabel: 'Perfil a incluir en el grupo',
            name: 'idIdentity',
            itemId: 'cmbIdentities',
            pageSize: 25,
            listConfig: {
                emptyText: 'No hay perfiles',
                deferEmptyText: false
            },
            bind: {
                store: '{identities}'
            }
        },
        {
            xtype: 'checkbox',
            name: 'active',
            fieldLabel: 'Activo',
            checked: true
        }
    ]    
});
