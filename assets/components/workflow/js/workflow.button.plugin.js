Ext.onReady(function() {
	var panel = Ext.getCmp('modx-panel-resource');
	if(!panel)
		return;

	var modab = Ext.getCmp("modx-action-buttons");
    
    modab.insert(12, '-');
    modab.insert(12,{
        xtype: 'button'
        ,text: 'Nachricht an Autor'
        // ,text: _('workflow.button_text')
        // ,method: 'remote'
        // ,process: 'update'
        ,id: 'modx-abtn-workflow-send'
        // ,checkDirty: true
        ,handler: function() {
        	MODx.Ajax.request({
        		url: Workflow.config.connector_url
        		,params: {
        			action: 'mgr/author/get'
        			,id: MODx.request.id
        		}
        		,listeners: {
	                'success':{
	                	fn:function(r) {
	                		console.log(r);
	                		window.location = 'mailto:' + r.object.author.email + '?subject=' + r.object.resource.pagetitle + '&body=Betreffend ' + r.object.resource.pagetitle
	                	}, scope: this
	                }
	            }
        	});
        	
        }
    });

    modab.doLayout();
});