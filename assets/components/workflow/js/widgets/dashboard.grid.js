/**
 * Loads a grid of all the resources a user has recently edited.
 * 
 * @class MODx.grid.RecentlyEditedResourcesByUser
 * @extends MODx.grid.Grid
 * @param {Object} config An object of options.
 * @xtype modx-grid-user-recent-resource
 */
Workflow.grid.DashboardResources = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        cls: 'workflow-dashboard-grid'
        ,url: Workflow.config.connector_url
        // url: MODx.config.assets_url + "components/workflow/connector.php"
        ,baseParams: {
            action: 'mgr/resource/getlist'
        }
        ,save_action: 'mgr/resource/updatefromgrid'
        ,autosave: true
        ,pageSize: 8
        ,fields: ['id','context_key','pagetitle','description','editedon','deleted','published','publishedon','createdon','menu','status','status_nice','author','preview_url']
        ,columns: [{
            header: _('id')
            ,dataIndex: 'id'
            ,width: 40
            ,sortable: true
        },{
            header: _('pagetitle')
            ,dataIndex: 'pagetitle'
            ,width: 150
            ,editor: { xtype: 'textfield' ,allowBlank: false }
            ,sortable: true
        },{
            header: _('status')
            ,dataIndex: 'status'
            ,width: 70
            ,editor: { xtype: 'workflow-combo-states' }
            ,sortable: true
            ,renderer: this._renderStatus
        },{
            header: _('user')
            ,dataIndex: 'author'
            ,width: 70
            ,editor: { xtype: 'workflow-combo-authors' }
            ,sortable: true
        },{
            header: _('published')
            ,dataIndex: 'published'
            ,width: 40
            ,editor: { xtype: 'combo-boolean' ,renderer: 'boolean' }
            ,sortable: true
        },{
            header: _('publishedon')
            ,dataIndex: 'publishedon'
            ,width: 100
            ,sortable: true
        },{
            header: _('createdon')
            ,dataIndex: 'createdon'
            ,width: 100
            ,sortable: true
        },{
            header: _('editedon')
            ,dataIndex: 'editedon'
            ,width: 100
            ,sortable: true
        }]
        ,tbar: [{
            xtype: 'modx-combo-user'
            ,id: 'workflow-filter-authors'
            ,name: 'author'
            ,emptyText: 'Autor'
            ,listeners: {
                'change': {fn: this.filterAuthor, scope: this}
            }
        },{
            xtype: 'workflow-combo-states'
            ,id: 'workflow-filter-states'
            ,value: 'awaiting'
            ,name: 'state'
            ,listeners: {
                'change': {fn: this.filterState, scope: this}
            }
        }, '-', {
            xtype: 'button'
            ,id: 'workflow-filter-clear'
            ,text: _('filter_clear')
            ,listeners: {
                'click': {fn: this.clearFilter, scope: this}
            }
        }]
        ,paging: true
        ,listeners: {
            'afterAutoSave': {fn:function(response) {
                // Extended component delivers a window
                // to enable more complex actions
                // var w = MODx.load({
                //     xtype: 'workflow-window-editor'
                //     ,record: response.object
                //     ,listeners: {
                //         'success': {fn:this.refresh,scope:this}
                //     }
                // });
                // w.setValues(response.object);
                // w.show();
                this.refresh();
            }, scope: this }
        }
    });
    Workflow.grid.DashboardResources.superclass.constructor.call(this,config);
};
Ext.extend(Workflow.grid.DashboardResources,MODx.grid.Grid,{    
    _renderStatus: function(value, p, rec) {
        return rec.data.status_nice;
    }
    ,preview: function() {
        window.open(this.config.record.preview_url);
        // window.open(MODx.config.base_url+'index.php?id='+this.menu.record.id);
    }
    ,filterAuthor: function(tf,newValue,oldValue) {
        var nv = newValue;
        var s = this.getStore();
        if(nv == '') {
            delete s.baseParams.author;
        } else {
            s.baseParams.author = nv;
        }
        this.getBottomToolbar().changePage(1);
        this.refresh();
        return true;
    }
    ,filterState: function(tf,newValue,oldValue) {
        var nv = newValue;
        var s = this.getStore();
        if(nv == '') {
            delete s.baseParams.state;
        } else {
            s.baseParams.state = nv;
        }
        this.getBottomToolbar().changePage(1);
        this.refresh();
        return true;
    }
    ,clearFilter: function() {
        s = this.getStore();
        // Reset the combo boxes
        Ext.getCmp('workflow-filter-states').reset();
        Ext.getCmp('workflow-filter-authors').reset();
        // Delete the base params
        delete s.baseParams.state;
        delete s.baseParams.author;
        // Refresh the grid
        this.getBottomToolbar().changePage(1);
        this.refresh();
    }
    ,getMenu: function() {
        return [
        // {
        //     text: _('workflow.dashboard.edit')
        //     ,handler: this.updateWorkflow
        //     ,scope: this
        //     ,hidden: true
        // },
        {
            // text: _('workflow.dashboard.edit_resource')
            text: 'Artikel bearbeiten'
            ,handler: function() {
                window.location.href = '?a=30&id='+ this.menu.record.id;
            }
            ,scope: this
        },{
            // text: _('workflow.dashboard.edit_resource')
            text: 'Artikel ansehen'
            ,handler: function() {
                window.open(this.menu.record.preview_url);
            }
            ,scope: this
        },{
            text: this.menu.record.published ? 'Artikel zurückziehen' : 'Artikel veröffentlichen'
            ,handler: this.changePublish
            ,scope: this
        }]
    }
    ,changePublish: function(btn, e) {
        MODx.Ajax.request({
            url: Workflow.config.connector_url
            ,params: {
                action: 'mgr/resource/changepublish'
                ,pk: this.menu.record.id
                ,id: this.menu.record.id
                ,published: this.menu.record.published
            }
            // ,listeners: {
            //     'success': function(r) {
            //         // this.grid.refresh();
            //     }
            // }
        })
    }
    ,updateWorkflow: function(btn, e) {
        if (!this.updateWorkflowWindow) {
            this.updateWorkflowWindow = MODx.load({
                xtype: 'workflow-window-editor'
                ,record: this.menu.record
                ,listeners: {
                    'success': {fn:this.refresh,scope:this}
                }
            });
        }
        this.updateWorkflowWindow.setValues(this.menu.record);
        this.updateWorkflowWindow.show(e.target);
    }
    
});
Ext.reg('workflow-grid-resource',Workflow.grid.DashboardResources);

Workflow.window.Editor = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: _('workflow.leave_message.title')
        ,url: Workflow.config.connector_url
        ,baseParams: {
            action: 'mgr/status/change'
            ,id: config.record.id
        }
        ,fields: [{
            xtype: 'panel'
            ,html: '<strong>#' + config.record.id + '</strong>'
        },{
            xtype: 'workflow-combo-states'
            ,name: 'state'
            ,value: config.record.status
        },{
            xtype: 'workflow-combo-authors'
            ,name: 'author'
            ,value: config.record.author
        },{
            xtype: 'textarea'
            ,fieldLabel: _('workflow.window.message')
            ,name: 'message'
            ,anchor: '100%'
        },{
            xtype: 'xcheckbox'
            ,name: 'sendmail'
            ,hideLabel: true
            ,boxLabel: _('workflow.window.sendmail')
        }]
    });
    Workflow.window.Editor.superclass.constructor.call(this,config);
}
Ext.extend(Workflow.window.Editor,MODx.Window);
Ext.reg('workflow-window-editor', Workflow.window.Editor);

Workflow.combo.States = function(config) {
    // Neu==new||
    // Wartet auf Veröffentlichung==awaiting||
    // Abgewiesen==rejected||
    // In Überarbeitung==progress||
    // Öffentlich==public||
    // Löschung beantragt==deleted
    var states = new Ext.data.ArrayStore({
        fields: ['display', 'value']
        ,data : [
            ["Neu", "new"],
            ["Wartet auf Veröffentlichung", "awaiting"],
            ["Abgewiesen", "rejected"],
            ["In Überarbeitung", "progress"],
            ["Öffentlich", "public"],
            ["Löschung beantragt", "deleted"]
        ]
    });

    config = config || {};
    Ext.applyIf(config,{
        displayField: 'display'
        ,valueField: 'value'
        ,store: states
        ,baseParams: { action: '' ,combo: true }
        ,mode: 'local'
        ,editable: false
        ,emptyText: 'Status'
    });
    Workflow.combo.States.superclass.constructor.call(this,config);
}
Ext.extend(Workflow.combo.States,MODx.combo.ComboBox);
Ext.reg('workflow-combo-states', Workflow.combo.States);

Workflow.combo.Authors = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        displayField: 'username'
        ,valueField: 'id'
        ,fields: ['id', 'username']
        ,emptyText: 'Autor'
        ,url: Workflow.config.connector_url
        ,baseParams: {
            action: 'mgr/author/getlist'
            ,combo: true
        }
        // ,editable: false
    });
    Workflow.combo.Authors.superclass.constructor.call(this,config);
}
Ext.extend(Workflow.combo.Authors,MODx.combo.ComboBox);
Ext.reg('workflow-combo-authors', Workflow.combo.Authors);