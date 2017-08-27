Ext.define('Melisa.billing.view.desktop.csd.add.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.billingCsdAddForm',
    
    defaults: {
        allowBlank: false,
        anchor: '100%'
    },
    items: [
        {
            xtype: 'textfield',
            fieldLabel: 'Archivo cer',
            name: 'idFileCer',
            itemId: 'txtFileCer',
            bind: {
                melisa: '{modules.filesSelect}',
                hidden: '{!modules.filesSelect.allowed}'
            },
            triggers: {
                foo: {
                    handler: 'moduleRun'
                }
            },
            listeners: {
                loaded: 'onLoadedModuleSelectFileCer'
            }
        },
        {
            xtype: 'textfield',
            fieldLabel: 'Archivo key',
            name: 'idFileKey',
            itemId: 'txtFileKey',
            bind: {
                melisa: '{modules.filesSelect}',
                hidden: '{!modules.filesSelect.allowed}'
            },
            triggers: {
                foo: {
                    handler: 'moduleRun'
                }
            },
            listeners: {
                loaded: 'onLoadedModuleSelectFileKey'
            }
        },
        {
            xtype: 'textfield',
            name: 'password',
            fieldLabel: 'Contraseña',
            inputType: 'password',
            autoComplete: false
        }
    ]
});
