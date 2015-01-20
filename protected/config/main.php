<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'UTA',
//        'language'=>'es_CL',
        'language'=>'es',
        'sourceLanguage'=>'en',
        'charset'=>'utf-8',
        'timeZone' => 'America/Santiago',
        'theme'=>'bootstrap',
    
	// preloading 'log' component
	'preload'=>array(
                'log'),

        'aliases' => array(
            'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'),
            'yiiwheels' => realpath(__DIR__ . '/../extensions/yiiwheels'),
        ),
        
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'application.modules.rights.*',
                'application.modules.rights.components.*',
                'ext.giix.components.*',
                'bootstrap.helpers.TbHtml',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool	
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'secreto',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
                        'generatorPaths' => array(
                                'ext.giix.generators',
                                'bootstrap.gii'
                        ),
		),
            
                'rights'=>array(
                        'superuserName'=>'Administrador',
                        'authenticatedName'=>'Usuario',
                        'userIdColumn'=>'id',
                        'userNameColumn'=>'username',
                        'enableBizRule'=>true,
                        'enableBizRuleData'=>false,
                        'displayDescription'=>true,
                        'flashSuccessKey'=>'RightsSuccess',
                        'flashErrorKey'=>'RightsError',
                        'baseUrl'=>'/rights',
//                        'layout'=>'rights.views.layouts.main',
//                        'appLayout'=>'application.views.layouts.main',
//                        'cssFile'=>'rights.css',
                        'appLayout'=>'//layouts/main',
//                        'cssFile'=>'rights.css',
                        'install'=>false,
                        'debug'=>false,
                ),
                
                'administracion',
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
                        'guestName'=>'Invitado',
                        'class'=>'RWebUser',
		),
            
                'authManager'=>array(
                        'class'=>'RDbAuthManager',
                        'defaultRoles'=>array('Invitado', 'Usuario'),
                ),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName'=>false,                        
			'rules'=>array(
//				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
                                '<controller:\w+>/<id:\d+>'=>'<controller>/ver',
                                '<controller:\w+>/<action:\w+>/<id:\d+>/<curso_id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
                 */
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=sisega',
                        //'connectionString' => 'mysql:host=192.168.0.119;dbname=sisega',
			'emulatePrepare' => true,
			'username' => 'sisegauser',
			'password' => 'sisega654321',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
                
                'bootstrap' => array(
                    'class' => 'bootstrap.components.TbApi',   
                ),
                
                'yiiwheels' => array(
                    'class' => 'yiiwheels.YiiWheels',
                ),
                
                'format'=>array(
                    'class'=>'application.components.Formatter',
                ),
                
                'coreMessages'=>array(
                    'basePath'=>null,
                ),
                
                'messages' => array (
                        'extensionPaths' => array(
                                'giix' => 'ext.giix.messages', // giix messages directory.
                        ),
                ),
                 'utilidad'=>array(
                        'class'=>'application.components.Utilidad',
                ),
	),
    
    
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'contacto@raboit.com',
                
                //Aplicación
                'empresa' => 'Universidad de Tarapacá',
                
                //Formatos para fecha, solo modificar si sabe lo que hace
		'dateOutcomeFormat' => 'Y-m-d',
		'dateTimeOutcomeFormat' => 'Y-m-d H:i:s',
		'dateIncomeFormat' => 'yyyy-MM-dd',
		'dateTimeIncomeFormat' => 'yyyy-MM-dd hh:mm:ss',
                
                'dateFormat' => 'dd/mm/yyyy',
                //Yii::app()->locale->dateFormat = dd/MM/yyyy (depende del lenguaje seleccionado)
	),
);