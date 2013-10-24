Ext.onReady(function() {
	var workflow = {
		addMenuItem: function() {
			var rt = Ext.getCmp('modx-resource-tree');
		    rt.on('contextmenu', function(node, e) {
		        node.cascade(function(n) {
		            // Is a leaf (like in a tree)
		            // if(n.isLeaf())
		            //     return;
		            n.ownerTree.cm.activeNode = n;
		            // Only add if not added yet
		            // if(n.ownerTree.cm.menu.items.length > 10)
		            //     return;
		            
		            // Create a new menu
		            var new_menu = new Ext.menu.Menu({
		                items: n.ownerTree.cm.items.items
		            });
		            console.log(n);
		            var pk = n.attributes.pk;
		            
		            st = [];
		            // Neu==new||Wartet auf Veröffentlichung==awaiting||Abgewiesen==rejected||In Überarbeitung==progress||Öffentlich==public||Löschung beantragt==deleted
		            var states = {
		            	'new': 'Neu',
		            	'awaiting': 'Wartet auf Veröffentlichung',
		            	'rejected': 'Zurückgewiesen',
		            	'progress': 'In Überarbeitung',
		            	'public': 'Öffentlich',
		            	'deleted': 'Löschung beantragt'
		            };
		            
		            Ext.iterate(states, function(key, value) {
		            	st.push({
			            	text: value
			            	,handler: workflow.changeStatus.createDelegate(this, [key, pk], true)
			            });
		            });

		            // Add the MU item to it
		            mu_item = new Ext.menu.Item({
		                text: 'Change status'
		                ,menu: {items: st}
		            });

		            new_menu.add(mu_item);
		            // Show it
		            new_menu.show(n.ui.getEl());
		            return true;
		        });
		    });
		}
		,changeStatus: function(btn, e, status, pk) {
			console.log(btn);
			MODx.msg.confirm({
		        title : _('workflow.leave_message.title')
		        ,message : _('workflow.leave_message.message')
		        ,width : 300
				,url: Workflow.config.connector_url
				,params: {
	                action: 'mgr/status/change'
	                ,status: status
	                ,id: pk
	            }
	            ,listeners: {
	                'success': {fn:function(r) {
	                	}, scope: this
	                }
	            }
		    });
		}
	}
	workflow.addMenuItem();
});

Workflow.tree.ResourceTree = function(config) {
	config = config || {};
    // this.ident = config.ident || 'gupmuit'+Ext.id();
    // ,closeAction: 'destroy'
    Workflow.tree.ResourceTree.superclass.constructor.call(this,config);
    this.on('show',this.setup,this);
} 

Ext.extend(Workflow.tree.ResourceTree, MODx.tree, {
	setup: function() {
		console.log('test');
		// var rt = Ext.getCmp('modx-resource-tree');
		// console.log(rt);
	 //    rt.on('contextmenu', function(node, e) {
	        
	 //        node.cascade(function(n) {
	 //            // Is a leaf (like in a tree)
	 //            if(n.isLeaf())
	 //                return;
	            
	 //            // Only add if not added yet
	 //            if(n.attributes.menu.items.length > 10)
	 //                return;
	 //            // Create a new menu
	 //            var new_menu = new Ext.menu.Menu({
	 //                items: n.attributes.menu.items
	 //            });
	 //            // Add the MU item to it
	 //            mu_item = new Ext.menu.Item({
	 //                text: 'Change status'
	 //                ,handler: workflow.showWindow
	 //            });
	 //            new_menu.add(mu_item);
	 //            // Show it
	 //            new_menu.show(n.ui.getEl());
	 //            return true;
	 //        });
	 //    });
	}
});
Ext.reg('modx-resource-tree',Workflow.tree.ResourceTree);