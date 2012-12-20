<?php

return array(
		'resources' => array (
			'router' => array (
				'routes' => array (
					'news' => array (
						'type'     => 'Zend_Controller_Router_Route_Static',
						'route'    => 'news',
						'label'	   => 'Новости',
						'defaults' => array (
							'module' 	 => 'news',
							'controller' => 'index',
							'action' 	 => 'index',			
					 	 ),		
				 	 ),
				 	 'news_item' => array (
				 	 	'type'     => 'Zend_Controller_Router_Route_Regex',
				 	 	'route'    => 'news/(.*).html',
				 	 	'label'    => 'Новость',
				 	 	'defaults' => array (
				 	 		'module' 	 => 'news',
				 	 		'controller' => 'index',
				 	 		'action' 	 => 'news-item',
				 	 		'news_alias' => '',				
				 	 	),
				 	 	'map' 	  => array(1 => 'news_alias'),
				 	 	'reverse' => 'news/%s.html'							
				 	 ),		
				  ),	
			  ),
			  'navigation' => array (
			  	 'pages' => array(
			  		'default/admin-index/index' => array (
			  			'pages' => array (
			  				'news/admin-news-item/index' => array (
			  					'id' => 'news/admin-news-item/index',
			  					'label' => 'Новость',
			  					'module' => 'news',
			  					'controller' => 'admin-news-item',
			  					'action' => 'index',
			  					'pages' => array(
			  						'news/admin-news/index' => array (
			  							'id' => 'news/admin-news/index',
			  							'label' => 'Страница новостей',
			  							'module' => 'news',
			  							'controller' => 'admin-news',
			  							'action' => 'index',				
			  						),
			  					),						
			  				),
			  			), 
			  		),
			  	 ),
			  ),		
		 ),
	);