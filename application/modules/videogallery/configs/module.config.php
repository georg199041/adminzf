<?php

return array(
	'resources'	=> array(
		'router' => array(
			'routes' => array(
				'videogallery' => array(
					'type' 	=> 'Zend_Controller_Router_Route_Static',
					'route'	=> 'videogallery.html',
					'label'	=> 'Видеогалерея',
					'defaults' => array(
						'module'	 => 'videogallery',
						'controller' => 'index',
						'action' 	 => 'index',		
					),			
				),
				'videogallery_album' => array(
					'type' 	=> 'Zend_Controller_Router_Route_Regex',
					'route' => 'videogallery/(.*).html',
					'label' => 'Видеогалерея - альбом',
					'defaults' => array(
						'module' 	   => 'videogallery',
						'controller'   => 'index',
						'action'	   => 'album',
						'action_alias' => '',				
					),
					'map' => array(1 => 'album_alias'),
					'reverse' => 'videogallery/%s.html'						
				),		
			),		
		),
		'navigation' => array(
			'pages' => array(
				'default/admin-index/index' => array(
					'pages' => array(
						'videogallery/admin-images/index' => array(
							'id' 		 => 'videogallery/admin-images/index',
							'label' 	 => 'Видеогалерея',
							'module' 	 => 'videogallery',
							'controller' => 'admin-images',
							'action' 	 => 'index',
							'pages'		 => array(
								'videogallery/admin-albums/index' => array(
									'id'	=> 'videogallery/admin-albums/index',
									'label'	=> 'Альбомы видеогалереи',
									'module' => 'videogallery',
									'controller' => 'admin-albums',
									'action'	=> 'index',					
								),	
							),						
						),	
					),		
				),	
			),	
		),			
	),
);