<?php

 /*               DO NOT EDIT THIS FILE

  Edit the file in the MyComponent config directory
  and run ExportObjects

 */



$packageNameLower = 'workflow'; /* No spaces, no dashes */

$components = array(
    /* These are used to define the package and set values for placeholders */
    'packageName' => 'Workflow',  /* No spaces, no dashes */
    'packageNameLower' => $packageNameLower,
    'packageDescription' => 'Workflow project',
    'version' => '1.0.4',
    'release' => 'beta',
    'author' => 'Andreas Bilz',
    'email' => 'Andreas Bilz <andreas@subsolutions.at>',
    'authorUrl' => 'http://www.subsolutions.at',
    'authorSiteName' => "subsolutions",
    'copyright' => '2013',

    /* no need to edit this except to change format */
    'createdon' => strftime('%m-%d-%Y'),

    'gitHubUsername' => 'herooutoftime',
    'gitHubRepository' => 'Workflow',

    /* two-letter code of your primary language */
    'primaryLanguage' => 'en',

    /* Set directory and file permissions for project directories */
    'dirPermission' => 0755,  /* No quotes!! */
    'filePermission' => 0644, /* No quotes!! */

    /* Define source and target directories */

    /* path to MyComponent source files */
    'mycomponentRoot' => $this->modx->getOption('mc.root', null,
        MODX_CORE_PATH . 'components/mycomponent/'),

    /* path to new project root */
    'targetRoot' => MODX_ASSETS_PATH . 'mycomponents/' . $packageNameLower . '/',


    /* *********************** NEW SYSTEM SETTINGS ************************ */

    /* If your extra needs new System Settings, set their field values here.
     * You can also create or edit them in the Manager (System -> System Settings),
     * and export them with exportObjects. If you do that, be sure to set
     * their namespace to the lowercase package name of your extra */

    'newSystemSettings' => array(
        'workflow.admin_email' => array( // key
            'key' => 'workflow.admin_email',
            'name' => 'setting_workflow.admin_email',
            'description' => 'setting_workflow.admin_email_desc',
            'namespace' => 'workflow',
            'xtype' => 'textfield',
            'value' => 'andreas.bilz@gmail.com',
            'area' => 'manager',
        ),
        'workflow.admin_group' => array( // key
            'key' => 'workflow.admin_group',
            'name' => 'setting_workflow.admin_group',
            'description' => 'setting_workflow.admin_group_desc',
            'namespace' => 'workflow',
            'xtype' => 'modx-combo-usergroup',
            'value' => 1,
            'area' => 'manager',
        ),
        'workflow.enabled' => array( // key
            'key' => 'workflow.enabled',
            'name' => 'Workflow Enabled',
            'description' => 'Workflow Enabled',
            'namespace' => 'workflow',
            'xtype' => 'combo-boolean',
            'value' => true,
            'area' => 'manager',
        ),
        'workflow.exclude' => array( // key
            'key' => 'workflow.exclude',
            'name' => 'setting_workflow.exclude',
            'description' => 'setting_workflow.exclude_desc',
            'namespace' => 'workflow',
            'xtype' => 'textfield',
            'value' => '',
            'area' => 'manager',
        ),
    ),

    /* ************************ NEW SYSTEM EVENTS ************************* */

    /* Array of your new System Events (not default
     * MODX System Events). Listed here so they can be created during
     * install and removed during uninstall.
     *
     * Warning: Do *not* list regular MODX System Events here !!! */

    'newSystemEvents' => array(
        'OnDocStatusChange' => array(
            'name' => 'OnDocStatusChange',
        ),
        // 'OnMyEvent2' => array(
        //     'name' => 'OnMyEvent2',
        //     'groupname' => 'Workflow',
        //     'service' => 1,
        // ),
    ),

    /* ************************ NAMESPACE(S) ************************* */
    /* (optional) Typically, there's only one namespace which is set
     * to the $packageNameLower value. Paths should end in a slash
    */

    'namespaces' => array(
        'workflow' => array(
            'name' => 'workflow',
            'path' => '{core_path}components/workflow/',
            'assets_path' => '{assets_path}components/workflow/',
        ),

    ),

    /* ************************ CONTEXT(S) ************************* */
    /* (optional) List any contexts other than the 'web' context here
    */

    // 'contexts' => array(
    //     'workflow' => array(
    //         'key' => 'workflow',
    //         'description' => 'workflow context',
    //         'rank' => 2,
    //     )
    // ),

    /* *********************** CONTEXT SETTINGS ************************ */

    /* If your extra needs Context Settings, set their field values here.
     * You can also create or edit them in the Manager (Edit Context -> Context Settings),
     * and export them with exportObjects. If you do that, be sure to set
     * their namespace to the lowercase package name of your extra.
     * The context_key should be the name of an actual context.
     * */

    // 'contextSettings' => array(
    //     'workflow_context_setting1' => array(
    //         'context_key' => 'workflow',
    //         'key' => 'workflow_context_setting1',
    //         'name' => 'Workflow Setting One',
    //         'description' => 'Description for setting one',
    //         'namespace' => 'workflow',
    //         'xtype' => 'textfield',
    //         'value' => 'value1',
    //         'area' => 'workflow',
    //     ),
    //     'workflow_context_setting2' => array(
    //         'context_key' => 'workflow',
    //         'key' => 'workflow_context_setting2',
    //         'name' => 'Workflow Setting Two',
    //         'description' => 'Description for setting two',
    //         'namespace' => 'workflow',
    //         'xtype' => 'combo-boolean',
    //         'value' => true,
    //         'area' => 'workflow',
    //     ),
    // ),

    /* ************************* CATEGORIES *************************** */
    /* (optional) List of categories. This is only necessary if you
     * need to categories other than the one named for packageName
     * or want to nest categories.
    */

    'categories' => array(
        'Workflow' => array(
            'category' => 'Workflow',
            'parent' => '',  /* top level category */
        ),
        // 'category2' => array(
        //     'category' => 'Category2',
        //     'parent' => 'Workflow', /* nested under Workflow */
        // )
    ),

    /* *************************** MENUS ****************************** */

    /* If your extra needs Menus, you can create them here
     * or create them in the Manager, and export them with exportObjects.
     * Be sure to set their namespace to the lowercase package name
     * of your extra.
     *
     * Every menu should have exactly one action */

    'menus' => array(
        'Workflow' => array(
            'text' => 'Workflow',
            'parent' => 'components',
            'description' => 'ex_menu_desc',
            'icon' => '',
            'menuindex' => 0,
            'params' => '',
            'handler' => '',
            'permissions' => '',

            'action' => array(
                'id' => '',
                'namespace' => 'workflow',
                'controller' => 'index',
                'haslayout' => true,
                'lang_topics' => 'workflow:default',
                'assets' => '',
            ),
        ),
    ),


    /* ************************* ELEMENTS **************************** */

    /* Array containing elements for your extra. 'category' is required
       for each element, all other fields are optional.
       Property Sets (if any) must come first!

       The standard file names are in this form:
           SnippetName.snippet.php
           PluginName.plugin.php
           ChunkName.chunk.html
           TemplateName.template.html

       If your file names are not standard, add this field:
          'filename' => 'actualFileName',
    */


    'elements' => array(

        // 'propertySets' => array( /* all three fields are required */
        //     'PropertySet1' => array(
        //         'name' => 'PropertySet1',
        //         'description' => 'Description for PropertySet1',
        //         'category' => 'Workflow',
        //     ),
        //     'PropertySet2' => array(
        //         'name' => 'PropertySet2',
        //         'description' => 'Description for PropertySet2',
        //         'category' => 'Workflow',
        //     ),
        // ),

        // 'snippets' => array(
        //     'Snippet1' => array(
        //         'category' => 'Workflow',
        //         'description' => 'Description for Snippet one',
        //         'static' => true,
        //     ),

        //     'Snippet2' => array( /* workflow with static and property set(s)  */
        //         'category' => 'Category2',
        //         'description' => 'Description for Snippet two',
        //         'static' => false,
        //         'propertySets' => array(
        //             'PropertySet1',
        //             'PropertySet2'
        //         ),
        //     ),

        // ),
        'plugins' => array(
            'Workflow' => array( /* minimal workflow */
                'category' => 'Workflow',
                'events' => array(
                    'OnManagerPageInit' => array(),
                    'OnDocFormDelete' => array(),
                    'OnDocFormSave' => array(),
                    'OnBeforeDocFormSave' => array(),
                ),
            ),
        ),
        'chunks' => array(
            'wfMail' => array(
                'description' => 'Workflow Mail Content',
                'category' => 'Workflow',
                'static' => false,
            ),
        ),
        'templateVars' => array(
            'wfStatus' => array(
                'category' => 'Workflow',
                'description' => 'Current status of the resource in Workflow',
                'caption' => 'Workflow Status',
                'type' => 'listbox',
                'elements' => 'Neu==new||Wartet auf Veröffentlichung==awaiting||Abgewiesen==rejected||In Überarbeitung==progress||Öffentlich==public||Löschung beantragt==deleted',
            ),
            'wfAuthor' => array( /* workflow with templates, default, and static specified */
                'category' => 'Workflow',
                'description' => 'Current author for this resource',
                'caption' => 'Workflow Author',
                'type' => 'hidden',
            ),
        ),
    ),
    /* (optional) will make all element objects static - 'static' field above will be ignored */
    'allStatic' => false,


    /* ************************* RESOURCES ****************************
     Important: This list only affects Bootstrap. There is another
     list of resources below that controls ExportObjects.
     * ************************************************************** */
    /* Array of Resource pagetitles for your Extra; All other fields optional.
       You can set any resource field here */
    // 'resources' => array(
    //     'Resource1' => array( /* minimal workflow */
    //         'pagetitle' => 'Resource1',
    //         'alias' => 'resource1',
    //         'context_key' => 'workflow',
    //     ),
    //     'Resource2' => array( /* workflow with other fields */
    //         'pagetitle' => 'Resource2',
    //         'alias' => 'resource2',
    //         'context_key' => 'workflow',
    //         'parent' => 'Resource1',
    //         'template' => 'Template2',
    //         'richtext' => false,
    //         'published' => true,
    //         'tvValues' => array(
    //             'Tv1' => 'SomeValue',
    //             'Tv2' => 'SomeOtherValue',
    //         ),
    //     ),
    // ),


    /* Array of languages for which you will have language files,
     *  and comma-separated list of topics
     *  ('.inc.php' will be added as a suffix). */
    'languages' => array(
        'en' => array(
            'default',
            'properties',
            'forms',
        ),
        'de' => array(
            'default',
            'properties',
            'forms',
        ),
    ),
    /* ********************************************* */
    /* Define optional directories to create under assets.
     * Add your own as needed.
     * Set to true to create directory.
     * Set to hasAssets = false to skip.
     * Empty js and/or css files will be created.
     */
    'hasAssets' => true,

    'assetsDirs' => array(
        /* If true, a default (empty) CSS file will be created */
        'css' => true,

        /* If true, a default (empty) JS file will be created */
        'js' => true,

        'images' => true,
        // 'audio' => true,
        // 'video' => true,
        // 'themes' => true,
    ),
    /* minify any JS files */
    'minifyJS' => true,
    /* Create a single JS file from all JS files */
    'createJSMinAll' => true,
    /* if this is false, regular jsmin will be used.
       JSMinPlus is slower but more reliable */
    'useJSMinPlus' => true,

    /* These will automatically go under assets/components/yourcomponent/js/
       Format: directory:filename
       (no trailing slash on directory)
       if 'createCmpFiles is true, these will be ignored.
    */
    $jsFiles = array(
        'workflow.js',
    ),


    /* ********************************************* */
    /* Define basic directories and files to be created in project*/

    'docs' => array(
        'readme.txt',
        'license.txt',
        'changelog.txt',
        'tutorial.html'
    ),

    /* (optional) Description file for GitHub project home page */
    'readme.md' => true,
    /* assume every package has a core directory */
    'hasCore' => true,

    /* ********************************************* */
    /* (optional) Array of extra script resolver(s) to be run
     * during install. Note that resolvers to connect plugins to events,
     * property sets to elements, resources to templates, and TVs to
     * templates will be created automatically -- *don't* list those here!
     *
     * 'default' creates a default resolver named after the package.
     * (other resolvers may be created above for TVs and plugins).
     * Suffix 'resolver.php' will be added automatically */
    'resolvers' => array(
        'default',
        'addUsers',
        'workflow',
    ),

    /* (optional) Validators can abort the install after checking
     * conditions. Array of validator names (no
     * prefix of suffix) or '' 'default' creates a default resolver
     *  named after the package suffix 'validator.php' will be added */

    'validators' => array(
        'default',
        'hasGdLib'
    ),

    /* (optional) install.options is needed if you will interact
     * with user during the install.
     * See the user.input.php file for more information.
     * Set this to 'install.options' or ''
     * The file will be created as _build/install.options/user.input.php
     * Don't change the filename or directory name. */
    'install.options' => 'install.options',


    /* Suffixes to use for resource and element code files (not implemented)  */
    'suffixes' => array(
        'modPlugin' => '.php',
        'modSnippet' => '.php',
        'modChunk' => '.html',
        'modTemplate' => '.html',
        'modResource' => '.html',
    ),


    /* ********************************************* */
    /* (optional) Only necessary if you will have class files.
     *
     * Array of class files to be created.
     *
     * Format is:
     *
     * 'ClassName' => 'directory:filename',
     *
     * or
     *
     *  'ClassName' => 'filename',
     *
     * ('.class.php' will be appended automatically)
     *
     *  Class file will be created as:
     * yourcomponent/core/components/yourcomponent/model/[directory/]{filename}.class.php
     *
     * Set to array() if there are no classes. */
    'classes' => array(
        'Workflow' => 'workflow:workflow',
    ),

    /* ************************************
     *  These values are for CMPs.
     *  Set any of these to an empty array if you don't need them.
     *  **********************************/

    /* If this is false, the rest of this section will be ignored */

    'createCmpFiles' => false,

    /* IMPORTANT: The array values in the rest of
       this section should be all lowercase */

    /* This is the main action file for your component.
       It will automatically go in core/component/yourcomponent/
    */

    'actionFile' => 'index.php',

    /* CSS file for CMP */

    'cssFile' => 'mgr.css',

    /* These will automatically go to core/components/yourcomponent/processors/
       format directory:filename
       '.class.php' will be appended to the filename

       Built-in processor classes include getlist, create, update, duplicate,
       import, and export. */

    'processors' => array(
        'mgr/snippet:getlist',
        'mgr/snippet:changecategory',
        'mgr/snippet:remove',

        // 'mgr/chunk:getlist',
        // 'mgr/chunk:changecategory',
        // 'mgr/chunk:remove',
    ),

    /* These will automatically go to core/components/yourcomponent/controllers[/directory]/filename
       Format: directory:filename */

    'controllers' => array(
        ':index.php',
        'mgr:header.php',
        'mgr:home.php',
    ),

    /* These will automatically go in assets/components/yourcomponent/ */

    'connectors' => array(
        'connector.php'

    ),
    /* These will automatically go to assets/components/yourcomponent/js[/directory]/filename
       Format: directory:filename */

    'cmpJsFiles' => array(
        ':workflow.js',
        'sections:home.js',
        'widgets:home.panel.js',
        'widgets:snippet.grid.js',
        'widgets:chunk.grid.js',
    ),


    /* *******************************************
     * These settings control exportObjects.php  *
     ******************************************* */
    /* ExportObjects will update existing files. If you set dryRun
       to '1', ExportObjects will report what it would have done
       without changing anything. Note: On some platforms,
       dryRun is *very* slow  */

    'dryRun' => '0',

    /* Array of elements to export. All elements set below will be handled.
     *
     * To export resources, be sure to list pagetitles and/or IDs of parents
     * of desired resources
    */
    'process' => array(
        // 'contexts',
        // 'snippets',
        'plugins',
        'templateVars',
        // 'templates',
        'chunks',
        // 'resources',
        // 'propertySets',
        'systemSettings',
        // 'contextSettings',
        'systemEvents',
        // 'menus'
    ),
    /*  Array  of resources to process. You can specify specific resources
        or parent (container) resources, or both.

        They can be specified by pagetitle or ID, but you must use the same method
        for all settings and specify it here. Important: use IDs if you have
        duplicate pagetitles */
    // 'getResourcesById' => false,

    // 'exportResources' => array(
    //     'Resource1',
    //     'Resource2',
    // ),
    /* Array of resource parent IDs to get children of. */
    // 'parents' => array(),
    /* Also export the listed parent resources
      (set to false to include just the children) */
    // 'includeParents' => false,


    /* ******************** LEXICON HELPER SETTINGS ***************** */
    /* These settings are used by LexiconHelper */
    'rewriteCodeFiles' => false,  /* remove ~~descriptions */
    'rewriteLexiconFiles' => true, /* automatically add missing strings to lexicon files */
    /* ******************************************* */

    /* Array of aliases used in code for the properties array.
     * Used by the checkproperties utility to check properties in code against
     * the properties in your properties transport files.
     * if you use something else, add it here (OK to remove ones you never use.
     * Search also checks with '$this->' prefix -- no need to add it here. */
    'scriptPropertiesAliases' => array(
        'props',
        'sp',
        'config',
        'scriptProperties'
    ),
);

return $components;